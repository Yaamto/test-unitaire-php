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
        //change le number en positif ou négatif en fonction de la position left/top ou right/bottom
        $number = $this->negativeOrPositiv($number);
        //Vérifier si le joueurs ne sors pas de la grille en fonction de la direction dans laquel il se trouve, si il ne sors pas alors il faut le faire avancer dans la direction
       if($this->direction === "left" || $this->direction === "right"){
           if($this->position[0] + $number > 0 && $this->position[0] + $number <= 9){
                $this->position[0] += $number;
           }
           else {
            $this->position[0] == $this-> position[0];
           }
       } 

       if($this->direction === "bottom" || $this->direction ==="top"){
            if($this->position[1] + $number > 0 && $this->position[1] + $number <= 9){
                $this->position[1] += $number;
            }
            else {
                $this->position[1] = $this->position[1]; 
            }
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

    //permet de renvoyer un nombre négatif ou positif en fonction de la direction du joueur (si c'est à gauche c'est négatif)
    public function negativeOrPositiv($number){
        if($this->direction === "left" || $this->direction === "top"){
            return -$number;
        }else if($this->direction === "right" || $this->direction === "bottom"){
            return $number;
        }
    }
}