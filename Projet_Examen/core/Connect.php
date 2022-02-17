<?php

namespace Outind\core;

Use \PDO;
Use \Exception;

abstract class Connect{
    
    protected $_host       = 'localhost';
    protected $_dbName     = 'bdd';
    protected $_user       = 'root';
    protected $_password   = '';

    
    public function connexion(){
        try{       
                 
                $pdo = new PDO('mysql:host='.$this->_host.';dbname='.$this->_dbName,$this->_user,$this->_password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->exec('SET NAMES UTF8');
                return $pdo;
                
        }catch(Exception $e){
            
            echo '<br>le fichier d\' erreur est : '.$e->getFile().' veuillez contacter l administrateur';
        }
    
        
    }
    
}