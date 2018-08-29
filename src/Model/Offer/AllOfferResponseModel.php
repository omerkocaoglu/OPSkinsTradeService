<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\Offer;

use Fabstract\Component\Serializer\Normalizer\ArrayType;
use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;

class AllOfferResponseModel implements NormalizableInterface
{
    /** @var StandardTradeOfferModel[] */
    public $offers = [];
    /** @var int */
    public $total = 0;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata->registerType('offers', new ArrayType(StandardTradeOfferModel::class));
    }
}
