<?php
 function lang($phrase)
 {
     static $lang = array(
         // Navbar Link

          "home_page"    =>"Home",
          "categories"   =>"Categories",
          "items"        =>"Items",
          "members"=>"Members",
          "conmments"=>"Comments",
          "statistics"=>"statistics",
          "logs"=>"Logs"

     );
    return $lang[$phrase];
 }
 ?>