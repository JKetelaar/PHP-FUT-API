<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api\market\items\players\attributes;

use JKetelaar\fut\api\ImprovedEnum;

class ChemistryStyle extends ImprovedEnum {
    const BASIC      = 250;
    const SNIPER     = 251;
    const FINISHER   = 252;
    const DEADEYE    = 253;
    const MARKSMAN   = 254;
    const HAWK       = 255;
    const ARTIST     = 256;
    const ARCHITECT  = 257;
    const POWERHOUSE = 258;
    const MAESTRO    = 259;
    const ENGINE     = 260;
    const SENTINEL   = 261;
    const GUARDIAN   = 262;
    const GLADIATOR  = 263;
    const BACKBONE   = 264;
    const ANCHOR     = 265;
    const HUNTER     = 266;
    const CATALYST   = 267;
    const SHADOW     = 268;
    const WALL       = 269;
    const SHIED      = 270;
    const CAT        = 271;
    const GLOVE      = 272;
    const GK_BASIC   = 273;
    const _DEFAULT   = self::BASIC;
}