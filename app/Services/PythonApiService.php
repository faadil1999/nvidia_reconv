<?php

namespace App\Services;

use App\Models\Skill;
use App\Models\CareerPath;
use Brick\Math\BigInteger;
use Illuminate\Http\Request;
use App\Enum\RessourceTypeEnum;
use Illuminate\Support\Facades\Http;

class PythonApiService
{
    protected $baseUrl;


    public function __construct()
    {
        $this->baseUrl = config('services.python_api.url');
    }

    /**
     * Send the message for getting the response of the API python
     *
     * @param string $content
     * @return string
     */
    public function getChatResponse(Request $request)
    {

        $response = Http::timeout(180)->post("{$this->baseUrl}/send-message/", [
            'content' =>  $request->input('content')
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->manageContent($data, $request->input('career_id'));
            return $response->json();
        }

        throw new \Exception("Erreur dans la communication avec l'API Python : " . $response->body());
    }


    /**
     * Create objects based on received text
     *
     * @param String $data, int $careerId
     *
     * @return void
     *
     */
    public function manageContent(array $data, int $careerId)
    {
        $text = $data['completion'];
        $patternIntroduction = '/^(.*?)\n\n(?=\\*\\*Step)/s';
        preg_match($patternIntroduction, $text, $introductionMatch);
        $introduction = trim($introductionMatch[1] ?? '');

        // Modèle de regex pour chaque étape avec title, description, resources et skills
        $stepsPattern = '/\\*\\*Step \\d+: (.*?)\\*\\*\\n\\n\\* \\*\\*Title:\\*\\* (.*?)\\n\\* \\*\\*Description:\\*\\* (.*?)\\n\\* \\*\\*Resources:\\*\\*\\n(.*?)\\n\\* \\*\\*Skills to focus on:\\*\\* (.*?)(?=\\n\\n\\*\\*Step \\d+:|\\n\\n\\*\\*(Additional Recommendations|Additional Tips)\\*\\*)/s';
        preg_match_all($stepsPattern, $text, $stepsMatches, PREG_SET_ORDER);

        // Récupération des étapes et de leurs détails
        $steps = [];
        foreach ($stepsMatches as $step) {
            $stepTitle = trim($step[1]);
            $title = trim($step[2]);
            $description = trim($step[3]);

            // Extraction des ressources ligne par ligne
            $resources = array_map('trim', explode("\n", trim($step[4])));

            // Extraction des compétences (séparées par des virgules)
            $skills = array_map('trim', explode(',', trim($step[5])));

            $steps[] = [
                'step_title' => $stepTitle,
                'title' => $title,
                'description' => $description,
                'resources' => $resources,
                'skills' => $skills
            ];
        }

        // Extraction de la section Additional Recommendations
        $additionalTipsPattern = '/\\*\\*(Additional Recommendations|Additional Tips)\\*\\*\\n(.*)/s';
        preg_match($additionalTipsPattern, $text, $additionalTipsMatch);
        $additionalTips = trim($additionalTipsMatch[2] ?? '');

        $careerPath = CareerPath::create([
            'user_id' => auth()->id(),
            'career_id' => $careerId,
            'introduction' => $introduction,
            'comment'   => $additionalTips
        ]);
        $nbr_step = 0;
        foreach ($steps as $step) {
            $nbr_step++;
            $stepModel = $careerPath->steps()->create([
                'title' => $step['title'],
                'description' => $step['description'],
                'order' => $nbr_step,
            ]);
            foreach ($step['resources'] as $resource) {
                $stepModel->ressources()->create([
                    'name' => $resource,
                ]);
            }
            foreach ($step['skills'] as $skill) {
                $skillModel = Skill::create([
                    'name' => $skill
                ]);
                $careerPath->skills()->attach($skillModel->id);
            }
        }

        dd($introduction, $steps, $additionalTips);
    }
}
