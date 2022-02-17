<?php

namespace Outind\controller;

Use Outind\models\User;
Use Outind\Controller\FormController;


class AjaxController {
    
    
    public function changePassword(array $data)
    {
        $form = new FormController(new User());
        $message = $form->formNewPass($data);
        return $message;
    }

    public function formUpInfo(array $data) 
    {
        $form = new FormController(new User());
        $message = $form->formUpInfo($data);
        return $message;
    }
}