<?php

use PHPUnit\Framework\TestCase;
require_once("src/Grille.php");

/**
 *  @author Bilal Bouterbiat
 */

class GrilleTest extends TestCase {


    public function testGrilleSize(){
        $grille = new Grille();
        $nbColonnes = count($grille->getGrille()[0]);
        $nbLignes = count($grille->getGrille());

        $this->assertEquals($nbColonnes, 10);
        $this->assertEquals($nbLignes, 10);
    }
}
?>