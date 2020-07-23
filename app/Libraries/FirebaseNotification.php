<?php

namespace App\Libraries;

class FirebaseNotification
{
    private $recipient=[];
    private $data=[];
    private $serverKey;
    private $fcmEndpoint;

    public function __construct()
    {
        $this->serverKey = 'AAAAhNaO4hk:APA91bHL7zVW-vf3X88xytY6Yult1WSNjWR6Dc5zRoRxsdDgpNXH7kGw_NZdGvDCj9VT6lRzFItcpNi0bYWL_BeBmzC6qiqUsGnz5G3vTzrtIUBSxjMJJkcSF0C8IUk5nukDwfsCchZ8';
        $this->fcmEndpoint = 'https://fcm.googleapis.com/fcm/send';
    }

    /**
     * @return array
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param array $recipient
     */
    public function setRecipient(array $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return string
     */
    public function getServerKey()
    {
        return $this->serverKey;
    }

    /**
     * @param string $serverKey
     */
    public function setServerKey($serverKey)
    {
        $this->serverKey = $serverKey;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getFcmEndpoint()
    {
        return $this->fcmEndpoint;
    }

    /**
     * @param string $fcmEndpoint
     */
    public function setFcmEndpoint($fcmEndpoint)
    {
        $this->fcmEndpoint = $fcmEndpoint;
    }


    /**
     *  @return array
     *  of header to firebase with server key
     */
    public function getHeader(){
        return [
            'Authorization:key='.$this->getServerKey(),
            'Content-Type:application/json'
        ];
    }
    /**
     *  @return array
     *  of fields to firebase with data
     */
    public function getFields(){
        return [
            'registration_ids' => $this->getRecipient(),
            'content-available' => true,
            'priority' => 'high',
            'data' => $this->getData(),
            'notification' => $this->getData()
        ];
    }
    /**
     * execution send notification function
     */
    public function FCMSend()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->getFcmEndpoint());
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeader());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->getFields()));
        $result = json_decode(curl_exec($ch));
        curl_close($ch);

        return $result;
    }
}