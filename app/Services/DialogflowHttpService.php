<?php

namespace App\Services;

use GuzzleHttp\Client;
use Firebase\JWT\JWT;

class DialogflowHttpService
{
    protected $client;
    protected $projectId;
    protected $token;

    public function __construct()
    {
        $this->projectId = env('DIALOGFLOW_PROJECT_ID');
        $keyFile = storage_path('app/dialogflow-key.json');
        $this->token = $this->getAccessToken($keyFile);

        $this->client = new Client([
            'base_uri' => 'https://dialogflow.googleapis.com/v2/projects/',
        ]);
    }

    private function getAccessToken($keyFile)
    {
        $json = json_decode(file_get_contents($keyFile), true);
        $now  = time();

        $payload = [
            'iss'   => $json['client_email'],
            'scope' => 'https://www.googleapis.com/auth/dialogflow',
            'aud'   => $json['token_uri'],
            'iat'   => $now,
            'exp'   => $now + 3600,
        ];

        $jwt = JWT::encode($payload, $json['private_key'], 'RS256');

        $client = new Client();
        $response = $client->post($json['token_uri'], [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion'  => $jwt,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['access_token'];
    }

    public function detectIntent($sessionId, $text, $languageCode = 'en')
    {
        $url = "{$this->projectId}/agent/sessions/{$sessionId}:detectIntent";

        $response = $this->client->post($url, [
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'query_input' => [
                    'text' => [
                        'text'          => $text,
                        'language_code' => $languageCode,
                    ],
                ],
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['queryResult']['fulfillmentText'] ?? 'No reply';
    }
}
