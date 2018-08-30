<?php

namespace OmerKocaoglu\OPSkinsTradeService\Services;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Serializer\Normalizer\Type;
use OmerKocaoglu\OPSkinsTradeService\Constant\OPSkinsOfferSortTypes;
use OmerKocaoglu\OPSkinsTradeService\Constant\OPSkinsOfferTypes;
use OmerKocaoglu\OPSkinsTradeService\Constant\OPSkinsTradeStates;
use OmerKocaoglu\OPSkinsTradeService\Constant\OPSkinsTradeInterfaces;
use OmerKocaoglu\OPSkinsTradeService\Model\Offer\AcceptOfferResponseModel;
use OmerKocaoglu\OPSkinsTradeService\Model\Offer\AllOfferResponseModel;
use OmerKocaoglu\OPSkinsTradeService\Model\Offer\SendTradeOfferResponseModel;
use OmerKocaoglu\OPSkinsTradeService\Model\Offer\StandardTradeOfferModel;

class TradeOfferService extends ServiceBase
{
    /** @var string */
    private $api_key = 'a10c27d7173b85889e26e29a8bf91a';
    /** @var string */
    private $trade_url = null;
    /** @var int[] */
    private $item_id_list = [];
    /** @var int */
    private $two_fa_code = 0;
    /** @var int */
    private $user_id = 0;
    /** @var int */
    private $page = 0;
    /** @var int */
    private $per_page = 0;
    /** @var string */
    private $type = null;
    /** @var int */
    private $state = 0;
    /** @var string */
    private $sort = null;

    /**
     * @param string $api_key
     * @return TradeOfferService
     */
    public function setApiKey($api_key)
    {
        Assert::isString($api_key);

        $this->api_key = $api_key;
        return $this;
    }

    /**
     * @param string $trade_url
     * @return TradeOfferService
     */
    public function setTradeUrl($trade_url)
    {
        Assert::isRegexMatches($trade_url, '/https:\/\/trade.opskins.com\/t\/[0-9]*\/\w*$/');

        $this->trade_url = $trade_url;
        return $this;
    }

    /**
     * @param int $two_fa_code
     * @return TradeOfferService
     */
    public function setTwoFaCode($two_fa_code)
    {
        Assert::isInt($two_fa_code);
        Assert::isNotNegative($two_fa_code);

        $this->two_fa_code = $two_fa_code;
        return $this;
    }

    /**
     * @param int[] $item_id_list
     * @return TradeOfferService
     */
    public function setTradeItems($item_id_list)
    {
        Assert::isArray($item_id_list);
        foreach ($item_id_list as $item_id) {
            Assert::isInt($item_id);
        }

        $this->item_id_list = $item_id_list;
        return $this;
    }

    /**
     * @param int $page
     * @return TradeOfferService
     */
    public function setPage($page)
    {
        Assert::isInt($page);
        Assert::isNotNegative($page);
        Assert::isNotEqualTo($page, 0);

        $this->page = $page;
        return $this;
    }

    /**
     * @param int $per_page
     * @return TradeOfferService
     */
    public function setPerPage($per_page)
    {
        Assert::isInt($per_page);
        Assert::isNotNegative($per_page);

        $this->per_page = $per_page;
        return $this;
    }

    /**
     * @param int $user_id
     * @return TradeOfferService
     */
    public function setUserId($user_id)
    {
        Assert::isInt($user_id);
        Assert::isNotNegative($user_id);
        Assert::isNotEqualTo($user_id, 0);

        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @param string $type
     * @return TradeOfferService
     */
    public function setType($type)
    {
        Assert::isInArray($type, OPSkinsOfferTypes::ALL);

        $this->type = $type;
        return $this;
    }

    /**
     * @param string $state
     * @return TradeOfferService
     */
    public function setState($state)
    {
        Assert::isInArray($state, OPSkinsTradeStates::ALL);
        switch ($state) {
            case OPSkinsTradeStates::ACTIVE:
                $this->state = 2;
                break;
            case OPSkinsTradeStates::ACCEPTED:
                $this->state = 3;
                break;
            case OPSkinsTradeStates::EXPIRED:
                $this->state = 5;
                break;
            case OPSkinsTradeStates::CANCELED:
                $this->state = 6;
                break;
            case OPSkinsTradeStates::DECLINED:
                $this->state = 7;
                break;
            case OPSkinsTradeStates::INVALID_ITEMS:
                $this->state = 8;
                break;
            case OPSkinsTradeStates::PENDING_CASE_OPEN:
                $this->state = 9;
                break;
            case OPSkinsTradeStates::EXPIRED_CASE_OPEN:
                $this->state = 10;
                break;
            case  OPSkinsTradeStates::FAILED_CASE_OPEN:
                $this->state = 12;
                break;
        }

        return $this;
    }

    /**
     * @param string $sort_type
     * @return TradeOfferService
     */
    public function setSort($sort_type)
    {
        Assert::isInArray($sort_type, OPSkinsOfferSortTypes::ALL);

        $this->sort = $sort_type;
        return $this;
    }

    /**
     * @return SendTradeOfferResponseModel
     */
    public function sendOffer()
    {
        Assert::isNotNegative($this->two_fa_code);
        Assert::isNotEqualTo($this->two_fa_code, 0);
        Assert::isNotNull($this->trade_url);
        Assert::isNotEmptyArray($this->item_id_list);

        $url = sprintf(
            OPSkinsTradeInterfaces::SEND_OFFER,
            $this->api_key,
            $this->trade_url,
            $this->two_fa_code,
            implode($this->item_id_list, ','));
        $content = $this->getClient()->post($url)->getBody()->getContents();
        /** @var SendTradeOfferResponseModel $send_trade_offer_response_model */
        $send_trade_offer_response_model = $this
            ->serializer
            ->deserialize($content, new Type(SendTradeOfferResponseModel::class));
        return $send_trade_offer_response_model;
    }

    /**
     * @param int $offer_id
     * @return StandardTradeOfferModel
     */
    public function getOffer($offer_id)
    {
        Assert::isInt($offer_id);
        Assert::isNotNegative($offer_id);
        Assert::isNotEqualTo($offer_id, 0);

        $url = sprintf(OPSkinsTradeInterfaces::GET_OFFER, $this->api_key, $offer_id);
        $content = $this->getClient()->get($url)->getBody()->getContents();
        /** @var StandardTradeOfferModel $offer_model */
        $offer_model = $this->serializer->deserialize($content, new Type(StandardTradeOfferModel::class));
        return $offer_model;
    }

    /**
     * @return AllOfferResponseModel
     */
    public function getOffers()
    {
        $url = sprintf(OPSkinsTradeInterfaces::GET_OFFERS, $this->api_key);
        if ($this->user_id !== 0) {
            $url = $this->addUidToUrl($url, $this->user_id);
        }

        if ($this->state !== 0) {
            $url = $this->addStateToUrl($url, $this->state);
        }

        if ($this->type !== null) {
            $url = $this->addTypeToUrl($url, $this->type);
        }

        if ($this->page !== 0) {
            $url = $this->addPageToUrl($url, $this->page);
        }

        if ($this->per_page !== 0) {
            $url = $this->addPerPageToUrl($url, $this->per_page);
        }

        if ($this->sort !== null) {
            $url = $this->addOfferSortToUrl($url, $this->sort);
        }

        $content = $this->getClient()->get($url)->getBody()->getContents();
        /** @var AllOfferResponseModel $offer_model */
        $offer_model = $this->serializer->deserialize($content, new Type(AllOfferResponseModel::class));
        return $offer_model;
    }

    /**
     * @param int $offer_id
     * @return StandardTradeOfferModel
     */
    public function cancelOffer($offer_id)
    {
        Assert::isInt($offer_id);
        Assert::isNotNegative($offer_id);
        Assert::isNotEqualTo($offer_id, 0);

        $url = sprintf(OPSkinsTradeInterfaces::CANCEL_OFFER, $this->api_key, $offer_id);
        $content = $this->getClient()->post($url)->getBody()->getContents();
        /** @var StandardTradeOfferModel $offer_model */
        $offer_model = $this->serializer->deserialize($content, new Type(StandardTradeOfferModel::class));
        return $offer_model;
    }

    /**
     * @param int $offer_id
     * @return AcceptOfferResponseModel
     */
    public function acceptOffer($offer_id)
    {
        Assert::isInt($offer_id);
        Assert::isNotNegative($offer_id);
        Assert::isNotEqualTo($offer_id, 0);
        Assert::isInt($this->two_fa_code);
        Assert::isNotNegative($this->two_fa_code);
        Assert::isNotEqualTo($this->two_fa_code, 0);

        $url = sprintf(OPSkinsTradeInterfaces::ACCEPT_OFFER, $this->api_key, $offer_id, $this->two_fa_code);
        $content = $this->getClient()->post($url)->getBody()->getContents();
        /** @var AcceptOfferResponseModel $accept_offer_model */
        $accept_offer_model = $this->serializer->deserialize($content, new Type(AcceptOfferResponseModel::class));
        return $accept_offer_model;
    }
}
