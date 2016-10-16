<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market;

use JKetelaar\fut\bot\config\URL;
use JKetelaar\fut\bot\errors\market\AmountTooBigException;
use JKetelaar\fut\bot\market\items\ItemType;
use JKetelaar\fut\bot\market\searching\filters\AttributeFilter;
use JKetelaar\fut\bot\market\trading\Trade;

class Searcher {

    const LIMIT = 50;

    /**
     * @var Handler
     */
    private $handler;

    /**
     * Searcher constructor.
     *
     * @param Handler $handler
     */
    public function __construct(Handler $handler) {
        $this->handler = $handler;
    }

    /**
     * @param ItemType          $type
     * @param AttributeFilter[] $filters
     * @param int               $offset
     * @param int               $amount
     * @param array             $params
     *
     * @throws AmountTooBigException
     * @return array|bool|null|string
     */
    public function searchFor(ItemType $type, array $filters = [], $offset = 0, $amount = 16, array $params = []) {
        if($amount > self::LIMIT) {
            throw new AmountTooBigException($amount, self::LIMIT);
        }
        $parameters = [];

        foreach($params as $parameter => $value) {
            $parameters[ $parameter ] = $value;
        }

        $parameters = array_merge(
            [
                'type'  => $type->getValue(),
                'start' => $offset,
                'num'   => $amount,
            ],
            $parameters
        );

        $trades = [];
        foreach(
            $this->handler->sendRequest(
                URL::API_TRANSFER_MARKET . http_build_query($parameters)
            )[ Trade::TAG ] as $item
        ) {
            $trades[] = Trade::toObject($item);
        }

        foreach($filters as $filter){
            $trades = $filter->filter($trades);
        }

        return $trades;
    }
}