<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-02
 * Time: 17:58
 */

class GoogleImgSearch implements ImagesSearchInterface
{
    const SEARCH_TYPE_IMAGE = 'image';

    const LIMIT = 10;

    private $_fields = 'queries(nextPage(startIndex)),items(link)';

    private $_apiBaseUrl = 'https://www.googleapis.com/customsearch/v1?';

    private $_apiKey;

    private $_cx;

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
        $offset = 0;

        while(count($imageCollection) < $limit) {

            $result = $this->_callApi($query, $offset);

            $offset = $result['queries']['nextPage'][0]['startIndex'];

            $this->_mapResultToImageCollection($imageCollection, $result['items'], $offset);

            usleep(100);
        }
    }

    /**
     * @param $searchQuery
     * @param $offset
     * @return ImageCollection
     */
    protected function _callApi($searchQuery, $offset = 0)
    {
        $queryParams = [
            'key' => $this->_apiKey,
            'cx' => $this->_cx,
            'q' => $searchQuery,
            'searchType' => self::SEARCH_TYPE_IMAGE,
            'fields' => $this->_fields,
            'start' => ++$offset,
        ];

        $url = $this->_apiBaseUrl . http_build_query($queryParams);

        $result = json_decode(file_get_contents($url), true);

        return $result;
    }

    /**
     * @param ImageCollection $imageCollection
     * @param $items
     * @param $offset
     */
    protected function _mapResultToImageCollection($imageCollection, $items, $offset)
    {
        foreach($items as $item)
        {
            $imageCollection->addImage(new Image($offset++, $item['link']));
        }
    }
}