<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\database\models;

use JKetelaar\fut\bot\config\URL;
use JKetelaar\fut\bot\market\items\players\attributes\Nation;
use JKetelaar\fut\bot\ResultParser;

class Player implements ResultParser {
    /**
     * @var int
     */
    private $assetId;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var Nation
     */
    private $nation;

    /**
     * @var int
     */
    private $rating;

    /**
     * Player constructor.
     *
     * @param int    $assetId
     * @param string $firstName
     * @param string $lastName
     * @param Nation $nation
     * @param int    $rating
     */
    public function __construct($assetId, $firstName, $lastName, Nation $nation, $rating) {
        $this->assetId   = $assetId;
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->nation    = $nation;
        $this->rating    = $rating;
    }

    /**
     * @param array $result
     *
     * @return Player
     */
    public static function toObject($result) {
        return new self(
            $result[ 'id' ], $result[ 'f' ], $result[ 'l' ], Nation::findByValue($result[ 'n' ], true), $result[ 'r' ]
        );
    }

    /**
     * @return int
     */
    public function getAssetId() {
        return $this->assetId;
    }

    /**
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @return Nation
     */
    public function getNation() {
        return $this->nation;
    }

    /**
     * @return int
     */
    public function getRating() {
        return $this->rating;
    }

    /**
     * @return string
     */
    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @return string URL of the player image
     */
    public function getImage() {
        return sprintf(URL::PLAYER_IMAGE, $this->assetId);
    }
}