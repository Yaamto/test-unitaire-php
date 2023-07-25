

// Vérifier que la grille soit de 10 sur 10

<?php

class Grille {
    protected array $grille = array();
    protected int $nbLignes = 10;
    protected int $nbColonnes = 10;

    public function __construct(){
        $this->createGrille();
    }

    public function createGrille(){
        for($i = 0; $i < $this->nbLignes; $i++){
            $this->grille[$i] = array();
            for($j = 0; $j < $this->nbColonnes; $j++){
                $this->grille[$i][$j] = 0;
            }
        }
    }

    public function getGrille(){
        return $this->grille;
    }
}