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

    public function testPlayersOnSameCase() {
        $game = new Game();

        $player1 = $game->getJoueurs()[0];
        $player2 = $game->getJoueurs()[1];

        $player1->setPosition([3, 3]);
        $player2->setPosition([3, 3]);

        $this->assertTrue($game->checkIfPlayersOnSameCase());
    }

    public function testPlayersNotOnSameCase() {
        $game = new Game();

        $player1 = $game->getJoueurs()[0];
        $player2 = $game->getJoueurs()[1];

        $player1->setPosition([1, 1]);
        $player2->setPosition([3, 3]);

        $this->assertFalse($game->checkIfPlayersOnSameCase());
    }

    public function testCurrentPlayerWins() {
        $game = new Game();
        $player1 = $game->getJoueurs()[0];
        $player2 = $game->getJoueurs()[1];

        // Positionner les joueurs sur la même case pour simuler une situation de victoire
        $player1->setPosition([2, 3]);
        $player2->setPosition([3, 3]);

        $this->assertNull($game->getWinner());
        // Faire une action (dans cet exemple, un simple déplacement)
        $game->action("move", 1);

        // Vérifier que le currentPlayer est déclaré comme gagnant après l'action
        $this->assertSame($player1, $game->getWinner());
    }

    public function testNoWinnerAfterAction() {
        $game = new Game();
        $player1 = $game->getJoueurs()[0];
        $player2 = $game->getJoueurs()[1];

        $player1->setPosition([2, 3]);
        $player2->setPosition([4, 5]);

        $this->assertNull($game->getWinner());

        $game->action("move", 1);

        $this->assertNull($game->getWinner());
    }

}