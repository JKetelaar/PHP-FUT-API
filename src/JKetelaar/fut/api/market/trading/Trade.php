<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\trading;

use JKetelaar\fut\bot\ResultParser;

class Trade implements ResultParser {

    const TAG = 'auctionInfo';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $tradeState;

    /**
     * @var int
     */
    private $buyNowPrice;

    /**
     * @var int
     */
    private $currentBid;

    /**
     * @var int
     */
    private $offers;

    /**
     * @var bool
     */
    private $watched;

    /**
     * @var string
     */
    private $bidStatus;

    /**
     * @var int
     */
    private $startingBid;

    /**
     * @var int
     */
    private $confidenceValue;

    /**
     * @var int
     */
    private $expires;

    /**
     * @var ItemData
     */
    private $itemData;

    /**
     * Trade constructor.
     *
     * @param int    $id
     * @param string $tradeState
     * @param int    $buyNowPrice
     * @param int    $currentBid
     * @param int    $offers
     * @param bool   $watched
     * @param string $bidStatus
     * @param int    $startingBid
     * @param int    $confidenceValue
     * @param int    $expires
     */
    public function __construct(
        $id,
        $tradeState,
        $buyNowPrice,
        $currentBid,
        $offers,
        $watched,
        $bidStatus,
        $startingBid,
        $confidenceValue,
        $expires
    ) {
        $this->id              = $id;
        $this->tradeState      = $tradeState;
        $this->buyNowPrice     = $buyNowPrice;
        $this->currentBid      = $currentBid;
        $this->offers          = $offers;
        $this->watched         = $watched;
        $this->bidStatus       = $bidStatus;
        $this->startingBid     = $startingBid;
        $this->confidenceValue = $confidenceValue;
        $this->expires         = $expires;
    }

    /**
     * @param array $result
     *
     * @return Trade
     */
    public static function toObject($result) {
        $trade    = new self(
            $result[ 'tradeId' ],
            $result[ 'tradeState' ],
            $result[ 'buyNowPrice' ],
            $result[ 'currentBid' ],
            $result[ 'offers' ],
            $result[ 'watched' ],
            $result[ 'bidState' ],
            $result[ 'startingBid' ],
            $result[ 'confidenceValue' ],
            $result[ 'expires' ]
        );
        $itemData = ItemData::toObject($result[ 'itemData' ]);
        $trade->setItemData($itemData);

        return $trade;
    }

    /**
     * @param ItemData $itemData
     */
    private function setItemData($itemData) {
        $this->itemData = $itemData;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTradeState() {
        return $this->tradeState;
    }

    /**
     * @return int
     */
    public function getBuyNowPrice() {
        return $this->buyNowPrice;
    }

    /**
     * @return int
     */
    public function getCurrentBid() {
        return $this->currentBid;
    }

    /**
     * @return int
     */
    public function getOffers() {
        return $this->offers;
    }

    /**
     * @return bool
     */
    public function isWatched() {
        return $this->watched;
    }

    /**
     * @return string
     */
    public function getBidStatus() {
        return $this->bidStatus;
    }

    /**
     * @return int
     */
    public function getStartingBid() {
        return $this->startingBid;
    }

    /**
     * @return int
     */
    public function getConfidenceValue() {
        return $this->confidenceValue;
    }

    /**
     * @return int
     */
    public function getExpires() {
        return $this->expires;
    }

    /**
     * @return ItemData
     */
    public function getItemData() {
        return $this->itemData;
    }
}