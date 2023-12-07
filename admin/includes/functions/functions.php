<?php


function pageTitle()
{
 global $getTitle;
 if(isset($getTitle)){

     echo $getTitle;

 }else{

     echo "defualt";

 }

}

//  type request mothed  ==post
function RequsetMothed($method){
 return $_SERVER['REQUEST_METHOD']== $method;
    
}
// Redirect Page
function redirectHome($thMsg="",$url = null,$Seconed=3){

    if($url === null){

      $url ='dashboard.php';

    }else{
     $url=isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER']:'dashboard.php';
    
    }
    echo $thMsg;
    header("refresh:$Seconed;url=$url");
    exit();
}

// Check  This Username  Is On database
function CheckItem($select,$Table,$value)
{
   global $conn;
   
   $query  =  mysqli_query($conn,"SELECT $select FROM `$Table` WHERE $select = '$value'");
        
   return  mysqli_num_rows($query);


}

/**
 * Count Number of Items Function v1.0
 * 
 * 
 * 
 */
function CheckCountItems($select,$Table,$value){
  global $conn;
  if( $value == ""){
    $value = 0;
  $query  =  mysqli_query($conn,"SELECT $select FROM `$Table` WHERE $select = '$value'");
  echo  mysqli_num_rows($query);
  }else{
    $query  =  mysqli_query($conn,"SELECT COUNT($select) FROM `$Table`"); 
  echo  mysqli_fetch_Column($query);
  }   
 
}

/**
 *  Count Number of Items Function v1.0
 *   Function Count Number Of The Items Rows
 * $Item  = The Item Is Count
 * $Table = The Table To choose From
 *  */ 
function CountItems($Item,$Table){
  global $conn;
  $query = mysqli_query($conn,"SELECT COUNT($Item) FROM `$Table`");
    $count = mysqli_fetch_Column($query);
    echo $count ;
  //  foreach ($count as $key => $value) {
  //     echo $value;
  //  }

  
}

/**
 * Get Latest Records Function v1.0
 *  Function To Get Latest Form Database[Members , Items, Comments]
 * $Select = Field To Select
 * $Table  = The Table Choose From
 * $Limit = Number Of Records To Get
 */
function getLatest($select,$Table,$order,$Limit = 5){
  global $conn;
  $getquery = mysqli_query($conn,"SELECT $select FROM `$Table`  ORDER BY $order DESC LIMIT $Limit");
   $rows = mysqli_fetch_all($getquery);
   return $rows;
}


/**
 * This Function To Add In Database
 * spread syntax in js(...$value) or splat operater
 */
function addToDatabase($table,...$valueform){
     global $conn;
     $query = mysqli_query($conn,"INSERT INTO `$table`( `Name`, `description`, `Ordering`)VALUES($valueform)");
     if($query){
         echo "تم اضافة العناصر ";
      }else{
        echo "لم تتم العملية";
      }
}

/*
 .. This function join tables
 .. Fetching data from more than one table
*/
 function JoinMoreTable($parentTable='items',$childTable=[]){
  global $conn;
  $sql = "SELECT $parentTable.*,$childTable[0].Name AS cat_name,$childTable[1].Username as user_name FROM items INNER JOIN $childTable[0] ON $childTable[0].ID =$parentTable.cat_id 
  INNER JOIN $childTable[1] ON $childTable[1].UserID= $parentTable.member_id";
  return mysqli_query($conn,$sql);
 }

/* 
  ** This Function Is Upload Image In Database
*/
function uploadImage($file){
  if($_SERVER['REQUEST_METHOD'] ===  "POST"):
         $errors = array();
         global  $pathFile;
        global  $nameImage;
    //  $image = $_FILES[$file];
     $nameImage = $_FILES[$file]['name'];
     $typeImage = $_FILES[$file]['type'];
     $tmpImage = $_FILES[$file]['tmp_name'];
     $sizeImage = $_FILES[$file]['size'];
     $errorImage = $_FILES[$file]['error'];
     $pathFile = dirname(__DIR__)."\ImageUpload\\";
    
         // set allowed file extension
         $allowed_extensions = array("jpg","gif","jpeg","png");
         // get file extension
         
         $iamge_extensions =explode(".", $nameImage);
         $iamge_extensions=  strtolower(end($iamge_extensions));
    
         // check if file not empty
         if($errorImage == 4):
             $errors[] = "<div class='alert  alert-success text-center'>Not File Uploaded </div>";
         else:
             // check file size 
             if($sizeImage > 100000):

                 $errors[]="<div class='alert alert-danger text-center'> File can't Be More Then X</div>";
             endif;
             // check  if file  is valid
             if(!in_array($iamge_extensions,$allowed_extensions)):
                 $errors[]="<div class='alert alert-danger text-center'>File Is Not Valid</div>";
                 endif;
         endif;
    
         // check if has not error
         if(empty($errors)){
            move_uploaded_file($tmpImage,$pathFile.$nameImage);
            //  echo "Image Uploaded Successfully";
         }else{
             foreach($errors as $err):
                 echo $err;
             endforeach;
            }

 
 endif;
}


// return page 
function ReturnPage($page='home'){
  return header("0,URL=$page.'php'");
}
