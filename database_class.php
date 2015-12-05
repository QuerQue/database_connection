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
				$this->error = 'SQL Query ERROR';
				echo $this->error;
				return false;
			}
		} else {
			$this->error = 'Database connectig ERROR';
			echo $this->error;
			return false;
		}
	}

	public function close()
	{
		if($this->connection)
		{
			if(mysqli_close($this->connection))
				return true;
		}
		else {
			$this->error = "Your're not connected";
			echo $this->error;
		}
	}

}
?>