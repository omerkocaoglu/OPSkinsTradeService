<?php

namespace OmerKocaoglu\OPSkinsTradeService\Constant;

class RegexPatterns
{
    const TRADE_URL_SHORT = '/^https:\/\/trade\.opskins\.com\/t\/(?<uid>\d+)\/\w+$/i';
    const TRADE_URL_LONG = '^https:\/\/trade\.opskins\.com\/trade\/userid\/(?<uid>\d+)\/token\/(?<token>\w+)$';
    const APP_ID = '/^[1-9]$/';
}
