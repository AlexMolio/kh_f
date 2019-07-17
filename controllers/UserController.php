<?php

class UserController
{
    public static function actionLogin()
    {
        $login = '';
        $password = '';
        $errors = false;
        
        if(isset($_POST['submit'])){
            $login = $_POST['login'];
            $password = $_POST['password'];
            
            
            if(!User::checkLogin($login)){
                $errors[] = 'Логин не прошел валидацию!';
            }
            if(!User::checkPassword($password)){
                $errors[] = 'Пароль не долженн быть короче 6-ти символов!';
            }
            if(!is_array($errors)){
                $user = User::checkUserData($login, $password);
                $userId = $user['id'];
                
                
                if($userId == false){
                    
                    $errors[] = 'Неверный логин или пароль!';
                    
                }else {
                    
                    User::auth($userId);
                    
                    header("Location: /admin");
                }
                
            }
        }
        
        require_once(ROOT . '/views/user/login.php');
        
    }
    
    public function actionLogout()
	{
		
		unset($_SESSION["user"]);
		header("Location: /");
	}
    
}

?>