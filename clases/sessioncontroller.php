<?php
    require_once 'clases/session.php';
    require_once 'models/usermodel.php';
    class SessionController extends Controller{
        private $userSession;
        private $username;
        private $userid;
        private $session;
        private $sites;
        private $user;
        private $defaultSites;

        public function __construct()
        {
            parent::__construct();
            $this->init();
        }

        function init(){
            $this->session = new Session();
            $json = $this->getJSONFileConfig();
            $this->sites = $json['sites'];
            $this->defaultSites = $json['default-sites'];
            $this->validateSession();
        }
        private function getJSONFileConfig(){
            $string = file_get_contents('config/access.json');
            $json = json_decode($string, true);
            return $json;
        }
        public function validateSession(){
            //error_log('SessionController::validateSession');
            // si existe la session
            if($this->existsSession()){
                $role = $this->getUserSessionData()->getRole();
                // si la pagina a entrar es publica
                if($this->isPublic()){
                    $this->redirectDefaultSiteByRole($role);
                }else{
                    // si no es publica
                    if($this->isAuthorized($role)){
                        // lo dejo pasar

                    }else{
                        $this->redirectDefaultSiteByRole($role);
                    }
                }
            }else{
                //no existe la sesion
                if($this->isPublic()){
                    // lo deja entrar
                }else{
                    header('Location: '. constant('URL') . '');
                }
            }
        }
        function existsSession(){
            if(!$this->session->exists()) return false;
            if($this->session->getCurrentUser() == null) return false;

            $userid = $this->session->getCurrentUser();

            if($userid) return true;

            return false;
        }
        function getUserSessionData(){
            $id = $this->session->getCurrentUser();
            $this->user = new UserModel();
            $this->user->get($id);
            //error_log('SessionController::getUserSessionData -> '. $this->user->getUsername());

            return $this->user;
        }
        function isPublic(){
            $currentURL = $this->getCurrentPage();
            $currentURL = preg_replace("/\?.*/","",$currentURL);// expresion regular, elimino los caracteres especiales que no necesito para la url
            for($i=0; $i < sizeof($this->sites); $i++){
                if($currentURL == $this->sites[$i]['sites'] && $this->sites[$i]['access'] == 'public'){
                    return true;
                }
            }
            return false;
        }
        private function getCurrentPage(){
            $actualLink = trim("$_SERVER[REQUEST_URI]");
            $url = explode('/', $actualLink);
            //error_log('SessionController::getCurrentPage -> '. $url[2]);
            return $url[2];
        }
        private function redirectDefaultSiteByRole($role){
            $url = '';
            for($i=0; $i < sizeof($this->sites); $i++){
                if($this->sites[$i]['role'] == $role){
                    $url = '/expense/' . $this->sites[$i]['sites'];
                    break;
                }
            }
            header('location: ' . $url);
        }
        function isAuthorized($role){
            $currentURL = $this->getCurrentPage();
            $currentURL = preg_replace("/\?.*/","",$currentURL);// expresion regular, elimino los caracteres especiales que no necesito para la url
            for($i=0; $i < sizeof($this->sites); $i++){
                if($currentURL == $this->sites[$i]['sites'] && $this->sites[$i]['role'] == $role){
                    return true;
                }
            }
            return false;
        }

        function initialize($user) {
            $this->session->setCurrentUser($user->getId());
            $this->authorizeAccess($user->getRole());
        }
        function authorizeAccess($role){
            switch($role){
                case 'user':   
                    $this->redirect($this->defaultSites['user'], []);
                break;

                case 'admin':   
                    $this->redirect($this->defaultSites['admin'], []);
                break;
            }
        }

        function logout(){
            $this->session->closeSession();
        }

    }

?>