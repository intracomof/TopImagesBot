<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-02
 * Time: 16:50
 */

class InputMessage
{
    private $_userId;
    private $_chatId;
    private $_messageText = '';

    public function __construct($message)
    {
        $this->_userId = $message['message']['from']['id'];
        $this->_chatId = $message['message']['chat']['id'];

        if(isset($message['message']['text']))
            $this->_messageText = $message['message']['text'];
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * @return mixed
     */
    public function getChatId()
    {
        return $this->_chatId;
    }

    /**
     * @return mixed
     */
    public function getMessageText()
    {
        return $this->_messageText;
    }


}