<?php
/**
 * @author JKetelaar
 */

namespace JKetelaar\fut\api\database;

use JKetelaar\fut\api\config\URL;
use JKetelaar\fut\api\database\models\Player;

class Players {
    /**
     * @var string
     */
    private $file;

    /**
     * @var Player[]
     */
    private $cachedPlayers;

    /**
     * @var array
     */
    private $cachedJSON;

    /**
     * Players constructor.
     *
     * @param string $file
     */
    public function __construct($file = DATA_DIR . 'players.json') {
        $this->file          = $file;
        $this->cachedPlayers = []; // Make sure it's an array to avoid notices/warnings

        $this->downloadPlayersFile();
    }

    /**
     * Downloads the players JSON file to the set file location
     */
    private function downloadPlayersFile() {
        file_put_contents($this->file, ($content = file_get_contents(URL::PLAYERS_DATABASE)));
        $this->cachedJSON = json_decode($content, true);
    }

    public function getPlayer($id) {
        if(isset($this->cachedPlayers[ $id ])) {
            return $this->cachedPlayers[ $id ];
        }

        $result = null;
        foreach($this->cachedJSON[ 'Players' ] as $player) {
            if($player[ 'id' ] == $id) {
                $result = $player;
            }
        }

        if($result === null) {
            foreach($this->cachedPlayers[ 'LegendsPlayers' ] as $legend) {
                if($legend[ 'id' ] == $id) {
                    $result = $legend;
                }
            }
        }

        if($result != null) {
            $player                     = Player::toObject($result);
            $this->cachedPlayers[ $id ] = ($result = $player);
        }

        return $result;
    }
}