<?php

include_once 'autoload.php';

$telegramBot = new TelegramBot(Config::$telegramApiKey);

$telegramBot->getWebhook();

$photo = 'https://www.howtocookthat.net/public_html/wp-content/uploads/2016/04/hello-kitty-550x335.jpg?x19907';

//echo $telegramBot->getInputMessage()->getMessageText();


$outputMessage = new PhotoMessage(
    [
        'chat_id' => $telegramBot->getInputMessage()->getChatId(),
        'photo' => 'https://www.howtocookthat.net/public_html/wp-content/uploads/2016/04/hello-kitty-550x335.jpg?x19907'
    ]
);

$telegramBot->setOutputMessage($outputMessage);

$telegramBot->sendPhoto();