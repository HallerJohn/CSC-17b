<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Tile{
    private $xpos;
    private $ypos;
    private $number;
    
    function __construct(){
        $this->xpos=4;
        $this->ypos=24;
        $this->number=1;
    }
    public function getX(){
        return $this->xpos;
    }
    public function getY(){
        return $this->ypos;
    }
    public function getNum(){
        return $this->number;
    }
}