<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api\market\searching\filters;

use JKetelaar\fut\api\market\trading\Trade;

interface Filter {
    /**
     * @param Trade[] $trades
     *
     * @return Trade[]
     */
    public function filter(array $trades);
}