<?php

    class Post extends Database
    {
        public static function getPostsByUserId(int $id)
        {
            $sql = "SELECT * FROM posts WHERE userid = :userid";

            $params = ["userid" => $id];

            return self::fetchAll($sql, $params);
        }

        public static function getAllPosts()
        {
            $sql = "SELECT * FROM posts";

            return self::fetchAll($sql);
        }

        public static function getPostById(int $id)
        {
            $sql = "SELECT * FROM posts WHERE postid = :postid";

            $params = ["postid" => $id];

            return self::fetch($sql, $params);
        }

        public static function getPostsByCategory(string $category)
        {
            $sql = "SELECT * FROM posts WHERE category = :category";

            $params = ["category" => $category];

            return self::fetchAll($sql, $params);
        }

        public static function getPostsBySearch(string $search)
        {
            $sql = "SELECT * FROM posts WHERE text LIKE '%$search%'";

            return self::fetchAll($sql);
        }

        public static function doesExistPost(int $id):bool
        {
            $sql = "SELECT postid FROM posts WHERE postid = :postid";

            $params = ["postid" => $id];

            return self::fetchColumn($sql, $params);
        }

        public static function incrementViewById(int $id)
        {
            $sql = "UPDATE posts SET views = views+1 WHERE postid = :postid";

            $params = ["postid" => $id];

            return self::query($sql, $params);
        }

        public static function edit(int $id, string $title, string $text)
        {
            $sql = "UPDATE posts SET title = :title, text = :text WHERE postid = :postid";

            $params = 
            [
                "title" => $title, 
                "text" => $text,
                "postid" => $id
            ];

            return self::query($sql, $params);
        }

        public static function add(string $title, string $text, string $category)
        {
            $sql = "INSERT INTO posts(title, text, category, userid) VALUES(:title, :text, :category, :userid)";

            $params = 
            [
                "title" => $title, 
                "text" => $text,
                "category" => $category,
                "userid" => $_SESSION['user']            
            ];

            return self::query($sql, $params);
        }

        public static function delete($id)
        {
            $sql = "DELETE FROM posts WHERE postid = :id";

            $params = ["id" => $id];

            return self::query($sql, $params);
        }

        public static function canDelete($postid, $userid)
        {
            $sql = "SELECT userid FROM posts WHERE postid = :postid";

            $params = ["postid" => $postid];

            $id = self::fetchColumn($sql, $params);

            if (isset($id) && $id === $userid)
                return true;

            return false;
        }
    }

?>