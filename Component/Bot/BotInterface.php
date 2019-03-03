<?php

interface BotInterface
{
    public function receiveWebhook();

    /**
     * @return InputMessage
     */
    public function getInputMessage();

    public function setOutputMessage($outputMessage);

    public function sendMessage();

    public function sendPhoto();
}
