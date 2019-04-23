<?php

    class PostController
    {
        public function actionView($id):bool
        {
            if (!Post::doesExistPost($id))
                return false;

            Post::incrementViewById($id);

            $post = Post::getPostById($id);

            $userId = $_SESSION['user'] ?? 0;

            $canEdit = $post['userid'] === $userId ? true : false;

            require_once(ROOT.'/views/post/index.php');

            return true;
        }

        public function actionCategory($category):bool
        {
            if ($category === "all")
            {
                $posts = Post::getAllPosts();

                require_once(ROOT.'/views/site/index.php');

                return true;
            }
            
            $posts = Post::getPostsByCategory($category);

            if (!$posts)
                return false;

            require_once(ROOT.'/views/site/index.php');
    
            return true;
        }

        public function actionEdit($id):bool
        {
            if (!isset($_SESSION['user']))
                return false;
            
            $post = Post::getPostById($id);

            $post['text'] = str_replace("<br />", "\n", $post['text']);

            if ($post['userid'] !== $_SESSION['user'])
                return false;

            require_once(ROOT.'/views/post/edit.php');

            return true;
        }

        public function actionEdited():bool
        {
            if (!isset($_POST['title']))
                return false;

            list('title' => $title, 'text' => $text, 'postid' => $id) = $_POST;

            $text = str_replace("\n", "<br />", $text);
            //$text = nl2br($text);

            if (Post::edit($id, $title, $text))
                echo '1';
            else
                echo 'Something went wrong';

            return true;
        }

        public function actionAdd():bool
        {
            if (!isset($_SESSION['user']))
                return false;

            require_once(ROOT.'/views/post/add.php');
            
            return true;
        }

        public function actionAdded():bool
        {
            if (!isset($_POST['title']) || !isset($_POST['text']) || !isset($_POST['category']))
                return false;
                        
            list('title' => $title, 'text' => $text, 'category' => $category) = $_POST;

            $text = str_replace("\n", "<br />", $text);

            if (Post::add($title, $text, $category))
                echo '1';
            else 
                echo "Something goes wrong";

            return true;
        }

        public function actionSearch():bool
        {
            if (!isset($_POST['search']))
                return false;

            $search = $_POST['search'];

            $posts = Post::getPostsBySearch($search);

            require_once(ROOT.'/views/site/index.php');
    
            return true;
        }

        public function actionDelete($id):bool
        {
            if (!isset($_SESSION['user']))
                return false;

            if (!Post::canDelete($id, $_SESSION['user']))
                return false;

            Post::delete($id);

            header("Location: /");

            return true;
        }
    }

?>