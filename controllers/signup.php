<?php
    require_once 'models/usermodel.php';
    class Signup extends SessionController{
        function __construct()
        {
            parent::__construct();
        }

        function render(){ // mostramos la vista y le pasamos los parametros necesarios
            $this->view->render('login/signup',[]);
        }
        function newUser(){
            if($this->existPOST(['username','password'])){// validamos que exista el username y el password
                $username = $this->getPost('username');
                $password = $this->getPost('password');
                if($username == '' || empty($username) || $password == '' || empty($password)){
                    $this->redirect('signup',['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY]);
                    return false;
                }

                $user = new UserModel();
                $user->setUsername($username);
                $user->setPassword($password);
                $user->setRole('user');
                if($user->exists($username)){
                    $this->redirect('signup',['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS]);
                }else if($user->save()){
                    $this->redirect('signup',['success' => SuccessMessages::SUCCESS_SIGNUP_NEWUSER]);
                }else{
                    $this->redirect('signup',['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
                }
            }else{
                $this->redirect('signup',['error' => ErrorMessages::ERROR_SIGNUP_NEWUSER]);
            }
        }
    }

?>