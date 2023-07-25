<?php

use PHPUnit\Framework\TestCase;
require("src/Game.php");
class TestGame extends TestCase{

    public function testPlayerPlayOneTimePerRound(){
        $game = new Game();
        $player = $game->getCurrentPlayer();
        $game->action("move", 1);
        $this->assertNotEquals($game->getCurrentPlayer(), $player);
    }
}