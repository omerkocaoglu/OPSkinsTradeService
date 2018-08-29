<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\Inventory;

use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;
use Fabstract\Component\Serializer\Normalizer\Type;
use OmerKocaoglu\OPSkinsTradeService\Model\Item\StandardItemModel;

class InventoryResponseModel implements NormalizableInterface
{
    /** @var int */
    public $total = 0;
    /** @var StandardItemModel */
    public $items = null;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata->registerType('items', new Type(StandardItemModel::class));
    }
}
