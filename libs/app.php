<?php
    require_once ('controllers/errores.php');
    class App{

        function __construct() {

            $url = isset($_GET['url']) ? $_GET['url'] : '';
            $url = rtrim($url, '/'); // remove '/' de la cadena que venga de $url
            $url = explode('/', $url); // separa en un array coomo elementos a todo lo que haya estado separado por el '/'
            // Ejemplo
            //http://localhost/expense/tumama/entanga/
            //localhost -- elemento 0
            //expense -- elemento 1
            //tumama -- elemento 2, etc.
            // REVISAR HTACCESS PARA SABER DE DONDE VIENE EL $url
            /*
                Con el .htaccess lo que logramos es acortar la url
                de http://localhost/expense/tumama/ quedaria solamente
                /tumama/entanga/
                elemento 0 tumama
                elemento 1 entanga, etc.
            */
            if(empty($url[0])){ // si no existe un controlardor especificado
                $archivoController = 'controllers/principal.php';
                require_once $archivoController;
                /* ACA ES DONDE DECIDIMOS A DONDE MANDAR SI ES QUE NO PONE BIEN LA URL */
                $controller = new Principal();
                $controller->loadModel('principal'); // cargamos el archivo que seria la vista
                $controller->render();  // renderizamos
                /***************************************************/
                return false;
            }
            $archivoController = 'controllers/' . $url[0] . '.php'; // le ponemos el nombre del controller, con la terminacion de su extencion

            if(file_exists($archivoController)){ // si existe el controller
                require_once $archivoController;
                $controller = new $url[0]; // en teoria creariamos un objeto, que vendria espeficado por la url
                $controller->loadModel($url[0]); // mandamos un error (404)

                if(isset($url[1])){ // si existe el metodo
                    if(method_exists($controller, $url[1])){
                        if(isset($url[2])){ //
                            // nro de parametros
                            $nparam = count($url) - 2;
                            //arreglo de parametros
                            $params = [];   

                            for($i = 0; $i < $nparam; $i++){
                                array_push($params, $url[$i] + 2); // esto se encarga de contar los parametros
                            }
                            $controller->{$url[1]}($params); // con esto hacemos que php interprete la cadena como un metodo
                        }else{
                            // no tiene parametros, se manda a llamar el metodo tal cual
                            $controller->{$url[1]}(); // con esto hacemos que php interprete la cadena como un metodo
                            
                        }
                    }else{ 
                        // error, no existe el metodo
                        $controller = new Errores();
                        $controller->render();
                    }
                }else{
                    // no hay metodo a cargar, se carga el metodo por default
                    $controller->render();
                }
            }else{
                // no existe el archivo, manda error
                $controller = new Errores();
                $controller->render();
            }
        }
    }

?>