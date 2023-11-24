<?php
/**
 *
 * 
 *  .............   items page   .............
 * 
 * 
 **/
  // URL image
const URLIMG = 'admin/includes/imageUpload/';
session_start();
if(isset($_SESSION['username'])){
 
      $getTitle = "Items";
      include "init.php";
    echo "<div class='container'>";
    $do = isset($_GET['do'])?$_GET['do']:'Manage';
      if($do=='Manage')
          {
            
            echo"<h3 class='members my-5'>  All Prodects  </h3>";
            $prodect = mysqli_query($conn,"SELECT * FROM `items`");
            echo  "<div class='row'>";
            while($row = mysqli_fetch_object( $prodect)){
            echo"
              <div class='col-sm-12 col-md-6 col-lg-3 col-xl-3 ms-5'>
                <div class='my-2 card  shadow' style='width: 18rem;'>
                  <img src='/imageUpload/.$row->image' class='card-img-top' alt='...'>
                  <div class='card-body'>
                    <div class='card-title'>
                      $row->name
                      <span class='badge text-light float-none float-sm-end' style='background-color:#3498db'>$row->price</span>
                    </div>
                      <p class='card-text'>$row->description</p>
                  </div>
                    <div class='card-body text-center'>
                      <a href='?do=Update&itemId=$row->item_id' class='btn text-light' style='background-color:#3498db;color:#fff'>Edit</a>
                      <a href='?do=Delete&itemId=$row->item_id' class='btn btn-danger'  onclick=\"return confirm('Are You Sure Delete','Are You Sure')\">Delete</a>
                    </div>
                </div>
              </div>
            ";
            }
        echo "</div>";
      }elseif($do=='Add'){
            ?>
            <h3 class="members">Add New Items</h3>
              
              <div class="container m-1">
            
              <form action="?do=Insert" method="POST"  enctype="multipart/form-data" novalidate>
              

                  <div class="form-group  form-group-lg">
                    <div class="row">
                    <label class="col-sm-2" style="font-weight: bold;">Name</label>
                    <div class="col-sm-8 col-md-6">
                      <input type="text" name="name" class="form-control p-2"  placeholder="Name Of The Item" required>
                      <div class="valid-feedback alert alert-success">Good</div>
                      <div class="invalid-feedback alert alert-danger">Fill This Field</div>
                    </div>
                    </div>
                  </div>
                  <div class="form-group form-group-lg my-3">
                    <div class="row">
                        <label for="qty" class="col-sm-2 control-label" style="font-weight: bold;">Description</label>
                        <div class="col-sm-8 col-md-6">
                          <input type="text"  class="form-control p-2" name="description" id="qty" placeholder='Describe The Item' required  >
                          <div class="valid-feedback alert alert-success">Good</div>
                          <div class="invalid-feedback alert alert-danger">Fill This Field</div>

                        </div>
                        </div>
                  </div>
                  <div class="form-group form-group-lg">
                    <div class="row">
                      <label for="qty"  class="col-sm-2 control-label" style="font-weight: bold;">Price</label>
                      <div class="col-sm-8 col-md-6">
                          <input type="text"  class="form-control p-2"   name="price"  placeholder="Price Of Item" required>
                          <div class="valid-feedback alert alert-success">Good</div>
                          <div class="invalid-feedback alert alert-danger">Fill This Field</div>
                        </div>
                        </div>
                    </div>

                  <div class="form-group form-group-lg  my-3">
                    <div class="row">
                    <label class="col-sm-2 control-label"  style="font-weight: bold;"> Country Made </label>
                      <div class="col-sm-8 col-md-6">
                        <input type="text"  class="form-control p-2"   name="country" placeholder="Country Of  Made" required>
                          <div class="valid-feedback alert alert-success">Good</div>
                          <div class="invalid-feedback alert alert-danger">Fill This Field</div>
                      </div>
                      </div>
                    </div>
                    <div class="form-group form-group-lg ">
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
                        <input type="file"  class="form-control p-2"   name="image" id="img" placeholder="Image Of  Item">
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
                        }
               
                }
              }else{
                  $thMsg= "<h3 class='alert alert-danger text-center'>Sorry You Can't Browse This Page Directly</h3>";
                  redirectHome($thMsg);
              }
      
        }elseif ($do=="Update") {
              $itemid = isset($_GET['itemId'])&&is_numeric($_GET['itemId'])?intval($_GET['itemId']):0;
              $query_Update = mysqli_query($conn,"SELECT * from items WHERE item_id = $itemid  LIMIT 1");
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
                        <input type="text" name="name" value="<?php echo $row->name?>" class="form-control p-2"  placeholder="Name Of The Item" required>
                        <div class="valid-feedback alert alert-success">Good</div>
                        <div class="invalid-feedback alert alert-danger">Fill This Field</div>
                      </div>
                      </div>
                    </div>
                    <div class="form-group form-group-lg my-3">
                      <div class="row">
                          <label for="qty" class="col-sm-2 control-label" style="font-weight: bold;">Description</label>
                          <div class="col-sm-8 col-md-6">
                            <input type="text"  class="form-control p-2" name="description" value="<?= $row->description ;?>"id="qty" placeholder='Describe The Item' required  >
                            <div class="valid-feedback alert alert-success">Good</div>
                            <div class="invalid-feedback alert alert-danger">Fill This Field</div>
  
                          </div>
                          </div>
                    </div>
                    <div class="form-group form-group-lg">
                      <div class="row">
                        <label for="qty"  class="col-sm-2 control-label" style="font-weight: bold;">Price</label>
                        <div class="col-sm-8 col-md-6">
                            <input type="text"  class="form-control p-2"   name="price" value="<?= $row->price ?>"  placeholder="Price Of Item" required>
                            <div class="valid-feedback alert alert-success">Good</div>
                            <div class="invalid-feedback alert alert-danger">Fill This Field</div>
                          </div>
                          </div>
                      </div>
  
                    <div class="form-group form-group-lg  my-3">
                      <div class="row">
                      <label class="col-sm-2 control-label"  style="font-weight: bold;"> Country Made </label>
                        <div class="col-sm-8 col-md-6">
                          <input type="text"  class="form-control p-2"   name="country" value="<?= $row->country_made?>" placeholder="Country Of  Made" required>
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
                              <option value="1">New</option>
                              <option value="2">Like New</option>
                              <option value="3">Used</option>
                              <option value="4">Very Old</option>
                          </select>
                        </div>
                        </div>
                      </div>
                      
                      <div class="form-group form-group-lg  my-3">
                      <div class="row">
                      <label class="col-sm-2 control-label"  style="font-weight: bold;">Image  </label>
                        <div class="col-sm-8 col-md-6">
                        <label class="col-sm-2 control-label"  style="font-weight: bold;" for="img"><img src="" alt="logo" ></label>
                          <input type="file"  class="form-control p-2"   name="image" id="img" placeholder="Image Of  Item" style="display:none">
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
                 mysqli_query($conn,"DELETE FROM `items` WHERE item_id = $itemid");
                 redirectHome(0);
        }elseif($do=="Approve") {
            echo "Approve";
              //  echo "delete";
          
          
              include $tpls."footer.php";
              echo "</div>";
          
    }else{
      header("location:index.php");
      exit();
    }
  }