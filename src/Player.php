<?php
require_once("Grille.php");
class Player {
    protected string $name;
    protected array $position;
    
    public function __construct($name, $position){
        $this->name = $name;
        $this->position = $position;
    }

    public function getPosition(){
        return $this->position;
    }
    
    public function move($number){
        $grid = new Grille();
        $grid = $grid->getGrille();
        if($number > 2){
            $number = 0;
        }
        
        if($this->position[0] + $number > 0 && $this->position[0] + $number <= count($grid) -1)
        {
            $this->position[0] += $number;
        }else {
            $this->position[0] = $this->position[0];
        }
    }
}