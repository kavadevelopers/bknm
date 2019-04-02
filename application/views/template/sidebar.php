
<?php 

    $user  = $this->session->userdata('id');
    $user = $this->auth->get_admin($user);



    function menu($path,$array)
    {
      
      foreach($array as $a)
      {
        if($path === $a)
        {
          print_r(array("active","menu-open",));
          break;  
        }
      }
    }
?> 
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
      <img src="<?php echo base_url(); ?><?=$this->config->config["logoFile"]?>" alt="<?=$this->config->config["projectName"]?> logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?=$this->config->config["projectName"]; ?></span>
     
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url(); ?>uploads/<?=$user->image;?>" style="width: 40px; height:40px;" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $this->auth->get_full_name(); ?></a>
          <span style="color: #c2c7d0;"><small>
            <?php
              if($user->user_type == 'customer')
              {
                echo "Customer";
              }
              else if($user->user_type == 'agent')
              {
                  echo $this->auth->promotion_level();
              }
              else if($user->user_type == 'admin')
              {
                echo "Admin";
              }
              else if($user->user_type == 'business')
              {
                echo "Investor";
              }
            ?>
          </small>
          </span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("dashboard"))[0]; ?>">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('course'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("course"))[0]; ?>">
              <i class="nav-icon fa fa-bars"></i>
              <p>
                Manage Courses
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('person'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("person"))[0]; ?>">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Manage Persons
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('bill'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("bill"))[0]; ?>">
              <i class="nav-icon fa fa-inbox"></i>
              <p>
                Bill
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('bank'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("bank"))[0]; ?>">
              <i class="nav-icon fa fa-inbox"></i>
              <p>
                Bank
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url('dashboard/logout'); ?>" class="nav-link">
              <i class="nav-icon fa fa-power-off"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>
        
        
                 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
