<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include ("Tile.php");

class Field{
    private $width;
    private $height;
    private $grid=array();
    
    function __construct(){
        $this->width=10;
        $this->height=25;
        for($i=0;$i<$this->height;$i++){
            for($j=0;$j<$this->width;$j++){
                $this->grid[$i][$j]=0;
            }
        }
    }
    public function display(){
        for($i=$this->height-1;$i>=0;$i--){
            for($j=$this->width-1;$j>=0;$j--){
                if($this->grid[$i][$j]==0){
                    echo "<img src= Images/WhiteTile.png width=25 height=25 />";
                }else if($this->grid[$i][$j]==1){
                    echo "<img src= Images/BlueTile.png width=25 height=25 />";
                }
            }
            echo ("<br>");
        }
    }
    
    public function play(){
        $var= new Tile();
        $this->place($var->getX(),$var->getY(),$var->getNum());
        
//        $this->display();
    }
    
    public function place($xpos, $ypos, $num){
        $this->grid[$xpos][$ypos]=$num;
    }
    
}