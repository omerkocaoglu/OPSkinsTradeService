<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\App;

use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;
use Fabstract\Component\Serializer\Normalizer\Type;
use OmerKocaoglu\OPSkinsTradeService\Model\ResponseBase;

class SupportedAppModel extends ResponseBase implements NormalizableInterface
{
    /** @var int */
    public $status = 0;
    /** @var int */
    public $time = 0;
    /** @var SupportedAppResponseModel */
    public $response = null;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata->registerType('response', new Type(SupportedAppResponseModel::class));
    }
}
