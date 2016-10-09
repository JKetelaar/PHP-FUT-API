<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\players;

use MyCLabs\Enum\Enum;

class Attribute extends Enum {

    const PACE = 0;
    const SHOOTING = 1;
    const PASSING = 2;
    const DRIBBLING = 3;
    const DEFENDING = 4;
    const PHYSICAL = 5;

}