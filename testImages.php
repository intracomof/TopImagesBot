<?php

include_once 'autoload.php';

$query = 'trump';

$googleImages = new ImageCollection();
$bingImages = new ImageCollection();

$googleImgSearch = new GoogleImgSearch(Config::$googleApiKey, Config::$googleCx);
$googleImgSearch->getImagesByQuery($googleImages, $query, 100);


$bingImgSearch = new BingImgSearch(Config::$bingApiKey);
$bingImgSearch->getImagesByQuery($bingImages, $query, 100);


$topImagesCollection = new ImageCollection();
$topImages = new TopImages($googleImages, $bingImages, $topImagesCollection);

$topImages->getAvgTopImages();

echo "<pre>";
print_r($topImagesCollection);