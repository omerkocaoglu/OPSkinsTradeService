<?php

namespace OmerKocaoglu\OPSkinsTradeService\Constant;

class OPSkinsOfferSortTypes
{
    const CREATED = 'created';
    const EXPIRED = 'expired';
    const MODIFIED = 'modified';

    const ALL = [
        self::CREATED => 'created',
        self::EXPIRED => 'expired',
        self::MODIFIED => 'modified'
    ];
}
