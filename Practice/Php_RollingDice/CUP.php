<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Cup{
    private $dices=array();
    
    public function Cup(){
        for($i=0;$i<5;$i++){
            $dices[$i]=new Dice;
        }
    }
}