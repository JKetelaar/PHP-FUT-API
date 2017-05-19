<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api\market\trading;

use JKetelaar\fut\api\config\URL;
use JKetelaar\fut\api\market\Handler;
use JKetelaar\fut\api\market\handler\Method;

class Trader {

    /**
     * @var Handler
     */
    private $handler;

    /**
     * Trader constructor.
     *
     * @param Handler $handler
     */
    public function __construct(Handler $handler) {
        $this->handler = $handler;
    }

    /**
     * @param int $tradeId
     * @param int $price
     */
    public function placeBid($tradeId, $price) {
        $price = $this->getValidPrice($price);
        return $this->handler->sendRequest(sprintf(URL::API_PLACE_BID, $tradeId), Method::PUT(), ['bid' => $price]);
    }

    private function getValidPrice($price) {
        if($price < 150) {
            return 150;
        } elseif($price < 1000) {
            return $price - ($price % 50);
        } elseif($price < 10000) {
            return $price - ($price % 100);
        } elseif($price < 50000) {
            return $price - ($price % 250);
        } elseif($price < 100000) {
            return $price - ($price % 500);
        } else {
            return $price - ($price % 1000);
        }
    }
}