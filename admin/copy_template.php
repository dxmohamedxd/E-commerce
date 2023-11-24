<?php

ob_start();
session_start();
if(isset($_SESSION['username'])){
  
  include "init.php";
  echo "<div class='container'>";
   $do=isset($_GET['do'])?$_GET['do']:'Manage';
   if($do=='Manage'){
       echo "Manage";
   }elseif($do=='Add'){
     echo "add";
   }elseif ($do=='Insert') {
   echo "insert";
   }elseif ($do=="Update") {
    echo "Update";
   }elseif ($do=='Edit') {
     echo 'EDIT';
   }elseif ($do=="Delete") {
    echo "delete";
   }
  include $tpls."footer.php";
  echo "</div>";
}else{
  header("location:index.php");
  exit();

}
ob_end_flush();