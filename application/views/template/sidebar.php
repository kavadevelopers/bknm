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
    
    <style type="text/css">
        .nav-treeview .nav-item a{
            font-style: italic;
            font-size: 14px;
        }

        ::placeholder {
              color: #a3a4a5 !important;
              font-weight: 700;
              opacity: 1;
        }
    </style>

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

                    <li class="nav-item has-treeview <?php menu($this->uri->segment(1),array("setting"))[1]; ?>">
            
                        <a href="#" class="nav-link <?php menu($this->uri->segment(1),array("setting"))[0]; ?>">
                            <i class="nav-icon fa fa-cogs"></i>
                            <p>Setting
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                       
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('setting/financial_year'); ?>" class="nav-link <?php menu($this->uri->segment(2),array("financial_year","save_financial_year","edit_financial_year","update_financial_year"))[0]; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Financial Year</p>
                                </a>
                            </li>
                        
                            <li class="nav-item">
                                <a href="<?= base_url('setting/head'); ?>" class="nav-link <?php menu($this->uri->segment(2),array("head","save_head","edit_head","update_head"))[0]; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Head</p>
                                </a>
                            </li>
                        
                            <!-- <li class="nav-item">
                                <a href="<?= base_url('setting/file_limit'); ?>" class="nav-link <?php menu($this->uri->segment(2),array("file_limit","save_file_limit"))[0]; ?>">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>File Limit</p>
                                </a>
                            </li> -->
                        </ul>

                    </li>

                    <li class="nav-item has-treeview <?php menu($this->uri->segment(1),array("user","subject","ifsc","professor"))[1]; ?>">
            
                        <a href="#" class="nav-link <?php menu($this->uri->segment(1),array("user","subject","ifsc","professor"))[0]; ?>">
                            <i class="nav-icon fa fa-american-sign-language-interpreting"></i>
                            <p>Management
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                       
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="<?php echo base_url('user'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("user"))[0]; ?>">
                                    <i class="nav-icon fa fa-user-circle"></i>
                                    <p>
                                        Manage User
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url('subject'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("subject"))[0]; ?>">
                                    <i class="nav-icon fa fa-address-book"></i>
                                    <p>
                                        Manage Courses
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url('ifsc'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("ifsc"))[0]; ?>">
                                    <i class="nav-icon fa fa-university"></i>
                                    <p>
                                        Manage IFSC
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url('professor'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("professor"))[0]; ?>">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>
                                        Manage Professor
                                    </p>
                                </a>
                            </li>


                        </ul>
                    </li>

                    <li class="nav-item has-treeview <?php menu($this->uri->segment(1),array("paper_setting"))[1]; ?>">
            
                        <a href="#" class="nav-link <?php menu($this->uri->segment(1),array("paper_setting"))[0]; ?>">
                            <i class="nav-icon fa fa-envelope-open"></i>
                            <p>Billing
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo base_url('paper_setting'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("paper_setting"))[0]; ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Paper Setting
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    

                    <li class="nav-item">
                        <a href="<?php echo base_url('dashboard'); ?>/logout" class="nav-link ">
                            <i class="nav-icon fa fa-sign-out"></i>
                            <p>
                                Sign Out
                            </p>
                        </a>
                    </li>
        
                </ul>
            </nav>
        </div>
    </aside>

  
    <div class="content-wrapper">
