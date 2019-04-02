<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
          		</div>
        	</div><!-- /.row -->
      	</div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
<!-- Main content -->
    <section class="content">
      	<div class="container-fluid">
            <form method="post" action="<?= base_url();?>subadmin/save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                    <!-- start here -->

                    <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Login Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Username <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('user_name'); ?>" type="text" name="user_name" id="user_name" placeholder="Username" autocomplete="off">
                                            <?php echo form_error('user_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('pass'); ?>" type="password" name="pass" id="pass" placeholder="Password" autocomplete="off">
                                            <?php echo form_error('pass'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Confirm Password <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('c_pass'); ?>" type="password" name="c_pass" id="c_pass" placeholder="Confirm Password" autocomplete="off">
                                            <?php echo form_error('c_pass'); ?>
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




                    <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Personal Information</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('first_name'); ?>" type="text" name="first_name" id="first_name" placeholder="First Name" autocomplete="off">
                                            <?php echo form_error('first_name'); ?>
                                        </div>
                                    </div>

                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Middle Name </label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('middle_name'); ?>" type="text" name="middle_name" id="middle_name" placeholder="Middle Name" autocomplete="off">
                                            <?php echo form_error('middle_name'); ?>
                                        </div>
                                    </div>
                                	
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('last_name'); ?>" type="text" name="last_name" id="last_name" placeholder="Last Name" autocomplete="off">
                                            <?php echo form_error('last_name'); ?>
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

                                 <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Contact information</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control form-control-sm" value="<?php echo set_value('email'); ?>" type="text" name="email" id="email" placeholder="Email" autocomplete="off">
                                            <?php echo form_error('email'); ?>
                                    </div>
                                </div> 
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" value="<?php echo set_value('mobile'); ?>" type="text" name="mobile" id="mobile" placeholder="Mobile" autocomplete="off">
                                         <?php echo form_error('mobile'); ?>
                                    </div> 
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile2 </label>
                                        <input class="form-control form-control-sm" value="<?php echo set_value('mobile2'); ?>" type="text" autocomplete="off" name="mobile2" id="mobile2" placeholder="Mobile2" >
                                         <?php echo form_error('mobile2'); ?>
                                    </div> 
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Address <span class="astrick">*</span></label>
                                        <textarea class="form-control form-control-sm" value="" type="text" name="address" id="address" placeholder=" Address" ><?php echo set_value('address'); ?></textarea>
                                         <?php echo form_error('address'); ?>
                                    </div> 
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" value="<?php echo set_value('city'); ?>" type="text" name="city" id="city" placeholder="City" >
                                         <?php echo form_error('city'); ?>
                                    </div> 
                                </div>

                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Zip code <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" value="<?php echo set_value('zip'); ?>" type="text" name="zip" id="zip" placeholder="Zip code" >
                                         <?php echo form_error('zip'); ?>
                                    </div> 
                                </div>

                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" value="<?php echo set_value('state'); ?>" type="text" name="state" id="state" placeholder="State" >
                                         <?php echo form_error('state'); ?>
                                    </div> 
                                </div>
                            </div>
                    </div>
                </div>

                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>subadmin" class="btn btn-danger">Cancel</a>
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
<!-- /.container-fluid -->

<script type="text/javascript">
    $(function(){
        
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