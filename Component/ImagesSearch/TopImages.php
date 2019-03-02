<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-02
 * Time: 23:54
 */
class TopImages
{
    protected $_maxImgCount;
    protected $_googleImages;
    protected $_bingImages;
    protected $_topImages;

    /**
     * TopImages constructor.
     * @param ImageCollection $googleImages
     * @param ImageCollection $bingImages
     * @param ImageCollection $topImages
     * @param int $maxImgCount
     */
    public function __construct($googleImages, $bingImages, $topImages, $maxImgCount = 5)
    {
        $this->_googleImages = $googleImages;
        $this->_bingImages = $bingImages;
        $this->_topImages = $topImages;
        $this->_maxImgCount = $maxImgCount;
    }

    public function getAvgTopImages()
    {
        /** @var Image $gImage */
        foreach($this->_googleImages as $gImage) {
            /** @var Image $bImage */
            foreach($this->_bingImages as $bImage) {
                if($gImage->getLink() == $bImage->getLink()) {
                    $newPosition = ($gImage->getPosition() + $bImage->getPosition())/2;
                    print_r($this->_bingImages->key());
                    $this->_topImages->addImage(new Image($newPosition, $gImage->getLink()));
                }
            }
        }
    }
}