<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\TradeUrl;

use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;
use Fabstract\Component\Serializer\Normalizer\Type;
use OmerKocaoglu\OPSkinsTradeService\Model\ResponseBase;

class TradeUrlResponseModel extends ResponseBase implements NormalizableInterface
{
    /** @var int */
    public $status = 0;
    /** @var int */
    public $time = 0;
    /** @var TradeUrlModel */
    public $response = null;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata->registerType('response', new Type(TradeUrlModel::class));
    }
}
