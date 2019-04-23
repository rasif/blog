<?php

    class UserController
    {
        public function actionRegister():bool
        {
            if (!isset($_POST['login']))
                return false;

            list('login' => $login, 'password' => $password, 'email' => $email) = $_POST;

            $error = User::checkEnteredData($login, $password, $email);

            if (empty($error))
                $error = User::register($login, $password, $email);

            echo $error;
            
            return true;
        }

        public function actionAuthorize():bool
        {
            if (!isset($_POST['login']))
                return false;
            
            list('login' => $login, 'password' => $password) = $_POST;

            if ($id = User::checkUser($login, $password))
            {
                $_SESSION['user'] = $id;
                echo '1';
            }
            else
                echo 'This user does not exist';

            return true;
        }

        public function actionExit():bool
        {
            if (isset($_SESSION['user']))
            {
                unset($_SESSION['user']);
                header('Location: /');
            }

            return true;
        }
    }

?>