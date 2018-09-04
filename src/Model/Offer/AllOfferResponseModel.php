<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\Offer;

use Fabstract\Component\Serializer\Normalizer\ArrayType;
use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;
use OmerKocaoglu\OPSkinsTradeService\Model\ResponseBase;

class AllOfferResponseModel extends ResponseBase implements NormalizableInterface
{
    /** @var int */
    public $status = 0;
    /** @var int */
    public $time = 0;
    /** @var int */
    public $current_page = 0;
    /** @var int */
    public $total_pages = 0;
    /** @var AllOfferResponseResponseModel */
    public $response = null;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata->registerType('offers', new ArrayType(StandardTradeOfferModel::class));
    }
}
