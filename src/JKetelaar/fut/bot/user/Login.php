<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\user;

use Curl\Curl;
use JKetelaar\fut\bot\config\Comparisons;
use JKetelaar\fut\bot\config\Configuration;
use JKetelaar\fut\bot\config\URL;
use JKetelaar\fut\bot\errors\login\MainLogin;
use JKetelaar\fut\bot\errors\NulledTokenFunction;
use JKetelaar\fut\bot\web\Parser;

class Login {

    const COOKIE_FILE = '';

    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var User
     */
    private $user;

    /**
     * Login constructor.
     *
     * @param User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
        $this->setupCurl();
    }

    private function setupCurl() {
        $this->curl = new Curl();

        $this->curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
        $this->curl->setOpt(CURLOPT_ENCODING, Configuration::HEADER_ACCEPT_ENCODING);
        $this->curl->setHeader('Accept-Language', Configuration::HEADER_ACCEPT_LANGUAGE);
        $this->curl->setHeader('Cache-Control', Configuration::HEADER_CACHE_CONTROL);
        $this->curl->setHeader('Accept', Configuration::HEADER_ACCEPT);
        $this->curl->setHeader('DNT', Configuration::HEADER_DNT);
        $this->curl->setUserAgent(Configuration::HEADER_USER_AGENT);
        $this->curl->setCookieFile(DATA_DIR . '/cookies.txt');
        $this->curl->setCookieJar(DATA_DIR . '/cookies.txt');
    }

    public function login() {
        $loginURL = $this->requestMain();
        $codeURL  = $this->postLoginForm($loginURL);
        $this->postTwoFactorForm($codeURL);

    }

    private function requestMain() {
        $this->curl->get(URL::LOGIN_MAIN);
        if($this->curl->error) {
            throw new MainLogin($this->curl->errorCode, $this->curl->errorMessage);
        }

        $document = Parser::getHTML($this->curl->response);
        $title    = Parser::getDocumentTitle($document);
        if(Parser::getDocumentTitle($document) === Comparisons::MAIN_LOGIN_TITLE) {
            return $this->curl->getInfo(CURLINFO_EFFECTIVE_URL);
        } else {
            throw new MainLogin(261582, 'Page not matching main login (' . $title . ')');
        }
    }

    private function postLoginForm($url) {
        $this->curl->post(
            $url,
            array_merge(
                Configuration::FORM_LOGIN_DEFAULTS,
                [
                    'email'    => $this->user->getUsername(),
                    'password' => $this->user->getPassword(),
                ]
            )
        );

        if($this->curl->error) {
            throw new MainLogin($this->curl->errorCode, $this->curl->errorMessage);
        }

        $document = Parser::getHTML($this->curl->response);
        $title    = Parser::getDocumentTitle($document);

        if($title === Comparisons::LOGIN_FORM_TITLE) {
            return $this->curl->getInfo(CURLINFO_EFFECTIVE_URL);
        } elseif($title === Comparisons::MAIN_LOGIN_TITLE) {
            throw new MainLogin(295712, 'Login failed');
        } else {
            throw new MainLogin(281658, 'Page not matching login form page (' . $title . ')');
        }
    }

    private function postTwoFactorForm($url) {
        $token = $this->user->getToken();
        if($token != null) {
            $this->curl->post(
                $url,
                array_merge(
                    Configuration::FORM_AUTHENTICATION_CODE_DEFAULTS,
                    [
                        'twofactorCode' => $token,
                    ]
                )
            );

            if($this->curl->error) {
                throw new MainLogin($this->curl->errorCode, $this->curl->errorMessage);
            }

            $document = Parser::getHTML($this->curl->response);
            $title    = Parser::getDocumentTitle($document);

            if($title === Comparisons::LOGGED_IN_TITLE) {
                var_dump('Logged in!');
            } elseif($title === Comparisons::MAIN_LOGIN_TITLE) {
                throw new MainLogin(285719, 'Could not login');
            } elseif($title === Comparisons::LOGIN_FORM_TITLE) {
                throw new MainLogin(295712, 'Incorrect verification code');
            } elseif($title === Comparisons::NO_AUTHENTICATOR_FORM_TITLE) {
                throw new MainLogin(224107, 'No authenticator set up');
            } else {
                throw new MainLogin(281752, 'Unknown error/page occurred (' . $title . ')');
            }
        } else {
            throw new NulledTokenFunction();
        }
    }
}