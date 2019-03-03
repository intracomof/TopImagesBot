<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-02
 * Time: 20:22
 */

class ImageCollection implements Iterator, Countable
{
    private $images = [];

    private $currentIndex = 0;

    /**
     * @param Image $image
     */
    public function addImage($image)
    {
        $this->images[] = $image;
    }

    public function count()
    {
        return count($this->images);
    }

    public function current()
    {
        return $this->images[$this->currentIndex];
    }

    public function key()
    {
        return $this->currentIndex;
    }

    public function next()
    {
        $this->currentIndex++;
    }

    public function rewind()
    {
        $this->currentIndex = 0;
    }

    public function valid()
    {
        return isset($this->images[$this->currentIndex]);
    }

    public function sortByPosition()
    {
        usort($this->images, function($first, $second){
            /** @var Image $second  */
            /** @var Image $first  */
            return $first->getPosition() > $second->getPosition();
        });

        $this->rewind();
    }

    public function slice($offset, $length)
    {
        $this->images = array_slice($this->images, $offset, $length);
    }

}