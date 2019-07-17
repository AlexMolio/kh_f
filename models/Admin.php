<?php

abstract class Admin
{
    public static function checkAdmin()
    {
        
        $userId = User::checkLogged();
       
        $user = User::getUserById($userId);
        
        if($user['status'] == '1'){
            
            return true;
            
        } else {
           
            header("Location: /user/login");
            
        }
    }
}

?>