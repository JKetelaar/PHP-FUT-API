<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\items\players\attributes;

use JKetelaar\fut\bot\ImprovedEnum;

class Position extends ImprovedEnum  {

    const DEFENDERS = 'defense';
    const MIDFIELDERS = 'midfield';
    const ATTACKERS = 'attacker';

    const GOAL_KEEPER = 'GK';

    const RIGHT_WING_BACK = 'RWB';
    const RIGHT_BACK = 'RB';
    const CENTER_BACK = 'CB';
    const LEFT_BACK = 'LB';
    const LEFT_WING_BACK = 'LWB';

    const CENTRAL_DEFENSIVE_MIDFIELDER = 'CDM';
    const RIGHT_MIDFIELDER = 'RM';
    const CENTRAL_MIDFIELDER = 'CM';
    const LEFT_MIDFIELDER = 'LM';
    const CENTRAL_ATTACKING_MIDFIELDER = 'CAM';

    const RIGHT_FORWARD = 'RF';
    const CENTRAL_FORWARD = 'CF';
    const LEFT_FORWARD = 'LF';
    const RIGHT_WINGER = 'RW';
    const STRIKER = 'ST';
    const LEFT_WINGER = 'LW';

}