<?php

use PHPUnit\Framework\TestCase;
require("src/Game.php");
class GameTest extends TestCase{
    //Vérifie si le joueur change bien de joueur après avoir joué une seule fois
    public function testPlayerPlayOneTimePerRound(){
        $game = new Game();
        $player = $game->getCurrentPlayer();
        $game->action("move", 1);
        $this->assertNotEquals($game->getCurrentPlayer(), $player);
    }
    //Vérifie si un joueur voit un autre joueur sur la ligne ou la column en fonction de sa direction 
    //On compare le status de la partie avec le joueur qui vient de passer son tour
    public function testPlayerCanSeeOtherPlayer(){
        $game = new Game();
        $game->getJoueurs()[1]->setPosition([0,2]);
        $game->action("changeDirection", null, "right");
        $this->assertEquals($game->getStatus(), array("player" => $game->getOtherPlayer(), "number" => 2));
    }

    public function testPlayerCantSeeOtherPlayer(){
        $game = new Game();
        $game->getJoueurs()[1]->setPosition([0,2]);
        $game->action("changeDirection", null, "left");
        $this->assertEquals($game->getStatus(), array());
    }
}