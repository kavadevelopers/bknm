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
            <form method="post" action="<?= base_url();?>customer/update" enctype="multipart/form-data">
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
                                            <input class="form-control form-control-sm" value="<?php echo set_value('user_name',$user['user_name']); ?>" type="text" name="user_name" id="user_name" placeholder="Username" autocomplete="off" readonly>
                                            <?php echo form_error('user_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('pass',$user['pass']); ?>" type="password" name="pass" id="pass" placeholder="Password" autocomplete="off" readonly>
                                            <?php echo form_error('pass'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Confirm Password <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('c_pass',$user['pass']); ?>" type="password" name="c_pass" id="c_pass" placeholder="Confirm Password" autocomplete="off" readonly>
                                            <?php echo form_error('c_pass'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="image-container">
                                                    <img src="<?=base_url().'uploads/'.$user['image'];?>" id="imgProfile" style="width: 150px; height: 150px;" class="img-thumbnail kava-image-upload" alt="No-Image" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="file" name="my_image" id="" onchange="readURL(this);" >
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
                                            <input class="form-control form-control-sm" type="text" id="fi_name" name="fi_name" value="<?php echo set_value('fi_name',$customer['fi_name']); ?>" placeholder="First Name" >
                                            <?php echo form_error('fi_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input class="form-control form-control-sm" type="text" id="mi_name" name="mi_name" value="<?php echo set_value('mi_name',$customer['mi_name']); ?>" placeholder="Middle Name" >
                                            <?php echo form_error('mi_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" id="la_name" name="la_name" value="<?php echo set_value('la_name',$customer['la_name']); ?>" placeholder="Last Name" >
                                            <?php echo form_error('la_name'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date of Birth <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm date_picker" type="text" id="bdate" name="bdate" value="<?php echo set_value('bdate',date('d-m-Y',strtotime($customer['bdate']))); ?>" placeholder="Date of Birth" autocomplete="off">
                                            <?php echo form_error('bdate'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control form-control-sm" id="cal_year" type="text" name="year" placeholder="Age" value="<?php echo set_value('year',$customer['age']); ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">    
                                        <div class="form-group">
                                            <label>Select Gurdian Type <span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm"  name="gur_type" autocomplete="off" required>
                                                <option value="">-- Select Gurdian Type --</option>
                                                <option value="Father" <?php if(set_value('gur_type',$customer['gur_type']) == 'Father') { echo "selected"; };?>>Father</option>
                                                <option value="Husband" <?php if(set_value('gur_type',$customer['gur_type']) == 'Husband') { echo "selected"; };?>>Husband</option>
                                                <option value="Gurdian" <?php if(set_value('gur_type',$customer['gur_type']) == 'Gurdian') { echo "selected"; };?>>Gurdian</option>
                                            </select>
                                            <?php echo form_error('gur_type'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gurdian Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="gur_name" value="<?php echo set_value('gur_name',$customer['gur_name']); ?>" placeholder="Gurdian Name" autocomplete="off" required>
                                            <?php echo form_error('gur_name'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sex <span class="astrick">*</span></label>
                                            <select name="sex" class="form-control form-control-sm">
                                                <option value="">-- Select Sex  --</option>
                                                <option value="Male" <?php if(set_value('sex',$customer['sex']) == 'Male'){ echo "selected"; } ?>>Male</option>
                                                <option value="Female" <?php if(set_value('sex',$customer['sex']) == 'Female'){ echo "selected"; } ?>>Female</option>
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
                                            <label>Mobile <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" id="mobile" name="mobile" value="<?php echo set_value('mobile',$customer['mobile']); ?>" placeholder="Mobile" autocomplete="off">
                                            <?php echo form_error('mobile'); ?>
                                        </div>
                                    </div>
                                      
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile2</label>
                                        <input class="form-control form-control-sm" type="text" id="mobile2" name="mobile2" value="<?php echo set_value('mobile2',$customer['mobile2']); ?>" placeholder="mobile2" autocomplete="off" >
                                        <?php echo form_error('mobile2'); ?>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control form-control-sm" type="text" id="email" name="email" value="<?php echo set_value('email',$user['email']); ?>" placeholder="Email" autocomplete="off">
                                        <?php echo form_error('email'); ?>
                                    </div>
                                </div>
                                   
                                 <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address <span class="astrick">*</span></label>
                                            <textarea class="form-control form-control-sm" type="text" id="address" name="address" value=""placeholder="Address" ><?php echo set_value('address',$customer['address']); ?></textarea>
                                            <?php echo form_error('address'); ?>
                                        </div>
                                    </div> 

                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" id="city" name="city" value="<?php echo set_value('city',$customer['city']); ?>" placeholder="City" >
                                            <?php echo form_error('city'); ?>
                                        </div>
                                    </div> 

                                 <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Zip code <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" id="pin_code" name="pin_code" value="<?php echo set_value('pin_code',$customer['pin_code']); ?>" placeholder="Zip code" >
                                            <?php echo form_error('pin_code'); ?>
                                        </div>
                                    </div> 

                                 <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" id="state" name="state" value="<?php echo set_value('state',$customer['state']); ?>" placeholder="State" >
                                            <?php echo form_error('state'); ?>
                                        </div>
                                    </div> 

                                </div>
                            </div>
                    </div>

                    <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Nominee’s Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" id="no_fi_name" name="no_fi_name" value="<?php echo set_value('no_fi_name',$customer['no_fi_name']); ?>" placeholder="First Name" >
                                            <?php echo form_error('no_fi_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input class="form-control form-control-sm" type="text" id="no_mi_name" name="no_mi_name" value="<?php echo set_value('no_mi_name',$customer['no_mi_name']); ?>" placeholder="Middle Name" >
                                            <?php echo form_error('no_mi_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" id="no_la_name" name="no_la_name" value="<?php echo set_value('no_la_name',$customer['no_la_name']); ?>" placeholder="Last Name" >
                                            <?php echo form_error('no_la_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">    
                                        <div class="form-group">
                                            <label>Select Gurdian Type <span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm"  name="no_gur_type" autocomplete="off" required>
                                                <option value="">-- Select Gurdian Type --</option>
                                                <option value="Father" <?php if(set_value('no_gur_type',$customer['no_gur_type']) == 'Father') { echo "selected"; };?>>Father</option>
                                                <option value="Husband" <?php if(set_value('no_gur_type',$customer['no_gur_type']) == 'Husband') { echo "selected"; };?>>Husband</option>
                                                <option value="Gurdian" <?php if(set_value('no_gur_type',$customer['no_gur_type']) == 'Gurdian') { echo "selected"; };?>>Gurdian</option>
                                            </select>
                                            <?php echo form_error('no_gur_type'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gurdian Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="no_gur_name" value="<?php echo set_value('no_gur_name',$customer['no_gur_name']); ?>" placeholder="Gurdian Name" autocomplete="off" required>
                                            <?php echo form_error('no_gur_name'); ?>

                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date of Birth <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" id="no_bdate" name="no_bdate" value="<?php echo set_value('no_bdate',date('d-m-Y',strtotime($customer['no_bdate']))); ?>" placeholder="Date of Birth" autocomplete="off">
                                            <?php echo form_error('no_bdate'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control form-control-sm" id="ncal_year" type="text" name="nyear" placeholder="Age" value="<?php echo set_value('nyear',$customer['nage']); ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Relationship with customer <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" id="relation" name="relation" value="<?php echo set_value('relation',$customer['relation']); ?>" placeholder="Relationship with customer" >
                                            <?php echo form_error('relation'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address <span class="astrick">*</span></label>
                                            <textarea class="form-control form-control-sm" type="text" id="no_address" name="no_address" value="" placeholder="Address" ><?php echo set_value('no_address',$customer['no_address']); ?></textarea>
                                            <?php echo form_error('no_address'); ?>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                    </div>

                    <div>
                        <input type="hidden" name="main_id" value="<?= $user['id']?>">
                        <input type="hidden" name="booked_last" value="<?= $customer['booking'];?>">
                    </div>

                        

                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>customer" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Save</button>
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
        
        // Birth Date    
        $('.date_picker').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true,
            endDate: "-18y"
        }).on('changeDate', function(ev){
            $('#cal_year').val(calculateAge(parseDate($(this).val()), new Date()));
        })

        
        $('#no_bdate').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        }).on('changeDate', function(ev){
            $('#ncal_year').val(calculateAge(parseDate($(this).val()), new Date()));
        })

        
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