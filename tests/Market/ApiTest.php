<?php
/**
 * @author JKetelaar
 */

namespace Market;

use JKetelaar\fut\bot\API;

class ApiTest extends \PHPUnit_Framework_TestCase {
    public function testPlatformCorrectness() {
        $this->assertTrue(API::getPlatform('ps4') === 'ps3');
        $this->assertTrue(API::getPlatform('ps3') === 'ps3');
        $this->assertTrue(API::getPlatform('x360') === '360');
        $this->assertTrue(API::getPlatform('xone') === '360');
        $this->assertTrue(API::getPlatform('pc') === 'pc');

        $this->assertNull(API::getPlatform('non existing'));
    }

    public function testGameSKUCorrectness() {
        $this->assertTrue(API::getGameSku('ps4') === 'FFA17PS4');
        $this->assertTrue(API::getGameSku('ps3') === 'FFA17PS3');
        $this->assertTrue(API::getGameSku('pc') === 'FFA17PCC');
        $this->assertTrue(API::getGameSku('xone') === 'FFA17XBO');
        $this->assertTrue(API::getGameSku('x360') === 'FFA17XBX');

        $this->assertNull(API::getGameSku('non existing'));
    }
}