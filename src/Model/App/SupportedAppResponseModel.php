<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\App;

use Fabstract\Component\Serializer\Normalizer\ArrayType;
use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;

class SupportedAppResponseModel implements NormalizableInterface
{
    /** @var AppModel[] */
    public $apps = [];

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata->registerType('apps', new ArrayType(AppModel::class));
    }
}
