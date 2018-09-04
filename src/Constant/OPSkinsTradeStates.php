<?php

namespace OmerKocaoglu\OPSkinsTradeService\Constant;

class OPSkinsTradeStates
{
    const ACTIVE = 2;
    const ACCEPTED = 3;
    const EXPIRED = 5;
    const CANCELED = 6;
    const DECLINED = 7;
    const INVALID_ITEMS = 8;
    const PENDING_CASE_OPEN = 9;
    const EXPIRED_CASE_OPEN = 10;
    const FAILED_CASE_OPEN = 12;

    const ALL = [
        self::ACTIVE => 2,
        self::ACCEPTED => 3,
        self::EXPIRED => 5,
        self::CANCELED => 6,
        self::DECLINED => 7,
        self::INVALID_ITEMS => 8,
        self::PENDING_CASE_OPEN => 9,
        self::EXPIRED_CASE_OPEN => 10,
        self::FAILED_CASE_OPEN => 12
    ];
}
