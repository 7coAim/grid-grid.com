<?php 
session_name("GridStar");
session_start();
require_once('config.php');

$_SESSION["UserID"]=null;
$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-86400, SITE_URL_DIR);
}

session_destroy();

header('Location: '.SITE_URL);

?>