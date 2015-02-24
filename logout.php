<?php
session_start();
require_once("Helper/Database.class.php");
require_once("Model/User.class.php");

$userManager = new Model_User();
$userManager->logout();

header("Location: index.php");