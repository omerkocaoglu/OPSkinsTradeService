<?php

namespace OmerKocaoglu\OPSkinsTradeService\Services;

use Fabstract\Component\Serializer\JSONSerializer;
use Fabstract\Component\Serializer\Normalizer\Type;
use GuzzleHttp\Client;
use OmerKocaoglu\OPSkinsTradeService\Model\Config\ConfigModel;

class ServiceBase
{
    protected $client = null;
    protected $serializer = null;

    protected function getClient()
    {
        if ($this->client === null) {
            $this->client = new Client();
            return $this->client;
        }

        return $this->client;
    }

    /**
     * @param string $key
     * @param string $value
     * @return string
     */
    protected function createQueryString($key, $value)
    {
        return $key . '=' . $value . '&';
    }

    /**
     * @return ConfigModel
     */
    protected function getServiceConfig()
    {
        $config_path = __DIR__ . '/../Config/config.json';
        $config_string = file_get_contents($config_path);
        $serializer = new JSONSerializer();
        return $serializer->deserialize($config_string, new Type(ConfigModel::class));
    }

    /**
     * @return JSONSerializer
     */
    protected function getJSONSerializer()
    {
        if ($this->serializer === null) {
            $this->serializer = new JSONSerializer();
        }

        return $this->serializer;
    }
}
