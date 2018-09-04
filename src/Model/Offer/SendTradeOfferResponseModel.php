<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\Offer;

use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;
use Fabstract\Component\Serializer\Normalizer\Type;
use OmerKocaoglu\OPSkinsTradeService\Model\ResponseBase;

class SendTradeOfferResponseModel extends ResponseBase implements NormalizableInterface
{
    /** @var int */
    public $status = 0;
    /** @var int */
    public $time = 0;
    /** @var SendTradeOfferResponseResponseModel */
    public $response = null;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata
            ->registerType('response', new Type(SendTradeOfferResponseResponseModel::class));
    }
}
