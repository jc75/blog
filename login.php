<?php
session_start();

require_once("Helper/Database.class.php");
require_once("Model/User.class.php");

if (array_key_exists("password", $_POST) && array_key_exists("login", $_POST))
{
	// je tente de connecter l'utilisateur
	
	$userManager = new Model_User(); // Model/User.class.php
	
	if ($userManager->verifLogin($_POST["login"], $_POST["password"]) != false)
	{
		// enregistrer les informations utilisateur en session
		$_SESSION["login"] = $_POST["login"];
		$_SESSION["password"] = $_POST["password"];
		// redirection sur la page d'accueil
		header("Location: index.php");exit();
	}
	
	
}

include "View/login.phtml";