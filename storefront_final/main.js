/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

document.getElementById('wooden_spoon').onclick = function(){click_button(this.id)};
document.getElementById('piece_of_paper').onclick = function(){click_button(this.id)};
document.getElementById('stapler').onclick = function(){click_button(this.id)};
document.getElementById('push_pin').onclick = function(){click_button(this.id)};
document.getElementById('slotted_wood_spoon').onclick = function(){click_button(this.id)};
document.getElementById('mini_wood_spoon').onclick = function(){click_button(this.id)};
document.getElementById('printer').onclick = function(){click_button(this.id)};
document.getElementById('friends').onclick = function(){click_button(this.id)};
document.getElementById('chair').onclick = function(){click_button(this.id)};
document.getElementById('wrist_guard').onclick = function(){click_button(this.id)};
document.getElementById('fancy_wood_spoon').onclick = function(){click_button(this.id)};
document.getElementById('computer').onclick = function(){click_button(this.id)};

var click_button = function(buttonId){
    console.log(buttonId);
};