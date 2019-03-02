<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-02
 * Time: 17:59
 */

interface ImagesSearchInterface
{
    public function getImagesByQuery($imageCollection, $query, $limit);
}