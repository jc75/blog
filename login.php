<?php
session_start();

require_once("Helper/Database.class.php");
require_once("Model/User.class.php");

if (array_key_exists("password", $_POST) && array_key_exists("username", $_POST))
{
	// je tente de connecter l'utilisateur
	
	$userManager = new Model_User(); // Model/User.class.php
	
	if ($userManager->verifLogin($_POST["username"], $_POST["password"]))
	{
		
		header("Location: index.php");exit();

	}else{

		$error = "Nom d'utilisateur ou mot de passe incorrect";
	}
	
	
}

include "View/login.phtml";