<?php

namespace OmerKocaoglu\OPSkinsTradeService\Services;

use Fabstract\Component\Http\Injectable;
use Fabstract\Component\Serializer\Normalizer\Type;
use GuzzleHttp\Client;
use OmerKocaoglu\OPSkinsTradeService\Model\Config\ConfigModel;

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

    /**
     * @param string $url
     * @param int $page
     * @return string
     */
    protected function addPageToUrl($url, $page)
    {
        $url .= ('&page=' . $page);
        return $url;
    }

    /**
     * @param string $url
     * @param int $per_page
     * @return string
     */
    protected function addPerPageToUrl($url, $per_page)
    {
        $url .= ('&per_page=' . $per_page);
        return $url;
    }

    /**
     * @param string $url
     * @param int $sort
     * @return string
     */
    protected function addInventorySortToUrl($url, $sort)
    {
        $url .= ('&sort=' . $sort);
        return $url;
    }

    /**
     * @param string $url
     * @param string $sort
     * @return string
     */
    protected function addOfferSortToUrl($url, $sort)
    {
        $url .= ('&sort=' . $sort);
        return $url;
    }

    /**
     * @param string $url
     * @param int $uid
     * @return string
     */
    protected function addUidToUrl($url, $uid)
    {
        $url .= ('&uid=' . $uid);
        return $url;
    }

    /**
     * @param string $url
     * @param int $state
     * @return string
     */
    protected function addStateToUrl($url, $state)
    {
        $url .= ('&state=' . $state);
        return $url;
    }

    /**
     * @param string $url
     * @param string $type
     * @return string
     */
    protected function addTypeToUrl($url, $type)
    {
        $url .= ('&type=' . $type);
        return $url;
    }

    /**
     * @return ConfigModel
     */
    protected function getServiceConfig()
    {
        $config_path = __DIR__ . '../Config/config.json';
        $config_string = file_get_contents($config_path);
        return $this->serializer->deserialize($config_string, new Type(ConfigModel::class));
    }
}
