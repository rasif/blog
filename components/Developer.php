<?php

    class Developer
    {
        public static function debug($variable)
        {
            echo '<pre> '.var_dump($variable).'</pre>';

            exit;
        }

        public static function nocache()
        {
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        }
    }

?>