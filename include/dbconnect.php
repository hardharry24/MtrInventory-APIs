<?php

require_once '../include/dbconfig.php';


class Database 
{
    private $_connection;
    private static $_instance;
    private $_host = DB_HOST;
    private $_user = DB_USER;
    private $_pass = DB_PASS;
    private $_db = DB_NAME;

    public static function getInstance()
    {
        if(!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        $this->_connection = new mysqli($this->_host, $this->_user, $this->_pass, $this->_db);
    }

    public function getConnection()
    {
        return $this->_connection;
    }

    private function __clone() {}
}

?>