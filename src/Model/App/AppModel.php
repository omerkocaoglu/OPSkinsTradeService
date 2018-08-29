<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\App;

use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;

class AppModel implements NormalizableInterface
{
    /** @var int */
    public $internal_app_id = 0;
    /** @var int */
    public $steam_app_id = 0;
    /** @var int */
    public $steam_context_id = 0;
    /** @var string */
    public $name = null;
    /** @var string */
    public $long_name = null;
    /** @var string */
    public $img = null;
    /** @var int */
    public $default = 0;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        // TODO: Implement configureNormalizationMetadata() method.
    }
}
