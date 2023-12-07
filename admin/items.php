<?php
/**
 *
 * 
 *  .............   items page   .............
 * 
 * 
 **/
 $UrlImg = 'includes/imageUpload/';
session_start();
if(isset($_SESSION['username'])){
 
      $getTitle = "Items";
      include "init.php";
    echo "<div class='container'>";
    $do = isset($_GET['do'])?$_GET['do']:'Manage';
      if($do=='Manage')
          {
           
            $items =  mysqli_query($conn,"SELECT * FROM `items`");
            echo"<h3 class=' members my-3'>  Manager Items  </h3>";
            echo "<div class='table-responsive'>
            <table class='main-table text-center table table-bordered'>
                <tr>
                  <th>#ID</th>
                  <th>Item Name</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>adding Data</th>
                  <th>Category</th>
                  <th>Username</th>
                  <th>Control</th>
                </tr>";
            // if(isset($items)){
              foreach(JoinMoreTable("items",["categries","users"]) as $item){
                echo "<tr>";
                   echo "<td>".$item['item_id']."</td>";
                   echo "<td>".$item['name']."</td>";
                   echo "<td>".$item['description']."</td>";
                   echo "<td>".$item['price']."</td>";
                   echo "<td>".$item['add_date']."</td>";
                   echo "<td>".$item['cat_name']."</td>";
                   echo "<td>".$item['user_name']."</td>";
                   echo"<td>";
                   if($item['approve']==0){
                    echo "<a href='?do=Approve&itemId=".$item['item_id']."' class='btn btn-outline-info btn-sm ' onclick=\"return confirm('Do You Want To Activate The items','activate')\">
                    
                  <span class='fa fa-check'></span>Approve</a>";

                  }
                 echo "<a href='?do=Update&itemId=".$item['item_id']."' class='btn btn-outline-success btn-sm ms-1' style=\"margin-right:1
                     0px\" >Edit</a>
                    <a href='?do=Delete&itemId=".$item['item_id']."' class='btn btn-outline-danger btn-sm ' onclick=\"return confirm('Are You Sure Delete','Are You Sure')\">Delete</a>
                    ";
                 
               echo " </tr>";
               }
        
            echo"</table>";
       
       

     echo "<div class='btn-add'>
               <a href='items.php?do=Add' class='mb-3 btn btn float-start'> <span class='i-plus'> + </span></a> 
             </div>";
      }elseif($do=='Add'){
            ?>
            <h3 class="members">Add New Items</h3>
              
              <div class="container m-1">
            
              <form action="?do=Insert" method="POST"  enctype="multipart/form-data" novalidate>
              

                  <div class="form-group  form-group-lg">
                    <div class="row">
                    <label class="col-sm-2" style="font-weight: bold;">Name</label>
                    <div class="col-sm-8 col-md-6">
                      <input type="text" name="name" class="form-control p-2"  required>
                      <div class="valid-feedback alert alert-success">Good</div>
                      <div class="invalid-feedback alert alert-danger">Fill This Field</div>
                    </div>
                    </div>
                  </div>
                  <div class="form-group form-group-lg my-3">
                    <div class="row">
                        <label for="qty" class="col-sm-2 control-label" style="font-weight: bold;">Description</label>
                        <div class="col-sm-8 col-md-6">
                          <input type="text"  class="form-control p-2" name="description" id="qty" required  >
                          <div class="valid-feedback alert alert-success">Good</div>
                          <div class="invalid-feedback alert alert-danger">Fill This Field</div>

                        </div>
                        </div>
                  </div>
                  <div class="form-group form-group-lg">
                    <div class="row">
                      <label for="qty"  class="col-sm-2 control-label" style="font-weight: bold;">Price</label>
                      <div class="col-sm-8 col-md-6">
                          <input type="text"  class="form-control p-2"   name="price"   required>
                          <div class="valid-feedback alert alert-success">Good</div>
                          <div class="invalid-feedback alert alert-danger">Fill This Field</div>
                        </div>
                        </div>
                    </div>

                  <div class="form-group form-group-lg  my-3">
                    <div class="row">
                    <label class="col-sm-2 control-label"  style="font-weight: bold;"> Country Made </label>
                      <div class="col-sm-8 col-md-6">
                        <input type="text"  class="form-control p-2"   name="country" required>
                          <div class="valid-feedback alert alert-success">Good</div>
                          <div class="invalid-feedback alert alert-danger">Fill This Field</div>
                      </div>
                      </div>
                    </div>
                    <div class="form-group form-group-lg">
                    <div class="row">
                    <label class="col-sm-2 control-label"  style="font-weight: bold;">Status </label>
                      <div class="col-sm-8 col-md-6">
                        <select name="status"  class="form-control  p-2" required>
                            <option value="0">....</option>
                            <option value="1">New</option>
                            <option value="2">Like New</option>
                            <option value="3">Used</option>
                            <option value="4">Very Old</option>
                        </select>
                      </div>
                      </div>
                    </div>
                    <div class="form-group form-group-lg my-3">
                      <div class="row">
                      <label class="col-sm-2 control-label"  style="font-weight: bold;">Member </label>
                        <div class="col-sm-8 col-md-6">
                          <select name="member" class="form-control  p-2" required>
                              <option value="0">....</option>
                              <?php
                              $query =  mysqli_query($conn,"SELECT * FROM `users`");
                               while($user = mysqli_fetch_object($query)){
                                echo "<option value='".$user->UserID."'>".$user->Username."</option>";
                              }
                              ?>

                          </select>
                        </div>
                        </div>
                      </div>
                      <div class="form-group form-group-lg my-3">
                       <div class="row">
                        <label class="col-sm-2 control-label"  style="font-weight: bold;">Category</label>
                        <div class="col-sm-8 col-md-6">
                          <select name="category" class="form-control  p-2" required>
                              <option value="0">....</option>
                              <?php
                              $query2 =  mysqli_query($conn,"SELECT * FROM `categries`");
                               while($cats = mysqli_fetch_object($query2)){
                                echo "<option value='".$cats->ID."'>".$cats->Name."</option>";
                              }
                              ?>

                          </select>
                        </div>
                        </div>
                      </div>
                    <div class="form-group form-group-lg  my-3">
                    <div class="row">
                    <label class="col-sm-2 control-label"  style="font-weight: bold;" id="#img">Image  </label>
                      <div class="col-sm-8 col-md-6">
                        <input type="file"  class="form-control p-2"   name="image" id="img">
                      </div>
                      </div>
                    </div>
                  
                    <div class="form-group form-group-lg  ">
                      <div class ="col-sm-offset-2 col-sm-10">
                          <input type="submit" class=" d-block m-auto btn b btn-lg" value ="Add Item" style="background-color:#3498db;color:#fff;width:20%;font-wieght:bold">
                      <div>
                  </div>
                
              </form>
              </div>
            
        <?php
      }elseif ($do=='Insert') {
              if(RequsetMothed("POST")){
            $name           =      $_POST['name'];
            $description     =      $_POST['description'];
            $price          =      $_POST['price'];
            $country        =      $_POST['country'];
            $status         =      $_POST['status'];
            $image          =      uploadImage('image');
            $member         =      $_POST['member'];
            $category         =      $_POST['category'];
            //  echo $pathFile. $nameImage;
            if(empty($name) && empty($description) && empty($price) && empty($country)){
                $thMsg ="<h3 class='alert alert-danger'> Please Fill Fields</h3>";
                redirectHome($thMsg,'back');
            }else{
                    $insert = mysqli_query($conn,"INSERT INTO `items`
                  (name, description,price,add_date,country_made,image, status,cat_id, member_id)
                  VALUES('$name','$description','$price',now(),'$country','$nameImage','$status','$category','$member')");
                        if($insert){
                          $thMsg = "<h3 class=' container alert  alert-success text-center'> Add Item Is Successfully</h3>";
                       redirectHome($thMsg,"back");
                          // header("REFRESH:2;URL=?do=Manage");
                          // ReturnPage("items");
                        }
               
                }
              }else{
                  $thMsg= "<h3 class='alert alert-danger text-center'>Sorry You Can't Browse This Page Directly</h3>";
                  redirectHome($thMsg);
              }
      
        }elseif ($do=="Update") {
              $itemid = isset($_GET['itemId'])&&is_numeric($_GET['itemId'])?intval($_GET['itemId']):0;
              $query_Update = mysqli_query($conn,"SELECT * from items WHERE item_id = $itemid");
              $row = mysqli_fetch_object($query_Update);
              if(mysqli_num_rows($query_Update)>0){
                ?>
                <h3 class="members">Edit Items</h3>
              
                <div class="container">
              
                <form action="?do=Edit" method="POST"  enctype="multipart/form-data" novalidate>
                
                 <input type="text" name="id" value="<?=$row->item_id?>"  style="display:none">
                    <div class="form-group  form-group-lg">
                      <div class="row">
                      <label class="col-sm-2" style="font-weight: bold;">Name</label>
                      <div class="col-sm-8 col-md-6">
                        <input type="text" name="name" value="<?php echo $row->name?>" class="form-control p-2"  required>
                        <div class="valid-feedback alert alert-success">Good</div>
                        <div class="invalid-feedback alert alert-danger">Fill This Field</div>
                      </div>
                      </div>
                    </div>
                    <div class="form-group form-group-lg my-3">
                      <div class="row">
                          <label for="qty" class="col-sm-2 control-label" style="font-weight: bold;">Description</label>
                          <div class="col-sm-8 col-md-6">
                            <input type="text"  class="form-control p-2" name="description" value="<?= $row->description ;?> "id="qty" required  >
                            <div class="valid-feedback alert alert-success">Good</div>
                            <div class="invalid-feedback alert alert-danger">Fill This Field</div>
  
                          </div>
                          </div>
                    </div>
                    <div class="form-group form-group-lg">
                      <div class="row">
                        <label for="qty"  class="col-sm-2 control-label" style="font-weight: bold;">Price</label>
                        <div class="col-sm-8 col-md-6">
                            <input type="text"  class="form-control p-2"   name="price" value="<?= $row->price ?>" required>
                            <div class="valid-feedback alert alert-success">Good</div>
                            <div class="invalid-feedback alert alert-danger">Fill This Field</div>
                          </div>
                          </div>
                      </div>
  
                    <div class="form-group form-group-lg  my-3">
                      <div class="row">
                      <label class="col-sm-2 control-label"  style="font-weight: bold;"> Country Made </label>
                        <div class="col-sm-8 col-md-6">
                          <input type="text"  class="form-control p-2"   name="country" value="<?= $row->country_made?>"  required>
                            <div class="valid-feedback alert alert-success">Good</div>
                            <div class="invalid-feedback alert alert-danger">Fill This Field</div>
                        </div>
                        </div>
                      </div>
                      <div class="form-group form-group-lg ">
                      <div class="row">
                      <label class="col-sm-2 control-label"  style="font-weight: bold;">Status </label>
                        <div class="col-sm-8 col-md-6">
                          <select name="status"  value="<?= $row->status ?>" class="form-control  p-2" required>
                              <option value="0">....</option>
                              <option value="1" <?=  $row->status==1?"selected":""; ?> >New</option>
                              <option value="2" <?=  $row->status==2?"selected":""; ?> >Like New</option>
                              <option value="3" <?=  $row->status==3?"selected":""; ?> >Used</option>
                              <option value="4" <?=  $row->status==4?"selected":""; ?> >Very Old</option>
                          </select>
                        </div>
                        </div>
                      </div>
                      <div class="form-group form-group-lg my-3">
                      <div class="row">
                      <label class="col-sm-2 control-label"  style="font-weight: bold;">Member </label>
                        <div class="col-sm-8 col-md-6">
                          <select name="member" class="form-control  p-2" required>
                              <option value="0">....</option>
                              <?php
                              $users=  mysqli_query($conn,"SELECT * FROM `users`");
                           
                                foreach($users as $user){
                                  echo "<option  value = '".$user['UserID'] . "'";
                                   echo $user['UserID'] == $row->member_id?"selected":"";
                                  echo  ">".$user['Username']."</option>";

                                }
                          
                              ?>

                          </select>
                        </div>
                        </div>
                      </div>
                      <div class="form-group form-group-lg my-3">
                       <div class="row">
                        <label class="col-sm-2 control-label"  style="font-weight: bold;">Category</label>
                        <div class="col-sm-8 col-md-6">
                          <select name="category" class="form-control  p-2" required>
                              <option value="0">....</option>
                              <?php
                              $query2 =  mysqli_query($conn,"SELECT * FROM `categries`");
                               while($cats = mysqli_fetch_object($query2)){
                                echo "<option value='".$cats->ID."'";
                                echo $cats->ID==$row->cat_id?"selected":"";
                                echo ">".$cats->Name."</option>";
                              }
                              ?>

                          </select>
                        </div>
                        </div>
                      </div>
                      <div class="form-group form-group-lg  my-3">
                      <div class="row">
                      <label class="col-sm-2 control-label"  style="font-weight: bold;">Image  </label>
                        <div class="col-sm-8 col-md-6">
                        <label class="col-sm-2 control-label"  style="font-weight: bold;" for="img"><img src="<?php echo $UrlImg.$row->image;?>" alt="logo" height="190" width="500" ></label>
                          <input type="file"  class="form-control p-2"   name="image" id="img" style="display:none">
                        </div>
                        </div>
                      </div>
                    
                      <div class="form-group form-group-lg  ">
                        <div class ="col-sm-offset-2 col-sm-10">
                            <input type="submit" class=" d-block m-auto btn b btn-lg" value ="Edit Item" style="background-color:#3498db;color:#fff;width:20%;font-wieght:bold">
                        <div>
                    </div>
                  
                </form>
                </div>
               <?php 
               
              }else{
                  $thMsg="<div class=' container alert alert-danger '>
                          <button class='btn-close' data-bs-dismiss='alert'></button>
                          There Is Not Such Id
                        </div>";
                    redirectHome($thMsg,'back');
                }
        }elseif ($do=='Edit') {
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $id               =       $_POST['id']; 
                  $name           =      $_POST['name'];
                  $description     =      $_POST['description'];
                  $price          =      $_POST['price'];
                  $country        =      $_POST['country'];
                  $status         =      $_POST['status'];
                  $image          =      uploadImage('image');
                  if(empty($name) && empty($description) && empty($price) && empty($country)){
                    $thMsg ="<h3 class='alert alert-danger'> Please Fill Fields</h3>";
                    redirectHome($thMsg,'back');
                  }else{
                       mysqli_query($conn,"UPDATE `items` SET 
                        `name`='$name',`description`='$description',`price`='$price',
                        `country_made`='$country   ',`image`='$nameImage',`status`='$status' where item_id='$id'");
                            echo "<h3 class='alert  alert-success text-center'> Updated the Items Is Successfully</h3>";
                            header("refresh:3;url=items.php");
                  }

            }
        }elseif($do=="Delete") {
        
                $itemid = isset($_GET['itemId'])&& is_numeric($_GET['itemId'])?intval($_GET['itemId']):0;
          
                if( CheckItem("item_id",'items',$itemid )  > 0){
                  mysqli_query($conn,"DELETE FROM `items` WHERE item_id = $itemid");
                  $msg = "<h3 class='alert alert-danger'>deleted Item Is Successfully </h3>";
                  redirectHome($msg,"back");
                }else{
                  header("location:items.php");
                }
                
        }elseif($do=="Approve") {
          $itemid = isset($_GET['itemId']) && is_numeric($_GET['itemId'])?intval($_GET['itemId']):0;
        
          if( CheckItem("item_id",'items',$itemid )  > 0){
              mysqli_query($conn,"UPDATE items SET approve=1 where item_id=$itemid");
              // $msg = "<h3 class='alert alert-info'> approve Item Is Successfully </h3>";
              header("location:items.php");
           }
          include $tpls."footer.php";
              echo "</div>";
    }else{
      header("location:index.php");
      exit();
    }
  }

