<?php



class AdminController
{
	public function actionIndex()
    {
        
        if(Admin::checkAdmin()){
            
        	require_once (ROOT . '/views/admin/index.php');
        	
        }
        
    	return true;
    }

    public function actionPosts()
    {
        if(Admin::checkAdmin()){

        	$productList = Posts::getPostsList();

        	require_once (ROOT . '/views/admin/posts.php');
    	
        }

    	return true;
    }
    
     public function actionPostupdate($id)
    {
        if(Admin::checkAdmin()){
        
            $result = false;
            $errors = false;
        	$postItem = Posts::getPostItem($id);
        	
        	if(isset($_POST['submit'])) {
    			$options['title'] = $_POST['title'];
    			$options['text'] = $_POST['text'];
                $options['content'] = str_replace("watch?v=", "embed/", $_POST['link']);
    			$options['content_status'] = $_POST['content_status'];
		
    			$options['status'] = $_POST['status'];
    			
    		
    			
    		    if($errors == false){

                    if(Posts::updatePost($id, $options))

                    if(is_uploaded_file($_FILES["content"]["tmp_name"])){
                            move_uploaded_file($_FILES["content"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/posts/{$id}.jpg");

                         Posts::addImagePath($id);   
                    }

                    

                    $result = true;
                
    		    }
                
        	}
        	
    
        	require_once (ROOT . '/views/admin/postupdate.php');

        }

    	return true;
    }
    
    public function actionPostcreate(){
        
        if(Admin::checkAdmin()){
        
            $result = false;
            $errors = false;
            
            if(isset($_POST['submit'])) {
                $options['title'] = $_POST['title'];
                $options['text'] = $_POST['text'];
                $options['content'] = str_replace("watch?v=", "embed/", $_POST['link']);
                $options['status'] = $_POST['status'];
                $options['content_status'] = $_POST['content_status'];
    			
    			
    			
    		    if($errors == false){


                    $id = Posts::createPost($options);


                    if($id){
                        
                        if(is_uploaded_file($_FILES["content"]["tmp_name"])){

                            move_uploaded_file($_FILES["content"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/posts/{$id}.jpg");

                            Posts::addImagePath($id);
                        }

                        
                        $result = true;

                      }  
    		    }
            
        	}
            
            require_once (ROOT . '/views/admin/postcreate.php');
            
        }
        return true;
    }
    
    public function actionPostdelete($id)
	{
		if(Admin::checkAdmin()){

    			Posts::deletePostById($id);
    
    			header("Location: /admin/posts");
    		
		}
    		
		return true;
	}

    public function actionPublic()
    {
        if(Admin::checkAdmin()){

            $publicList = Publications::getPublicList();

            require_once (ROOT . '/views/admin/public.php');
        
        }

        return true;
    }

    public function actionPublicupdate($id)
    {
        if(Admin::checkAdmin()){
        
            $result = false;
            $errors = false;
            $publicItem = Publications::getPublicItem($id);
            
            if(isset($_POST['submit'])) {
                $options['title'] = $_POST['title'];
                $options['date_from'] = $_POST['date_from'];
                $options['date_to'] = $_POST['date_to'];
                $options['hw_player'] = $_POST['hw_player'];
                $options['present'] = $_POST['present'];
                $options['link'] = $_POST['link'];
               
                $options['status'] = $_POST['status'];
                
                
                if($errors == false){

                    $result = Publications::updatePublic($id, $options);
                
                }
                
            }
            
    
            require_once (ROOT . '/views/admin/publicupdate.php');

        }

        return true;
    }
    
    public function actionPubliccreate(){
        
        if(Admin::checkAdmin()){
        
            $result = false;
            $errors = false;
            
            if(isset($_POST['submit'])) {
                $options['title'] = $_POST['title'];
                $options['date_from'] = $_POST['date_from'];
                $options['date_to'] = $_POST['date_to'];
                $options['hw_player'] = $_POST['hw_player'];
                $options['present'] = $_POST['present'];
                $options['link'] = $_POST['link'];
               
                $options['status'] = $_POST['status'];
                
                
                if($errors == false){

                    $result = Publications::createPublic($options);
                    
                }
            
            }
            
            require_once (ROOT . '/views/admin/publiccreate.php');
            
        }
        return true;
    }
    
    public function actionPublicdelete($id)
    {
        if(Admin::checkAdmin()){

                Publications::deletePublicById($id);
    
                header("Location: /admin/public");
            
        }
            
        return true;
    }
}

?>