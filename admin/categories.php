<?php

ob_start();
session_start();
if(isset($_SESSION['username'])){
  $getTitle = "Categories";
  include "init.php";
  echo "<div class='container'>";
   $do=isset($_GET['do'])?$_GET['do']:'Manage';
   if($do=='Manage'){
     $sort = "ASC";

     $sort_array = ["ASC","DESC"];

     if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array))
     {
      $sort = $_GET['sort'];
     }
     $result = mysqli_query($conn,"SELECT * FROM `categries` ORDER BY Ordering $sort")

     ?>

     <h2 class="members">Manage Categories</h2>
       <div class="mb-3 categories">
        <div class="row">
            <div class="col-sm-6 col-md-12">
                <div>
               
                    <div class="p-2 panel-haeding" >
                         Manage categories
                           <div class=" ordering float-end">
                             Ordering :
                             <a  class="<?php if( $sort =='ASC'){ echo 'active';}?>" href="?sort=ASC"> ASC</a> | 
                             <a  class="<?php if( $sort == 'DESC'){ echo 'active';}?>" href="?sort=DESC"> DESC</a>
                           </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-control p-2 bg-light"> 
                       
                        <?php
                    while($row = mysqli_fetch_object($result)){
                 
                      echo "<div class='cat'>";
                            echo "<div class='hidden-buttons'>";
                               echo"<a href='categories.php?do=Update&userId=$row->ID' class='btn btn-xs btn-primary'>Edit</a>
                                   <a href='categories.php?do=Delete&userId=$row->ID' class='btn btn-xs btn-danger' onclick=\"return confirm('Are You Sure Delete','Are You Sure')\">Delete</a>
                                  ";
                            echo "</div>";
                            echo "<h3>$row->Name</h3>";
                            if($row->description == ""){
                             echo "<p>This Cotegories Has No Description</p>";
                             }else {
                             echo  "<p>".$row->description."</p>";
                              };
                            if($row->Visbility==1){ echo "<span class='visbility'> Hidden </span>";};
                            if($row->Allow_Comment==1){echo "<span class='comment'> Comment Disabled </span>";};
                            if($row->Allow_Ads==1){echo "<span class='ads'> Ads Disabled </span>";};
                       echo "</div>";
                        echo"<hr>";
                     }
                        
                           ?>
                        </ul>
                     </div>
                   </div> 
                </div>
         
           
          </div>

       </div>
       <div  class="btn-add">
          <a href='categories.php?do=Add' class="my-3 btn btn  float-start"> <span> + </span>  Add New Category</a>
       </div>

   <?php   
   }elseif($do=='Add'){ ?>
    <h3 class="members">Add New Categories</h3>
       
       <div class="container">
     
       <form action="?do=Insert" method="POST" class=" d-block m-auto form-horizontal  p-2 p-md-3 p-xl-4 rounded" novalidate>
      

          <div class="form-group  form-group-lg">
             <div class="row">
             <label class="col-sm-2" style="font-weight: bold;">Name</label>
             <div class="col-sm-8 col-md-6">
               <input type="text" name="name" class="form-control p-2"  placeholder="Name Of The Category" required>
               <div class="valid-feedback alert alert-success">Good</div>
               <div class="invalid-feedback alert alert-danger">Fill This Field</div>
            </div>
            </div>
          </div>
           <div class="form-group form-group-lg my-3">
             <div class="row">
                <label for="qty" class="col-sm-2 control-label" style="font-weight: bold;">Description</label>
                 <div class="col-sm-8 col-md-6">
      
                   <input type="text"  class="form-control p-2" name="description" id="qty" placeholder='Describe The Category' >
                </div>
                </div>
           </div>
           <div class="form-group form-group-lg">
             <div class="row">
              <label for="qty"  class="col-sm-2 control-label" style="font-weight: bold;">Ordering</label>
               <div class="col-sm-8 col-md-6">
                   <input type="text"  class="form-control p-2"   name="ordering" id="qty" placeholder="Number To Arrange The Categories">
                </div>
                </div>
            </div>

           <div class="form-group form-group-lg  my-3">
            <div class="row">
             <label class="col-sm-2 control-label"  style="font-weight: bold;"> Visible </label>
             <div class="col-sm-8 col-md-6">
                <div>
                  <input type="radio"   name="visible" id="vis-yes"  value="0"  checked>
                  <label for="vis-yes"> Yes</label>
                </div>
                <div>
                  <input type="radio"  name="visible" id="vis-no"  value="1" >
                  <label for="vis-no"> No</label>
                </div>
               
              </div>
              </div>
            </div>
            <div class="form-group form-group-lg ">
            <div class="row">
             <label class="col-sm-2 control-label"  style="font-weight: bold;"> Allow Commenting </label>
             <div class="col-sm-8 col-md-6">
                <div>
                  <input type="radio"   name="comment" id="vis-yes"  value="0" checked >
                  <label for="vis-yes"> Yes</label>
                </div>
                <div>
                  <input type="radio"  name="comment" id="vis-no"  value="1" >
                  <label for="vis-no"> No</label>
                </div>
               
              </div>
              </div>
            </div>
            <div class="form-group form-group-lg  my-3">
            <div class="row">
             <label class="col-sm-2 control-label"  style="font-weight: bold;"> Allow Ads </label>
             <div class="col-sm-8 col-md-6">
                <div>
                  <input type="radio"   name="ads" id="ads-yes"  value="0" checked >
                  <label for="ads-yes"> Yes</label>
                </div>
                <div>
                  <input type="radio"  name="ads" id="ads-no"  value="1" >
                  <label for="ads-no"> No</label>
                </div>
               
              </div>
              </div>
            </div>
            <div class="form-group form-group-lg  ">
              <div class ="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn b btn-lg" value ="Add" style="margin-left:210px;background-color:#3498db;color:#fff;width:20%;font-wieght:bold">
               <div>
           </div>
         
       </form>
       </div>
    
   <?php
   }elseif ($do=='Insert') {
    if($_SERVER['REQUEST_METHOD'] =="POST"){
       $name    =     $_POST['name'];
       $desc    =     $_POST['description'];
       $order   =     $_POST['ordering'];
       $visible =     $_POST['visible'];
       $comment =     $_POST['comment'];
       $ads    =      $_POST['ads'];
       if(!empty($name)){

         if (!checkItem('Name','categries',"$name")>0) {
         
        
            $query = mysqli_query($conn,"INSERT INTO `categries` (`Name`, `description`, 
            `Ordering`, `Visbility`, `Allow_Comment`, `Allow_Ads`)
            VALUES('$name','$desc','$order','$visible','$comment','$ads')");
           if($query){
              $thMsg = "<h3 class=' container alert  alert-success text-center'> Add Category Is Successfully</h3>";
              redirectHome($thMsg,"back");
           }
         }else{
          echo  "<h3 class='container alert   alert-danger text-center'>This Categories Already Exit";
           header("refresh:3;url=category.php");
          // redirectHome($thMsg,"back");
         }
      }else{
        $thMsg = "<h3 class=' container alert  alert-danger text-center'> Please Write Name</h3>";
        redirectHome($thMsg,"back");
      }
     }else{
      $thMsg ="<h3 class=' container alert  alert-danger text-center'> Sorry You Can't Browse This Page Directly</h3>";
      redirectHome($thMsg);
     }
   }elseif ($do=="Update"){
    $userid = isset($_GET['userId'])&& is_numeric($_GET['userId'])?intval($_GET['userId']):0;
   if(checkItem("ID","categries","$userid")>0){
    $result = mysqli_query($conn,"SELECT * from categries WHERE ID=$userid");
    $row = mysqli_fetch_object($result);
    ?>
 <h3 class="members">Edit Categories</h3>
       
       <div class="container">
     
       <form action="?do=Edit" method="POST" class=" d-block m-auto form-horizontal  p-2 p-md-3 p-xl-4 rounded">
      
       <input type="hidden"name="userid" class="form-control"  value="<?php echo $row->ID?>" >
          <div class="form-group  form-group-lg">
             <div class="row">
             <label class="col-sm-2" style="font-weight: bold;">Name</label>
             <div class="col-sm-8 col-md-6">
               <input type="text" required name="name"  value="<?php echo $row->Name?>"class="form-control p-2"  placeholder="Name Of The Category" required autocomplete="off" >
            </div>
            </div>
          </div>
           <div class="form-group form-group-lg my-3">
             <div class="row">
                <label for="qty" class="col-sm-2 control-label" style="font-weight: bold;">Description</label>
                 <div class="col-sm-8 col-md-6">
      
                   <input type="text"  class="form-control p-2"  value="<?php echo $row->description?>" name="description" id="qty" placeholder='Describe The Category'   >
                </div>
                </div>
           </div>
           <div class="form-group form-group-lg">
             <div class="row">
              <label for="qty"  class="col-sm-2 control-label" style="font-weight: bold;">Ordering</label>
               <div class="col-sm-8 col-md-6">
                   <input type="text"  class="form-control p-2"  value="<?php echo $row->Ordering ?>"  name="ordering" id="qty" placeholder="Number To Arrange The Categories">
                </div>
                </div>
            </div>

           <div class="form-group form-group-lg  my-3">
            <div class="row">
             <label class="col-sm-2 control-label"  style="font-weight: bold;"> Visible </label>
             <div class="col-sm-8 col-md-6">
                <div>
                  <input type="radio"   name="visible" id="vis-yes"  value="0"  <?php if($row->Visbility==0){echo 'checked';}?>  >
                  <label for="vis-yes"> Yes</label>
                </div>
                <div>
                  <input type="radio"  name="visible" id="vis-no"  value="1" <?php if($row->Visbility==1){echo 'checked';}?> >
                  <label for="vis-no"> No</label>
                </div>
               
              </div>
              </div>
            </div>
            <div class="form-group form-group-lg ">
            <div class="row">
             <label class="col-sm-2 control-label"  style="font-weight: bold;"> Allow Commenting </label>
             <div class="col-sm-8 col-md-6">
                <div>
                  <input type="radio"   name="comment" id="vis-yes"  value="0" <?php if($row->Allow_Comment == 0){echo 'checked';}?>  >
                  <label for="vis-yes"> Yes</label>
                </div>
                <div>
                  <input type="radio"  name="comment" id="vis-no"  value="1" <?php if($row->Allow_Comment == 1 ){echo 'checked';}?>  >
                  <label for="vis-no"> No</label>
                </div>
               
              </div>
              </div>
            </div>
            <div class="form-group form-group-lg  my-3">
            <div class="row">
             <label class="col-sm-2 control-label"  style="font-weight: bold;"> Allow Ads </label>
             <div class="col-sm-8 col-md-6">
                <div>
                  <input type="radio"   name="ads" id="ads-yes"  value="0"  <?php if($row->Allow_Ads==0){echo 'checked';}?>>
                  <label for="ads-yes"> Yes</label>
                </div>
                <div>
                  <input type="radio"  name="ads" id="ads-no"  value="1" <?php if($row->Allow_Ads==1){echo 'checked';}?> >
                  <label for="ads-no"> No</label>
                </div>
               
              </div>
              </div>
            </div>
            <div class="form-group form-group-lg  ">
              <div class ="col-sm-offset-2 col-sm-10">
                  <input type="submit" class="btn b btn-lg" value ="Save Edit" style="margin-left:210px;background-color:#3498db;color:#fff;width:20%;font-wieght:bold">
               <div>
           </div>
         
       </form>
       </div>
       <?php
      }else{
        $thMsg= "<h3 class='alert alert-danger text-center'>There Is Not Such Id</h3>";
        redirectHome($thMsg);
      }
       
       ?>
   <?php
   }elseif ($do=='Edit') {
     $ID     = $_POST['userid'];
    $name    =    $_POST['name'];
    $desc    =     $_POST['description'];
    $order   =    $_POST['ordering'];
    $visible =    $_POST['visible'];
    $comment =    $_POST['comment'];
    $ads    =     $_POST['ads'];
    $query = mysqli_query($conn,"UPDATE `categries` SET `Name`='$name',`description`='$desc',
    `Ordering`='$order',`Visbility`='$visible',`Allow_Comment`='$comment',`Allow_Ads`=' $ads  ' WHERE ID ='$ID'");
      if($query){
        echo "<h3 class='alert  alert-success text-center'> Updated The Category Is Successfully</h3>";
        header("refresh:3;url=categories.php");
      }
   }elseif($do=="Delete") {
     $userid = $_GET['userId'];
     $check = checkItem("ID","categries","$userid");
     if($check){
     mysqli_query($conn,"DELETE FROM `categries` WHERE ID= $userid");
    $thMsg= "<h3 class='alert  alert-success text-center'> Deleted The Category Is Successfully</h3>";
      redirectHome($thMsg,"back");
     
    }else{
      $thMsg= "<h3 class='alert alert-danger text-center'>There Is Not Such Id</h3>";
      redirectHome($thMsg,"back");
    }
   }
  include $tpls."footer.php";
  echo "</div>";
}else{
  header("location:index.php");
  exit();

}
ob_end_flush();