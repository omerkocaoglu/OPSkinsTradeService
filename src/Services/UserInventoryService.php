<?php

namespace OmerKocaoglu\OPSkinsTradeService\Services;

use Fabstract\Component\Assert\Assert;
use Fabstract\Component\Serializer\Normalizer\Type;
use OmerKocaoglu\OPSkinsTradeService\Constant\OPSkinsTradeInterfaces;
use OmerKocaoglu\OPSkinsTradeService\Constant\InventorySortParameters;
use OmerKocaoglu\OPSkinsTradeService\Model\Inventory\InventoryResponseModel;

class UserInventoryService extends ServiceBase
{
    /** @var string */
    private $trade_url = null;
    /** @var int */
    private $app_id = 1; //default value's defined as 1 since vgo's internal app id's 1...
    /** @var int */
    private $page = 0;
    /** @var int */
    private $per_page = 0;
    /** @var int */
    private $sort = 0;

    /**
     * @param string $trade_url
     * @return UserInventoryService
     */
    public function setTradeUrl($trade_url)
    {
        Assert::isRegexMatches($trade_url, '/https:\/\/trade.opskins.com\/t\/[0-9]*\/\w*$/');
        $this->trade_url = $trade_url;
        return $this;
    }

    /**
     * @param int $app_id
     * @return UserInventoryService
     */
    public function setAppId($app_id)
    {
        Assert::isRegexMatches($app_id, '/^[1-9]$/');
        $this->app_id = $app_id;
        return $this;
    }

    /**
     * @param int $page
     * @return UserInventoryService
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
     * @return UserInventoryService
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
     * @param string $inventory_sort_parameter
     * @param bool $descending
     * @return UserInventoryService
     */
    public function sort($inventory_sort_parameter, $descending = false)
    {
        Assert::isInArray($inventory_sort_parameter, InventorySortParameters::ALL);
        switch ($inventory_sort_parameter) {
            case InventorySortParameters::NAME:
                if (!$descending) {
                    $this->sort = 1;
                } else {
                    $this->sort = 2;
                }
                break;
            case InventorySortParameters::LAST_UPDATE:
                if (!$descending) {
                    $this->sort = 3;
                } else {
                    $this->sort = 4;
                }
                break;
            case InventorySortParameters::SUGGESTED_PRICE:
                if (!$descending) {
                    $this->sort = 5;
                } else {
                    $this->sort = 6;
                }
                break;
        }
        return $this;
    }

    /**
     * @return null|InventoryResponseModel
     */
    public function getInventory()
    {
        Assert::isNotNull($this->trade_url);
        /** @var int $uid */
        $uid = 0;

        preg_match('/https:\/\/trade.opskins.com\/t\/(?<uid>[0-9]*)\/\w*$/', $this->trade_url, $matches_for_uid);
        if (count($matches_for_uid) > 0 && $matches_for_uid['uid'] !== null) {
            $uid = $matches_for_uid['uid'];
        }

        Assert::isPositive(intval($uid));

        $url = sprintf(OPSkinsTradeInterfaces::GET_INVENTORY, $uid, $this->app_id);

        if ($this->page !== 0) {
            $url = $this->addPageToUrl($url, $this->page);
        }

        if ($this->per_page !== 0) {
            $url = $this->addPerPageToUrl($url, $this->per_page);
        }

        if ($this->sort !== 0) {
            $url = $this->addInventorySortToUrl($url, $this->sort);
        }

        $content = $this->getClient()->get($url)->getBody()->getContents();
        /** @var InventoryResponseModel $inventory_response_model */
        $inventory_response_model = $this
            ->serializer
            ->deserialize($content, new Type(InventoryResponseModel::class));
        return $inventory_response_model;
    }
}
