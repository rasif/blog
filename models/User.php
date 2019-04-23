<?php 

    class User extends Database
    {
        private const LOGIN_LENGTH = 3;
        private const PASSWORD_LENGTH = 3;

        public static function register(string $login, string $password, string $email):string
        {
            $sql = "INSERT INTO users(login, password, email) VALUES(:login, :password, :email)";

            $params = 
            [
                'login' => $login,
                'password' => $password,
                'email' => $email
            ];

            self::query($sql, $params);

            return "1";
        }

        public static function checkUser(string $login, string $password):int
        {
            $sql = "SELECT userid FROM users WHERE login = :login AND password = :password";

            $params = 
            [
                'login' => $login,
                'password' => $password
            ];
            
            return self::fetchColumn($sql, $params);
        }

        public static function checkEnteredData(string $login, string $password, string $email):string
        {
            $error = "";

            if (!self::checkLogin($login))
                $error = "Your login is very easy";
            else if (!self::checkPassword($password))
                $error = "Your password is very easy";
            else if (!self::checkEmail($email))  
                $error = "Invalid email";
            else if (self::checkExistence("login", $login))
                $error = "Type another login. This one exists";
            else if (self::checkExistence("email", $email))
                $error = "Type another email. This one exists";
            
            return $error;
        }

        public static function checkEmailExistence(string $email):bool
        {
            $sql = "SELECT email FROM users WHERE email = :email";

            $params = ['email' => $email];

            return self::fetchColumn($sql, $params);
        }

        public static function checkExistence(string $name, string $value):bool
        {
            $sql = "SELECT $name FROM users WHERE $name = :value";

            $params = ['value' => $value];
        
            return self::fetchColumn($sql, $params);
        }

        public static function checkLogin($login):bool
        {
            return strlen($login) > self::LOGIN_LENGTH;
        }
        
        public static function checkPassword($password):bool
        {
            return strlen($password) > self::PASSWORD_LENGTH;
        }
        
        public static function checkEmail($email):bool
        {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }
    }

?>
