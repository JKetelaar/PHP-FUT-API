<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\items\players;

use JKetelaar\fut\bot\market\items\players\attributes\Attribute;
use JKetelaar\fut\bot\ResultParser;

class AttributeValue implements ResultParser {

    const TAG = 'attributeList';

    /**
     * @var Attribute
     */
    private $attribute;

    /**
     * @var int
     */
    private $value;

    /**
     * Attributes constructor.
     *
     * @param Attribute $attribute
     * @param int       $value
     */
    public function __construct(Attribute $attribute, $value) {
        $this->attribute = $attribute;
        $this->value     = $value;
    }

    /**
     * @param array $result
     *
     * @return AttributeValue[]
     */
    public static function toObjects($result) {
        $attributes = [];
        foreach($result as $item) {
            $attributes[] = self::toObject($item);
        }

        return $attributes;
    }

    /**
     * @param array $result
     *
     * @return AttributeValue
     */
    public static function toObject($result) {
        $index = $result[ 'index' ];
        $value = $result[ 'value' ];

        return new self(
            Attribute::findByValue($index, true), $value
        );
    }

    /**
     * @return Attribute
     */
    public function getAttribute() {
        return $this->attribute;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }
}