<?php

namespace OmerKocaoglu\OPSkinsTradeService\Constant;

class OPSkinsTradeInterfaces
{
    const GET_INVENTORY = 'https://api-trade.opskins.com/ITrade/GetUserInventory/v1/?uid=%s&app_id=%s';
    const SEND_OFFER = 'https://%s@api-trade.opskins.com/ITrade/SendOffer/v1/?trade_url=%s&twofactor_code=%s&items=%s';
    const GET_TRADE_URL = 'https://%s@api-trade.opskins.com/ITrade/GetTradeURL/v1/';
    const GET_OFFERS = 'https://%s@api-trade.opskins.com/ITrade/GetOffers/v1/';
    const GET_OFFER = 'https://%s@api-trade.opskins.com/ITrade/GetOffer/v1/?offer_id=%s';
    const GET_ALL_SUPPORTED_APPS = 'https://api-trade.opskins.com/ITrade/GetApps/v1/';
    const CANCEL_OFFER = 'https://%s@api-trade.opskins.com/ITrade/CancelOffer/v1/?offer_id=%s';
    const ACCEPT_OFFER = 'https://%s@api-trade.opskins.com/ITrade/AcceptOffer/v1/?offer_id=%s&twofactor_code=%s';
}
