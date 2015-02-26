<?php

Class Helper_Database
{
	private $db;

	public function __construct($host, $user, $password)
	{
		$this->db = new PDO($host, $user, $password);
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->db->exec("SET NAMES UTF8");
	}
	
	public function fetchAll($req, $data = array())
	{
		$query = $this->db->prepare($req);
		$query->execute($data);
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}

	public function fetchOne($req, $data = array())
	{
		$query = $this->db->prepare($req);
		$query->execute($data);
		$res = $query->fetch(PDO::FETCH_ASSOC);
		return $res;
	}

	public function lastInsertId()
	{
		$last_id = $this->db->lastInsertId();
		return $last_id;
	}

	public function insert($req, $data = array())
	{
		$query = $this->db->prepare($req);
		$query->execute($data);
		return true;
	}


}