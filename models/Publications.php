<?php

class Publications
{
    const SHOW_BY_DEFAULT = 6;

    public static function getPublicItem($id)
    {

        $publicItem = array();

       
        $db = Db::getConnection();

        $result = $db-> query("SELECT * FROM public WHERE id = $id");
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;


        while($row = $result->fetch()){

                $publicItem[$i]['id'] = $row['id'];
                $publicItem[$i]['title'] = $row['title'];

                $timestamp = strtotime($row['date_from']);
                $publicItem[$i]['date_from'] = date('d.m.Y', $timestamp);

                $timestamp = strtotime($row['date_to']);
                $publicItem[$i]['date_to'] = date('d.m.Y', $timestamp);



                $publicItem[$i]['hw_player'] = $row['hw_player'];
                $publicItem[$i]['present'] = $row['present'];
                $publicItem[$i]['link'] = $row['link'];
                $publicItem[$i]['create_date'] = $row['create_date'];
                $publicItem[$i]['pub_date'] = $row['pub_date'];
              
                $publicItem[$i]['status'] = $row['status'];
            $i++;
        }

        return $publicItem;
    }

    public static function getPublicList()
    {

        $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM public');
            $publicList = array();
            $i = 0;
            while ($row = $result->fetch()) {
                $publicList[$i]['id'] = $row['id'];
                $publicList[$i]['title'] = $row['title'];

                $timestamp = strtotime($row['date_from']);
                $publicList[$i]['date_from'] = date('d.m.Y', $timestamp);

                $timestamp = strtotime($row['date_to']);
                $publicList[$i]['date_to'] = date('d.m.Y', $timestamp);

                $publicList[$i]['hw_player'] = $row['hw_player'];
                $publicList[$i]['present'] = $row['present'];
                $publicList[$i]['link'] = $row['link'];
                $publicList[$i]['create_date'] = $row['create_date'];
                $publicList[$i]['pub_date'] = $row['pub_date'];
              
                $publicList[$i]['status'] = $row['status'];
                
                $i++;
            }
            return $publicList;
    }


    public static function deletePublicById($id)
    {
        
        $db = Db::getConnection();

        $sql = 'DELETE FROM public WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function createPublic($options)
    {
        
        $db = Db::getConnection();
       
        $sql = 'INSERT INTO public (title, date_from, date_to, hw_player, present, link, status) VALUES (:title, :date_from, :date_to, :hw_player, :present, :link, :status)';
        


        $result = $db->prepare($sql);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':date_from', $options['date_from'], PDO::PARAM_STR);
        $result->bindParam(':date_to', $options['date_to'], PDO::PARAM_STR);
        $result->bindParam(':hw_player', $options['hw_player'], PDO::PARAM_STR);
        $result->bindParam(':present', $options['present'], PDO::PARAM_STR);
        $result->bindParam(':link', $options['link'], PDO::PARAM_STR);
        
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);



        if ($result->execute()) {

            return true;
        }
        
        return 0;
    }

    public static function updatePublic($id, $options)
    {
        $db = Db::getConnection();
       
        $sql = 'UPDATE public SET title = :title, date_from = :date_from, date_to = :date_to, hw_player = :hw_player, present = :present, link = :link, status = :status WHERE id = :id';
        


        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':date_from', $options['date_from'], PDO::PARAM_STR);
        $result->bindParam(':date_to', $options['date_to'], PDO::PARAM_STR);
        $result->bindParam(':hw_player', $options['hw_player'], PDO::PARAM_STR);
        $result->bindParam(':present', $options['present'], PDO::PARAM_STR);
        $result->bindParam(':link', $options['link'], PDO::PARAM_STR);
      
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);



        if ($result->execute()) {
            

            return true;
        }
        
        return 0;
    }
    
    public static function getTextStatus($status)
	{
	    switch ($status) {
	            case '1':
	                return 'Отображается';
	                break;
	            case '0':
	                return 'Скрыт';
	                break;
	        }
	}
	

	

    
}
?>