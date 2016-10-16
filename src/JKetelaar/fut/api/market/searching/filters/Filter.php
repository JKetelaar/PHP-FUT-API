<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\searching\filters;

use JKetelaar\fut\bot\market\trading\Trade;

interface Filter {
    /**
     * @param Trade[] $trades
     *
     * @return Trade[]
     */
    public function filter(array $trades);
}