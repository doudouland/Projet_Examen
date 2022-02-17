<?php

namespace Outind\models;

Use PDO;
Use Outind\core\Connect;

class Edl extends Connect{

    private $_pdo;

    public function __construct(){

        $this->_pdo = $this->connexion();
    }

    public function addOne($param){

        $sql = "INSERT INTO `edl`(``,``) VALUES (:,:)";
        $q = $this->_pdo->prepare($sql);
        $q->execute([
            ':' => $param,
        ]);
    }

    public function findOne($param){

        $sql = "SELECT ``,`` FROM `` WHERE `` = :";
        $q = $this->_pdo->prepare($sql);
        $q->execute([
            ':' => $param,
        ]);

        return $q->fetch(\PDO::FETCH_ASSOC);
    }
}