<?php
session_start();

require_once("Helper/Database.class.php");
require_once("Model/User.class.php");
require_once("Model/Article.class.php");

if (array_key_exists("valider", $_POST))
{
	// je tente de connecter l'utilisateur
	$articleManager = new Model_Article(); // Model/User.class.php

	$last_id = $articleManager->createArticle(array("title" => $_POST["title"],"description" =>$_POST["description"],"user" => $_SESSION["id"]));

	$articleManager -> insertImage($_FILES, $last_id);
	
	$articleManager -> insertTag($_POST["tags"], $last_id);
		
	//var_dump($_FILES);
	header("Location: index.php");exit();	
}

include "View/header.phtml";
include "View/createpost.phtml";
include "View/footer.phtml";