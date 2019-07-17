<?php

class Posts
{
    const SHOW_BY_DEFAULT = 6;

    public static function getPostItem($id)
    {

        $productItem = array();

       
        $db = Db::getConnection();

        $result = $db-> query("SELECT * FROM post WHERE id = $id");
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;


        while($row = $result->fetch()){

            $productItem[$i]['id'] = $row['id'];
            $productItem[$i]['title'] = $row['title'];
            $productItem[$i]['text'] = $row['text'];
            $productItem[$i]['content'] = $row['content'];
            $productItem[$i]['content_status'] = $row['content_status'];
            
            
            $productItem[$i]['status'] = $row['status'];
            $i++;
        }

        return $productItem;
    }

    public static function getPostsList()
    {

        $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM post');
            $postsList = array();
            $i = 0;

            if($result){
                while ($row = $result->fetch()) {
                    $postsList[$i]['id'] = $row['id'];
                    $postsList[$i]['title'] = $row['title'];
                    $postsList[$i]['text'] = $row['text'];
                    $postsList[$i]['content'] = $row['content'];
                    $postsList[$i]['create_date'] = $row['create_date'];
                    $postsList[$i]['pub_date'] = $row['pub_date'];
                    $postsList[$i]['status'] = $row['status'];
                    $postsList[$i]['content_status'] = $row['content_status'];
                    
                    $i++;
                }
            }
            return $postsList;
    }


    public static function deletePostById($id)
    {
        
        $db = Db::getConnection();

        $sql = 'DELETE FROM post WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function createPost($options)
    {
        
        $db = Db::getConnection();
       
        $sql = 'INSERT INTO post (title, text, content, status, content_status) VALUES (:title, :text, :content, :status, :content_status)';
        


        $result = $db->prepare($sql);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':text', $options['text'], PDO::PARAM_STR);
        $result->bindParam(':content', $options['content'], PDO::PARAM_STR);
        $result->bindParam(':content_status', $options['content_status'], PDO::PARAM_INT);
        
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);


        if ($result->execute()) {

            return $db->lastInsertId();
        }
        
        return 0;
    }

    public static function updatePost($id, $options)
    {
        $db = Db::getConnection();
       
        $sql = 'UPDATE post SET title = :title, text = :text, content = :content, status = :status, content_status = :content_status  WHERE id = :id';
        


        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':text', $options['text'], PDO::PARAM_STR);
        $result->bindParam(':content', $options['content'], PDO::PARAM_INT);
        $result->bindParam(':content_status', $options['content_status'], PDO::PARAM_INT);
    
      
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

    public static function getTextContentStatus($status)
	{
	    switch ($status) {
	            case '1':
	                return 'Видео';
	                break;
	            case '0':
	                return 'Фото';
	                break;
	        }
	}
	

    public static function getImage($id)
    {
        $noImage = 'no-image.jpg';

        $path = '/upload/images/posts/';

        $pathToProductImage = $path . $id . '.jpg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)){
            return $pathToProductImage;
        }

        return $path.$noImage;
    }

    public static function addImagePath($id)
    {
        $noImage = 'no-image.jpg';

        $path = '/upload/images/posts/';

        $pathToProductImage = $path . $id . '.jpg';

        $db = Db::getConnection();
       
        $sql = 'UPDATE post SET content = :content WHERE id = :id';
        


        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':content',  $pathToProductImage, PDO::PARAM_STR);

        if ($result->execute()) {
            
            return true;
        }
        
        return 0;
    }
    
}
?>