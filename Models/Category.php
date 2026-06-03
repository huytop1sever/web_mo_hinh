<?php

//dung PDO
require_once '../config/database.php';

class Category
{
    private $pdo;

    public function __construct()
    {
        global $conn;
        $this->pdo = $conn;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC";

        $result = $this->pdo->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $id = (int)$id;

        $sql = "SELECT * FROM categories WHERE id = $id";

        $result = $this->pdo->query($sql);

        return $result->fetch(PDO::FETCH_ASSOC);
    }


}
