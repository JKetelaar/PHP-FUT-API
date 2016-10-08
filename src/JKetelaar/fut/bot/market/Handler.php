<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market;

use Curl\Curl;
use JKetelaar\fut\bot\errors\market\IncorrectHeaders;
use JKetelaar\fut\bot\errors\market\MarketError;
use JKetelaar\fut\bot\errors\market\UnknownEndpoint;
use JKetelaar\fut\bot\user\User;

class Handler {

    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var User
     */
    private $user;

    /**
     * Handler constructor.
     *
     * @param Curl $curl
     * @param User $user
     */
    public function __construct(Curl $curl, User $user) {
        $this->curl = $curl;
        $this->user = $user;
    }

    /**
     * @param string $url
     * @param array  $data
     * @param null   $headers
     *
     * @return string|bool|array|null
     * @throws IncorrectHeaders
     * @throws MarketError
     * @throws UnknownEndpoint
     */
    public function sendRequest($url, $data = [], $headers = null) {
        $curl = &$this->curl;

        if($headers != null && is_array($headers)) {
            if(array_keys($headers) !== range(0, count($headers) - 1)) {
                throw new IncorrectHeaders();
            }

            foreach($headers as $key => $header) {
                $curl->setHeader($key, $header);
            }
        }

        $curl->setHeader('X-HTTP-Method-Override', 'GET');
        $curl->post($url, $data);

        if($curl->error) {
            throw new MarketError(null, $curl->errorCode, $curl->errorMessage);
        }

        if($curl->httpStatusCode == 404) {
            throw new UnknownEndpoint($url);
        }

        return $curl->response;
    }
}