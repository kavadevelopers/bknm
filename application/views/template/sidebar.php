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
  
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    
        <a href="<?php echo base_url('dashboard'); ?>" class="brand-link">
            <img src="<?php echo base_url(); ?><?=$this->config->config["logoFile"]?>" alt="<?=$this->config->config["projectName"]?> logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
            <span class="brand-text font-weight-light">
                <?=$this->config->config["projectName"]; ?>        
            </span>
         
        </a>

    
        <div class="sidebar">
      
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo base_url(); ?>uploads/<?=$user->image;?>" style="width: 40px; height:40px;" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">
                        <?= $user->name; ?>        
                    </a>
                    <span style="color: #c2c7d0;">
                        <small>
                            <?php
                                if($user->user_type == 'user')
                                {
                                    echo "User";
                                }
                                else if($user->user_type == 'admin')
                                {
                                    echo "Admin";
                                }
                            ?>
                        </small>
                    </span>
                </div>
            </div>

      
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
                    <li class="nav-item">
                        <a href="<?php echo base_url('dashboard'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("dashboard"))[0]; ?>">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo base_url('user'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("user"))[0]; ?>">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Manage User
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo base_url('subject'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("subject"))[0]; ?>">
                            <i class="nav-icon fa fa-address-book"></i>
                            <p>
                                Manage Subjct
                            </p>
                        </a>
                    </li>
        
                </ul>
            </nav>
        </div>
    </aside>

  
    <div class="content-wrapper">
