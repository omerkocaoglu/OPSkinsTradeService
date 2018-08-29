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
    private $page = 1; //default value's defined as 1 since default page value's 1...
    /** @var int */
    private $per_page = 10;
    /** @var int */
    private $sort = 2; //default value's defined 2 since for ascending sorting by name is defined 2 by opskins...

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
        Assert::isPositive($page);
        $this->page = $page;
        return $this;
    }

    /**
     * @param int $per_page
     * @return UserInventoryService
     */
    public function setPerPage($per_page)
    {
        Assert::isPositive($per_page);
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

        Assert::isPositive($uid);

        $url = sprintf(OPSkinsTradeInterfaces::GET_INVENTORY, $uid, $this->app_id);
        $url = $this->addPageToUrl($url);
        $url = $this->addPerPageToUrl($url);
        $url = $this->addSort($url);
        $content = $this->getClient()->get($url)->getBody()->getContents();
        /** @var InventoryResponseModel $inventory_response_model */
        $inventory_response_model = $this
            ->serializer
            ->deserialize($content, new Type(InventoryResponseModel::class));
        return $inventory_response_model;
    }

    /**
     * @param string $url
     * @return string
     */
    private function addPageToUrl($url)
    {
        $url .= ('&page=' . $this->page);
        return $url;
    }

    /**
     * @param string $url
     * @return string
     */
    private function addPerPageToUrl($url)
    {
        $url .= ('&per_page=' . $this->per_page);
        return $url;
    }

    /**
     * @param string $url
     * @return string
     */
    private function addSort($url)
    {
        $url .= ('&sort=' . $this->sort);
        return $url;
    }
}
