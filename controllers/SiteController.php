<?php

    class SiteController 
    {
        public function actionIndex():bool
        {
            if (isset($_SESSION['user']))
                $posts = Post::getPostsByUserId($_SESSION['user']);
            else 
                $posts = Post::getAllPosts();

            require_once(ROOT.'/views/site/index.php');

            return true;
        }
    }

?>