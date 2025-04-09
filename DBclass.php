<?php 

class Database{
    private $host = 'localhost';
    private $db_name = 'systemeGestion';
    private $username = 'root';
    private $password = 'Mytech6624';
    public $connection;
    
    
    public function __construct(){
        $this->connection = null;
        try{
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function Connect(){
        return $this->connection;
    }
    
}

?>