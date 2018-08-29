<?php

namespace OmerKocaoglu\OPSkinsTradeService\Services;

use Fabstract\Component\Http\Injectable;
use GuzzleHttp\Client;

class ServiceBase extends Injectable implements ServiceAware
{
    protected $client = null;

    protected function getClient()
    {
        if ($this->client === null) {
            $this->client = new Client();
            return $this->client;
        }

        return $this->client;
    }
}
