
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">

        
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#app-nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="app-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a href="dashboard.php" class="nav-link"><?php echo lang("home_page");?></a></li>
                <li class="nav-item"><a href="categories.php" class="nav-link"> <?php echo lang("categories");?></a></li>
                <li class="nav-item"><a href="items.php" class="nav-link"> <?php echo lang("items");?></a></li>
          
                <li class="nav-item"><a href="members.php" class="nav-link"> <?php echo lang("members");?></a></li>
                <li class="nav-item"><a href="vue.php" class="nav-link"> <?php echo lang("statistics");?></a></li>
                <li class="nav-item"><a href="#" class="nav-link"> <?php echo lang("logs");?></a></li>

            </ul>
            <ul class="navbar-nav ms-auto">
               <div class="dropstart float-end">
               <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" style="background-color:#3498db;">
                   <?php echo $_SESSION['username'];?>
              </button>
              <ul class="dropdown-menu dropdown-menu-light" style="background-color:#3498db;min-width:180px;padding:0;font-size:1em;border:none;">
                <li><a href="members.php?do=Edit&userId=<?php  echo $_SESSION['Id'];?>" class="dropdown-item">Edit Profile</a></li>
                <li><a href="#" class="dropdown-item">Setting</a></li>
                <li><a href="logout.php"  class="dropdown-item" onclick="return confirm('هل تريد تسجيل الخروج','تسجيل الخروج')">Logout</a></li>
            </ul>
              </div>
          </ul>
        </div>
    </div>
</nav>