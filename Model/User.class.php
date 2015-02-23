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
		// récupérer l'utilisateur ayant pour login "$login" -> le stocker dans une variable $user
		// si le mot de passe en db correspond au mot de passe entré dans le formulaire
		// -> return $user
		// sinon
		// -> return false
		$user = $this->db->fetchOne($login, $password);
		if ($user)
		{
			return $user;
		}
		else
		{
			return false;
		}



	}

	public function logout()
	{

	}

	public function createUser($query, $data)
	{
		
		$this->db->insert($query,$data);
		

	}

	public function isLogin()
	{


	}

}