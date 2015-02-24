<?php

//if (array_key_exists("username",$_SESSION))echo "Bienvenu ".$_SESSION["username"].",";
session_start();
require_once("Helper/Database.class.php");
require_once("Model/User.class.php");
require_once("Model/Article.class.php");

$userManager = new Model_User();
$article = new Model_Article();

include "View/header.phtml";
include "View/content.phtml";
include "View/footer.phtml";