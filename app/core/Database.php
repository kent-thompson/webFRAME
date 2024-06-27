<?php
namespace App\core;

class Database {
    protected $host;
    protected $db;
    protected $user;
    protected $pass;
    //protected $protocol = 'TCP';
    protected $port;
    protected $charset;
    protected $options;

    private $info;
    private $pdo = null;

    function __construct() {

        $local = getenv('LOGNAME', true);
        if( $local =='boo') {
            $this->host = '127.0.0.1';
            $this->db   = 'test-db';
            $this->user = 'boo';
            $this->pass = 'boo';
            //protected $protocol = 'TCP';
            $this->port = "3306";
            $this->charset = 'utf8mb4';
            $this->options = [
                    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset;"; // port=$this->port protocol=$this->protocol;
            $this->pdo = new \PDO($dsn, $this->user, $this->pass, $this->options);
        } else {
            // add online database data here
            $this->host = '';
            $this->db = '';
            $this->user = '';
            $this->pass = '';
            $dsn = "";
            try {
                $this->pdo = new \PDO($dsn, $this->user, $this->pass);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
       }
   }

    public function connect() {
        if( isset($this->pdo) ) {
            return $this->pdo;
        } else {
            return null;
        }
    }
}
