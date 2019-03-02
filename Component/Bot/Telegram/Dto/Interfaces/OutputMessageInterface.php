<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-02
 * Time: 17:09
 */

interface OutputMessageInterface
{
    public function setChatId($chatId);
    public function getChatId();
    public function toArray();
}