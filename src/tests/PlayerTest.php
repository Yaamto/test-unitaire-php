<?php
use PHPUnit\Framework\TestCase;
require_once("src/Player.php");
require_once("src/Grille.php");
require_once("src/Game.php");

class PlayerTest extends TestCase{

    public function testTwoPlayers(){
       $game = new Game();
       $nbJoueur = count($game->getJoueurs());
       $this->assertEquals($nbJoueur, 2);
    }

    public function testUserCanMove(){
        $player = new Player("basile", [2,3]);
        $position = $player->getPosition();
        $player->move(1);

        $this->assertNotEquals($position, $player->getPosition());
    }
    //Fonction permettant de vérifier que le joueur ne peut sortir de la grille
    public function testPlayerCantGoOut(){
        $player1 = new Player("basile", [9,9]);
        $grid = new Grille();
        $grid = $grid->getGrille();

        $player1->move(1);

        $this->assertEquals($player1->getPosition()[0], count($grid) -1);
        $this->assertEquals($player1->getPosition()[1], count($grid[0]) -1);
  
        $player2 = new Player("basile", [0,0]);
        $player2->move(1);

        $this->assertGreaterThanOrEqual(0, $player2->getPosition()[0]);
        $this->assertGreaterThanOrEqual(0, $player2->getPosition()[1]);
    }

    // Fonction permettant de s'assurer que le joueur ne peut pas se déplacer de plus de 2 cases si c'est le cas alors on force
    // le joueur à se déplacer de 2 cases
    public function testPlayerCanMoveOnlyTwoSteps(){
        $player = new Player("bilal", [2,3]);
        $player->move(3);
        $position = $player->getPosition();
        $this->assertEquals($position[0], 4);
    }

    public function testPlayerCanChangeDirection(){
        $player = new Player("bilal", [2,3]);
        $player->changeDirection("left");
        $this->assertEquals($player->getDirection(), "top");
    }
}
?>