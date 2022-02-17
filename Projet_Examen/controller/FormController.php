<?php 

namespace Outind\Controller;

Use Outind\core\{Https,Cookies};
Use Outind\models\User;


class FormController{
    
    protected $_user; 
    
    public function __construct(User $user){
        $this->_user = $user;
    }
    
    
    public function controlRegister(array $post){

        if(isset($post['lastName'],$post['email'],$post['password'],$post['password2'])
        && !empty($post['lastName'])    && !empty($post['email'])
        && !empty($post['password'])    && !empty($post['password2'])){
            
            $message = [];

            if($post['password'] !== $post['password2'] ) {
                $message[] = ' mot de passe et confirmation differents ';
            }

            if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
                $message[] = ' ce n\'est pas une adresse e-mail  ';
            }
            
             
            $user = $this->_user->findOne($post['email']);
            
            
            
            
            if(empty($user) && count($message) === 0){
                
                $this->_user->addOne($post['lastName'],$post['password'],$post['email']);
                            
                return ["Bravo l'enregistrement à bien été éfféctué "];
                
            
            }elseif($user && count($message) === 0){
                
                return ["Cette adresse email est deja utilisée "];
            } 
             
            return $message;
            
            
        }else{
            
            return ['veuillez remplir les champs '];
            
        }
        
        
    }
    
    
    public function controlLogin(array $post){
        
        if(!empty($post['email']) && !empty($post['password']) )
        {
             
            $user = $this->_user->findOne($post['email']);
            
            if(empty($user) || password_verify($post['password'], $user['password']) == false){
                
                return ["Mot de passe incorrect ou mail incorrect "];
                
            }else{

                if(isset($post['remember'])){
                    
                    Cookies::setCookies(['email','password'],[ 'email' => $post['email'], 'password' => $post['password']]);
                
                }else{
                    
                    Cookies::deleteCookie(['email','password']);
                }
                 
                $_SESSION['id']             = intval($user['id']);
                $_SESSION['lastName']       = htmlspecialchars($user['lastName']);
                $_SESSION['email']          = htmlspecialchars($user['email']);
                $_SESSION['role']           = $user['role'];
                
                
                $http = new Https();
                $http->redirect('index.php');
                    
                
            }
        } else {
            return ["veuillez remplir les champs"];
        
        }
        
        
    }


    public function formNewPass(array $post):string
    {
        if(!empty($post['password1']) 
            && !empty($post['password2']) 
            && !empty($post['password3']) 
            && !empty($post['id']))
        {
            $user = $this->_user->findOne($_SESSION['email']);

            if(password_verify($post['password1'], $user['password']) == false){
                return "Mot de passe incorrect";   
            }

            if($post['password2'] != $post['password3']){
                return 'les deux mots de passe ne concordent pas';
            }
             
            $this->_user->changePass($post);
            return 'la modification sera prise en compte a la prochaine connexion';
            
        } else {
            return "veuillez remplir les champs";
        }

        
    }

    public function formUpInfo(array $data) :string
    {
        if(!empty($data['lastName'])  
            && !empty($data['id']))
        {
            $error = [];
            
            if(count($error) == 0){

                $this->_user->updateInfo($data);
                $_SESSION['lastName']       = htmlspecialchars($data['lastName']);
                return 'la modification à bien été prise en compte';

            }
            
        } else {

            return "veuillez remplir les champs";
        
        }
    }
    
}