<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api\config;

abstract class Configuration {
    const FUT_YEAR = 2017;

    // Headers
    const HEADER_USER_AGENT      = 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko';
    const HEADER_ACCEPT          = 'text/html, application/xhtml+xml, */*';
    const HEADER_ACCEPT_ENCODING = 'gzip, deflate';
    const HEADER_ACCEPT_LANGUAGE = 'en-US,en;q=0.8';
    const HEADER_DNT             = '1';
    const HEADER_CACHE_CONTROL   = 'no-cache';
    const X_UT_EMBED_ERROR       = true;
    const X_UT_ROUTE             = 'https://utas.external.fut.ea.com';
    const X_REQUESTED_WITH       = 'XMLHttpRequest';

    const X_UT_ROUTE_PARAM = 'X-UT-Route';

    // Forms defaults
    const FORM_LOGIN_DEFAULTS = [
        '_rememberMe'  => 'on',
        'rememberMe'   => 'on',
        '_eventId'     => 'submit',
        'facebookAuth' => '',
    ];

    const FORM_AUTHENTICATION_CODE_DEFAULTS = [
        '_eventId'         => 'submit',
        '_trustThisDevice' => 'on',
        'trustThisDevice'  => 'on',
    ];

    const DEFAULT_SESSION_FORM_DATA = [
        'isReadOnly'     => false,
        'sku'            => 'FUT17WEB',
        'clientVersion'  => 1,
        'locale'         => 'en-GB',
        'method'         => 'authcode',
        'priorityLevel'  => 4,
        'identification' => [ 'authCode' => '' ],
    ];

    // HTML Classes
    const SIGN_OUT_CLASS = 'eas-nav-global_text--login';
}