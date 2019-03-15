<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tetris</title>
        <?php   include 'Field.php';
//                include 'jquery-3.3.1.js';
        ?>
        <style>
            body {
              background-color: white;
              text-align: center;
            }
        </style>
    </head>
    <body>
        <?php $object = new Field() ?>
        
        <div id="field">
            <p style="display: inline-table;
               border:5px black;
               line-height: 0;
               border-style: solid;
               border-color: black;
               box-sizing: content-box;">
                <?php
                $object->display();
                ?>
            </p>
        </div>
        <?php
            $object->play();
            refresh();
        ?>
        
        <script type="text/javascript" src="jquery-3.3.1.js"></script>
        <script type="text/javascript">
            function refresh(){
                setTimeout(function(){
                    $('#field').load(' #field');
                    refresh();
                }, 2000);
            }
        </script>
            
    
    </body>
    
    
    
</html>


