<?php
session_start();

require_once("Helper/Database.class.php");
require_once("Model/User.class.php");
require_once("Model/Article.class.php");

if (array_key_exists("valider", $_POST))
{
	// je tente de connecter l'utilisateur
	$articleManager = new Model_Article(); // Model/User.class.php

	$id = $_POST["id_article"];

	$last_id = $articleManager->insertComment(array("content" => $_POST["content"],"id_article" =>$_POST["id_article"],"id_user" => $_SESSION["id"]));
	
	header("Location: post.php?id=$id");exit();
}

