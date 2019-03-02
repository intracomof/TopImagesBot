<?php
/**
 * Created by PhpStorm.
 * User: oleksandrpinchuk
 * Date: 2019-03-02
 * Time: 16:46
 */

class TelegramBot
{
    const TYPE_POST = 'post';
    const TYPE_GET = 'get';

    private $_apiKey;

    private $_apiBaseUrl = 'https://api.telegram.org/bot';

    /** @var InputMessage */
    private $_inputMessage;

    /** @var PhotoMessage */
    private $_outputPhotoMessage;

    /**
     * TelegramBot constructor.
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->_apiKey = $apiKey;
        $this->_apiBaseUrl .= $apiKey;
    }

    /**
     *
     */
    public function getWebhook()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $this->setInputMessage(new InputMessage($body));
    }

    /**
     * @param InputMessage $inputMessage
     */
    public function setInputMessage($inputMessage)
    {
        $this->_inputMessage = $inputMessage;
    }

    /**
     * @return InputMessage
     */
    public function getInputMessage()
    {
        return $this->_inputMessage;
    }

    /**
     * @param OutputMessageInterface $outputPhotoMessage
     */
    public function setOutputMessage($outputPhotoMessage)
    {
        $this->_outputPhotoMessage = $outputPhotoMessage;
    }

    public function sendPhoto()
    {
        $this->_call('/sendPhoto', $this->_outputPhotoMessage->toArray());
    }

    /**
     * @param $url
     * @param $data
     * @param string $type
     * @return mixed
     */
    protected function _call($url, $data, $type = self::TYPE_POST)
    {
        $headers = [
            'Content-Type: application/json',
        ];

        if ($type == self::TYPE_GET) {
            $url .= '?'.http_build_query($data);
        }

        $curl = curl_init($this->_apiBaseUrl . $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        if($type == self::TYPE_POST) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $return = curl_exec($curl);

        curl_close($curl);

        return json_decode($return, true);
    }

}

