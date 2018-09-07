<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\Config;

use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;

class ConfigModel implements NormalizableInterface
{
    /** @var int */
    public $user_inventory_page_default_value = 0;
    /** @var int */
    public $user_inventory_per_page_default_value = 0;
    /** @var int */
    public $offer_page_default_value = 0;
    /** @var int */
    public $offer_per_page_default_value = 0;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
    }
}
