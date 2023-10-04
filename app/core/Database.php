<?php
namespace App\core;

class Database {
	protected $host = '127.0.0.1';
	protected $db   = 'test-db';
	protected $user = 'boo';
	protected $pass = 'boo';
	//protected $protocol = 'TCP';
	protected $port = "3306";
	protected $charset = 'utf8mb4';

	private $info;
	private $pdo = null;

	protected $options = [
			\PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
			\PDO::ATTR_EMULATE_PREPARES   => false,
	];

	function __construct() {
		$dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset;"; // port=$this->port protocol=$this->protocol;
		try {
			$this->pdo = new \PDO($dsn, $this->user, $this->pass, $this->options);
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int)$e->getCode());
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

