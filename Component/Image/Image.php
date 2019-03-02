<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-02
 * Time: 20:22
 */

class Image
{
    private $_position;
    private $_link;

    /**
     * Image constructor.
     * @param $position
     * @param $link
     */
    public function __construct($position, $link)
    {
        $this->_position = $position;
        $this->_link = $link;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->_position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->_position = $position;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->_link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->_link = $link;
    }



}