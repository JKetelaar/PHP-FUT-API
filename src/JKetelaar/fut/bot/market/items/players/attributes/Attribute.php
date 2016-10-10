<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\players;

use JKetelaar\fut\bot\ImprovedEnum;

class Attribute extends ImprovedEnum  {

    const PACE = 0;
    const SHOOTING = 1;
    const PASSING = 2;
    const DRIBBLING = 3;
    const DEFENDING = 4;
    const PHYSICAL = 5;

}