<?php /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dice{
    
    private $DieNum;
    private $DieName;
    private function setNum(){
        $this->DieNum=rand()%6+1;
    }
    
    private function setName(){
        switch($this->DieNum){
        case 1:$this->DieName="DICE/one.png";break;
        case 2:$this->DieName="DICE/two.png";break;
        case 3:$this->DieName="DICE/three.png";break;
        case 4:$this->DieName="DICE/four.png";break;
        case 5:$this->DieName="DICE/five.png";break;
        case 6:$this->DieName="DICE/six.png";break;
        default: $this->DieName="Error";
        }
    }

    public function Dice(){
        $this->setNum();
        $this->setName();
        $this->write();
    }
    public function getNum(){
        return $this->DieNum;
    }
    public function getName(){
        return $this->DieName;
    }
    public function write(){
        echo "<img src=".$this->getName()." />";
        echo "<br/><br/>";
    }
    
    
}

