<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$this->config->config["projectTitle"]?> | Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="<?php echo base_url(); ?>image/favicon.png" type="image/png"/>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>font-awesome/css/font-awesome.min.css">
 
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="<?php echo base_url(); ?>plugins/jquery/jquery_new.js"></script>
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/daterangepicker/daterangepicker-bs3.css">

  <!-- Notify js -->
<script src="<?php echo base_url(); ?>plugins/notifyjs/bootstrap-notify.js"></script>
<script src="<?php echo base_url(); ?>plugins/notifyjs/bootstrap-notify.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/custom_add.css">
<!-- bootstrap-datepicker -->
<script src="<?php echo base_url(); ?>plugins/datepicker/bootstrap-datepicker.js"></script>
</head>


<body class="hold-transition login-page">
	<div class="wrapper">
		<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
			<ul class="navbar-nav">
			  <li class="nav-item">
			    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
			  </li>
			  
			</ul>


			<ul class="navbar-nav ml-auto">
			    
			</ul>
		</nav>
  		<aside class="main-sidebar sidebar-dark-primary elevation-4">
		    <a href="<?php echo base_url('welcome'); ?>" class="brand-link">
		      <img src="<?php echo base_url(); ?><?=$this->config->config["logoFile"]?>" alt="<?=$this->config->config["projectName"]?> logo" class="brand-image img-circle elevation-3"
		           style="opacity: .8">
		      <span class="brand-text font-weight-light"><?=$this->config->config["projectName"]; ?></span>
		     
		    </a>
		    <div class="sidebar">
			    <nav class="mt-2">
			        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			          
			          <li class="nav-item">
			            <a href="<?php echo base_url('welcome'); ?>" class="nav-link ">
			              <i class="nav-icon fa fa-sign-in"></i>
			              <p>
			                Login
			              </p>
			            </a>
			          </li>


			    	</ul>
			    </nav>
		    </div>

  		</aside>

  		<div class="content-wrapper">

	   	<div class="content-header">
	      	<div class="container-fluid">
	        	<div class="row mb-2">
	          		<div class="col-sm-6">
	            		<h1 class="m-0 text-dark">Register</h1>
	          		</div>
	        	</div>
	      	</div>
	    </div>



        <section class="content">
        <div class="container-fluid">
            <form method="post" action="<?= base_url(); ?>register/save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                    <!-- start here -->

                        <!-- 
                        **************************************************
                                        Login Details   
                        **************************************************
                        -->

                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Login Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>User Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('user_name'); ?>" type="text" name="user_name" placeholder="User Name" autocomplete="off">
                                            <?php echo form_error('user_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reference Id  OR Agent Id<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('ref'); ?>" type="text" name="ref" placeholder="Reference Id OR Agent Id" >
                                            <?php echo form_error('ref'); ?>
                                            
                                        </div>
                                    </div>

                                     

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('pass'); ?>" type="password" name="pass" placeholder="Password" autocomplete="off">
                                            <?php echo form_error('pass'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Confirm Password <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('con_pass'); ?>" type="password" name="con_pass" placeholder="Confirm Password" autocomplete="off">
                                            <?php echo form_error('con_pass'); ?>
                                        </div>
                                    </div>


                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Coustomer Id</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('coust_id'); ?>" type="text" name="coust_id" placeholder="Coustomer Id" autocomplete="off">
                                            <?php echo form_error('coust_id'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="image-container">
                                                    <img src="<?=base_url();?>uploads/user.png" id="imgProfile" style="width: 150px; height: 150px;" class="img-thumbnail kava-image-upload" alt="No-Image" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" name="my_image" id="" onchange="readURL(this);" required>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>

                        <!-- 
                        **************************************************
                                       Personal Information  
                        **************************************************
                        -->

                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Personal Information</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First Name<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('fi_name'); ?>" type="text" name="fi_name" placeholder="First Name" >
                                            <?php echo form_error('fi_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('mi_name'); ?>" type="text" name="mi_name" placeholder="Middle Name" >
                                            <?php echo form_error('mi_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Name<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('la_name'); ?>" type="text" name="la_name" placeholder="Last Name" >
                                            <?php echo form_error('la_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Father Name<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('fa_name'); ?>" type="text" name="fa_name" placeholder="Father Name" >
                                            <?php echo form_error('fa_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mother Name<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('mo_name'); ?>" type="text" name="mo_name" placeholder="Mother Name" >
                                            <?php echo form_error('mo_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Birth Date<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="date_picker_A" value="<?php echo set_value('bdate'); ?>" autocomplete="off" type="text" name="bdate" placeholder="Birth Date" readonly>
                                            <?php echo form_error('bdate'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Joining Date</label>
                                            <input class="form-control form-control-sm" id="jdate" type="text" name="jdate" placeholder="Joining Date" autocomplete="off" value="<?php echo set_value('jdate',date('d-m-Y')); ?>" readonly>
                                            <?php echo form_error('jdate'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control form-control-sm" id="cal_year" type="text" name="year" placeholder="Age" value="<?php echo set_value('year'); ?>" readonly>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                                
                                                <label>Id Proof Type<span class="astrick">*</span></label>
                                                <select class="form-control form-control-sm select2" name="proof_type" autocomplete="off">
                                                <option value="">-- Select Id Proof Type --</option>
                                                <?php $proof = proof_type();
                                                    
                                                    foreach ($proof as $key => $value) {
                                                ?>
                                                    <option value="<?= $value['type'] ?>" <?php if($value['type'] == set_value('proof_type')) { echo "selected"; } ?>><?= $value['type'] ?></option>
                                                <?php } ?>
                                            </select>

                                            <?php echo form_error('proof_type'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Id Proof Number<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('proof_num'); ?>" type="text" name="proof_num" placeholder="Id Proof Number" autocomplete="off">
                                            <?php echo form_error('proof_num'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Qualification<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('quali'); ?>" type="text" name="quali" placeholder="Qualification" >
                                            <?php echo form_error('quali'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Designation<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('desig'); ?>" type="text" name="desig" placeholder="Designation" >
                                            <?php echo form_error('desig'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sex <span class="astrick">*</span></label>
                                            <select name="sex" class="form-control form-control-sm">
                                                <option value="">-- Select Sex  --</option>
                                                <option value="Male" <?php if(set_value('sex') == 'Male'){ echo "selected"; } ?>>Male</option>
                                                <option value="Female" <?php if(set_value('sex') == 'Female'){ echo "selected"; } ?>>Female</option>
                                            </select>
                                            <?php echo form_error('sex'); ?>
                                        </div>
                                    </div>
                                    
                                   
                                </div>
                            </div>
                        </div>

                        <!-- 
                        **************************************************
                                        Contact information    
                        **************************************************
                        -->

                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Contact information</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('email'); ?>" type="text" name="email" placeholder="Email" autocomplete="off">
                                             <?php echo form_error('email'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mobile Number <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('mobile'); ?>" type="text" name="mobile" placeholder="Mobile Number" autocomplete="off">
                                            <?php echo form_error('mobile'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Mobile Number2</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('mobile2'); ?>" type="text" name="mobile2" placeholder="Mobile Number2" autocomplete="off">
                                            <?php echo form_error('mobile2'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address <span class="astrick">*</span></label>
                                            <textarea class="form-control form-control-sm" type="text" name="address" placeholder="Address"><?php echo set_value('address'); ?></textarea>
                                            <?php echo form_error('address'); ?>
                                        </div>
                                    </div>

                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('city'); ?>" type="text" name="city" placeholder="City" >
                                            <?php echo form_error('city'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Zip code <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('zip'); ?>" type="text" name="zip" placeholder="Zip code" >
                                            <?php echo form_error('zip'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('state'); ?>" type="text" name="state" placeholder="State">
                                            <?php echo form_error('state'); ?>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>


                        <!-- 
                        **************************************************
                                        Bank Details   
                        **************************************************
                        -->

                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Bank Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bank Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('bank'); ?>" type="text" name="bank" placeholder="Bank Name" >
                                            <?php echo form_error('bank'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>A/C Number <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('ac_number'); ?>" type="text" name="ac_number" placeholder="A/C Number" autocomplete="off">
                                            <?php echo form_error('ac_number'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>IFSC Code <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('ifsc_code'); ?>" type="text" name="ifsc_code" placeholder="IFSC Code" autocomplete="off">
                                            <?php echo form_error('ifsc_code'); ?>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Branch Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('branch_name'); ?>" type="text" name="branch_name" placeholder="Branch Name" >
                                            <?php echo form_error('branch_name'); ?>
                                        </div>
                                    </div>

                                                                   
                                </div>
                            </div>
                        </div>  


                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>



                    <!-- end here -->

                    </div>
                </div>
            </form>    
        </div><!-- // container-fluid -->
    </section>






<!-- Minimal Drop down -->
<script src="<?php echo base_url(); ?>plugins/select2/select2.full.min.js"></script>
<!-- Minimal Drop down -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>plugins/select2/select2.min.css">

		<script type="text/javascript">
		    
		     
		    $(function(){
		        $('.select2').select2();
		        // Birth Date    
		        $('.date_picker').datepicker({
		            format: 'dd-mm-yyyy',
		            todayHighlight:'TRUE',
		            autoclose: true,
		            endDate: "+0d"
		        }).on('changeDate', function(ev){
		            $('#cal_year').val(calculateAge(parseDate($(this).val()), new Date()));
		        })

		        
		        // Joining Date 
		        $('#jdate').datepicker({
		            format: 'dd-mm-yyyy',
		            todayHighlight:'TRUE',
		            autoclose: true,
		            endDate: "+0d"
		        });

		        




		        
		    })

		</script>	


  	</div>


	  <footer class="main-footer">
	    <strong>
	      Copyright &copy; 2017 - <?php echo date('Y'); ?> 
	      <a href="<?=$this->config->config["companyWebLink"]?>">
	          <?=$this->config->config["projectName"]?>
	      </a>
	    </strong>


	    All rights reserved.
	    
	    <div class="float-right d-none d-sm-inline-block">
	      <b>Powered By </b>
	      <strong> 
	        <a target="_blank" href="http://www.kavadevelopers.com">
	            Kava Developers
	        </a>
	      </strong>
	    </div>
	  
	  </footer>
<script src="<?php echo base_url(); ?>dist/js/plugins/custom_add.js"></script>
 
</div>
<script type="text/javascript">
	function parseDate(dateStr) {
	  var dateParts = dateStr.split("-");
	  return new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);
	}
	function calculateAge (dateOfBirth, dateToCalculate) {
	    var calculateYear = dateToCalculate.getFullYear();
	    var calculateMonth = dateToCalculate.getMonth();
	    var calculateDay = dateToCalculate.getDate();

	    var birthYear = dateOfBirth.getFullYear();
	    var birthMonth = dateOfBirth.getMonth();
	    var birthDay = dateOfBirth.getDate();

	    var age = calculateYear - birthYear;
	    var ageMonth = calculateMonth - birthMonth;
	    var ageDay = calculateDay - birthDay;

	    if (ageMonth < 0 || (ageMonth == 0 && ageDay < 0)) {
	        age = parseInt(age) - 1;
	    }
	    return age;
	}
	
</script>

<script type="text/javascript">
    
     
    $(function(){
        
        // Birth Date    
        $('#date_picker_A').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true,
            endDate: "-18y"
        }).on('changeDate', function(ev){
            $('#cal_year').val(calculateAge(parseDate($(this).val()), new Date()));
        })

        
        // Joining Date 
        $('#jdate').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true,
            endDate: "+0d"
        });

        




        // Error Notify 

        <?php if(!empty(validation_errors())){ ?>
    
            $.notify({
                title: '<strong></strong>',
                icon: 'fa fa-times-circle',
                message: 'Your Form Was Not Submmited Check Your Form'
            },{
                type: 'danger'
            }); 
        <?php } ?>
    })

</script>
</body>
</html>
