<?php 

    namespace app\db;
    use \PDO;

    class Db {

        private $db;
        private const DBDRIVE = "mysql";
        private const DBHOST = "localhost";
        private const DBNAME = "base_api";
        private const DBUSER = "root";
        private const DBPASS = "";

        public function __construct() { 
            $this->db = $this->setDb();
        }

        public function setDb() { 

            return new PDO(
                self::DBDRIVE.':host='.self::DBHOST.';dbname='.self::DBNAME, self::DBUSER, self::DBPASS
            );

        }

        public function getDb() { 
            return $this->db;
        }
    }