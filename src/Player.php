<?php
require_once("Grille.php");
class Player {
    protected string $name;
    protected array $position;
    protected string $direction;
    
    public function __construct($name, $position, $direction = "right"){
        $this->name = $name;
        $this->position = $position;
        $this->direction = $direction;
    }

    public function getPosition(){
        return $this->position;
    }
    
    public function move($number){
        //force l'utilisateur à bouger que de deux cases si supérieur à 2
        if($number > 2){
            $number = 2;
        }
        //Vérifie si le joueur ne sort pas de la grille en x
        if($this->position[0] + $number > 0 && $this->position[0] + $number <= 9)
        {
            $this->position[0] += $number;
        }else {
            $this->position[0] = $this->position[0];
        }
    }
    public function changeDirection($direction){
       //Faire en sorte que le joueur change de direction sur 90 degré
         if($direction == "left"){
              if($this->direction == "right"){
                $this->direction = "top";
              }else if($this->direction == "top"){
                $this->direction = "left";
              }else if($this->direction == "left"){
                $this->direction = "bottom";
              }else if($this->direction == "bottom"){
                $this->direction = "right";
              }
        }
        if($direction == "right"){
            if($this->direction == "right"){
            $this->direction = "bottom";
            }else if($this->direction == "bottom"){
            $this->direction = "left";
            }else if($this->direction == "left"){
            $this->direction = "top";
            }else if($this->direction == "top"){
            $this->direction = "right";
            }
        }
    }
    public function getDirection(){
        return $this->direction;
    }

    public function setPosition($position){
        $this->position = $position;
    }
}