<?php

namespace OmerKocaoglu\OPSkinsTradeService\Services;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Assert\AssertionException;
use Fabstract\Component\Serializer\Normalizer\Type;
use OmerKocaoglu\OPSkinsTradeService\Constant\OPSkinsOfferSortTypes;
use OmerKocaoglu\OPSkinsTradeService\Constant\OPSkinsOfferTypes;
use OmerKocaoglu\OPSkinsTradeService\Constant\OPSkinsTradeStates;
use OmerKocaoglu\OPSkinsTradeService\Constant\OPSkinsTradeInterfaces;
use OmerKocaoglu\OPSkinsTradeService\Constant\QueryParameterKeys;
use OmerKocaoglu\OPSkinsTradeService\Model\Offer\AcceptOfferResponseModel;
use OmerKocaoglu\OPSkinsTradeService\Model\Offer\AllOfferResponseModel;
use OmerKocaoglu\OPSkinsTradeService\Model\Offer\SendTradeOfferResponseModel;
use OmerKocaoglu\OPSkinsTradeService\Model\Offer\StandardTradeOfferModel;

class TradeOfferService extends ServiceBase
{
    /** @var string */
    private $api_key = null;
    /** @var string */
    private $trade_url = null;
    /** @var int */
    private $two_fa_code = 0;
    /** @var int[] */
    private $item_id_list = [];
    /** @var int */
    private $page = 0;
    /** @var int */
    private $per_page = 0;
    /** @var int */
    private $uid = 0;
    /** @var string */
    private $type = null;
    /** @var int[] */
    private $state_list = [];
    /** @var string */
    private $sort = null;
    /** @var int[] */
    private $offer_id_list = [];

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
     * @throws AssertionException
     */
    public function setTradeUrl($trade_url)
    {
        if ((new TradeUrlService())->isTradeUrlValid($trade_url) === false) {
            throw new AssertionException('invalid trade url');
        }

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
        Assert::isNotEqualTo($per_page, 0);

        $this->per_page = $per_page;
        return $this;
    }

    /**
     * @param int $uid
     * @return TradeOfferService
     */
    public function setUid($uid)
    {
        Assert::isInt($uid);
        Assert::isNotNegative($uid);
        Assert::isNotEqualTo($uid, 0);

        $this->uid = $uid;
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
     * @param string[] $state_list
     * @return TradeOfferService
     */
    public function setState($state_list)
    {
        Assert::isArrayOfString($state_list);

        foreach ($state_list as $state) {
            Assert::isInArray($state, OPSkinsTradeStates::ALL);

        }

        $this->state_list = $state_list;

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
     * @param int[] $offer_id_list
     */
    public function setOfferIdList($offer_id_list)
    {
        Assert::isArray($offer_id_list);
        foreach ($offer_id_list as $offer_id) {
            Assert::isInt($offer_id);
        }

        $this->offer_id_list = $offer_id_list;
        return;
    }

    /**
     * @return SendTradeOfferResponseModel
     */
    public function sendOffer()
    {
        Assert::isInt($this->two_fa_code);
        Assert::isNotNegative($this->two_fa_code);
        Assert::isNotEqualTo($this->two_fa_code, 0);
        Assert::isString($this->trade_url);
        Assert::isNotEmptyArray($this->item_id_list);

        $url = sprintf(
            OPSkinsTradeInterfaces::SEND_OFFER,
            $this->api_key !== null ? $this->api_key : $this->getServiceConfig()->api_key);

        if ($this->trade_url !== null) {
            $url .= $this->createQueryString(QueryParameterKeys::TRADE_URL, $this->trade_url);
        }

        if ($this->two_fa_code !== 0) {
            $url .= $this->createQueryString(QueryParameterKeys::TWO_FACTOR_CODE, $this->two_fa_code);
        }

        if (count($this->item_id_list) > 0) {
            $url .= $this->createQueryString(QueryParameterKeys::ITEMS, implode(',', $this->item_id_list));
        }

        $content = $this->getClient()->post(substr($url, 0, -1))->getBody()->getContents();
        /** @var SendTradeOfferResponseModel $send_trade_offer_response_model */
        $send_trade_offer_response_model = $this->getJSONSerializer()
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

        $url = sprintf(
            OPSkinsTradeInterfaces::GET_OFFER,
            $this->api_key !== null ? $this->api_key : $this->getServiceConfig()->api_key);

        if (count($this->offer_id_list) > 0) {
            $url .= $this->createQueryString(QueryParameterKeys::OFFER_ID, implode(',', $this->offer_id_list));
        }

        $content = $this->getClient()->get(substr($url, 0, -1))->getBody()->getContents();
        /** @var StandardTradeOfferModel $offer_model */
        $offer_model = $this->getJSONSerializer()
            ->deserialize($content, new Type(StandardTradeOfferModel::class));
        return $offer_model;
    }

    /**
     * @return AllOfferResponseModel
     */
    public function getOffers()
    {
        $url = sprintf(
            OPSkinsTradeInterfaces::GET_OFFERS,
            $this->api_key !== null ? $this->api_key : $this->getServiceConfig()->api_key);

        if ($this->uid !== 0) {
            $url .= $this->createQueryString(QueryParameterKeys::UID, $this->uid);
        }

        if (count($this->state_list) > 0) {
            $url .= $this->createQueryString(QueryParameterKeys::STATE, implode(',', $this->state_list));
        }

        if ($this->type !== null) {
            $url .= $this->createQueryString(QueryParameterKeys::TYPE, $this->type);
        }

        if ($this->page !== 0) {
            $url .= $this->createQueryString(QueryParameterKeys::PAGE, $this->page);
        }

        if ($this->per_page !== 0) {
            $url .= $this->createQueryString(QueryParameterKeys::PER_PAGE, $this->per_page);
        }

        if ($this->sort !== null) {
            $url .= $this->createQueryString(QueryParameterKeys::SORT, $this->sort);
        }

        if (count($this->offer_id_list) > 0) {
            $url .= $this->createQueryString(QueryParameterKeys::OFFER_ID, implode(',', $this->offer_id_list));
        }

        $content = $this->getClient()->get(substr($url, 0, -1))->getBody()->getContents();
        /** @var AllOfferResponseModel $offer_model */
        $offer_model = $this->getJSONSerializer()
            ->deserialize($content, new Type(AllOfferResponseModel::class));
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

        $url = sprintf(
            OPSkinsTradeInterfaces::CANCEL_OFFER,
            $this->api_key !== null ? $this->api_key : $this->getServiceConfig()->api_key);

        if (count($this->offer_id_list) > 0) {
            $url .= $this->createQueryString(QueryParameterKeys::OFFER_ID, implode(',', $this->offer_id_list));
        }

        $content = $this->getClient()->post(substr($url, 0, -1))->getBody()->getContents();
        /** @var StandardTradeOfferModel $offer_model */
        $offer_model = $this->getJSONSerializer()
            ->deserialize($content, new Type(StandardTradeOfferModel::class));
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

        $url = sprintf(
            OPSkinsTradeInterfaces::ACCEPT_OFFER,
            $this->api_key !== null ? $this->api_key : $this->getServiceConfig()->api_key);

        if (count($this->offer_id_list) !== 0) {
            $url .= $this->createQueryString(QueryParameterKeys::OFFER_ID, implode(',', $this->offer_id_list));
        }

        if ($this->two_fa_code !== 0) {
            $url .= $this->createQueryString(QueryParameterKeys::TWO_FACTOR_CODE, $this->two_fa_code);
        }

        $content = $this->getClient()->post(substr($url, 0, -1))->getBody()->getContents();
        /** @var AcceptOfferResponseModel $accept_offer_model */
        $accept_offer_model = $this->getJSONSerializer()
            ->deserialize($content, new Type(AcceptOfferResponseModel::class));
        return $accept_offer_model;
    }
}
