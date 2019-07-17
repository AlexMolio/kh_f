<?php



class SiteController
{
    public function actionIndex()
    {

    	$publicList = Publications::getPublicList();
		
		$postsList = Posts::getPostsList();

        require_once (ROOT . '/views/site/index.php');

        return true;
    }

    public function actionAdmin()
    {
    	

    	require_once (ROOT . '/views/admin/index.php');


    	return true;
    }
}

?>