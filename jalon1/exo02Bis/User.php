<?php

require_once('init_pdo.php');

class User {
    protected $props;

    public function __construct($props=array()){$this->props=$props;}

    public function __get($prop) { return $this->props[$prop];}
    public function __set($prop, $val) {$this->props[$prop]=$val;}

    public static function query($sql){
        global $pdo;
        $st = $pdo->query($sql) or die("sql query arror ! request : ".$sql);
        $st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
        return $st;
    }

    public function isAdmin(){
        return $this->props['isAdmin'];
    }
}
