<?php 
session_start();

Use Outind\Autoloader;
Use Outind\Core\{Cookies,Https};
Use Outind\Controller\{FormController, AjaxController};
Use Outind\Models\User;

require_once 'Core/Autoloader.php';

Autoloader::register();


$userModel       = new User();
$http            = new Https();
$cookies         = new Cookies();
$formController  = new FormController($userModel); 


$fmt = new NumberFormatter( 'fr_FR', NumberFormatter::CURRENCY );

if(array_key_exists('ajax',$_GET)){
    
    if(!array_key_exists('action', $_POST)) 
        $http->redirect('index.php?action=home');
    
    $ajax = new AjaxController();
    
    switch($_POST['action']) 
    {
        case 'upPass':
            echo $ajax->changePassword($_POST);
        break;

        case 'upInfo':
            $message = $ajax->formUpInfo($_POST);
            echo json_encode($message);
        break;
    }
    
}
elseif(array_key_exists('action',$_GET)){
    
    switch($_GET['action']){
        
        
        case 'home':
            
            $path = 'home.php';
        break;

         
        case 'register':
             
            ($http->isOnline()) ? $http->redirect('index.php') : '' ; 

            

            if($_POST):
                $message = $formController->controlRegister($_POST);  
                
            endif;
            $path = 'register.php';
        break;
        case 'login':
            
            ($http->isOnline()) ? $http->redirect('index.php') : '' ; 

            if($_POST):
                $message = $formController->controlLogin($_POST); 
                
            endif;
            $path = 'login.php';
        break;
        case 'logout':
            session_destroy();
            $http->redirect('index.php');
        break;


        case 'account':
            $path = 'account.php';
            
        break;
        default:
        $http->redirect('index.php');
    
    }
     
 
    require 'template/template.php';

}else{
    
    $http->redirect('index.php?action=home');
    
}



