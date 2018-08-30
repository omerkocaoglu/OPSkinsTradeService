<?php

namespace OmerKocaoglu\OPSkinsTradeService\Constant;

class OPSkinsTradeStates
{
    const ACTIVE = 'active';
    const ACCEPTED = 'accepted';
    const EXPIRED = 'expired';
    const CANCELED = 'canceled';
    const DECLINED = 'declined';
    const INVALID_ITEMS = 'invalid_items';
    const PENDING_CASE_OPEN = 'pending_case_open';
    const EXPIRED_CASE_OPEN = 'expired_case_open';
    const FAILED_CASE_OPEN = 'failed_case_open';

    const ALL = [
        self::ACTIVE => 'active',
        self::ACCEPTED => 'accepted',
        self::EXPIRED => 'expired',
        self::CANCELED => 'canceled',
        self::DECLINED => 'declined',
        self::INVALID_ITEMS => 'invalid_items',
        self::PENDING_CASE_OPEN => 'pending_case_open',
        self::EXPIRED_CASE_OPEN => 'expired_case_open',
        self::FAILED_CASE_OPEN => 'failed_case_open'
    ];
}
