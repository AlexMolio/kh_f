<?php

	class Order
	{
		public static function addOrder($name, $email, $comment, $status)
		{

		$db = Db::getConnection();

		$sql = 'INSERT INTO orders (buyer_name, buyer_email, comment, status) VALUES (:name, :email, :comment, :status)';

		//$status = 1;

		echo "2343243";

		$result = $db->prepare($sql);
		$result->bindParam(':name', $name, PDO::PARAM_STR);
		$result->bindParam(':email', $email, PDO::PARAM_STR);
		$result->bindParam(':comment', $comment, PDO::PARAM_STR);
		$result->bindParam(':status', $status, PDO::PARAM_STR);


		return $result->execute();

		}
	

		public static function getOrdersList()
	    {
	        
	        $db = Db::getConnection();
	        
	        $result = $db->query('SELECT id, buyer_name, buyer_email, comment, date, status FROM orders ORDER BY id DESC');
	        $ordersList = array();
	        $i = 0;
	        while ($row = $result->fetch()) {
	            $ordersList[$i]['id'] = $row['id'];
	            $ordersList[$i]['buyer_name'] = $row['buyer_name'];
	            $ordersList[$i]['buyer_email'] = $row['buyer_email'];
	            $ordersList[$i]['comment'] = $row['comment'];
	            
	            $timestamp = strtotime($row['date']);
	            $ordersList[$i]['date'] = date('d.m.Y h:i:s', $timestamp); 
	            
	            $ordersList[$i]['status'] = $row['status'];
	            $i++;
	        }
	        return $ordersList;
	    }
	    
	}

?>