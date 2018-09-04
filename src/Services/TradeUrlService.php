<?php

namespace OmerKocaoglu\OPSkinsTradeService\Services;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Serializer\JSONSerializer;
use Fabstract\Component\Serializer\Normalizer\Type;
use OmerKocaoglu\OPSkinsTradeService\Constant\OPSkinsTradeInterfaces;
use OmerKocaoglu\OPSkinsTradeService\Model\TradeUrl\TradeUrlModel;
use OmerKocaoglu\OPSkinsTradeService\Model\TradeUrl\TradeUrlResponseModel;

class TradeUrlService extends ServiceBase
{
    /** @var string */
    private $api_key = null;

    /**
     * @param string $api_key
     * @return TradeUrlService
     */
    public function setApiKey($api_key)
    {
        Assert::isString($api_key);
        $this->api_key = $api_key;
        return $this;
    }

    /**
     * @param string $trade_url
     * @return bool
     */
    public function isTradeUrlValid($trade_url)
    {
        return preg_match('/https:\/\/trade.opskins.com\/t\/(?<uid>[0-9]*)\/\w*$/', $trade_url) === 1 ? true : false;
    }

    /**
     * @param string $trade_url
     * @return string|null
     */
    public function getUidFromTradeUrl($trade_url)
    {
        preg_match('/https:\/\/trade.opskins.com\/t\/(?<uid>[0-9]*)\/\w*$/', $trade_url, $matches_for_uid);
        if (count($matches_for_uid) > 0 && $matches_for_uid['uid'] !== null) {
            return $matches_for_uid['uid'];
        }

        return null;
    }

    /**
     * @return TradeUrlModel
     */
    public function getTradeUrl()
    {
        $url = sprintf(
            OPSkinsTradeInterfaces::GET_TRADE_URL,
            $this->api_key === null ? $this->getServiceConfig()->api_key : $this->api_key);
        $content = $this->getClient()->get($url)->getBody()->getContents();
        /** @var TradeUrlModel $trade_url_model */
        $trade_url_model = $this->getJSONSerializer()
            ->deserialize($content, new Type(TradeUrlResponseModel::class));
        return $trade_url_model;
    }
}
