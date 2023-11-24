<?php

session_start();

if(isset($_SESSION['username'])){
  $getTitle = "Members";
    include "init.php";
   $do = isset($_GET['do'])?$_GET['do']:"Manage";
   /**************************** Manage Members Page **********************/
    if( $do == "Manage"){ 
    
    
      ?>
  
   
       <h2 class="members">Manage Member</h2>
       <div class="container">
         <div class=" table-responsive">
         <table class="main-table text-center table table-bordered ">
             <tr>
               <th>#ID</th>
               <th>Username</th>
               <th>E-mail</th>
               <th>Full Name</th>
               <th>Register Data</th>
               <th>Control</th>
             </tr>
            
             <?php
             $RegStatus="";
             
              if(isset($_GET['page']) && $_GET['page']=="pending"){
                $RegStatus = "AND RegStatus=0";

        
         
              }

              $result = mysqli_query($conn,"SELECT * from users where GroupID!=1 $RegStatus");
           
             while($row = mysqli_fetch_object($result)){
          
           //<<< heredoc
          echo "<tr>
                    
                      <td>$row->UserID</td>
                      <td>$row->Username</td>
                      <td>$row->Email</td>
                      <td>$row->Fullname</td>
                      <td> $row->Date</td>
                      <td>
                       <a href='?do=Edit&userId=$row->UserID' class='btn btn-success ms-1' style=\"margin-right:1
                       
                       0px\" >Edit</a>
                       <a href='?do=Delete&userId=$row->UserID' class='btn btn-danger ' onclick=\"return confirm('Are You Sure Delete','Are You Sure')\">Delete</a>
                       ";
                       if($row->RegStatus==0){
                        echo "<a href='?do=Activate&UserID=$row->UserID' class='btn btn-info ' style='color:white' onclick=\"return confirm('Do You Want To Activate The Member','activate')\">  Activate</a>";
                       }
                    echo "
                     </td>
                     </tr>
                    ";

             
              }
           
              ?>
          
         </table>
          </div>
      <div class="btn-add">
             <a href='members.php?do=Add' class="mb-3 btn btn float-start"> <span> + </span> New Member</a> 
    </div>
</div>
    <!-- models start  -->
    <div id="myModal" data-bs-backdrop="static" class="modal fade">
    <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                Edit Member
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-5">
                    <form action="?do=Insert" method="POST" novalidate>
                    <div class="row">
                      <div class="input-group">
                        <div class="input-group-text">
                            <span class="bi bi-person-fill"></span>
                        </div>
                        <div class="col-sm-10 col-md-8">
                            <input type="text" value="<?php echo $row->UserID;?>" name="user" class="form-control p-3 " placeholder="Username"  required  autocomplete="off" >
                        </div>
                       </div>
                     </div>
                     <!-- Field Password -->
                     <div class="row ">
                      <div class="input-group my-4">
                        
                         <span  class="input-group-text">
                                <span class="bi bi-shield-lock-fill"></span>
                         </span>
                         <div class="col-sm-10 col-md-8">
                             <input type="password"  class="form-control p-3" name="password" placeholder="Password"  required  autocomplete="new-password">
                          </div>
                        </div>
                      </div>
                        <!-- Field E-mail -->
                    <div class="row">
                      <div class="input-group ">
                         <span class="input-group-text">
                             <span class="bi bi-envelope-dash-fill"></span>
                         </span>
                         <div class="col-sm-10 col-md-8">
                              <input type="email"  class="form-control p-3"   name="email"  placeholder="E-mail" required>
                         </div>
                      </div>
                   </div>
                   <!-- field Full name -->
                   <div class="row">
                      <div class="input-group my-4">
                         <span  class="input-group-text">
                             <span class="bi bi-person-plus-fill"></span>
                         </span>
                          <div class="col-sm-10 col-md-8">
                               <input type="text" class="form-control p-3"  name="full"  placeholder="Fullname"  required >
                          </div>
                       </div>
                    </div>
                      <!-- submit  -->
                    <div>
                          <input type="submit" class=" d-block m-auto mt-3 btn  btn-lg" value = "Add" style="background-color:#3498db;color:#fff;width:20%;font-wieght:bold">
                    </div>
                    
                  </form>
             </div>
            </div>
            <div>
    <!-- models end -->
         <?php
         // Activated Members
        }elseif($do == 'Activate'){
            $id = $_GET['UserID']  ;
            $active = mysqli_query($conn,"UPDATE `USERS` SET RegStatus = 1 where UserID=$id");
            if($active){
               $Msg="<div class='container  alert alert-info'>The Member Has Been Activated</div>";
               redirectHome( $Msg,"back",3);
            }

         ?>
            <?php }
            /* *******************  delete member page  ************************ */
            elseif($do == 'Delete'){


                $ID = $_GET['userId'];

              $del= mysqli_query($conn,"DELETE FROM `users` WHERE `UserID`='$ID' ");
           
               if($del)
                  {
           
                     redirectHome("","back",0);
                  }
               }
          /******************           add new member                  ************************* */
            elseif($do =='Add' ) {  
    
              ?>
           
        <h2 class="members">Add New Member</h2>
     
        <div class="container mt-5">
          <form action="?do=Insert" method="POST" novalidate>
          <div class="row">
            <div class="input-group">
              <div class="input-group-text">
                  <span class="bi bi-person-fill"></span>
              </div>
              <div class="col-sm-10 col-md-8">
                  <input type="text" name="user" class="form-control p-3 " placeholder="Username"  required  autocomplete="off" >
              </div>
             </div>
           </div>
           <!-- Field Password -->
           <div class="row ">
            <div class="input-group my-4">
              
               <span  class="input-group-text">
                      <span class="bi bi-shield-lock-fill"></span>
               </span>
               <div class="col-sm-10 col-md-8">
                   <input type="password"  class="form-control p-3" name="password" placeholder="Password"  required  autocomplete="new-password">
                </div>
              </div>
            </div>
              <!-- Field E-mail -->
          <div class="row">
            <div class="input-group ">
               <span class="input-group-text">
                   <span class="bi bi-envelope-dash-fill"></span>
               </span>
               <div class="col-sm-10 col-md-8">
                    <input type="email"  class="form-control p-3"   name="email"  placeholder="E-mail" required>
               </div>
            </div>
         </div>
         <!-- field Full name -->
         <div class="row">
            <div class="input-group my-4">
               <span  class="input-group-text">
                   <span class="bi bi-person-plus-fill"></span>
               </span>
                <div class="col-sm-10 col-md-8">
                     <input type="text" class="form-control p-3"  name="full"  placeholder="Fullname"  required >
                </div>
             </div>
          </div>
            <!-- submit  -->
          <div>
                <input type="submit" class=" d-block m-auto mt-3 btn  btn-lg" value = "Add" style="background-color:#3498db;color:#fff;width:20%;font-wieght:bold">
          </div>
          
        </form>
   </div>
       
   <?php
  /***************************  Insert data Page     *************************** */
   }elseif($do== "Insert"){
     if($_SERVER['REQUEST_METHOD']=="POST"){

   
    $user   = strtolower($_POST['user']);
    $email  =  $_POST['email'];
    $Full   =   strtolower($_POST['full']);
    $pass   =   sha1($_POST['password']);
        // validtion
        $Error = array();
        if(empty($user)){
          $Error[] = "<div class='alert alert-danger'> Username Can't Is Empty</div>";
        }
        if(empty($email)){
          $Error[] = "<div class='alert alert-danger'> E-mail Can't Is Empty</div>";
        }
        if(empty($Full)){
          $Error[] = "<div class='alert alert-danger'> Full name  Can't Is Empty</div>";
        }
        if(strlen($user) < 4){
          $Error[] = " <div class='alert alert-danger'> Username Can't Be Less Then 4 character</div>";
        }
        if(strlen($user) > 20 ){
          $Error[] = "<div class='alert alert-danger'> Username Can't Be More Then 20 character</div>";
          
        }
        
if(!$Error){
     if(CheckItem("Username","users","$user") > 0)
       {
        $thMsg= "<h3 class='container alert   alert-danger text-center'>This Username Already Exit";

        redirectHome($thMsg,"back");

      }else {
        
        $insert = mysqli_query($conn,"INSERT INTO `users`(`Username`, `Password`, `Email`, `Fullname`,`RegStatus`,`Date`)
                      VALUES ('$user','$pass','$email','$Full','1',now())");
     
        if($insert){
         $thMsg = "<h3 class=' container alert  alert-success text-center'> Add Member Is Successfully</h3>";
        redirectHome($thMsg,"back");
         }
      }
    }else {
    foreach ($Error as $err) {
      
     $thMsg = "<div class='container'> $err </div";
      redirectHome($thMsg,"back");
    // header("REFRESH:2;URL=?do=Add");

    }
  
    }
 }else {
  $thMsg="<h3 class=' container alert  alert-danger text-center'> Sorry You Can't Browse This Page Directly</h3>";
  redirectHome($thMsg,"back");
 }
// ........................ Edit Page
 }elseif($do == "Edit"){
    
    
    $userid=isset($_GET['userId'])&& is_numeric($_GET['userId'])?intval($_GET['userId']):0;
    $result = mysqli_query($conn,"SELECT * from users WHERE UserID=$userid LIMIT 1");
    $row = mysqli_fetch_object($result);
  
    if( mysqli_num_rows( $result )>0){
    ?>
  
        <h2 class="members">Edit Member</h2>
       
     <div class="container mt-4">
        <form action="?do=Update" method="POST" class="onvalidate">
           <div class="form-group p-2">
           <input type="hidden"name="userid" class="form-control"  value="<?php echo $row->UserID?>" >
              <label class="col-sm-2" style="font-weight: bold;">Username</label>
              <div class="col-sm-10 col-md-8">
                <input type="text" required name="user" class="form-control p-3"  value="<?php echo $row->Username ?>" require autocomplete="off" >
             </div>
           </div>
            <div class="form-group p-2">
              <label for="qty" class="col-sm-2" style="font-weight: bold;">Password </label>
               <div class="col-sm-10 col-md-8">
                 <input type="hidden"  class="form-control p-3" name="oldpassword" id="qty" value="<?php echo $row->Password;?>" >
                 <input type="password"  class="form-control p-3" name="newpassword" id="qty"   autocomplete="new-password">
                </div>
            </div>
            <div class="form-group p-2">
            <label for="qty" style="font-weight: bold;">E-mail </label>
            <div class="col-sm-10 col-md-8">
              <input type="email"  class="form-control p-3"  value="<?php echo $row->Email?>" name="email" id="qty"  required="required">
              </div>
            </div>

            <div class="form-group p-2">
              <label  style="font-weight: bold;"> Full Name </label>
              <div class="col-sm-10 col-md-8">
                 <input type="text" class="form-control p-3" value="<?php echo $row->Fullname?>" name="full" id="price"  >
              </div>
             </div>

             <div class="form-group">
                <input type="submit" class=" mt-3 btn b btn-lg" value = "Save Edit" style="margin-left:210px;background-color:#3498db;color:#fff;width:25%;font-wieght:bold">
            </div>
          
        </form>
        
        </div> 
 
   
   <?php 
   }else{

     echo  "<h3 class='alert alert-danger text-center'>There Is Not Such Id</h3>";
    }

  }elseif($do=="Update")  // Update Page
  {
      echo " <h2 class='members'>Update Member</h2>";

      // if($_SERVER['REQUEST_METHOD']=="POST"){

         $id     =    $_POST['userid'];
         $user   =  $_POST['user'];
         $email  =  $_POST['email'];
         $Full   =   $_POST['full'];
         // Password Trick
         $pass = empty($_POST['newpassword'])?$_POST['oldpassword']:sha1($_POST['newpassword']);
          // validtion
          $Error = array();
          if(empty($user)){
            $Error = "<div class='alert alert-danger'> Username Can't Is Empty</div>";
          }
          if(empty($email)){
            $Error[] = "<div class='alert alert-danger'> E-mail Can't Is Empty</div>";
          }
          if(empty($Full)){
            $Error[] = "<div class='alert alert-danger'> Full name  Can't Is Empty</div>";
          }
          if(strlen($user) < 4){
            $Error[] = " <div class='alert alert-danger'> Username Can't Be Less Then 4 character</div>";
          }
          if(strlen($user) > 20 ){
            $Error[] = "<div class='alert alert-danger'> Username Can't Be More Then 20 character</div>";
          }
          
          if(!$Error){
               $Update   =  mysqli_query($conn,"UPDATE `users` SET `Username`='$user',`Password`='$pass',
                           `Email`='$email',`Fullname`='$Full' WHERE `UserID`='$id'");
            if (  $Update ) {
                echo "<h3 class='alert  alert-success text-center'> Updated the Member Is Successfully</h3>";
                header("refresh:3;url=members.php");
                // redirectHome($thMsg,"back");
              }
          }else {

          foreach ($Error as $err) {
            
           echo "<div class='container'> $err </div";

           }
          }

       
      //  }else {
      //   echo  "<h3 class='alert alert-danger text-center'>Sorry You Can't Browse This Page Directly</h3>";
      // }
  }

    include $tpls."footer.php";
}else {
 header("location:index.php");
 exit();
}
?>


