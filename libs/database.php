<?php
class Database{

    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host = constant('HOST'); // ESTAS CONSTANTES
        $this->db = constant('DB'); // LAS DEFINO EN
        $this->user = constant('USER'); // LA CARPETA config/config.php
        $this->password = constant('PASSWORD');
        $this->charset = constant('CHARSET');
    }

    function connect(){
        try{
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $pdo = new PDO($connection, $this->user, $this->password, $options);
            //error_log('Conexión a BD exitosa');
            return $pdo;
        }catch(PDOException $e){
            error_log('Error connection: ' . $e->getMessage());
        }
    }

}

?>