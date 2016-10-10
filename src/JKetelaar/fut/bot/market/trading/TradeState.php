<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\trading;

use JKetelaar\fut\bot\ImprovedEnum;

class TradeState extends ImprovedEnum {

    const ACTIVE = 'active';
    const EXPIRED = 'expired';
    const NONE = null;
    const _DEFAULT = self::NONE;

}