<!-- Start Header -->
  <div class="topbar hidden-sm hidden-xs">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <nav class="secondary-menu">
            <ul class="pull-left">
              <li><a href="#"><i class="fa fa-phone"></i> +91 1234567890</a></li>
              <li><a href="#"><i class="fa fa-envelope"></i> info@qpgs.com</a></li>
            </ul>
          </nav>
        </div>
        <div class="col-md-6">
          <nav class="secondary-menu">
            <ul class="pull-right">
                <?php
                if($_SESSION['admin_id']!='')
                {
                    ?>
                    <li class="dropdown pull-right">
                        <a data-toggle="dropdown"> Welcome <?php echo $_SESSION['name']; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li class="dropdown"><a href="logout.php">Logout</a></li>
                          
                        </ul>
                     </li>    
                    <?php
                }
                ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- Start Header -->
  <header class="site-header">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h1 class="logo"> <a href="index.php">Question Paper Generation System</a> </h1>
        </div>
        <div class="col-md-8">
          <button class="mmenu-toggle"><i class="fa fa-bars fa-lg"></i></button>
          <nav class="main-menu">
            <ul class="sf-menu" id="main-menu">
                <?php
                
                    if($_SESSION['admin_id']!='')
                    {
                        ?>
                        <li><a href="dashboard.php">Home</a></li>
                        <?php if($_SESSION['user_type']==1) { ?> 
                        <li>
                            <a href="staffs.php">Staff</a>
                            <ul class="dropdown">
                                <li><a href="staffs.php">View Staff</a></li>
                                <li><a href="addstaff.php">Add Staff</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="subjects.php">Subjects</a>
                            <ul class="dropdown">
                                <li><a href="subjects.php">View Subjects</a></li>
                                <li><a href="addsubject.php">Add Subject</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="units.php">Units</a>
                            <ul class="dropdown">
                                <li><a href="units.php">View Units</a></li>
                                <li><a href="addunit.php">Add Unit</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="questions.php">Questions</a>
                            <ul class="dropdown">
                                <li><a href="questions.php">View Questions</a></li>
                                <li><a href="addquestion.php">Add Question</a></li>
                            </ul>
                        </li>
                        <?php if($_SESSION['user_type']==1) { ?> 
                        <li>
                            <a href="questionpapers.php">Question Papers</a>
                            <ul class="dropdown">
                                <li><a href="questionpapers.php">View Question Papers</a></li>
                                <li><a href="addquestionpaper.php">Add Question Paper</a></li>
                                <li><a href="autoquestionpaper.php">Auto Question Paper</a></li>
                            </ul>
                        </li>
                        <?php } ?> 
                        <li><a href="logout.php">Logout</a></li>
                        <?php
                    }
                    else
                    {
                        ?>
                        <li><a href="Index.php">Home</a></li>
                        <li><a href="login.php">Login</a></li>
                        <?php
                    }
                    
                ?>
                
              
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <nav class="mobile-menu">
      <div class="container">
        <div class="row"></div>
      </div>
    </nav>
  </header>