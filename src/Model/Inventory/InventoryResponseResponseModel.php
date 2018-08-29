<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\Inventory;

use Fabstract\Component\Serializer\Normalizer\ArrayType;
use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;
use OmerKocaoglu\OPSkinsTradeService\Model\Item\StandardItemModel;

class InventoryResponseResponseModel implements NormalizableInterface
{
    /** @var StandardItemModel[] */
    public $items = [];
    /** @var int */
    public $total = 0;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata->registerType('items', new ArrayType(StandardItemModel::class));
    }
}
