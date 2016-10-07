<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\config;

class URL {
    const REFERER = 'https://www.easports.com/iframe/fut17/?locale=en_US&baseShowoffUrl=https%3A%2F%2Fwww.easports.com%2Fde%2Ffifa%2Fultimate-team%2Fweb-app%2Fshow-off&guest_app_uri=http%3A%2F%2Fwww.easports.com%2Fde%2Ffifa%2Fultimate-team%2Fweb-app';

    // Login URLs
    const LOGIN_MAIN     = 'https://www.easports.com/fifa/ultimate-team/web-app';
    const LOGIN_NUCLEUS  = 'https://www.easports.com/iframe/fut17/?locale=en_US&baseShowoffUrl=https%3A%2F%2Fwww.easports.com%2Fde%2Ffifa%2Fultimate-team%2Fweb-app%2Fshow-off&guest_app_uri=http%3A%2F%2Fwww.easports.com%2Fde%2Ffifa%2Fultimate-team%2Fweb-app';
    const LOGIN_PERSONAS = 'https://www.easports.com/fifa/api/personas';
    const LOGIN_SHARDS   = 'https://www.easports.com/iframe/fut17/p/ut/shards/v2';
    const LOGIN_ACCOUNTS = 'https://www.easports.com/iframe/fut17/p/ut/game/fifa17/user/accountinfo?filterConsoleLogin=true&sku=FUT17WEB&returningUserGameYear=2016&_=';
    const LOGIN_SESSION  = 'https://www.easports.com/iframe/fut17/p/ut/auth';
    const LOGIN_QUESTION = 'https://www.easports.com/iframe/fut17/p/ut/game/fifa17/phishing/question?_=';
    const LOGIN_VALIDATE = 'https://www.easports.com/iframe/fut17/p/ut/game/fifa17/phishing/validate?_=';

    // API Endpoints
    const API_CREDITS               = '/ut/game/fifa17/user/credits';
    const API_TRADEPILE             = '/ut/game/fifa17/tradepile';
    const API_REMOVE_FROM_TRADEPILE = '/ut/game/fifa17/trade/%s'; // Replaceable %s
    const API_WATCHLIST             = '/ut/game/fifa17/watchlist';
    const API_PILESIZE              = '/ut/game/fifa17/clientdata/pileSize';
    const API_RELIST                = '/ut/game/fifa17/auctionhouse/relist';
    const API_TRANSFER_MARKET       = '/ut/game/fifa17/transfermarket?';
    const API_PLACE_BID             = '/ut/game/fifa17/trade/%s/bid'; // Replaceable %s
    const API_LIST_ITEM             = '/ut/game/fifa17/auctionhouse';
    const API_STATUS                = '/ut/game/fifa17/trade/status?';
    const API_ITEM                  = '/ut/game/fifa17/item';
}