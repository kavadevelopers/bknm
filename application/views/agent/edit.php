<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark">Edit Agent</h1>
          		</div>
        	</div><!-- /.row -->
      	</div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->

<!-- Main content -->
    <section class="content">
      	<div class="container-fluid">
            <form method="post" action="<?= base_url(); ?>agent/update" enctype="multipart/form-data">
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
                                            <input class="form-control form-control-sm" value="<?php echo set_value('user_name',$user['user_name']); ?>" type="text" name="user_name" placeholder="User Name" autocomplete="off" readonly>
                                            <?php echo form_error('user_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reference Id OR Agent Id<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('ref',$user['reference_id']); ?>" type="text" name="ref" placeholder="Reference Id OR Agent Id" autocomplete="off" readonly>
                                            <?php echo form_error('ref'); ?>
                                            
                                        </div>
                                    </div>  

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('pass',$user['pass']); ?>" type="password" name="pass" placeholder="Password" autocomplete="off" readonly>
                                            <?php echo form_error('pass'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Confirm Password <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('con_pass',$user['pass']); ?>" type="password" name="con_pass" placeholder="Confirm Password" autocomplete="off" readonly>
                                            <?php echo form_error('con_pass'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Coustomer Id</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('coust_id',$coustmer_id); ?>" type="text" name="coust_id" placeholder="Coustomer Id" autocomplete="off" readonly>
                                            <?php echo form_error('coust_id'); ?>
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
                                            <input class="form-control form-control-sm" value="<?php echo set_value('fi_name',$agent['fi_name']); ?>" type="text" name="fi_name" placeholder="First Name" >
                                            <?php echo form_error('fi_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('mi_name',$agent['mi_name']); ?>" type="text" name="mi_name" placeholder="Middle Name" >
                                            <?php echo form_error('mi_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Name<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('la_name',$agent['la_name']); ?>" type="text" name="la_name" placeholder="Last Name" >
                                            <?php echo form_error('la_name'); ?>
                                        </div>
                                    </div>


                                    <input class="form-control form-control-sm" value="0" type="hidden" name="fa_name" placeholder="Father Name" >

                                    <div class="col-md-4">    
                                        <div class="form-group">
                                            <label>Select Gurdian Type <span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm"  name="gur_type" autocomplete="off" >
                                                <option value="">-- Select Gurdian Type --</option>
                                                <option value="Father" <?php if(set_value('gur_type',$agent['gur_type']) == 'Father') { echo "selected"; };?>>Father</option>
                                                <option value="Husband" <?php if(set_value('gur_type',$agent['gur_type']) == 'Husband') { echo "selected"; };?>>Husband</option>
                                                <option value="Gurdian" <?php if(set_value('gur_type',$agent['gur_type']) == 'Gurdian') { echo "selected"; };?>>Gurdian</option>
                                            </select>
                                            <?php echo form_error('gur_type'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gurdian Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="gur_name" value="<?php echo set_value('gur_name',$agent['gur_name']); ?>" placeholder="Gurdian Name" autocomplete="off" >
                                            <?php echo form_error('gur_name'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mother Name<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('mo_name',$agent['mo_name']); ?>" type="text" name="mo_name" placeholder="Mother Name" >
                                            <?php echo form_error('mo_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Birth Date<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm date_picker" value="<?php echo set_value('bdate',date('d-m-Y',strtotime($agent['bdate']))); ?>" type="text" name="bdate" autocomplete="off" placeholder="Birth Date" readonly>
                                            <?php echo form_error('bdate'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Joining Date</label>
                                            <input class="form-control form-control-sm" id="jdate" type="text" name="jdate" placeholder="Joining Date" autocomplete="off" value="<?php echo set_value('jdate',date('d-m-Y',strtotime($agent['jdate']))); ?>" readonly>
                                            <?php echo form_error('jdate'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control form-control-sm" id="cal_year" type="text" name="year" placeholder="Age" autocomplete="off" value="<?php echo set_value('year',$agent['year']); ?>" readonly>
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
                                                    <option value="<?= $value['type'] ?>" 
                                                        <?php if($agent['proof_type'] == $value['type']) { echo "selected"; } ?>><?= $value['type'] ?></option>
                                                <?php } ?>
                                            </select>

                                            <?php echo form_error('proof_type'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Id Proof Number<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('proof_num',$agent['proof_num']); ?>" type="text" name="proof_num" placeholder="Id Proof Number" autocomplete="off">
                                            <?php echo form_error('proof_num'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Qualification<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('quali',$agent['quali']); ?>" type="text" name="quali" placeholder="Qualification" >
                                            <?php echo form_error('quali'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Designation<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('desig',$agent['desig']); ?>" type="text" name="desig" placeholder="Designation" >
                                            <?php echo form_error('desig'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sex <span class="astrick">*</span></label>
                                            <select name="sex" class="form-control form-control-sm">
                                                <option value="">-- Select Sex  --</option>
                                                <option value="Male" <?php if(set_value('sex',$agent['sex']) == 'Male'){ echo "selected"; } ?>>Male</option>
                                                <option value="Female" <?php if(set_value('sex',$agent['sex']) == 'Female'){ echo "selected"; } ?>>Female</option>
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
                                            <input class="form-control form-control-sm" value="<?php echo set_value('email',$agent['email']); ?>" type="text" name="email" placeholder="Email" autocomplete="off">
                                             <?php echo form_error('email'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mobile Number <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('mobile',$agent['mobile']); ?>" type="text" name="mobile" placeholder="Mobile Number" autocomplete="off">
                                            <?php echo form_error('mobile'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Mobile Number2</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('mobile2',$agent['mobile2']); ?>" type="text" name="mobile2" placeholder="Mobile Number2" autocomplete="off">
                                            <?php echo form_error('mobile2'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address <span class="astrick">*</span></label>
                                            <textarea class="form-control form-control-sm" type="text" name="address" placeholder="Address"><?php echo set_value('address',$agent['address']); ?></textarea>
                                            <?php echo form_error('address'); ?>
                                        </div>
                                    </div>

                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('city',$agent['city']); ?>" type="text" name="city" placeholder="City" >
                                            <?php echo form_error('city'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Zip code <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('zip',$agent['zip']); ?>" type="text" name="zip" placeholder="Zip code" >
                                            <?php echo form_error('zip'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('state',$agent['state']); ?>" type="text" name="state" placeholder="State">
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
                                            <input class="form-control form-control-sm" value="<?php echo set_value('bank',$agent['bank']); ?>" type="text" name="bank" placeholder="Bank Name" >
                                            <?php echo form_error('bank'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>A/C Number <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('ac_number',$agent['ac_number']); ?>" type="text" name="ac_number" placeholder="A/C Number" autocomplete="off" >
                                            <?php echo form_error('ac_number'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>IFSC Code <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('ifsc_code',$agent['ifsc_code']); ?>" type="text" name="ifsc_code" placeholder="IFSC Code" autocomplete="off">
                                            <?php echo form_error('ifsc_code'); ?>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Branch Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('branch_name',$agent['branch_name']); ?>" type="text" name="branch_name" placeholder="Branch Name" >
                                            <?php echo form_error('branch_name'); ?>
                                        </div>
                                    </div>

                                                                   
                                </div>
                            </div>
                        </div> 

                        <div>
                            <input type="hidden" name="main_id" value="<?= $user['id'];?>">
                        </div>

                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>agent" class="btn btn-danger">Cancel</a>
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

        
        // Joining Date 
        $('#jdate').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true,
            endDate: "+0d"
        });

        if($('#jdate').val() == ''){
            $('#jdate').datepicker("setDate",new Date());
        }




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