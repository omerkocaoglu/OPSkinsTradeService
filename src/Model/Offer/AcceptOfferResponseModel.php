<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\Offer;

use Fabstract\Component\Serializer\Normalizer\ArrayType;
use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;
use Fabstract\Component\Serializer\Normalizer\Type;
use OmerKocaoglu\OPSkinsTradeService\Model\ResponseBase;
use OmerKocaoglu\OPSkinsTradeService\Model\Item\StandardItemModel;

class AcceptOfferResponseModel extends ResponseBase implements NormalizableInterface
{
    /** @var StandardTradeOfferModel */
    public $offer = null;
    /** @var StandardItemModel[] */
    public $new_items = [];
    /** @var int */
    public $failed_cases = 0;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata
            ->registerType('offer', new Type(StandardTradeOfferModel::class))
            ->registerType('new_items', new ArrayType(StandardItemModel::class));
    }
}
