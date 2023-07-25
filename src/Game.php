
<?php
require_once("Grille.php");
require_once("Player.php");
class Game {
    protected Grille $grille;
    protected array $joueurs = array();
    protected Player $currentPlayer;

    public function __construct(){
        $this->grille = new Grille();
        $this->grille->createGrille();
        $player1 = new Player("Joueur 1", array(0,0));
        $player2 = new Player("Joueur 2", array(0,0));
        array_push($this->joueurs, $player1);
        array_push($this->joueurs, $player2);
        $this->currentPlayer = $player1;
    }

   public function getJoueurs(){
        return $this->joueurs;
    }

    public function getCurrentPlayer(){
        return $this->currentPlayer;
    }
    public function action($action, $number){
        if($action == "move"){
            $this->currentPlayer->move($number);
        }
        $this->changePlayer();
    }   
    public function changePlayer(){
        if($this->currentPlayer == $this->joueurs[0]){
            $this->currentPlayer = $this->joueurs[1];
        }else{
            $this->currentPlayer = $this->joueurs[0];
        }
    }
}