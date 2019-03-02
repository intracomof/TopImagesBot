<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-02
 * Time: 17:13
 */

class PhotoMessage implements OutputMessageInterface
{
    private $_photo;

    private $_chatId;

    public function __construct($data)
    {
        $this->_photo = $data['photo'];
        $this->_chatId = $data['chat_id'];
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->_photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->_photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getChatId()
    {
        return $this->_chatId;
    }

    /**
     * @param mixed $chatId
     */
    public function setChatId($chatId)
    {
        $this->_chatId = $chatId;
    }

    public function toArray()
    {
        return [
            'photo' => $this->_photo,
            'chat_id' => $this->_chatId,
        ];
    }


}