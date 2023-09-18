<?php

    class Principal extends SessionController{  // 

        function __construct() {
            parent:: __construct(); // con esto llamamos al constructor padre
        }

        function render(){
            $this->view->render('principal/index');
        }
    }
?>