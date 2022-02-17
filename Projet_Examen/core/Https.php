<?php 

namespace Outind\core;

class Https{
    
    public function redirect(string $path) :void {
    
        header('Location: '.$path);
        exit;
        
    } 
    
    public function isOnline() :bool {
        
        if (array_key_exists('role', $_SESSION)) {
            
            return true;
            
        }else {
         
            return false;
        }
        
    }

    public function isAdmin() :bool {
        
        if (array_key_exists('role', $_SESSION)) {

            switch($_SESSION['role']){

                case 'Admin':
                    return true;
                break;

                case 'User':
                    return false;
                break;    
            }
        }
    }
    
    
    
}