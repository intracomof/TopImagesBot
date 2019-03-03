<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-02
 * Time: 17:58
 */

class GoogleImgSearchMock implements ImagesSearchInterface
{
    private $_apiKey;

    private $_cx;

    private $_mockImagesArr = [
        'http://dps.org.ua/images/net1.png',
        'http://dps.org.ua/images/magnifying_glass.png',
        'https://allnet.me/images/00ce1.png',
        'http://dps.org.ua/images/balls.png',
        'https://allnet.me/images/a3901.png',
        'http://dps.org.ua/images/transport.png',
        'http://dps.org.ua/images/phone.png',
        'http://dps.org.ua/images/mon2.png',
        'https://allnet.me/images/f7b95.png',
        'http://dps.org.ua/images/football.png',
        'http://dps.org.ua/images/palms.png',
        'http://dps.org.ua/images_ser/7317_65_10420',
        'http://dps.org.ua/images_ser/7850_52_10254',
        'http://dps.org.ua/images_ser/9995_38_10827',
        'https://allnet.me/images/f2c94.png',
        'https://allnet.me/images/dc089.png',
    ];

    /**
     * GoogleCustomSearch constructor.
     * @param $apiKey
     * @param $cx
     */
    public function __construct($apiKey, $cx)
    {
        $this->_apiKey = $apiKey;
        $this->_cx = $cx;
    }

    /**
     * @param ImageCollection $imageCollection
     * @param $query
     * @param int $limit
     */
    public function getImagesByQuery($imageCollection, $query, $limit = 50)
    {
        foreach($this->_mockImagesArr as $key => $value) {
            $imageCollection->addImage(new Image($key, $value));
        }
    }
}