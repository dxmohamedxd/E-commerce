<?php
include "conn/ConDB.php";
// routes
$tpls = 'includes/templates/'; //
$func = "includes/functions/";
// include the important files

include "includes/languages/en.php";
include $func."functions.php";
include $tpls."header.php";

if(!isset($noNavbar)){
   include $tpls."navbar.php";
}


?>
