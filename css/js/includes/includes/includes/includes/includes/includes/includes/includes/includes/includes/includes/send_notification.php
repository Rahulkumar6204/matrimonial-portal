<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

$factory = (new Factory)->withServiceAccount('path/to/your/firebase-credentials.json');
$messaging = $factory->createMessaging();

$message = CloudMessage::fromArray([
    'token' => 'USER_FCM_TOKEN', // Replace with the user's FCM token
    'notification' => [
        'title' => 'New Match!',
        'body' => 'You have a new match with John Doe.',
    ],
]);

$messaging->send($message);
?>
