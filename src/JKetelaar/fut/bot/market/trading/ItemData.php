<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\trading;

use JKetelaar\fut\bot\market\items\misc\ItemState;
use JKetelaar\fut\bot\market\players\ItemType;

class ItemData {

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $timestamp;

    /**
     * @var bool
     */
    private $untradeable;

    /**
     * @var int
     */
    private $assetId;

    /**
     * @var ItemType
     */
    private $itemType;

    /**
     * @var int
     */
    private $resourceId;

    /**
     * @var int
     */
    private $owners;

    /**
     * @var int
     */
    private $discardValue;

    /**
     * @var ItemState
     */
    private $itemState;

    /**
     * @var int
     */
    private $cardsubtypeid;

    /**
     * @var int
     */
    private $lastSalePrice;

    /**
     * @var int
     */
    private $rareflag;

    /**
     * ItemData constructor.
     *
     * @param int       $id
     * @param int       $timestamp
     * @param bool      $untradeable
     * @param int       $assetId
     * @param ItemType  $itemType
     * @param int       $resourceId
     * @param int       $owners
     * @param int       $discardValue
     * @param ItemState $itemState
     * @param int       $cardsubtypeid
     * @param int       $lastSalePrice
     * @param int       $rareflag
     */
    public function __construct(
        $id,
        $timestamp,
        $untradeable,
        $assetId,
        ItemType $itemType,
        $resourceId,
        $owners,
        $discardValue,
        ItemState $itemState,
        $cardsubtypeid,
        $lastSalePrice,
        $rareflag
    ) {
        $this->id            = $id;
        $this->timestamp     = $timestamp;
        $this->untradeable   = $untradeable;
        $this->assetId       = $assetId;
        $this->itemType      = $itemType;
        $this->resourceId    = $resourceId;
        $this->owners        = $owners;
        $this->discardValue  = $discardValue;
        $this->itemState     = $itemState;
        $this->cardsubtypeid = $cardsubtypeid;
        $this->lastSalePrice = $lastSalePrice;
        $this->rareflag      = $rareflag;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTimestamp() {
        return $this->timestamp;
    }

    /**
     * @return boolean
     */
    public function isUntradeable() {
        return $this->untradeable;
    }

    /**
     * @return int
     */
    public function getAssetId() {
        return $this->assetId;
    }

    /**
     * @return ItemType
     */
    public function getItemType() {
        return $this->itemType;
    }

    /**
     * @return int
     */
    public function getResourceId() {
        return $this->resourceId;
    }

    /**
     * @return int
     */
    public function getOwners() {
        return $this->owners;
    }

    /**
     * @return int
     */
    public function getDiscardValue() {
        return $this->discardValue;
    }

    /**
     * @return ItemState
     */
    public function getItemState() {
        return $this->itemState;
    }

    /**
     * @return int
     */
    public function getCardsubtypeid() {
        return $this->cardsubtypeid;
    }

    /**
     * @return int
     */
    public function getLastSalePrice() {
        return $this->lastSalePrice;
    }

    /**
     * @return int
     */
    public function getRareflag() {
        return $this->rareflag;
    }
}