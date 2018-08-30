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
    public $internal_app_id = 0;
    /** @var string */
    public $name = null;
    /** @var string */
    public $color = null;
    /** @var string */
    public $image = null;
    /** @var int */
    public $suggested_price = 0;
    /** @var bool */
    public $tradable = false;
    /** @var StandardItemAttributeModel */
    public $attributes = null;

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
