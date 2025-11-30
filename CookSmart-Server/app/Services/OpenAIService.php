<?php

namespace App\Services;

class OpenAIService
{
    protected $apiKey;
    protected $baseUrl = "https://api.openai.com/v1/chat/completions";

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function chat($message, $model = "gpt-4o-mini")
    {
        $postData = [
            "model" => $model,
            "messages" => [
                ["role" => "user", "content" => $message]
            ]
        ];

        $ch = curl_init($this->baseUrl);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Bearer " . $this->apiKey
            ],
            CURLOPT_POSTFIELDS => json_encode($postData)
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return [
                "error" => curl_error($ch)
            ];
        }

        curl_close($ch);

        $json = json_decode($response, true);

        if (!isset($json["choices"][0]["message"]["content"])) {
            return [
                "error" => "Invalid OpenAI response",
                "raw" => $json
            ];
        }

        return [
            "content" => $json["choices"][0]["message"]["content"],
            "raw"     => $json
        ];
    }

   
    public function messageOnly($prompt)
    {
        $response = $this->chat($prompt);

        if (isset($response['content'])) {
            return $response['content'];
        }

        return "AI error: no content returned.";
    }
}
