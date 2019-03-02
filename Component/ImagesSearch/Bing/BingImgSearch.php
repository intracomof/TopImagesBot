<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-02
 * Time: 17:58
 */

class BingImgSearch implements ImagesSearchInterface
{
    private $_apiKey;

    private $_apiBaseUrl = 'https://api.cognitive.microsoft.com/bing/v7.0/images/search?';

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
        $offset = 0;

        while(count($imageCollection) < $limit) {

            $result = $this->_callApi($query, $offset);

            $offset = $result['nextOffset'];

            $this->_mapResultToImageCollection($imageCollection, $result['value'], $offset);

            usleep(100);
        }
    }

    /**
     * @param $query
     * @param $offset
     * @return mixed
     */
    protected function _callApi($query, $offset)
    {
        $headers = [
            'Ocp-Apim-Subscription-Key: ' . $this->_apiKey,
        ];

        $queryParams = [
            'q' => $query,
            'offset' => $offset,
        ];

        $url = $this->_apiBaseUrl . http_build_query($queryParams);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $return = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($return, true);

        return $result;
    }

    /**
     * @param ImageCollection $imageCollection
     * @param $items
     * @param $offset
     */
    private function _mapResultToImageCollection($imageCollection, $items, $offset)
    {
        foreach($items as $item)
        {
            $imageCollection->addImage(new Image(++$offset, $item['contentUrl']));
        }
    }

}