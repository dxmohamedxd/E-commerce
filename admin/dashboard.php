<?php
  ob_start(); //   output buffering start
session_start();
if(isset($_SESSION['username'])){
    $getTitle = "Dashboard";
    /* Start Deshboard Page */
    include "init.php";
  $numUser = 6;
  $latestUser = getLatest("*","USERS","UserID",$numUser);
  $numItem=6;
  $latestItems= getLatest('*',"items",'item_id',$numItem)

    ?>
    <div class="container home-stats text-center">
    <h2 class="members">Deshboard</h2>
         <div class="row">
              <div class="col-md-3 mb-sm-2">
                 <div class="stat st-member">
                    Total  Members
                   <span><a href="members.php"><?php  CheckCountItems('UserID','USERS',0);?></a></span>
                 </div>
              </div>
              <div class="col-md-3">
                <div class="stat st-pending"> 
                  Pending Members 
                  <span><a href="members.php?do=Manage&page=pending" ><?php CheckCountItems('RegStatus','USERS',"");?> </a></span>
                 </div>
              </div>
              <div class="col-md-3">
                 <div class="stat st-item">
                    Total  Items
                     <span><a href="items.php"><?php  CountItems('item_id','items');?> </a></span>
                 </div>
              </div>
              <div class="col-md-3">
                <div class="stat st-comment">
                 Total  Comments
                <span>0</span>
               </div>
              </div>
         
         </div>
    </div>
    <div class="container Latest mb-3">
        <div class="row">
            <div class="col-sm-6">
                <div>
               
                    <div class=" p-2" style="background-color:#eee;border:1px solid #ddd; font-size:20px;">
                         Latest <?php echo $numUser ?> Registerd Users 
                    </div>
                    <div class="panel-body">
                        <div class="form-control p-2 bg-light" style="font-size:20px"> 
                        <ul class="list-unstyled latest_ul">
                        <?php
                    
                           foreach ($latestUser as $latest)
                             {
                               echo
                                "<li>".ucwords($latest[1]).
                                  "<a href='members.php?do=Edit&userId=$latest[0]'>
                                   <span class='btn btn-success float-end'>
                                    Edit
                                   </span></a>";
                                   if($latest[7]==0){
                                    echo "<a href='members.php?do=Activate&UserID=$latest[0]' class='btn btn-info float-end ' style='color:white' onclick=\"return confirm('Do You Want To Activate The Member','activate')\">  Activate</a>";
                                   }
                                   
                                   "</li>";
                              }
                        
                           ?>
                        </ul>
                         </div>
                   </div> 
                </div>
            </div>
            <div class="col-sm-6">
                <div>
                    <div class="p-2"  style="background-color:#eee;border:1px solid #ddd; font-size:20px">
                         Latest Items <?= count($latestItems)?>
                    </div>
                    <div class="panel-body">
                        <div class="form-control p-2 bg-light" style="font-size:20px"> 
                        <ul class="list-unstyled latest_ul">
                        <?php
                    
                           foreach ($latestItems as $latest)
                             {
                               echo
                                "<li>".ucwords($latest[1]).
                                  "<a href='items.php?do=Update&itemId=$latest[0]'>
                                   <span class='btn btn-success float-end'>
                                    Edit
                                   </span></a>";
                                  //  echo 95,$latest[8];
                                   if($latest[8]==0){
                                    echo "<a href='items.php?do=Approve&itemId=$latest[0]' class='btn btn-info float-end ' style='color:white' onclick=\"return confirm('Do You Want To Activate The Member','activate')\">  Approve</a>";
                                   }
                                   
                                   "</li>";
                              }
                        
                           ?>
                        </ul>
                         </div>
                   </div> 
                </div>
            </div>

        </div>

     </div>
    <?php
    /*End Deshboard Page */
}else{
  
    header("location:index.php");
    exit();
}
 include $tpls."footer.php";
 ob_end_flush()
?>