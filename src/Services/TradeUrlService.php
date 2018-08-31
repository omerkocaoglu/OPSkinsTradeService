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
