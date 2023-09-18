<?php 

    error_reporting(E_ALL); // Error/Exception engine, always use E_ALL
    ini_set('ignore_repeated_errors', TRUE); // always use TRUE
    ini_set('display_errors', FALSE); // eRROR/EXCEPTION DISPLAY, USE false ONLY PRODUCTION EN...
    ini_set('log_errors', TRUE);// ERROR/EXCEPTION file loggin engine.
    ini_set("error_log","F:/wamp64/www/expense/error.log");
    error_log('Inicio de aplicacion web');
    
    require_once 'libs/database.php';
    require_once 'clases/errormessages.php';
    require_once 'clases/successmessages.php';
    require_once 'libs/controller.php';
    require_once 'libs/model.php';
    require_once 'libs/view.php';
    require_once 'clases/sessioncontroller.php';
    require_once 'libs/app.php';
    require_once 'config/config.php';
    include_once 'models/usermodel.php';
    include_once 'models/expensesmodel.php';
    include_once "models/categoriesmodel.php";
    $app = new App();

?>