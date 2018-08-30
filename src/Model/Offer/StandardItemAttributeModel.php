<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\Offer;

use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;

class StandardItemAttributeModel implements NormalizableInterface
{
    /** @var string */
    public $category = null;
    /** @var string */
    public $eth_inspect = null;
    /** @var string */
    public $image_generic_360 = null;
    /** @var string */
    public $image_generic_600 = null;
    /** @var string */
    public $inspect = null;
    /** @var int */
    public $paint_index = 0;
    /** @var int */
    public $pattern_index = 0;
    /** @var string */
    public $preview_url_back_image = null;
    /** @var string */
    public $preview_url_front_image = null;
    /** @var string */
    public $preview_url_thumb_image = null;
    /** @var string */
    public $preview_url_video = null;
    /** @var string */
    public $rarity = null;
    /** @var int */
    public $sku = 0;
    /** @var int */
    public $suggested_price_floor = 0;
    /** @var string */
    public $trade_hold_expires = null;
    /** @var string */
    public $type = null;
    /** @var float */
    public $wear = 0.0;
    /** @var bool */
    public $missing = false;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
    }
}
