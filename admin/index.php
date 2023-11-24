<?php
   session_start();
   
   $noNavbar = "";
   $getTitle ="Login";
   include "init.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
     $username = $_POST['user'];
     $password = $_POST['pass'];
     $hashedpass = sha1($password);
     $result = mysqli_query($conn,"SELECT UserID,Username,Password from users WHERE Username = '$username' AND  Password ='$hashedpass' AND GroupID = 1");
       $getData = mysqli_fetch_object($result);
     $count = mysqli_num_rows($result);
    if($count > 0)
    {
     
      $_SESSION['username'] = $username ;
      $_SESSION['Id']   =    $getData->UserID;
       header("location:dashboard.php");
       exit();
       
    }
    
}

?>
<form class="login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
     <h3 class="text-center">Admin Login</h3>
     <input type="text"  class="form-control" name="user" placeholder="Username" autocomplate="off" />
     <input type="password"   class="form-control"  name="pass" placeholder="Password" autocomplate="off" />

    <input type="submit" class="w-100 btn btn-primary" value="Login">

</form>
<?php

include $tpls."footer.php";

?>
