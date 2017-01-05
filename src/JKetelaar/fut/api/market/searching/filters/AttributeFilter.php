<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api\market\searching\filters;

use JKetelaar\fut\api\market\items\players\attributes\Attribute;
use JKetelaar\fut\api\market\items\players\PlayerType;
use JKetelaar\fut\api\market\trading\Trade;

class AttributeFilter implements Filter {

    /**
     * @var Attribute
     */
    private $attribute;

    /**
     * @var int
     */
    private $limit;

    /**
     * AttributeFilter constructor.
     *
     * @param Attribute $attribute
     * @param int       $limit
     */
    public function __construct(Attribute $attribute, $limit) {
        $this->attribute = $attribute;
        $this->limit     = $limit;
    }

    /**
     * @return int
     */
    public function getLimit() {
        return $this->limit;
    }

    /**
     * @param Trade[] $trades
     *
     * @return Trade[]
     */
    public function filter(array $trades) {
        $newTrades = [];
        foreach($trades as $trade) {
            /**
             * @var PlayerType $item
             */
            $item = $trade->getItemData()->getItem();
            foreach($item->getAttributes() as $attribute) {
                if($attribute->getAttribute()->getKey() === $this->getAttribute()->getKey()) {
                    if($attribute->getValue() > $this->limit) {
                        $newTrades[] = $trade;
                    }
                }
            }
        }

        return $newTrades;
    }

    /**
     * @return Attribute
     */
    public function getAttribute() {
        return $this->attribute;
    }
}