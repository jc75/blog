<?php

Class Model_User
{
	private $db;

	public function __construct()
	{
		$this->db = new Helper_Database("mysql:host=127.0.0.1;dbname=blog", "root", "troiswa");

	}

	public function verifLogin($login, $password)
	{

		$user = $this->db->fetchOne("SELECT * FROM users WHERE pseudo = :username", array("username" => $_POST["username"]));

			if (password_verify($password, $user["password"]))
			{
				$_SESSION["id"] = $user["id"];
				$_SESSION["admin"] = $user["is_admin"];
				$_SESSION["username"] = $user["pseudo"];
				return true;
			}
			else
			{
				return false;
			}
		
	}

	public function logout()
	{
		session_destroy();
	}

	public function createUser($data)
	{	
		$user = $this->db->insert("INSERT INTO users(pseudo, password) VALUES(:username, :password)",$data);
		
		$_SESSION["id"] = $this->db->lastInsertId();
		$_SESSION["admin"] = 0;
		$_SESSION["username"] = $POST["pseudo"];
		//$query->execute($data);
		return true;
		
	}

	public function isLogged()
	{

		if (array_key_exists("username",$_SESSION))
		{
			return true;

		}else{

			return false;
		}
	
	}

	public function isAdmin()
	{

		if ($_SESSION["admin"]==1)
		{
			return true;

		}else{

			return false;
		}
	
	}

}