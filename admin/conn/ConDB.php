<?php
//connect DB  (mysqli)
$conn = new mysqli("localhost","root","","shop");
if($conn){

 global $conn;

}else{
  
  echo   "Failed To Connect";
}
// connect DB (PDO)
// $dbc= "mysql:localhost,dbname:shop";
// $user= "root";
// $pass = "";
// $option = array(

//     PDO::MYSQL_ATTR_INIT_COMMANT=>'SET NAMES uft8',
//   // PDO::MYSQL_ATTR_INIT_COMMANT => 'SET NAMES uft8',
// );
/*try {

    $connect = new PDO($dbc,$user,$pass);
    //$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ATTR_EXCEPTION);

     //echo "You Are Connected Welcome To Database";

} catch (PDOExcption $e) {

   echo "Failed To Connect " . $e->getMessage();
}

*/
?>