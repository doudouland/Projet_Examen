<?php

namespace Outind\core;

class Cookies
{
    
    static function deleteCookie(array $cookies) :void{
        
        foreach($cookies as $cookieName){
            
        
            if(array_key_exists($cookieName,$_COOKIE)){
                
                setcookie($cookieName);                                                
                unset($_COOKIE[$cookieName]);
                                                                
            }
            
            
        }
        
    }
    
     
    static function setCookies(array $cookies,array $array) :void{
        
            foreach($cookies as $cookieName){
                
            setcookie($cookieName,$array[$cookieName],time()+365*24*3600);
    
        }
        
    }
        
    public function checkCookie(string $cookieName) :void{
        
        if(array_key_exists($cookieName,$_COOKIE)){
                                                            
            echo "value='".$_COOKIE[$cookieName]."'";
                                                            
        }
        
    }
}