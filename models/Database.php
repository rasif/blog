<?php

    abstract class Database
    {
        protected static function getConnection()
        {
            $params = self::getParams();
            $options = self::getOptions();

            $dsn = "mysql:host={$params['host']}; dbname={$params['dbname']}; charset={$params['charset']}";
            $db = new PDO($dsn, $params['username'], $params['password'], $options);

            return $db;
        }

        protected static function query($sql, $params = []) 
        {
            $db = self::getConnection();

            $stmt = $db->prepare($sql);

            if (!empty($params)) 
            {
                foreach ($params as $key => $val) 
                {
                    if (is_int($val)) 
                        $type = PDO::PARAM_INT;
                    else 
                        $type = PDO::PARAM_STR;

                    $stmt->bindValue(':'.$key, $val, $type);
                }
            }

            $stmt->execute();

            return $stmt;
        }

        protected static function fetchAll($sql, $params = []) 
        {
            $result = self::query($sql, $params);

            return $result->fetchAll();
        }

        protected static function fetch($sql, $params = []) 
        {
            $result = self::query($sql, $params);

            return $result->fetch();
        }
    
        protected static function fetchColumn($sql, $params = []) 
        {
            $result = self::query($sql, $params);

            return $result->fetchColumn();
        }

        private static function getParams():array
        {
            return array
            (
                "host" => "localhost",
                "dbname" => "medium",
                "username" => "root",
                "password" => "",
                "charset" => "utf8"    
            );
        }

        private static function getOptions():array
        {
            $options = 
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            return $options;
        }
    }

?>