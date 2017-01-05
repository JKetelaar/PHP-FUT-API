<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api\market\items\players;

use JKetelaar\fut\api\market\items\AbstractItemType;
use JKetelaar\fut\api\market\items\misc\Formation;
use JKetelaar\fut\api\market\items\players\attributes\ChemistryStyle;
use JKetelaar\fut\api\market\items\players\attributes\Nation;
use JKetelaar\fut\api\market\items\players\attributes\Position;
use JKetelaar\fut\api\ResultParser;

/**
 * Class PlayerType
 * @package JKetelaar\fut\api\market\items\players
 * @AllArgsConstructor
 */
class PlayerType extends AbstractItemType implements ResultParser {

    /**
     * @var int
     */
    private $morale;

    /**
     * @var ChemistryStyle
     */
    private $playStyle;

    /**
     * @var 99
     */
    private $fitness;

    /**
     * @var InjuryType
     */
    private $injuryType;

    /**
     * @var int
     */
    private $injuryGames;

    /**
     * @var Position
     */
    private $preferredPosition;

    /**
     * @var int
     */
    private $training;

    /**
     * @var int
     */
    private $contract;

    /**
     * @var int
     */
    private $suspension;

    /**
     * @var AttributeValue[]
     */
    private $attributes;

    /**
     * @var Nation
     */
    private $nation;

    /**
     * PlayerType constructor.
     *
     * @param int              $morale
     * @param ChemistryStyle   $playStyle
     * @param int              $fitness
     * @param InjuryType       $injuryType
     * @param int              $injuryGames
     * @param Position         $preferredPosition
     * @param int              $training
     * @param int              $contract
     * @param int              $suspension
     * @param AttributeValue[] $attributes
     * @param Nation           $nation
     * @param int              $teamid
     * @param int              $leagueId
     * @param int              $rating
     * @param int              $marketDataMinPrice
     * @param int              $marketDataMaxPrice
     * @param Formation        $formation
     */
    public function __construct(
        $teamid,
        $leagueId,
        $rating,
        $marketDataMinPrice,
        $marketDataMaxPrice,
        Formation $formation,
        $morale,
        ChemistryStyle $playStyle,
        $fitness,
        InjuryType $injuryType,
        $injuryGames,
        Position $preferredPosition,
        $training,
        $contract,
        $suspension,
        array $attributes,
        Nation $nation
    ) {
        parent::__construct($teamid, $leagueId, $rating, $marketDataMinPrice, $marketDataMaxPrice, $formation);

        $this->morale            = $morale;
        $this->playStyle         = $playStyle;
        $this->fitness           = $fitness;
        $this->injuryType        = $injuryType;
        $this->injuryGames       = $injuryGames;
        $this->preferredPosition = $preferredPosition;
        $this->training          = $training;
        $this->contract          = $contract;
        $this->suspension        = $suspension;
        $this->attributes        = $attributes;
        $this->nation            = $nation;
    }

    /**
     * @param array $result
     *
     * @return object
     */
    public static function toObject($result) {
        $player = new self(
            $result[ 'teamid' ],
            $result[ 'leagueId' ],
            $result[ 'rating' ],
            isset($result[ 'marketDataMinPrice' ]) ? $result[ 'marketDataMinPrice' ] : 0,
            isset($result[ 'marketDataMaxPrice' ]) ? $result[ 'marketDataMaxPrice' ] : 0,
            Formation::findByKey($result[ 'formation' ], true),
            $result[ 'morale' ],
            ChemistryStyle::findByValue($result[ 'playStyle' ], true),
            $result[ 'fitness' ],
            InjuryType::findByValue($result[ 'injuryType' ], true),
            $result[ 'injuryGames' ],
            Position::findByValue($result[ 'preferredPosition' ], true),
            $result[ 'training' ],
            $result[ 'contract' ],
            $result[ 'suspension' ],
            AttributeValue::toObjects($result[ AttributeValue::TAG ]),
            Nation::findByValue($result[ 'nation' ], true)
        );

        return $player;
    }

    /**
     * @return int
     */
    public function getMorale() {
        return $this->morale;
    }

    /**
     * @return ChemistryStyle
     */
    public function getPlayStyle() {
        return $this->playStyle;
    }

    /**
     * @return mixed
     */
    public function getFitness() {
        return $this->fitness;
    }

    /**
     * @return InjuryType
     */
    public function getInjuryType() {
        return $this->injuryType;
    }

    /**
     * @return int
     */
    public function getInjuryGames() {
        return $this->injuryGames;
    }

    /**
     * @return Position
     */
    public function getPreferredPosition() {
        return $this->preferredPosition;
    }

    /**
     * @return int
     */
    public function getTraining() {
        return $this->training;
    }

    /**
     * @return int
     */
    public function getContract() {
        return $this->contract;
    }

    /**
     * @return int
     */
    public function getSuspension() {
        return $this->suspension;
    }

    /**
     * @return AttributeValue[]
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * @return Nation
     */
    public function getNation() {
        return $this->nation;
    }
}