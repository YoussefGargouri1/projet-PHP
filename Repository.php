<?php
class Repository {
    private $pdo ;
    private $table;
    //constructeur pour initialiser la connexion a la basse de donnees
    public function __construct ($pdo , $table){
        $this -> pdo = $pdo ;
        $this -> table = $table;
    }
    //la methode findAll
    public function findAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // la methode findByID
    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //la methode create(%data)
    public function create($data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");
        $stmt->execute($data);
    }

    //la methode delete($id)
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

} 