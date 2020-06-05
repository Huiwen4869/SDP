<?php 

require_once 'include/logout.inc.php';

// remove all session variables
session_unset(); 

// destroy the session 


header('elogin.php');

?>