<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api\market\trading;

use JKetelaar\fut\api\ImprovedEnum;

class TradeState extends ImprovedEnum {

    const ACTIVE   = 'active';
    const EXPIRED  = 'expired';
    const NONE     = null;
    const _DEFAULT = self::NONE;

}