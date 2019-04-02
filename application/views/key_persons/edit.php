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
            <form method="post" action="<?= base_url();?>key_persons/update" enctype="multipart/form-data">
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
                                            <input class="form-control form-control-sm" value="<?php echo set_value('user_name',$user['user_name']); ?>" type="text" name="user_name" id="user_name" placeholder="Username"  autocomplete="off" readonly>
                                            <?php echo form_error('user_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('pass',$user['pass']); ?>" type="password" name="pass" id="pass" placeholder="Password"  autocomplete="off" readonly>
                                            <?php echo form_error('pass'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Confirm Password <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('c_pass',$user['pass']); ?>" type="password" name="c_pass" id="c_pass" placeholder="Confirm Password"  autocomplete="off" readonly>
                                            <?php echo form_error('c_pass'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Commission Percentage% ex.(1.50) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('percentage',$business['persent']); ?>" type="text" name="percentage" id="percentage" placeholder="Commission Percentage%ex.(1.50)"  autocomplete="off">
                                            <?php echo form_error('percentage'); ?>
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
                                            <input class="form-control form-control-sm" value="<?php echo set_value('fi_name',$business['fi_name']); ?>" type="text" name="fi_name" id="fi_name" placeholder="First Name"  autocomplete="off">
                                            <?php echo form_error('fi_name'); ?>
                                        </div>
                                    </div>

                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('mi_name',$business['mi_name']); ?>" type="text" name="mi_name" id="mi_name" placeholder="Middle Name"  autocomplete="off">
                                            <?php echo form_error('mi_name'); ?>
                                        </div>
                                    </div>
                                	
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('la_name',$business['la_name']); ?>" type="text" name="la_name" id="la_name" placeholder="Last Name"  autocomplete="off">
                                            <?php echo form_error('la_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Father’ name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('fa_name',$business['fa_name']); ?>" type="text" name="fa_name" id="fa_name" placeholder="Father name"  autocomplete="off">
                                            <?php echo form_error('fa_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mother’s name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('mo_name',$business['mo_name']); ?>" type="text" name="mo_name" id="mo_name" placeholder="Mother name"  autocomplete="off">
                                            <?php echo form_error('mo_name'); ?>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date Of Birth<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm date_picker" value="<?php echo set_value('bdate',date('d-m-Y',strtotime($business['bdate']))); ?>" type="text" name="bdate" id="bdate" autocomplete="off" placeholder="Date Of Birth" readonly>
                                            <?php echo form_error('bdate'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date Of Joining</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('jdate',date('d-m-Y',strtotime($business['jdate']))); ?>" type="text" name="jdate" id="jdate" autocomplete="off" placeholder="Date Of Joining" readonly>
                                            <?php echo form_error('jdate'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('age',$business['age']); ?>" type="text" name="age" id="age" placeholder="Age" readonly>
                                            <?php echo form_error('age'); ?>
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
                                                        <?php if($business['proof_type'] == $value['type']) { echo "selected"; } ?>><?= $value['type'] ?></option>
                                                <?php } ?>
                                            </select>

                                            <?php echo form_error('proof_type'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Id Proof Number<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('proof_num',$business['proof_num']); ?>" type="text" name="proof_num" placeholder="Id Proof Number" autocomplete="off">
                                            <?php echo form_error('proof_num'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Qualification<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('quali',$business['quali']); ?>" type="text" name="quali" id="quali" placeholder="Qualification" >
                                            <?php echo form_error('quali'); ?>
                                        </div>
                                    </div>

                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Designation<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('desig',$business['desig']); ?>" type="text" name="desig" id="desig" placeholder="Designation" >
                                            <?php echo form_error('desig'); ?>
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sex <span class="astrick">*</span></label>
                                            <select name="sex" class="form-control form-control-sm">
                                                <option value="">-- Select Sex  --</option>
                                                <option value="Male" <?php if(set_value('sex',$business['sex']) == 'Male'){ echo "selected"; } ?>>Male</option>
                                                <option value="Female" <?php if(set_value('sex',$business['sex']) == 'Female'){ echo "selected"; } ?>>Female</option>
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
                                    <input class="form-control form-control-sm" value="<?php echo set_value('email',$business['email']); ?>" type="text" name="email" id="email" placeholder="Email" autocomplete="off">
                                    <?php echo form_error('email'); ?>
                                </div>
                            </div> 
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile Number <span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" value="<?php echo set_value('mobile',$business['mobile']); ?>" type="text" name="mobile" id="mobile" placeholder="Mobile Number" autocomplete="off">
                                     <?php echo form_error('mobile'); ?>
                                </div> 
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile Number2</label>
                                    <input class="form-control form-control-sm" value="<?php echo set_value('mobile2',$business['mobile2']); ?>" autocomplete="off" type="text" name="mobile2" id="mobile2" placeholder="Mobile Number2" >
                                     <?php echo form_error('mobile2'); ?>
                                </div> 
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Address <span class="astrick">*</span></label>
                                    <textarea class="form-control form-control-sm" value="" type="text" name="address" id="address" placeholder="Address" ><?php echo set_value('address',$business['address']); ?></textarea>
                                     <?php echo form_error('address'); ?>
                                </div> 
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>City <span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" value="<?php echo set_value('city',$business['city']); ?>" type="text" name="city" id="city" placeholder="City" >
                                     <?php echo form_error('city'); ?>
                                </div> 
                            </div>

                             <div class="col-md-4">
                                <div class="form-group">
                                    <label>Zip code <span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" value="<?php echo set_value('zip',$business['zip']); ?>" type="text" name="zip" id="zip" placeholder="Zip code" >
                                     <?php echo form_error('zip'); ?>
                                </div> 
                            </div>

                             <div class="col-md-4">
                                <div class="form-group">
                                    <label>State <span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" value="<?php echo set_value('state',$business['state']); ?>" type="text" name="state" id="state" placeholder="State" >
                                     <?php echo form_error('state'); ?>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Bank Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bank Name<span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" value="<?php echo set_value('bank',$business['bank']); ?>" type="text" name="bank" id="bank" placeholder="Bank Name" >
                                         <?php echo form_error('bank'); ?>
                                    </div> 
                                </div>

                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label>A/C Number<span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" value="<?php echo set_value('ac_number',$business['ac_number']); ?>" type="text" name="ac_number" id="ac_number" placeholder="A/C Number" autocomplete="off" >
                                         <?php echo form_error('ac_number'); ?>
                                    </div> 
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>IFSC Code<span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" value="<?php echo set_value('ifsc_code',$business['ifsc_code']); ?>" type="text" name="ifsc_code" id="ifsc_code" placeholder=" IFSC Code" autocomplete="off" >
                                         <?php echo form_error('ifsc_code'); ?>
                                    </div> 
                                </div>

                               <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Branch Name<span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" value="<?php echo set_value('branch_name',$business['branch_name']); ?>" type="text" name="branch_name" id="branch_name" placeholder="Branch Name" >
                                         <?php echo form_error('branch_name'); ?>
                                    </div> 
                                </div> 

                            </div>
                     </div>
                 </div>      

                 <div>
                     <input type="hidden" name="main_id" value="<?= $user['id']?>">
                 </div>

                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>key_persons" class="btn btn-danger">Cancel</a>
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
            $('#age').val(calculateAge(parseDate($(this).val()), new Date()));
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