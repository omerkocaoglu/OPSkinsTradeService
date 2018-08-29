<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\Item;

use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;

class StandardItemModel implements NormalizableInterface
{
    /** @var int */
    public $id = 0;
    /** @var int */
    public $internal_app_id = 0;
    /** @var int */
    public $sku = 0;
    /** @var float */
    public $wear = 0.0;
    /** @var int */
    public $trade_hold_expires = 0;
    /** @var null */
    public $name = null;
    /** @var null */
    public $category = null;
    /** @var null */
    public $rarity = null;
    /** @var null */
    public $type = null;
    /** @var null */
    public $color = null;
    /** @var array */
    public $image = [];
    /** @var int */
    public $suggested_price = 0;
    /** @var array */
    public $previews_url = [];
    /** @var null */
    public $inspect = null;
    /** @var int */
    public $pattern_index = 0;
    /** @var int */
    public $paint_index = 0;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
    }
}
