<?php
    define('_MYSQL_HOST','127.0.0.1');
    define('_MYSQL_PORT',3306);
    define('_MYSQL_DBNAME','bd_test');
    define('_MYSQL_USER','root');
    define('_MYSQL_PASSWORD','');
    $connectionString = "mysql:host=" . _MYSQL_HOST;

    if (defined('_MYSQL_PORT'))
        $connectionString .= ";port=" . _MYSQL_PORT;

    $connectionString .= ";dbname=" . _MYSQL_DBNAME;

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    try {
        $pdo = new PDO($connectionString, _MYSQL_USER, _MYSQL_PASSWORD, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $erreur) {
        echo 'Erreur : ' . $erreur->getMessage();
    } 


    class User {
        protected $props;

        public function __construct($props = array()){$this->props=$props;}

        public function __get($prop){return $this->props[$prop];}

        public function __set($prop, $val){$this->props[$prop] = $val;}

        public static function query($sql){
            global $pdo;
            $st = $pdo->query($sql) or die("sql query error ! request".$sql);
            $st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
            return $st;
        }

        public function isAdmin(){
            return $this->props['IS_ADMIN'];
        }
    }


