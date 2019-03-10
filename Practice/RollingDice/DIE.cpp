/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#include "Die.h"
#include <cstdlib>
#include <iostream>

DIE::DIE(){
    setNum();
    setName();
    print();
}
void DIE::setNum(){
    this->DieNum=rand()%6+1;
}
void DIE::setName(){
    switch(this->DieNum){
        case 1:this->DieName="DICE/one.png";break;
        case 2:this->DieName="DICE/two.png";break;
        case 3:this->DieName="DICE/three.png";break;
        case 4:this->DieName="DICE/four.png";break;
        case 5:this->DieName="DICE/five.png";break;
        case 6:this->DieName="DICE/six.png";break;
        default: this->DieName="Error";
    }
}

void DIE::print(){
    cout<<this->getName()<<endl;
}