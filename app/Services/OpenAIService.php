<?php

namespace App\Services;

use App\Models\Category;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAIService
{
    public function analyzeIncident(string $title, string $description): array
    {
        $categories = Category::pluck('name')->toArray();

        $categoryList = implode(', ', $categories);

        $response = OpenAI::chat()->create([
            'model' => 'gpt-5.6-luna',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "You analyze cybersecurity incidents.

Your tasks are:
1. Generate a short, clear summary of the incident.
2. Predict exactly one category from this list: {$categoryList}.

Return ONLY valid JSON in this format:
{
    \"summary\": \"...\",
    \"category\": \"...\"
}

The category must be exactly one of the categories provided."
                ],
                [
                    'role' => 'user',
                    'content' => "Title: {$title}\nDescription: {$description}",
                ],
            ],
        ]);

        $content = $response->choices[0]->message->content;

        return json_decode($content, true);
    }
}
