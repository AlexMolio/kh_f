<?php

class User
{

	
	public static function auth($userId)
	{
		$_SESSION['user'] = $userId;
	}

	public static function checkLogged()
	
	{

		if(isset($_SESSION['user'])) {
		   
			return $_SESSION['user'];
		}

		header("Location: /user/login");
	}
	
	public static function checkLogin($login) 
	{ 
	    if(strip_tags($login) == $login){
	        
    	    if(strlen($login) >= 2){
    	        return true;
    	    } 
	    }   
	    return false;
	    
	}
	
	public static function checkPassword($password) 
	
	{
	    if(strip_tags($password) == $password){
	        
    	    if(strlen($password) >= 6){
    	        return true;
    	    }
	    }  
	    return false;
	    
	}
	
	public static function checkUserData($login, $password)
	
	{
		$db = Db::getConnection();

		$sql = 'SELECT * FROM user WHERE login = :login AND password = :password';

		$result = $db->prepare($sql);
		$result->bindParam(':login', $login, PDO::PARAM_STR);
		$result->bindParam(':password', $password, PDO::PARAM_STR);
		$result->execute();

		$user = $result->fetch();
		if($user) {
			return $user;
		} else {
		    return false;
		}
	}
	
	public static function getUserById($userId)
	
	{
	    if($userId) {
	        
    	    $db = Db::getConnection();
    	    
    	    $sql = 'SELECT * FROM user WHERE id = :id';
    	    
    	    $result = $db->prepare($sql);
    	    $result->bindParam(':id', $userId, PDO::PARAM_STR);
    	    $result->execute();
    	    
    	    $user = $result->fetch();
	    
	    	if($user) {
		    	return $user;
	    	} else {
		        return false;
		    }
	    }
	}
	
	

}