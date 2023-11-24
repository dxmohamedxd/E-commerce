<?php
 function lang($phrase)
 {
     static $lang = array(
         // Navbar Link

          "home_page"    =>"Home",
          "categories"   =>"Categories",
          "items"        =>"Items",
          "members"=>"Members",
          "statistics"=>"statistics",
          "logs"=>"Logs"

     );
    return $lang[$phrase];
 }
 ?>