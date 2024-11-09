<?php

namespace App\Services;

use Brick\Math\BigInteger;
use Illuminate\Http\Request;
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
        // Extraction de l'introduction avant les étapes
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
        $additionalTipsPattern = '/\\*\\*(Additional Recommendations|Additional Tips):\\*\\*(.*)/s';
        preg_match($additionalTipsPattern, $text, $additionalTipsMatch);
        $additionalTips = trim($additionalTipsMatch[2] ?? '');



        dd($introduction, $steps, $additionalTips);
    }
}
