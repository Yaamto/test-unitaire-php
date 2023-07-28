
<?php
require_once("Grille.php");
require_once("Player.php");
class Game {
    protected Grille $grille;
    protected array $joueurs = array();
    protected Player $currentPlayer;
    protected array $status = array();
    protected ?Player $winner = null;

    public function __construct(){
        $this->grille = new Grille();
        $this->grille->createGrille();
        $player1 = new Player("Joueur 1", array(0,0));
        $player2 = new Player("Joueur 2", array(9,9), "left");
        array_push($this->joueurs, $player1);
        array_push($this->joueurs, $player2);
        $this->currentPlayer = $player1;
    }

  
    public function action($action, $number = null, $direction = null){
        if($action == "move"){
            $this->currentPlayer->move($number);
        }
        if($action == "changeDirection"){
            $this->currentPlayer->changeDirection($direction);
        }
        
        $isWinner = $this->checkIfPlayersOnSameCase();

        if($isWinner === true){
            $this->setWinner($this->currentPlayer);
        }else {
            $this->checkIfPlayerCanSee();
            $this->changePlayer();
        }
        
    }   

    public function changePlayer(){
        if($this->currentPlayer == $this->joueurs[0]){
            $this->currentPlayer = $this->joueurs[1];
        }else{
            $this->currentPlayer = $this->joueurs[0];
        }
    }

    public function checkIfPlayerCanSee(){
        $currentPlayer = $this->getCurrentPlayer();
        $otherPlayer = $this->getOtherPlayer();
        $position = $currentPlayer->getPosition();
        $otherPosition = $otherPlayer->getPosition();
        $nbDiffCases = 0;

        if($position[0] === $otherPosition[0]){
           $nbDiffCases = $position[1] - $otherPosition[1];
           if($nbDiffCases <= 0 && $currentPlayer->getDirection() == "bottom"){
                $nbDiffCases = $nbDiffCases * -1;
                $this->status = array("player" => $currentPlayer, "number" => $nbDiffCases);
           }else if($nbDiffCases > 0 && $currentPlayer->getDirection() == "top"){
                $this->status = array("player" => $currentPlayer, "number" => $nbDiffCases);
           }
            
           //Vérifie si le joueur actuelle est sur la même ligne que l'autre joueur, si oui alors on met à jour le status avec le joueur et le nombre de cases qui les séparent
          
        }else if($position[1] === $otherPosition[1]){
            $nbDiffCases = $position[0] - $otherPosition[0];
            //vérifie si les joueurs sont en face, si oui alors on change le status en mettant celui qui voit et le nombre de cases qui les sépares
           if($nbDiffCases <= 0 && $currentPlayer->getDirection() == "left"){
                $nbDiffCases = $nbDiffCases * -1;
                $this->status = array("player" => $currentPlayer, "number" => $nbDiffCases);
              }else if($nbDiffCases > 0 && $currentPlayer->getDirection() == "bottom"){
                $this->status = array("player" => $currentPlayer, "number" => $nbDiffCases);
              }
        }
    }

    public function checkIfPlayersOnSameCase() {
        $currentPlayer= $this->getCurrentPlayer();
        $otherPlayer = $this->getOtherPlayer();
        
        $currentPlayerPosition = $currentPlayer->getPosition();
        $otherPlayerPosition = $otherPlayer->getPosition();
    
        return $currentPlayerPosition[0] === $otherPlayerPosition[0] && $currentPlayerPosition[1] === $otherPlayerPosition[1];
    }

   
    //Permet de calculer le nombre de cases qui séparent les deux joueurs
    public function diffCases($position, $otherPosition, $index){
        if($position[$index] < $otherPosition[$index]){
            return $otherPosition[$index] - $position[$index];
        }else{
            return $position[$index] - $otherPosition[$index];
        }
    }

    public function getOtherPlayer(){
        if($this->currentPlayer == $this->joueurs[0]){
            return $this->joueurs[1];
        }else{
            return $this->joueurs[0];
        }
    }

    public function getWinner(){
        return $this->winner;
    }
    public function setWinner($winner){
        $this->winner = $winner;
    }

    public function getJoueurs(){
        return $this->joueurs;
    }

    public function getCurrentPlayer(){
        return $this->currentPlayer;
    }

    public function getStatus(){
        return $this->status;
    }
}