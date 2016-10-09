<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\items\players;

use JKetelaar\fut\bot\market\items\AbstractItemType;
use JKetelaar\fut\bot\market\items\InjuryType;
use JKetelaar\fut\bot\market\items\misc\Formation;
use JKetelaar\fut\bot\market\items\players\attributes\Nation;
use JKetelaar\fut\bot\market\items\players\attributes\Position;
use JKetelaar\fut\bot\market\players\Attribute;
use JKetelaar\fut\bot\market\players\ChemistryStyle;

/**
 * Class PlayerType
 * @package JKetelaar\fut\bot\market\items\players
 * @AllArgsConstructor
 */
class PlayerType extends AbstractItemType {

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
     * @var Attribute[]
     */
    private $attributes;

    /**
     * @var Nation
     */
    private $nation;

    /**
     * PlayerType constructor.
     *
     * @param int                                           $morale
     * @param ChemistryStyle                                $playStyle
     * @param int                                           $fitness
     * @param InjuryType                                    $injuryType
     * @param int                                           $injuryGames
     * @param Position                                      $preferredPosition
     * @param int                                           $training
     * @param int                                           $contract
     * @param int                                           $suspension
     * @param \JKetelaar\fut\bot\market\players\Attribute[] $attributes
     * @param Nation                                        $nation
     * @param int                                           $teamid
     * @param int                                           $leagueId
     * @param int                                           $rating
     * @param int                                           $marketDataMinPrice
     * @param int                                           $marketDataMaxPrice
     * @param Formation                                     $formation
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

}