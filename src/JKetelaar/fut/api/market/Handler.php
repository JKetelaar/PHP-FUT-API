<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api\market;

use Curl\Curl;
use JKetelaar\fut\api\config\Configuration;
use JKetelaar\fut\api\config\URL;
use JKetelaar\fut\api\errors\market\IncorrectEndpoint;
use JKetelaar\fut\api\errors\market\IncorrectHeaders;
use JKetelaar\fut\api\errors\market\MarketError;
use JKetelaar\fut\api\errors\market\UnknownEndpoint;
use JKetelaar\fut\api\errors\market\UnparsableEndpoint;
use JKetelaar\fut\api\market\handler\Method;
use JKetelaar\fut\api\market\trading\ItemData;
use JKetelaar\fut\api\market\trading\Trade;
use JKetelaar\fut\api\user\User;

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
     * @var Searcher
     */
    private $searcher;

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
     * TODO: Still in development, throws errors
     *
     * @deprecated
     *
     * @param int $assetId
     *
     * @return ItemData
     */
    public function getDefinition($assetId) {
        return ItemData::toObject($this->sendRequest(sprintf(URL::API_DEF, $assetId))[ ItemData::TAG ][ 0 ]);
    }

    /**
     * @param string $url
     * @param Method $method
     * @param array  $data
     * @param null   $headers
     *
     * @param bool   $anonymous
     *
     * @throws IncorrectEndpoint
     * @throws IncorrectHeaders
     * @throws MarketError
     * @throws UnknownEndpoint
     * @throws UnparsableEndpoint
     * @return array|bool|null|string
     */
    public function sendRequest($url, Method $method = null, $data = [], $headers = null, $anonymous = false) {
        if($method === null) {
            $method = Method::GET();
        }

        if($anonymous === true) {
            $curl = new Curl();
            $curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
            $curl->setOpt(CURLOPT_ENCODING, Configuration::HEADER_ACCEPT_ENCODING);
            $curl->setHeader('Accept-Language', Configuration::HEADER_ACCEPT_LANGUAGE);
            $curl->setHeader('Cache-Control', Configuration::HEADER_CACHE_CONTROL);
            $curl->setHeader('Accept', Configuration::HEADER_ACCEPT);
            $curl->setHeader('DNT', Configuration::HEADER_DNT);
            $curl->setUserAgent(Configuration::HEADER_USER_AGENT);
        } else {
            $curl = &$this->curl;
        }

        foreach($this->user->getHeaders() as $key => $header) {
            $curl->setHeader($key, $header);
        }

        if(filter_var($url, FILTER_VALIDATE_URL) !== false) {
            throw new IncorrectEndpoint($url);
        } else {
            $url = $this->user->getHeaders()[ Configuration::X_UT_ROUTE_PARAM ] . $url;
            if(filter_var($url, FILTER_VALIDATE_URL) === false) {
                throw new UnparsableEndpoint($url);
            }
        }

        if($headers != null && is_array($headers)) {
            if(array_keys($headers) !== range(0, count($headers) - 1)) {
                throw new IncorrectHeaders();
            }

            foreach($headers as $key => $header) {
                $curl->setHeader($key, $header);
            }
        }

        $curl->setHeader('X-HTTP-Method-Override', $method);
        $curl->post($url, $data);

        if($curl->error) {
            throw new MarketError(null, $curl->errorCode, $curl->errorMessage);
        }

        if($curl->httpStatusCode == 404) {
            throw new UnknownEndpoint($url);
        }

        return json_decode(json_encode($curl->response), true);
    }

    /**
     * @return Trade[]
     */
    public function getTradepile() {
        $auctions = [];
        foreach(($request = $this->sendRequest(URL::API_TRADEPILE)[ Trade::TAG ]) as $auction) {
            $auctions[] = Trade::toObject($auction);
        }

        return $auctions;
    }

    public function getWatchlist() {
        $watchers = [];
        foreach($this->sendRequest(URL::API_WATCHLIST)[ Trade::TAG ] as $item) {
            $watchers[] = Trade::toObject($item);
        }

        return $watchers;
    }

    public function getCredits() {
        $result = $this->sendRequest(URL::API_CREDITS);
        if(isset($result[ 'credits' ])) {
            return $result[ 'credits' ];
        }

        return null;
    }

    public function getCurrencies() {
        $result = $this->sendRequest(URL::API_CREDITS);
        if(isset($result[ Currency::TAG ])) {
            $currencies = [];

            foreach($result[ Currency::TAG ] as $currency) {
                $currencies[] = Currency::toObject($currency);
            }

            return $currencies;
        }

        return null;
    }

    /**
     * @return Searcher
     */
    public function getSearcher() {
        if($this->searcher == null) {
            $this->searcher = new Searcher($this);
        }

        return $this->searcher;
    }
}