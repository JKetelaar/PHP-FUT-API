<?php
/**
 * @author JKetelaar
 */

$searcher = $api->getHandler()->getSearcher();

// Search for players on the market, no limits etc
$players = $searcher->searchFor(\JKetelaar\fut\api\market\items\ItemType::PLAYER());

// Search for players with a result of 50 players
$players = $searcher->searchFor(\JKetelaar\fut\api\market\items\ItemType::PLAYER(), [], 0, 50);

// Search on page two for players
$players = $searcher->searchFor(\JKetelaar\fut\api\market\items\ItemType::PLAYER(), [], 50, 50);

// Search for players with the attribute pace bigger than 80
$players = $searcher->searchFor(
    \JKetelaar\fut\api\market\items\ItemType::PLAYER(),
    [
        new AttributeFilter(
            Attribute::PACE(), 85
        ),
    ]
);

// Search for players costing less than 800 coins
$players = $searcher->searchFor(
    \JKetelaar\fut\api\market\items\ItemType::PLAYER(),
    [],
    0,
    16,
    [
        \JKetelaar\fut\api\market\searching\Parameter::MAX_BUY => 800,
    ]
);

// Search for a specific player (Mario Götze) with the Player API
$playersAPI = $api->getPlayersAPI();
$player     = $playersAPI->getPlayer(7763);
$players    = $searcher->searchFor(
    \JKetelaar\fut\api\market\items\ItemType::PLAYER,
    [],
    0,
    16,
    [ \JKetelaar\fut\api\market\searching\Parameter::MASKED_DEFINITION_ID => $player->getBaseId() ]
);