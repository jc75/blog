<?php
session_start();

require_once("Helper/Database.class.php");
require_once("Model/User.class.php");
require_once("Model/Article.class.php");

$userManager = new Model_User();
$article = new Model_Article();

$article_post = $article->getOne($_GET["id"]);


$article_comment =	$article->showComment($_GET["id"]);

//var_dump($article_comment);

$pageNext = $article->pageNext($_GET["id"]);

$pagePrev = $article->pagePrev($_GET["id"]);

include "View/header.phtml";
include "View/post.phtml";
include "View/footer.phtml";