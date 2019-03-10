/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* 
 * File:   Die.h
 * Author: John Haller
 *
 * Created on March 10, 2019, 1:25 AM
 */
#include <iostream>

#ifndef DIE_H
#define DIE_H

using namespace std;

class DIE{
private:
    int DieNum;
    string DieName;
    void setNum();
    void setName();
public:
    DIE();
    int getNum(){
        return DieNum;
    }
    string getName(){
        return DieName;
    }
    void print();
    
};

#endif /* DIE_H */

