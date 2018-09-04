<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\TradeUrl;

use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;
use OmerKocaoglu\OPSkinsTradeService\Model\ResponseBase;

class TradeUrlModel extends ResponseBase implements NormalizableInterface
{
    /** @var int */
    public $uid = 0;
    /** @var string */
    public $token = null;
    /** @var string */
    public $long_url = null;
    /** @var string */
    public $short_url = null;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
    }
}
