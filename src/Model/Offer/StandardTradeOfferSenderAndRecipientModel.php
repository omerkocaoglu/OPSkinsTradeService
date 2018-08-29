<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\Offer;

use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;
use Fabstract\Component\Serializer\Normalizer\Type;
use OmerKocaoglu\OPSkinsTradeService\Model\Item\StandardItemModel;

class StandardTradeOfferSenderAndRecipientModel implements NormalizableInterface
{
    /** @var int */
    public $uid = 0;
    /** @var string */
    public $steam_id = null;
    /** @var string */
    public $display_name = null;
    /** @var string */
    public $avatar = null;
    /** @var bool */
    public $verified = false;
    /** @var StandardItemModel */
    public $items = null;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata
            ->registerType('items', new Type(StandardItemModel::class));
    }
}
