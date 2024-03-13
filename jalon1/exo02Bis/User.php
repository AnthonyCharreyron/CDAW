<?php

class User {
    protected $props;

    public function __construct($props=array()){$this->props=$props;}

    public function __get($prop) { return $this->props[$prop];}
    public function __set($prop, $val) {$this->props[$prop]=$val;}

    protected static function query($sql){
        $st = static::db()->query($sql) or die("sql query arror ! request : ".$sql);
        $st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, gate_called_class());
        return $st;
    }

    public function isAdmin(){
        return $this->props['isAdmin'];
    }
}
