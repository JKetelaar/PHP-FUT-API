<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\market\handler;

use MyCLabs\Enum\Enum;

class Method extends Enum {

    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';

}