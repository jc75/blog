<?php
session_start();

require_once("Helper/Database.class.php");
require_once("Model/User.class.php");


if (array_key_exists("password", $_POST) && array_key_exists("username", $_POST))
{

	$userManager = new Model_User(); // Model/User.class.php
	
	$userManager->createUser(array("username" => $_POST["username"],"password" => password_hash($_POST["password"], PASSWORD_DEFAULT)));
	
	header("Location: index.php");exit();
	
	
}

include "View/register.phtml";