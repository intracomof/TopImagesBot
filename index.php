<?php

include_once 'autoload.php';

$telegramBot = new TelegramBot(Config::$telegramApiKey);

$botLogic = new BotLogic($telegramBot);

$botLogic->start();