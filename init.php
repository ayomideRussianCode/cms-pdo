<?php
//start session
session_start();

//includes the main config file
require_once "config/config.php";

//load database
require_once "classes/Database.php";

//include helper functions
require_once "helpers.php";

// define global constants
define("APP_NAME", "CMS PDO SYSTEM");

?> 