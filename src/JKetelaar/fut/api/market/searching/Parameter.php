<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\searching;

use JKetelaar\fut\bot\ImprovedEnum;

class Parameter extends ImprovedEnum {
    const LEAGUE               = 'leag';
    const CHEMISTRY_STYLE      = 'playStyle';
    const TEAM                 = 'team';
    const MIN_BUY              = 'minb';
    const MAX_BUY              = 'maxb';
    const MIN_BID              = 'micr';
    const MAX_BID              = 'macr';
    const DEFINITION_ID        = 'definitionId';
    const MASKED_DEFINITION_ID = 'maskedDefId';
    const LEVEL                = 'lev';
    const ZONE                 = 'zone';
    const POSITION             = 'pos';
}