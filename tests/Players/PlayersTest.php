<?php
/**
 * @author JKetelaar
 */

namespace Players;

use JKetelaar\fut\api\database\Players;

class PlayersTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var int
     */
    const TEST_PLAYER = 192318;

    /**
     * @var Players
     */
    private $players;

    public function __construct($name = null, array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);

        $this->players = new Players();
    }

    public function testPlayerRetrieval() {
        $this->assertNotNull($this->players->getPlayer(self::TEST_PLAYER));
        $this->assertTrue(strtolower($this->players->getPlayer(self::TEST_PLAYER)->getFirstName()) === 'mario');
    }
}