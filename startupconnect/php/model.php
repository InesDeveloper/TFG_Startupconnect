<?php

function getGPTResponse($prompt) {
    $apiKey = "sk-proj-KBWf2jmAK0rYFc4W6iXvT3BlbkFJMvbqnXMJTJleiRcGr9gy";
    $url = 'https://api.openai.com/v1/chat/completions'; 
    $orgID = 'org-8i39aebGBBwH6EpCTRCWbRnI';
    
    $headers = array(
        "Authorization: Bearer {$apiKey}",
        "OpenAI-Organization: {$orgID}", 
        "Content-Type: application/json"
    );

    // Define messages
    $messages = array();
    $message = array();
    $message["role"] = "user";
    $message["content"] = $prompt;
    $messages[] = $message;

    // Define data
    $data = array();
    $data["model"] = "gpt-3.5-turbo";
    $data["messages"] = $messages;
    $data["max_tokens"] = 100;
    
    // init curl
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
    $result = curl_exec($curl);
    if (curl_errno($curl)) {
        return 'Error:' . curl_error($curl);
    } else {
        $jsonResponse = json_decode($result);
        $message_content = $jsonResponse->choices[0]->message->content;
        return $message_content;
    }
    
    curl_close($curl);
}
?>