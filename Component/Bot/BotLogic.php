<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-03
 * Time: 19:55
 */

class BotLogic
{
    protected $_bot;
    /**
     * BotLogic constructor.
     * @param BotInterface $bot
     */
    public function __construct($bot)
    {
        $this->_bot = $bot;
    }

    public function start()
    {
        $this->_bot->receiveWebhook();

        $query = $this->_bot->getInputMessage()->getMessageText();

        $images = $this->_findTopImages($query);

        /** @var Image $image */
        foreach($images as $image)
        {
            $outputMessage = new PhotoMessage(
                [
                    'chat_id' => $this->_bot->getInputMessage()->getChatId(),
                    'photo' => $image->getLink()
                ]
            );

            $this->_bot->setOutputMessage($outputMessage);

            $this->_bot->sendPhoto();
        }
    }

    /**
     * @param $query
     * @return ImageCollection TopImages
     */
    protected function _findTopImages($query)
    {
        $bingImages = new ImageCollection();
        $bingImgSearch = new BingImgSearchMock(Config::$bingApiKey);
        $bingImgSearch->getImagesByQuery($bingImages, $query, 20);

        $googleImages = new ImageCollection();
        $googleImgSearch = new GoogleImgSearchMock(Config::$googleApiKey, Config::$googleCx);
        $googleImgSearch->getImagesByQuery($googleImages, $query, 20);


        $topImagesCollection = new ImageCollection();
        $topImages = new TopImages($googleImages, $bingImages, $topImagesCollection);
        $topImages->getAvgTopImages();

        unset($googleImages);
        unset($bingImages);
        unset($googleImgSearch);
        unset($bingImgSearch);
        unset($topImages);

        return $topImagesCollection;
    }
}