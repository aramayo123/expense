<?php 

    class Errores extends Controller{

        function __construct() {
            parent::__construct();
            //error_log('Errores::construct-> Inicio de errores');
        }

        function render(){
            //error_log('Errores::render-> Si renderiza');
            $this->view->render('errores/index');
        }

    }


?>