<?php
    class db{
        //Properties
        private $dbhost = '192.168.64.2';
        private $dbuser = 'root1';
        private $dbpass = 'root1';
        private $dbname = 'ieee';

          //Connection
        public function connect(){
        $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str,$this->dbuser,$this->dbpass);
        $dbConnection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
    }
