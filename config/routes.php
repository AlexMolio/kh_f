<?php

    return array(
        'admin/postdelete/([0-9]+)' => 'admin/postdelete/$1',
        'admin/post/([0-9]+)' => 'admin/postupdate/$1',
        'admin/postcreate' => 'admin/postcreate/',

        'admin/publicdelete/([0-9]+)' => 'admin/publicdelete/$1',
        'admin/public/([0-9]+)' => 'admin/publicupdate/$1',
        'admin/publiccreate' => 'admin/publiccreate/',
        
        'user/login' => 'user/login',
        'user/logout' => 'user/logout',
        
        'admin/public' => 'admin/public',
        'admin/posts' => 'admin/posts',
        'admin' => 'admin/index',
        '' => 'site/index',
        
    );

?>