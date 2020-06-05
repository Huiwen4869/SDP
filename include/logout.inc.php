<?php

session_start();

include 'conn.inc.php';

// echo $_SESSION['userId'];

/*
if($_SESSION['userid']){
    echo ("<script> alert('Log out sucessfull'); </script>");
    echo ("<script> window.location.replace('../login.php');</script>");
    session_destroy();
}*/
if ($_SESSION['eid']) {
    echo ("<script> alert('Log out sucessfull'); </script>");
    echo ("<script> window.location.replace('../elogin.php');</script>");
    session_destroy();
}else{
    echo ("<script> alert('Something Wrong !!'); </script>");
    echo ("<script> window.location.replace('../sad.php');</script>");
}

