<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot;

use MyCLabs\Enum\Enum;

/**
 * Class ImprovedEnum
 * @package JKetelaar\fut\bot
 * @method static ImprovedEnum _DEFAULT()
 */
class ImprovedEnum extends Enum {

    /**
     * @param string $value
     *
     * @param bool   $returnObject
     *
     * @param null   $default
     *
     * @return null|ImprovedEnum|object
     */
    public static function findByValue($value, $returnObject = false, $default = null) {
        foreach(self::values() as $item) {
            if(strtolower($item->getKey()) === strtolower($value)) {
                return $returnObject ? $item : $item->getValue();
            }
        }

        return ($default instanceof Enum) ? ($returnObject ? $default : $default->getValue()) : $default;
    }

    /**
     * @return string
     */
    public function getName(){
        return ucwords(str_replace('_', ' ', strtolower($this->getKey())));
    }
}