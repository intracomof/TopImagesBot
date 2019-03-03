<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-02
 * Time: 17:58
 */

class BingImgSearchMock implements ImagesSearchInterface
{
    private $_apiKey;

    private $_mockImagesArr = [
        'http://dps.org.ua/images_ser/9995_38_10827',
        'https://allnet.me/images/dc089.png',
        'https://allnet.me/images/a3901.png',
        'https://allnet.me/images/f7b95.png',
        'https://allnet.me/images/00ce1.png',
        'https://allnet.me/images/f2c94.png',
        'https://allnet.me/images/4f06b.png',
        'https://allnet.me/images/db03e.png',
        'https://allnet.me/images/5c39e.png',
        'https://allnet.me/images/f0885.png',
        'https://allnet.me/images/40368.png',
        'https://allnet.me/images/41dfe.png',
        'https://allnet.me/images/d45e9.png',
        'https://allnet.me/images/a8b41.png',
        'https://allnet.me/images/fcffb.png',
        'https://allnet.me/images/a8c55.png',
        'https://allnet.me/images/92727.png',
        'http://dps.org.ua/images/football.png',
    ];

    /**
     * BingImgSearch constructor.
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->_apiKey = $apiKey;
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