<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\bot\web;

use simplehtmldom_1_5\simple_html_dom;
use Sunra\PhpSimple\HtmlDomParser;

class Parser {
    /**
     * @param $string
     *
     * @return bool|\simplehtmldom_1_5\simple_html_dom
     */
    public static function getHTML($string) {
        $html = HtmlDomParser::str_get_html($string, true, false);

        return $html;
    }

    /**
     * @param simple_html_dom $dom
     *
     * @return null|string
     */
    public static function getDocumentTitle(simple_html_dom $dom) {
        $head = $dom->find('head');
        if(count($head) > 0) {
            $title = $head[ 0 ]->find('title', 0);
            if($title != null && ($text = $title->innertext) != null) {
                return $text;
            }
        }

        return null;
    }
}