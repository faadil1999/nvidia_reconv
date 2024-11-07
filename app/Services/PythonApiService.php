<?php

namespace App\Services;

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
        $response = Http::post("{$this->baseUrl}/send-message/", [
            'content' =>  $request->input('content')
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception("Erreur dans la communication avec l'API Python : " . $response->body());
    }
}
