<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\Item;

use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;
use Fabstract\Component\Serializer\Normalizer\Type;
use OmerKocaoglu\OPSkinsTradeService\Model\Offer\StandardItemAttributeModel;

class StandardItemModel implements NormalizableInterface
{
    /** @var int */
    public $id = 0;
    /** @var int */
    public $sku = 0;
    /** @var int */
    public $wear = 0;
    /** @var int */
    public $pattern_index = 0;
    /** @var string */
    public $previews_urls = null;
    /** @var string */
    public $eth_inspect = null;
    /** @var string */
    public $trade_hold_expires = null;
    /** @var int */
    public $internal_app_id = 0;
    /** @var string */
    public $inspect = null;
    /** @var bool */
    public $tradable = false;
    /** @var string */
    public $name = null;
    /** @var string */
    public $category = null;
    /** @var string */
    public $rarity = null;
    /** @var string */
    public $type = null;
    /** @var string */
    public $paint_index = null;
    /** @var string */
    public $color = null;
    /** @var string */
    public $image = null;
    /** @var int */
    public $suggested_price = 0;
    /** @var int */
    public $suggested_price_floor = 0;


//    /** @var StandardItemAttributeModel */
//    public $attributes = null;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata
            ->registerType('attributes', new Type(StandardItemAttributeModel::class));
    }
}
