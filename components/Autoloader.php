<?php

    class Autoloader
    {
        private $classes = [];

        public function __construct()
        {
            spl_autoload_register([$this, 'loadAuto']);
        }

        public function initiate(string $sourcePath)
        {
            $this->registerClass('Router', $sourcePath.'/components/Router.php');
            $this->registerClass('Developer', $sourcePath.'/components/Developer.php');

            $this->registerClass('SiteController', $sourcePath.'/controllers/SiteController.php');
            $this->registerClass('UserController', $sourcePath.'/controllers/UserController.php');
            $this->registerClass('PostController', $sourcePath.'/controllers/PostController.php');

            $this->registerClass('Database', $sourcePath.'/models/Database.php');
            $this->registerClass('User', $sourcePath.'/models/User.php');
            $this->registerClass('Post', $sourcePath.'/models/Post.php');
        }

        private function registerClass(string $name, string $path)
        {
            if (file_exists($path))
            {
                $this->classes[$name] = $path;
            }
        }

        private function loadAuto(string $className)
        {
            if (!empty($this->classes[$className]))
            {
                require_once($this->classes[$className]);
            }
        }
    }

?>