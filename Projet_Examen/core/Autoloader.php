<?php

namespace Outind;

class Autoloader
{
    
    static function register()
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
        
    }
    
    static function autoload($class){

        
        $class = str_replace(__NAMESPACE__. '\\','',$class);

        
        $class = str_replace('\\','/',$class); 

        
        $directory = __DIR__; 

        $path = $directory.$class;
        
        $path = str_replace('\core','/',$path);

        
        if(file_exists($directory. '/' . $class . '.php')){
            require $directory .'/' . $class . '.php'; 
        }else{
            require $path . '.php';
        }
    }


}