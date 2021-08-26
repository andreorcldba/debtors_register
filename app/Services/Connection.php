<?php

namespace App\Services;
use PDO;

class Connection
{
    protected $username = null;
    protected $password = null;
    protected $database = null;
    protected $type = null;
    protected $port = null;
    protected $host = null;
    public $_db_connect;

    public function __construct() {
        $parsed = parse_ini_file('../.env', true);

        $this->username = $parsed["DB_USERNAME"];
        $this->password = $parsed["DB_PASSWORD"];
        $this->database = $parsed["DB_DATABASE"];
        $this->type = $parsed["DB_TYPE"];
        $this->port = $parsed["DB_PORT"];
        $this->host = $parsed["DB_HOST"];
    }

    function db_connect(){

        try {
            $this->_db_connect = new PDO("$this->type:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->_db_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->_db_connect; 
        } catch(PDOException $e) {
            return 'ERROR: ' . $e->getMessage();
        }
    }

    function db_close(){
        $this->_db_connect = null;
    }
}