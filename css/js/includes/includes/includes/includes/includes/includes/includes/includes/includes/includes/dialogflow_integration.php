<?php
require 'vendor/autoload.php';

use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\TextInput;
use Google\Cloud\Dialogflow\V2\QueryInput;

function detectIntent($text, $sessionId) {
    $sessionsClient = new SessionsClient();
    $session = $sessionsClient->sessionName('your-project-id', $sessionId);
    $textInput = new TextInput();
    $textInput->setText($text);
    $textInput->setLanguageCode('en-US');
    $queryInput = new QueryInput();
    $queryInput->setText($textInput);

    $response = $sessionsClient->detectIntent($session, $queryInput);
    $sessionsClient->close();

    return $response->getQueryResult()->getFulfillmentText();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userMessage = $_POST['message'];
    $sessionId = $_POST['sessionId'];
    $botResponse = detectIntent($userMessage, $sessionId);
    echo json_encode(['response' => $botResponse]);
}
?>
