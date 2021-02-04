<?php

namespace App\Support;

Abstract Class ProviderAdaptor
{
    private $url;
    protected $items;
    public $provider_id;

    public function __construct(int $id, string $url)
    {
        $this->url = $url;
        $this->provider_id = $id;
        $this->items = $this->readUrl();
    }

    private function readUrl()
    {
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $this->url);
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $jsonData = json_decode(curl_exec($curlSession));
        curl_close($curlSession);

        return $jsonData;
    }

    abstract protected function getValues();
}