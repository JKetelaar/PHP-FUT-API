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
     * @param string $key
     *
     * @param bool   $returnObject
     *
     * @param null   $default
     *
     * @return null|ImprovedEnum|object
     */
    public static function findByKey($key, $returnObject = false, $default = null) {
        foreach(self::values() as $item) {
            if(strtolower($item->getKey()) === strtolower($key)) {
                return $returnObject ? $item : $item->getValue();
            }
        }

        if($default == null) {
            $default = self::_DEFAULT();
        }

        return ($default instanceof Enum) ? ($returnObject ? $default : $default->getValue()) : $default;
    }

    /**
     * @param string $value
     * @param bool   $returnObject
     * @param null   $default
     *
     * @return null|ImprovedEnum|object
     */
    public static function findByValue($value, $returnObject = false, $default = null) {
        foreach(self::values() as $item) {
            if(strtolower($item->getValue()) === strtolower($value)) {
                return $returnObject ? $item : $item->getKey();
            }
        }

        if($default == null) {
            $default = self::_DEFAULT();
        }

        return ($default instanceof Enum) ? ($returnObject ? $default : $default->getKey()) : $default;
    }

    /**
     * @return string
     */
    public function getName() {
        return ucwords(str_replace('_', ' ', strtolower($this->getKey())));
    }
}