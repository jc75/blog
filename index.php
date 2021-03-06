<?php
session_start();

require_once("Helper/Database.class.php");
require_once("Model/User.class.php");
require_once("Model/Article.class.php");

$userManager = new Model_User();
$article = new Model_Article();

$nbPost = 2; //nombre de post par page

if(!array_key_exists("page", $_GET) || ($_GET["page"]==1))
	{
		$_GET["page"] = 1;
		$offset = 1;
	}
	else
	{
		$offset = $_GET["page"];
	}

$page = $article -> pagination($offset,$nbPost);

include "View/header.phtml";
include "View/content.phtml";
include "View/footer.phtml";