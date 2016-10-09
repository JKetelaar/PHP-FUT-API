<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\items;

use JKetelaar\fut\bot\market\items\misc\Formation;

abstract class AbstractItemType {

    /**
     * @var int
     */
    private $teamid;

    /**
     * @var int
     */
    private $leagueId;

    /**
     * @var int
     */
    private $rating;

    /**
     * @var int
     */
    private $marketDataMinPrice;

    /**
     * @var int
     */
    private $marketDataMaxPrice;

    /**
     * @var Formation
     */
    private $formation;

    /**
     * AbstractItemType constructor.
     *
     * @param int       $teamid
     * @param int       $leagueId
     * @param int       $rating
     * @param int       $marketDataMinPrice
     * @param int       $marketDataMaxPrice
     * @param Formation $formation
     */
    public function __construct(
        $teamid,
        $leagueId,
        $rating,
        $marketDataMinPrice,
        $marketDataMaxPrice,
        Formation $formation
    ) {
        $this->teamid             = $teamid;
        $this->leagueId           = $leagueId;
        $this->rating             = $rating;
        $this->marketDataMinPrice = $marketDataMinPrice;
        $this->marketDataMaxPrice = $marketDataMaxPrice;
        $this->formation          = $formation;
    }

    /**
     * @return int
     */
    public function getTeamid() {
        return $this->teamid;
    }

    /**
     * @return int
     */
    public function getLeagueId() {
        return $this->leagueId;
    }

    /**
     * @return int
     */
    public function getRating() {
        return $this->rating;
    }

    /**
     * @return int
     */
    public function getMarketDataMinPrice() {
        return $this->marketDataMinPrice;
    }

    /**
     * @return int
     */
    public function getMarketDataMaxPrice() {
        return $this->marketDataMaxPrice;
    }

    /**
     * @return Formation
     */
    public function getFormation() {
        return $this->formation;
    }
}