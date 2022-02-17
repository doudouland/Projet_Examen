<?php 

namespace Outind\models;

Use PDO;
Use Outind\core\Connect;

class User extends Connect{
    
    private $_pdo;
    
    public function __construct(){
        
        $this->_pdo = $this->connexion();
    }
    

    public function addOne(string $lastName,string $psw,string $mail){
        
        $psw = password_hash($psw, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO `users`(`email`, `password`, `lastName`) 
        VALUES (:email,:password,:lastName)";
        $q = $this->_pdo->prepare($sql);
        $q->execute([
                    ':email'    => $mail,
                    ':password' => $psw,
                    ':lastName' => $lastName
                    ]);  
        
        
    }
    
    
    public function findOne($mail){
        
        $sql = "SELECT `id`, `email`, `password`, `lastName`, `role` FROM `users` WHERE `email` = :mail";
        $q = $this->_pdo->prepare($sql);
        $q->execute([
                    ':mail' => $mail
                    ]);  
        
        return $q->fetch(\PDO::FETCH_ASSOC); 
    }
    
    
    public function changePass(array $data)
    {
        $data['password'] = password_hash($data['password2'], PASSWORD_DEFAULT);

        $sql = "UPDATE `users` SET `password`= :password WHERE `id` = :id";
        $q = $this->_pdo->prepare($sql);
        $q->execute([
            ':password' => $data['password'],
            ':id'       => $data['id']
        ]);

    }


    public function updateInfo(array $data)
    {        
        $sql = "UPDATE `users` SET `lastName`=:lastname WHERE id=:id";
        $q = $this->_pdo->prepare($sql);
        $q->execute([
            ':lastname'    => $data['lastName'],
            ':id'          => $data['id']    
        ]);

    }

    
}