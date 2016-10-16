<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api\market\items\misc;

use JKetelaar\fut\api\ImprovedEnum;

class ItemState extends ImprovedEnum {

    const FOR_SALE = 'forSale';
    const FREE     = 'free';
    const _DEFAULT = self::FREE;

}