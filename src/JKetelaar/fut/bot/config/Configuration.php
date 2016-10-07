<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\config;

class Configuration {

    // Headers
    const HEADER_USER_AGENT      = 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko';
    const HEADER_ACCEPT          = 'text/html, application/xhtml+xml, */*';
    const HEADER_ACCEPT_ENCODING = 'gzip, deflate';
    const HEADER_ACCEPT_LANGUAGE = 'en-US,en;q=0.8';
    const HEADER_DNT             = '1';
    const HEADER_CACHE_CONTROL   = 'no-cache';
    const X_UT_EMBED_ERROR       = true;
    const X_UT_ROUTE             = 'https://utas.fut.ea.com';
    const X_REQUESTED_WITH       = 'XMLHttpRequest';

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

    // HTML Classes
    const SIGN_OUT_CLASS = 'eas-nav-global_text--login';
}