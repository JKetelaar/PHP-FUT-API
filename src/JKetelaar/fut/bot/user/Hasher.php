<?php
/**
 * @author JKetelaar
 * @deprecated
 */

namespace JKetelaar\fut\bot\user;

class Hasher {

    private static $r1Shifts = [ 7, 12, 17, 22, 7, 12, 17, 22, 7, 12, 17, 22, 7, 12, 17, 22 ];
    private static $r2Shifts = [ 5, 9, 14, 20, 5, 9, 14, 20, 5, 9, 14, 20, 5, 9, 14, 20 ];
    private static $r3Shifts = [ 4, 11, 16, 23, 4, 11, 16, 23, 4, 11, 16, 23, 4, 11, 16, 23 ];
    private static $r4Shifts = [ 6, 10, 15, 21, 6, 10, 15, 21, 6, 10, 15, 21, 6, 10, 15, 21 ];
    private static $hexChr   = '0123456789abcdef';

    public static function md5($string) {
        $x = self::chunkMessage($string);
        $a = 1732584193;
        $b = -271733879;
        $c = -1732584194;
        $d = 271733878;

        for($i = 0; $i < sizeof($x); $i += 16) {
            $tempA = $a;
            $tempB = $b;
            $tempC = $c;
            $tempD = $d;

            $a = self::md5_f($a, $b, $c, $d, $x[ $i + 0 ], self::$r1Shifts[ 0 ], -680876936);
            $d = self::md5_f($d, $a, $b, $c, $x[ $i + 1 ], self::$r1Shifts[ 1 ], -389564586);
            $c = self::md5_f($c, $d, $a, $b, $x[ $i + 2 ], self::$r1Shifts[ 2 ], 606105819);
            $a = self::md5_f($a, $b, $c, $d, $x[ $i + 4 ], self::$r1Shifts[ 4 ], -176418897);

            var_dump($a);
            var_dump($b);
            var_dump($c);
            var_dump($d);
            die();

            $d = self::md5_f($d, $a, $b, $c, $x[ $i + 5 ], self::$r1Shifts[ 5 ], 1200080426);
            $c = self::md5_f($c, $d, $a, $b, $x[ $i + 6 ], self::$r1Shifts[ 6 ], -1473231341);
            $b = self::md5_f($b, $c, $d, $a, $x[ $i + 7 ], self::$r1Shifts[ 7 ], -45705983);

            $a = self::md5_f($a, $b, $c, $d, $x[ $i + 8 ], self::$r1Shifts[ 8 ], 1770035416);
            $d = self::md5_f($d, $a, $b, $c, $x[ $i + 9 ], self::$r1Shifts[ 9 ], -1958414417);
            $c = self::md5_f($c, $d, $a, $b, $x[ $i + 10 ], self::$r1Shifts[ 10 ], -42063);

            $b = self::md5_f($b, $c, $d, $a, $x[ $i + 11 ], self::$r1Shifts[ 11 ], -1990404162);
            $a = self::md5_f($a, $b, $c, $d, $x[ $i + 12 ], self::$r1Shifts[ 12 ], 1804603682);
            $d = self::md5_f($d, $a, $b, $c, $x[ $i + 13 ], self::$r1Shifts[ 13 ], -40341101);
            $c = self::md5_f($c, $d, $a, $b, $x[ $i + 14 ], self::$r1Shifts[ 14 ], -1502002290);
            $b = self::md5_f($b, $c, $d, $a, $x[ $i + 15 ], self::$r1Shifts[ 15 ], 1236535329);
            $a = self::md5_g($a, $b, $c, $d, $x[ $i + 1 ], self::$r2Shifts[ 0 ], -165796510);

            $d = self::md5_g($d, $a, $b, $c, $x[ $i + 6 ], self::$r2Shifts[ 1 ], -1069501632);
            $c = self::md5_g($c, $d, $a, $b, $x[ $i + 11 ], self::$r2Shifts[ 2 ], 643717713);
            $b = self::md5_g($b, $c, $d, $a, $x[ $i + 0 ], self::$r2Shifts[ 3 ], -373897302);
            $a = self::md5_g($a, $b, $c, $d, $x[ $i + 5 ], self::$r2Shifts[ 4 ], -701558691);
            $d = self::md5_g($d, $a, $b, $c, $x[ $i + 10 ], self::$r2Shifts[ 5 ], 38016083);
            $c = self::md5_g($c, $d, $a, $b, $x[ $i + 15 ], self::$r2Shifts[ 6 ], -660478335);
            $b = self::md5_g($b, $c, $d, $a, $x[ $i + 4 ], self::$r2Shifts[ 7 ], -405537848);
            $a = self::md5_g($a, $b, $c, $d, $x[ $i + 9 ], self::$r2Shifts[ 8 ], 568446438);
            $d = self::md5_g($d, $a, $b, $c, $x[ $i + 14 ], self::$r2Shifts[ 9 ], -1019803690);
            $c = self::md5_g($c, $d, $a, $b, $x[ $i + 3 ], self::$r2Shifts[ 10 ], -187363961);
            $b = self::md5_g($b, $c, $d, $a, $x[ $i + 8 ], self::$r2Shifts[ 11 ], 1163531501);
            $a = self::md5_g($a, $b, $c, $d, $x[ $i + 13 ], self::$r2Shifts[ 12 ], -1444681467);
            $d = self::md5_g($d, $a, $b, $c, $x[ $i + 2 ], self::$r2Shifts[ 13 ], -51403784);
            $c = self::md5_g($c, $d, $a, $b, $x[ $i + 7 ], self::$r2Shifts[ 14 ], 1735328473);
            $b = self::md5_g($b, $c, $d, $a, $x[ $i + 12 ], self::$r2Shifts[ 15 ], -1926607734);
            $a = self::md5_h($a, $b, $c, $d, $x[ $i + 5 ], self::$r3Shifts[ 0 ], -378558);
            $d = self::md5_h($d, $a, $b, $c, $x[ $i + 8 ], self::$r3Shifts[ 1 ], -2022574463);
            $c = self::md5_h($c, $d, $a, $b, $x[ $i + 11 ], self::$r2Shifts[ 2 ], 1839030562);
            $b = self::md5_h($b, $c, $d, $a, $x[ $i + 14 ], self::$r3Shifts[ 3 ], -35309556);
            $a = self::md5_h($a, $b, $c, $d, $x[ $i + 1 ], self::$r3Shifts[ 4 ], -1530992060);
            $d = self::md5_h($d, $a, $b, $c, $x[ $i + 4 ], self::$r3Shifts[ 5 ], 1272893353);
            $c = self::md5_h($c, $d, $a, $b, $x[ $i + 7 ], self::$r3Shifts[ 6 ], -155497632);
            $b = self::md5_h($b, $c, $d, $a, $x[ $i + 10 ], self::$r3Shifts[ 7 ], -1094730640);
            $a = self::md5_h($a, $b, $c, $d, $x[ $i + 13 ], self::$r3Shifts[ 8 ], 681279174);
            $d = self::md5_h($d, $a, $b, $c, $x[ $i + 0 ], self::$r3Shifts[ 9 ], -358537222);
            $c = self::md5_h($c, $d, $a, $b, $x[ $i + 3 ], self::$r3Shifts[ 10 ], -722521979);
            $b = self::md5_h($b, $c, $d, $a, $x[ $i + 6 ], self::$r3Shifts[ 11 ], 76029189);
            $a = self::md5_h($a, $b, $c, $d, $x[ $i + 9 ], self::$r3Shifts[ 12 ], -640364487);
            $d = self::md5_h($d, $a, $b, $c, $x[ $i + 12 ], self::$r3Shifts[ 13 ], -421815835);
            $c = self::md5_h($c, $d, $a, $b, $x[ $i + 15 ], self::$r3Shifts[ 14 ], 530742520);
            $b = self::md5_h($b, $c, $d, $a, $x[ $i + 2 ], self::$r3Shifts[ 15 ], -995338651);
            $a = self::md5_i($a, $b, $c, $d, $x[ $i + 0 ], self::$r4Shifts[ 0 ], -198630844);
            $d = self::md5_i($d, $a, $b, $c, $x[ $i + 7 ], self::$r4Shifts[ 1 ], 1126891415);
            $c = self::md5_i($c, $d, $a, $b, $x[ $i + 14 ], self::$r4Shifts[ 2 ], -1416354905);
            $b = self::md5_i($b, $c, $d, $a, $x[ $i + 5 ], self::$r4Shifts[ 3 ], -57434055);
            $a = self::md5_i($a, $b, $c, $d, $x[ $i + 12 ], self::$r4Shifts[ 4 ], 1700485571);
            $d = self::md5_i($d, $a, $b, $c, $x[ $i + 3 ], self::$r4Shifts[ 5 ], -1894986606);
            $c = self::md5_i($c, $d, $a, $b, $x[ $i + 10 ], self::$r4Shifts[ 6 ], -1051523);
            $b = self::md5_i($b, $c, $d, $a, $x[ $i + 1 ], self::$r4Shifts[ 7 ], -2054922799);
            $a = self::md5_i($a, $b, $c, $d, $x[ $i + 8 ], self::$r4Shifts[ 8 ], 1873313359);
            $d = self::md5_i($d, $a, $b, $c, $x[ $i + 15 ], self::$r4Shifts[ 9 ], -30611744);
            $c = self::md5_i($c, $d, $a, $b, $x[ $i + 6 ], self::$r4Shifts[ 10 ], -1560198380);
            $b = self::md5_i($b, $c, $d, $a, $x[ $i + 13 ], self::$r4Shifts[ 11 ], 1309151649);
            $a = self::md5_i($a, $b, $c, $d, $x[ $i + 4 ], self::$r4Shifts[ 12 ], -145523070);
            $d = self::md5_i($d, $a, $b, $c, $x[ $i + 11 ], self::$r4Shifts[ 13 ], -1120210379);
            $c = self::md5_i($c, $d, $a, $b, $x[ $i + 2 ], self::$r4Shifts[ 14 ], 718787259);
            $b = self::md5_i($b, $c, $d, $a, $x[ $i + 9 ], self::$r4Shifts[ 15 ], -343485551);
            $b = self::md5_i($b, $c, $d, $a, $x[ $i + 9 ], self::$r4Shifts[ 15 ], -343485551);

            $a = self::add($a, $tempA);
            $b = self::add($b, $tempB);
            $c = self::add($c, $tempC);
            $d = self::add($d, $tempD);
        }

        return self::numToHex($a) . self::numToHex($b) . self::numToHex($c) . self::numToHex($d);
    }

    public static function chunkMessage($answer) {
        $numberOfBlocks = ((strlen($answer) + 8) >> 6) + 1;
        $blocks         = array_fill(0, $numberOfBlocks * 16, 0);

        for($i = 0; $i < strlen($answer); $i++) {
            $blocks[ $i >> 2 ] |= self::utf8_char_code_at($answer, $i) << (($i % 4) * 8);
        }

        $blocks[ strlen($answer) >> 2 ] |= 0x80 << ((strlen($answer) % 4) * 8);
        $blocks[ $numberOfBlocks * 16 - 2 ] = strlen($answer) * 8;

        return $blocks;
    }

    private static function utf8_char_code_at($str, $index) {
        $char = mb_substr($str, $index, 1, 'UTF-8');

        if(mb_check_encoding($char, 'UTF-8')) {
            $ret = mb_convert_encoding($char, 'UTF-32BE', 'UTF-8');

            return hexdec(bin2hex($ret));
        } else {
            return null;
        }
    }

    private static function md5_f($a, $b, $c, $d, $x, $s, $t) {
        return self::cmn(($b & $c) | ((~$b) & $d), $a, $b, $x, $s, $t);
    }

    private static function cmn($q, $a, $b, $x, $s, $t) {
        $result = self::bitwiseRotate(self::add(self::add($a, $q), self::add($x, $t)), $s);
        return self::add($result, $b);
    }

    private static function add($x, $y) {
        $lsw = ($x & 0xFFFF) + ($y & 0xFFFF);
        $msw = ($x >> 16) + ($y >> 16) + ($lsw >> 16);
        $s =  (self::_32bitleftshift($msw, 16)) | ($lsw & 0xFFFF);
        return $s;
    }

    private static function bitwiseRotate($x, $c) {
        $s = self::_32bitleftshift($x, $c);
        return $s | (self::zeroFill($x, (32 - $c)));
    }

    private static function _32bitleftshift($number, $steps)
    {
        $binary = decbin($number).str_repeat("0", $steps);
        $binary = str_pad($binary, 32, "0", STR_PAD_LEFT);
        $binary = substr($binary, strlen($binary) - 32);
        if ($binary{0} == "1")
        {
            return -(pow(2, 31) - bindec(substr($binary, 1)));
        }
        else
        {
            return bindec($binary);
        }
    }

    private static function zeroFill($a,$b) {
        if($a >= 0) {
            return $a >> $b;
        }
        if($b == 0) {
            return (($a >> 1) & 0x7fffffff) * 2 + (($a >> $b) & 1);
        }

        return ((~$a) >> $b) ^ (0x7fffffff >> ($b - 1));
    }

        private static function md5_g($a, $b, $c, $d, $x, $s, $t) {
        return self::cmn(($b & $d) | ((~$b) & $d), $a, $b, $x, $s, $t);
    }

    private static function md5_h($a, $b, $c, $d, $x, $s, $t) {
        return self::cmn($b ^ $c ^ $d, $a, $b, $x, $s, $t);
    }

    private static function md5_i($a, $b, $c, $d, $x, $s, $t) {
        return self::cmn($c ^ ($b | (~$d)), $a, $b, $x, $s, $t);
    }

    private static function numToHex($num) {
        $str = '';

        for($i = 0; $i <= 3; $i++) {
            $str .= self::$hexChr[ ($num >> ($i * 8 + 4)) & 0x0F ];
            $str .= self::$hexChr[ ($num >> ($i * 8)) & 0x0F ];
        }

        return $str;
    }
}