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

    public function testPlayerCanMoveOneStep(){
        $player = new Player("bilal", [2,3]);
        $player->move(1);
        $this->assertEquals($player->getPosition(), [3,3]);
    }

    public function testPlayerCanMoveTwoStep(){
        $player = new Player("Bilal", [2,3]);
        $player->move(2);
        $this->assertEquals($player->getPosition(), [4,3]);
    }

    // Fonction permettant de s'assurer que le joueur ne peut pas se déplacer de plus de 2 cases si c'est le cas alors on force
    // le joueur à se déplacer de 2 cases
    public function testPlayerCantMoveMoreTwoSteps(){
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

    public function testNumberIsNegativOrPositiv(){
        $player = new Player("Test Player", [0, 0], "left");
        $this->assertEquals(-2, $player->negativeOrPositiv(2));

        //le joueur est maintenant orienté vers le haut
        $player->changeDirection("right");
        $this->assertEquals(-3, $player->negativeOrPositiv(3));
        
        //le joueur est maintenant orienté vers la droite
        $player->changeDirection("right");
        $this->assertEquals(4, $player->negativeOrPositiv(4));

        //le joueur est maintenant orienté vers le bas
        $player->changeDirection("right");
        $this->assertEquals(1, $player->negativeOrPositiv(1));
    }

    public function testPlayerCantGoOutsideBottom(){
        $player1 = new Player("bilal", [9,9], "bottom");
        $player1->move(1);
        $position1 = $player1->getPosition();
        $this->assertEquals($position1, [9,9]);
    }
    public function testPlayerCantGoOutsideRight(){
        $player = new Player("basile", [9,9], "right");
        $player->move(1);
        $position = $player->getPosition();
        $this->assertEquals($position, [9,9]);
    }
    public function testPlayerCantGoOutsideTop(){
        $player = new Player("basile", [0,0], "top");
        $player->move(1);
        $position = $player->getPosition();
        $this->assertEquals($position, [0,0]);
    }
    public function testPlayerCantGoOutsideLeft(){
        $player = new Player("basile", [0,0], "left");
        $player->move(1);
        $position = $player->getPosition();
        $this->assertEquals($position, [0,0]);
    }

}
?>