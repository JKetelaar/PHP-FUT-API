<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\user;

use Curl\Curl;
use Fut\EAHashor;
use JKetelaar\fut\bot\API;
use JKetelaar\fut\bot\config\Comparisons;
use JKetelaar\fut\bot\config\Configuration;
use JKetelaar\fut\bot\config\URL;
use JKetelaar\fut\bot\errors\CaptchaException;
use JKetelaar\fut\bot\errors\login\MainLogin;
use JKetelaar\fut\bot\errors\NulledTokenFunction;
use JKetelaar\fut\bot\web\Parser;

class Login {

    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var string Path to cookies file
     */
    private $path;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $nucleusId;

    /**
     * @var array
     */
    private $shardInfos;

    /**
     * @var array
     */
    private $persona;

    /**
     * @var array
     */
    private $session;

    /**
     * Login constructor.
     *
     * @param User   $user
     * @param string $path
     */
    public function __construct(User $user, $path) {
        $this->user = $user;
        $this->path = $path;
        $this->curl = $this->setupCurl();
    }

    private function setupCurl() {
        // Some pages are more than 2MB, so we have to reserve some extra space
        define('MAX_FILE_SIZE', 5 * 1000 * 1000);

        $curl = new Curl();

        $curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
        $curl->setOpt(CURLOPT_ENCODING, Configuration::HEADER_ACCEPT_ENCODING);
        $curl->setHeader('Accept-Language', Configuration::HEADER_ACCEPT_LANGUAGE);
        $curl->setHeader('Cache-Control', Configuration::HEADER_CACHE_CONTROL);
        $curl->setHeader('Accept', Configuration::HEADER_ACCEPT);
        $curl->setHeader('DNT', Configuration::HEADER_DNT);
        $curl->setUserAgent(Configuration::HEADER_USER_AGENT);
        $curl->setCookieFile($this->path);
        $curl->setCookieJar($this->path);

        return $curl;
    }

    public function login() {
        $result = false;
        if(($resultMain = $this->requestMain()) != null) {
            if( !is_bool($resultMain)) {
                $codeURL = $this->postLoginForm($resultMain);

                $result = $this->postTwoFactorForm($codeURL);
            } else {
                $result = $resultMain;
            }
        }

        if( !is_bool($result)) {
            throw new MainLogin(298175, 'Unknown result given by flow');
        }

        return $result;
    }

    private function requestMain() {
        $this->curl->get(URL::LOGIN_MAIN);
        if($this->curl->error) {
            throw new MainLogin($this->curl->errorCode, $this->curl->errorMessage);
        }

        $document = Parser::getHTML($this->curl->response);
        $title    = Parser::getDocumentTitle($document);

        if($this->isLoggedInPage($title)) {
            return $this->getFUTPage();
        }

        if(Parser::getDocumentTitle($document) === Comparisons::MAIN_LOGIN_TITLE) {
            return $this->curl->getInfo(CURLINFO_EFFECTIVE_URL);
        } else {
            throw new MainLogin(261582, 'Page not matching main login (' . $title . ')');
        }
    }

    private function isLoggedInPage($title) {
        return $title === Comparisons::LOGGED_IN_TITLE;
    }

    private function getFUTPage() {
        $this->curl->get(URL::LOGIN_NUCLEUS);

        if($this->curl->error) {
            throw new MainLogin($this->curl->errorCode, $this->curl->errorMessage);
        }

        preg_match('/EASW_ID\W*=\W*\'(\d*)\'/', $this->curl->response, $matches);
        if(count($matches > 1) && ($id = $matches[ 1 ]) != null) {
            $this->nucleusId = $id;

            return $this->getShards($id);
        } else {
            throw new MainLogin(295717, 'Could not find EAWS ID');
        }
    }

    private function getShards($id = null) {
        if($id == null) {
            $id = $this->nucleusId;
        }

        $tempCurl = &$this->curl;
        $tempCurl->setOpt(CURLOPT_HTTPHEADER, [ 'Content-Type:application/json' ]);
        $tempCurl->setHeaders(
            [
                'Easw-Session-Data-Nucleus-Id' => $id,
                'X-UT-Embed-Error'             => Configuration::X_UT_EMBED_ERROR,
                'X-UT-Route'                   => Configuration::X_UT_ROUTE,
                'X-Requested-With'             => Configuration::X_REQUESTED_WITH,
                'Referer'                      => URL::REFERER,
            ]
        );

        $tempCurl->get(URL::LOGIN_SHARDS);

        if($tempCurl->error) {
            throw new MainLogin($tempCurl->errorCode, $tempCurl->errorMessage);
        }

        if(($response = $tempCurl->response) != null) {
            if(($shards = json_decode(json_encode($tempCurl->response), true)) != null) {
                foreach($shards[ 'shardInfo' ] as $shard) {
                    foreach($shard[ 'platforms' ] as $platform) {
                        if($platform === API::getPlatform($this->user->getPlatform())) {
                            $this->shardInfos = $shard;
                        }
                    }
                }

                return $this->getAccountInformation();
            } else {
                throw new \Exception(289684, 'Could not decode shards');
            }
        } else {
            throw new \Exception(292751, 'No response received for shards');
        }
    }

    /**
     * @param null $shards
     *
     * @throws MainLogin
     * @return bool
     */
    private function getAccountInformation($shards = null) {
        if($shards == null) {
            $shards = $this->shardInfos;
        }

        $tempCurl = &$this->curl;
        $tempCurl->setHeader('X-UT-Route', 'https://' . $shards[ 'clientFacingIpPort' ]);
        $tempCurl->get(URL::LOGIN_ACCOUNTS);

        if($tempCurl->error) {
            throw new MainLogin($tempCurl->errorCode, $tempCurl->errorMessage);
        }

        $accounts = json_decode(json_encode($tempCurl->response), true);
        if(count($accounts) > 0 && count($accounts[ 'userAccountInfo' ]) > 0 && count(
                                                                                      $accounts[ 'userAccountInfo' ][ 'personas' ]
                                                                                  ) > 0
        ) {
            $p = null;
            foreach($accounts[ 'userAccountInfo' ][ 'personas' ] as $persona) {
                foreach($persona[ 'userClubList' ] as $club) {
                    if($club[ 'year' ] == Configuration::FUT_YEAR && $club[ 'platform' ] == API::getPlatform(
                            $this->user->getPlatform()
                        )
                    ) {
                        $p = $persona;
                    }
                }
            }
            if($p != null) {
                $this->persona = $p;

                return $this->getSession();
            } else {
                throw new MainLogin(281625, 'Could not find a fitting persona');
            }
        } else {
            throw new MainLogin(281725, 'Provided persona\'s are incorrect');
        }
    }

    private function getSession() {
        $data = [
            'nucleusPersonaId'          => $this->persona[ 'personaId' ],
            'nucleusPersonaDisplayName' => $this->persona[ 'personaName' ],
            'gameSku'                   => API::getGameSku($this->user->getPlatform()),
            'nucleusPersonaPlatform'    => API::getPlatform($this->user->getPlatform()),
        ];
        $data = array_merge(Configuration::DEFAULT_SESSION_FORM_DATA, $data);

        $curl = &$this->curl;

        $curl->setHeader('Content-Type', 'application/json');
        $curl->post(URL::LOGIN_SESSION, $data);

        if($curl->error) {
            throw new MainLogin($curl->errorCode, $curl->errorMessage);
        }

        $data          = json_decode(json_encode($curl->response), true);
        $this->session = $data;

        return $this->phishing();
    }

    private function phishing() {
        $curl = &$this->curl;
        $curl->setHeader('X-UT-SID', $this->session[ 'sid' ]);

        $curl->get(URL::LOGIN_QUESTION);

        if($curl->error) {
            throw new MainLogin($curl->errorCode, $curl->errorMessage);
        }

        // Check for other responses
        $question = json_decode(json_encode($curl->response), true);

        if(isset($question[ 'code' ])) {
            if($question[ 'code' ] === Comparisons::CAPTCHA_BODY_CODE) {
                throw new CaptchaException();
            }
        }

        if(isset($question[ 'string' ])) {
            if($question[ 'string' ] === Comparisons::ALREADY_LOGGED_IN) {
                $this->setForFutureRequests($question[ 'token' ]);

                return true;
            }
        }

        return $this->validate();
    }

    private function setForFutureRequests($token) {
        $headers = [
            'X-UT-PHISHING-TOKEN'           => $token,
            'X-HTTP-Method-Override'        => 'GET',
            Configuration::X_UT_ROUTE_PARAM => 'https://' . explode(':', $this->session[ 'ipPort' ])[ 0 ],
            'x-flash-version'               => '20,0,0,272',
        ];
        $this->user->setHeaders($headers);
    }

    public function validate() {
        $secret = EAHashor::getHash($this->user->getSecret());

        $this->curl->setHeader('Content-Type', 'application/x-www-form-urlencoded');
        $this->curl->setHeader('X-UT-SID', $this->session[ 'sid' ]);

        $this->curl->post(URL::LOGIN_VALIDATE, [ 'answer' => $secret ]);

        if($this->curl->error) {
            throw new MainLogin($this->curl->errorCode, $this->curl->errorMessage);
        }

        $debug = json_decode($this->curl->response, true);
        if(isset($debug[ 'debug' ])) {
            if($debug[ 'debug' ] === Comparisons::CORRECT_ANSWER) {
                $this->setForFutureRequests($debug[ 'token' ]);

                return true;
            }
        }
        throw new MainLogin(2856162, 'Could not login with secret');
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
                return $this->getFUTPage();
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

    /**
     * @return Curl
     */
    public function getCurl() {
        return $this->curl;
    }
}