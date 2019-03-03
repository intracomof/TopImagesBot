<?php

include_once 'Config/Config.php';
include_once 'Component/Bot/BotInterface.php';
include_once 'Component/Bot/BotLogic.php';
include_once 'Component/Bot/Telegram/TelegramBot.php';
include_once 'Component/Bot/Telegram/Dto/Interfaces/OutputMessageInterface.php';
include_once 'Component/Bot/Telegram/Dto/InputMessage.php';
include_once 'Component/Bot/Telegram/Dto/PhotoMessage.php';
include_once 'Component/ImagesSearch/TopImages.php';
include_once 'Component/ImagesSearch/ImagesSearchInterface.php';
include_once 'Component/ImagesSearch/Google/GoogleImgSearch.php';
include_once 'Component/ImagesSearch/Bing/BingImgSearch.php';
include_once 'Component/Image/Image.php';
include_once 'Component/Image/ImageCollection.php';
include_once 'Component/ImagesSearch/Bing/BingImgSearchMock.php';
include_once 'Component/ImagesSearch/Google/GoogleImgSearchMock.php';
