<?php

class Database
{
	private $host;
	private $dbuser;
	private $dbpassword;
	private $dbname;

	public $connection;
	public $error;

	public function  __construct($host, $dbuser, $dbpassword, $dbname)
	{
		$this->host = $host;
		$this->dbuser = $dbuser;
		$this->dbpassword = $dbpassword;
		$this->dbname = $dbname;
	}

	public function connect()
	{
		if ($this->connection = new mysqli($this->host, $this->dbuser, $this->dbpassword, $this->dbname)) {
			return true;
		} else {
			$this->error = mysqli_error();
			return false;
		}
	}


	public function select($sql)
	{
		if ($this->connection) {
			if (isset($sql) && $sql != ' ') {
				if ($result = mysqli_query($this->connection, $sql)) {
					return $result;
				} else {
					$this->error = mysqli_error();
					return false;
				}
			} else {
				$this->error = 'Blad zapytania SQL';
				echo $this->error;
				return false;
			}
		} else {
			$this->error = 'Blad polaczenia z baza danych';
			echo $this->error;
			return false;
		}
	}

}
?>