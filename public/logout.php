<?php

session_start(); //Session start

$_SESSION = array();

session_destroy(); //Session Finish

header("location: login.php"); //redirect login page
exit; //Fin.

?>