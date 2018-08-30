<?php

namespace OmerKocaoglu\OPSkinsTradeService\Model\Offer;

use Fabstract\Component\Serializer\Normalizer\NormalizableInterface;
use Fabstract\Component\Serializer\Normalizer\NormalizationMetadata;
use Fabstract\Component\Serializer\Normalizer\Type;

class StandardTradeOfferModel implements NormalizableInterface
{
    /** @var int */
    public $id = 0;
    /** @var StandardTradeOfferUserModel */
    public $sender = null;
    /** @var StandardTradeOfferUserModel */
    public $recipient = null;
    /** @var int */
    public $state = 0;
    /** @var string */
    public $state_name = null;
    /** @var int */
    public $time_created = 0;
    /** @var int */
    public $time_updated = 0;
    /** @var int */
    public $time_expires = 0;
    /** @var string */
    public $message = null;
    /** @var bool */
    public $is_gift = false;
    /** @var bool */
    public $is_case_opening = false;
    /** @var bool */
    public $sent_by_you = false;

    /**
     * @param NormalizationMetadata $normalization_metadata
     * @return void
     */
    public function configureNormalizationMetadata($normalization_metadata)
    {
        $normalization_metadata
            ->registerType('sender', new Type(StandardTradeOfferUserModel::class))
            ->registerType('recipient', new Type(StandardTradeOfferUserModel::class));
    }
}
