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
            <form method="post" id="purchase_form" action="<?= base_url('num_sellers/save');?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group col-md-4">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-warning">
                                              Number Of Seller(s)
                                            </button>&nbsp;
                                            <select class="form-control dp-2" name="num_of_saller" id="num_of_saller" onchange="sellers();" autocomplete="off" required="">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select> 

                                        </div>
                                    </div>
                                </div> <!-- // col-md-6 -->   

                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group col-md-4">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-warning">
                                              Number Of Purchaser(s)
                                            </button>&nbsp;
                                            <select class="form-control dp-2" name="num_of_purchaser" id="num_of_purchaser" onchange="purchse();" autocomplete="off" required>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select> 

                                        </div>
                                    </div>
                                </div> <!-- // col-md-6 -->   
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">      
                        <div class="card-header">
                            <h3 class="card-title">Sellers Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="name[]" placeholder="Name" autocomplete="off" required>
                                    </div>
                                </div>

                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control form-control-sm" type="email" name="email[]" placeholder="Email" autocomplete="off" >
                                    </div>
                                </div>

                              
                                <div class="col-md-6">    
                                    <div class="form-group">
                                        <label>Select Gurdian Type <span class="astrick">*</span></label>
                                        <select class="form-control form-control-sm"  name="gur_type[]" autocomplete="off" required>
                                            <option value="">-- Select Gurdian Type --</option>
                                            <option value="Father">Father</option>
                                            <option value="Husband">Husband</option>
                                            <option value="Gurdian">Gurdian</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="gur_name[]" placeholder="Enter Gurdian Name" autocomplete="off" required>
                                    </div>
                                </div>
                                   
                                        
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address <span class="astrick">*</span></label>
                                        <textarea class="form-control form-control-sm" type="text" name="address[]" placeholder="Address" autocomplete="off" required></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="state[]" placeholder="State" autocomplete="off" required>
                                    
                                    </div>
                                </div>

                           
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bank Name </label>
                                        <input class="form-control form-control-sm" type="text" name="bank[]" placeholder="Bank Name" autocomplete="off" >
                                        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>A/C Number </label>
                                        <input class="form-control form-control-sm" type="text" name="ac_number[]" placeholder="A/C Number" autocomplete="off" >
                                        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>IFSC Code</label>
                                        <input class="form-control form-control-sm" type="text" name="ifsc_code[]" placeholder="IFSC Code" autocomplete="off">
                                       
                                    </div>
                                </div>

                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile<span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="mobile[]" placeholder="Mobile" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                            
                                            <label>Id Proof Type<span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="proof_type[]" autocomplete="off">
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

                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Id Proof Number<span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" value="<?php echo set_value('proof_num'); ?>" type="text" name="proof_num[]" placeholder="Id Proof Number" autocomplete="off">
                                        <?php echo form_error('proof_num'); ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Share Amount<span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" id="share_amt0" onkeyup="single_tototal();" type="text" name="share_amount[]" placeholder="Share Amount" autocomplete="off" required>
                                       
                                    </div>
                                </div>

                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Advance Payment<span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" id="advnce_pay0" onkeyup="single_tototal();" type="text" name="advance_pay[]" placeholder="Advance Payment" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="image-container">
                                                <img src="<?= base_url();?>uploads/user.png" id="imgProfile1" style="width: 150px; height: 150px;" class="img-thumbnail kava-image-upload">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="file" name="my_image[]" id="" onchange="img_return(this,'');" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                                                           
                            </div><!-- row -->
                        </div>
                    </div><!--  card-info -->

                    <div id="Dynamic_Seller">
                                
                    </div>

                </div>


                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Purchares Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="pu_name[]" placeholder="Name" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control form-control-sm" type="email" name="pu_email[]" placeholder="Email" autocomplete="off" >
                                    </div>
                                </div>

                                   
                                <div class="floar-right col-md-6">
                                    <div class="form-group">
                                        <label>Select Gurdian Type </label>
                                        <select class="form-control form-control-sm" name="pu_gur_type[]" >
                                            <option value="">-- Select Gurdian Type --</option>
                                            <option value="Father">Father</option>
                                            <option value="Husband">Husband</option>
                                            <option value="Gurdian">Gurdian</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gurdian Name</label>
                                        <input class="form-control form-control-sm" type="text" name="pu_gur_name[]" placeholder="Gurdian Name" >
                                    </div>
                                </div>
                                   
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address <span class="astrick">*</span></label>
                                        <textarea class="form-control form-control-sm" type="text" name="pu_address[]" placeholder="Address" autocomplete="off" required></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="pu_state[]" placeholder="State" autocomplete="off" required>
                                    
                                    </div>
                                </div>

                           
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bank Name </label>
                                        <input class="form-control form-control-sm" type="text" name="pu_bank[]" placeholder="Bank Name" autocomplete="off" >
                                        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>A/C Number </label>
                                        <input class="form-control form-control-sm" type="text" name="pu_ac_number[]" placeholder="A/C Number" autocomplete="off" >
                                        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>IFSC Code</label>
                                        <input class="form-control form-control-sm" type="text" name="pu_ifsc_code[]" placeholder="IFSC Code" autocomplete="off">
                                       
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile<span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="pu_mobile[]" placeholder="Mobile" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                            
                                            <label>Id Proof Type<span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="pu_proof_type[]" autocomplete="off">
                                            <option value="">-- Select Id Proof Type --</option>
                                            <?php $proof = proof_type();
                                                
                                                foreach ($proof as $key => $value) {
                                            ?>
                                                <option value="<?= $value['type'] ?>" <?php if($value['type'] == set_value('pu_proof_type')) { echo "selected"; } ?>><?= $value['type'] ?></option>
                                            <?php } ?>
                                        </select>

                                        <?php echo form_error('pu_proof_type'); ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Id Proof Number<span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" value="<?php echo set_value('pu_proof_num'); ?>" type="text" name="pu_proof_num[]" placeholder="Id Proof Number" autocomplete="off">
                                        <?php echo form_error('pu_proof_num'); ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="image-container">
                                                <img src="<?= base_url();?>uploads/user.png" id="imgProfile2" style="width: 150px; height: 150px;" class="img-thumbnail kava-image-upload">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="file" name="pu_my_image[]" id="" onchange="img_return_seller(this,'');" required>
                                        </div>
                                    </div>
                                </div>
                                                           
                            </div><!-- row -->
                        </div>
                    </div><!--  card-info -->
                    <div id="Dynamic_Purchaser">
                                
                    </div>
                </div>

                

            </div>

            

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Land Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row"> 
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Land Location/Name <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" value="" type="text" name="purchase_id" placeholder="Land Location/Name" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Khasra/Arazi No. <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="khasra" placeholder=" Khasra/Arazi No." autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Land Details </label>
                                        <textarea class="form-control form-control-sm" type="text" name="land_detail" placeholder="Land Details" autocomplete="off" ></textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mouza <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="mouza" placeholder="Mouza" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tehsil <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="tehsil" placeholder="Tehsil" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>District <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="district" placeholder="District" autocomplete="off" required>
                                    </div>
                                </div>

                                

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Land Type <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="land_type" placeholder="Land Type" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Location <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="land_location" placeholder="Location" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Account Number(land) <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="ac_num_land" placeholder="Account Number(land)" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Land area (in Sq. Yd) <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="total_land_yrd" id="total_land_yrd" onkeyup="hecter('y',this.value);" placeholder="Total Land area (in Yard)" autocomplete="off" required>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Land area (in Hectares) <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="total_land" id="total_land_hec" onkeyup="hecter('h',this.value);" placeholder="Total Land area (in Hectares)" autocomplete="off" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Land Size(in Sq. Ft) <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" onkeyup="hecter('sq',this.value);" name="lan_size" id="lan_size_sq" placeholder="Land Size(in Sq. Ft)" autocomplete="off" required>
                                    </div>
                                </div>
                                
                                

                                <input class="form-control form-control-sm" type="hidden" name="per_unit_share" value="0" autocomplete="off" required>

                                
                            </div><!-- // row -->
                        </div>
                    </div><!-- // card-info -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">  
                        <div class="card-header">
                            <h3 class="card-title">Payment Detail</h3>
                        </div>
                        <div class="card-body">
                            <div class="row"> 
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Purchase Amount <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="purchase_amount" step="0.01" id="purchase_amount" value="0" onkeyup="ramining_amount()" placeholder="Purchase Amount" autocomplete="off" required readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Purchase Date <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" id="purchase_date" type="text" name="purchase_date" placeholder="Purchase Date" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>First Payment[Advance] <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="number" name="adva_payment" id="adva_payment" placeholder="First Payment[Advance]" autocomplete="off" value="0" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>First Payment Date <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" id="adva_pay_date" type="text" name="adva_pay_date" placeholder="First Payment Date" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Time Ward Land Agreement <span class="astrick">*</span></label>
                                                
                                                <select class="form-control form-control-sm select2" name="time_ward_land" id="time_ward_land" onchange="Installment_Cal();" autocomplete="off" required>
                                                    <option value="">-- Select Time Ward Land Agreement --</option>
                                                    <?php for($i=0; $i <= 150 ; $i++) { ?>
                                                        
                                                        <option value="<?= $i ?>"><?= $i ?> Month</option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Remaning Amount <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="number" name="bal_amount" id="bal_amount" step="0.01" placeholder="Remaning Amount" autocomplete="off" required readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Payment Mode <span class="astrick">*</span></label>
                                                <select name="payment_mode" class="form-control form-control-sm"  required>
                                                    <option value="">-- Select Payment Mode  --</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Payment Mode Detail <span class="astrick">*</span></label>
                                                <textarea class="form-control form-control-sm" id="payment_mode_detail" type="text" name="payment_mode_detail" placeholder="Payment Mode Detail Ex. (Cheque No., Ref.No.)" autocomplete="off" required></textarea>
                                            </div>
                                        </div>

                                    


                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="row">
                                        <table class="table" id="balance_A">
                                            <thead>
                                                <tr>
                                                    <th style="width: 33.33%;">Investor Name</th>
                                                    <th style="width: 33.33%;">Balance</th>
                                                    <th style="width: 33.33%;">Amount For Payment</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control form-control-sm select2" onchange="get_balance_ajax(this.value,'1')" name="parter_id[]" id="parter_id1" required>
                                                            <option value="">-- Select Investor Name --</option>
                                                            <?php foreach($Parterners as $key => $value){ ?>
                                                                <option value="<?=$value['id']?>"><?=$value['fullname'].' - '.$value['user_type_id']?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input id="main_amt1" class="form-control form-control-sm" type="text" value="" readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control form-control-sm" id="added_amt1" type="text" placeholder="Amount For Payment"  name="paid[]" required readonly>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody id="add_row">
                                            
                                    
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" style="text-align: right;">
                                                        <button type="button" class="btn btn-success btn-sm" onclick="add_row();" title="Add Row"><i class="fa fa-plus"></i> Add Row</button>
                                                        <button type="button" class="btn btn-sm btn-danger" id="remove_row'+i+'" onclick="remove()"><i class="fa fa-close"></i> Remove Last</button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Installment Detail</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Installment Packages <span class="astrick">*</span></label>
                                        <select name="install_packges" class="form-control form-control-sm" id="install_packges" autocomplete="off" required>
                                            <option value="">Select Time Ward Land Agreement to get this field </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="installment">

                            </div>
                                
                                         
                        </div>
                    </div><!--  card-info -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                               <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Conditions/Remarks[if any]</label>
                                        <textarea rows="5" class="form-control form-control-sm" id="conditions" type="text" name="conditions" placeholder="Conditions/Remarks[if any]" autocomplete="off"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">  
                        <div class="card-header">
                            <h3 class="card-title">Witness Detail</h3>
                        </div>
                        <div class="card-body">
                            <div class="row"> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="witness_name" id="witness_name" placeholder="Witness 1 Name" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="witness_mobile" id="witness_mobile" placeholder="Witness 1 Mobile" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Address <span class="astrick">*</span></label>
                                        <textarea class="form-control form-control-sm" type="text" name="witness_address" id="witness_address" placeholder="Witness 1 Address" autocomplete="off" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="witness_name2" id="" placeholder="Witness 2 Name" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile <span class="astrick">*</span></label>
                                        <input class="form-control form-control-sm" type="text" name="witness_mobile2" id="" placeholder="Witness 2 Mobile" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Address <span class="astrick">*</span></label>
                                        <textarea class="form-control form-control-sm" type="text" name="witness_address2" id="" placeholder="Witness 2 Address" autocomplete="off" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-footer">
                            <div class="float-right">
                              <a href="<?= base_url(); ?>num_sellers" class="btn btn-danger">Cancel</a>
                              <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-plus"></i>&nbsp;Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        </div>
    </section>
    <!-- Main content -->






<script type="text/javascript">

    function single_tototal()
    {
        var num_of_saler = parseFloat($('#num_of_saller').val());
        var total_amount = 0;
        var advnce_pay = 0;
        for(var i = 0;i < num_of_saler;i++){
           
            var purchase_amt = $('#share_amt'+i).val();
            var advance = $('#advnce_pay'+i).val();

            if(purchase_amt != '')
            {
                total_amount += parseFloat(purchase_amt);
            }

            if(advance != '')
            {
                advnce_pay += parseFloat(advance);
            }
        }   

        $('#purchase_amount').val(total_amount);
        $('#adva_payment').val(advnce_pay);
        ramining_amount();
    }

  $(function(){
        
        $('#purchase_form').submit(function(){
           
            if(parseFloat($('#purchase_amount').val()) <= 0)
            {
                $.notify({
                    title: '<strong></strong>',
                    icon: 'fa fa-times-circle',
                    message: 'Please Check Purchase Amount'
                },{
                    type: 'danger'
                });
                $('#purchase_amount').focus();
                return false;
            }
            else if(parseFloat($("#purchase_amount").val()) < parseFloat($("#adva_payment").val())){
                
                $.notify({
                    title: '<strong></strong>',
                    icon: 'fa fa-times-circle',
                    message: 'Please Check Adavance Payment'
                },{
                    type: 'danger'
                });
                $("#adva_payment").focus();
                return false;
            }
            

           
            length = parseFloat($('#balance_A tbody tr').length) + 1;
            
            for(i_nre = 1;i_nre <= length;i_nre++)
            {   
                if(parseFloat($('#main_amt'+i_nre).val()) < parseFloat($('#added_amt'+i_nre).val())){
                    $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-times-circle',
                        message: 'Please Check Amount For Payment'
                    },{
                        type: 'danger'
                    }); 
                    $('#added_amt'+i_nre).focus();
                    return false;
                }
            }

            if($('#install_packges').val() == 'No')
            {
                if(parseFloat($('#bal_amount').val()) != 0)
                {
                    $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-times-circle',
                        message: 'If You Choose No Installment Remaning Amount Must zero'
                    },{
                        type: 'danger'
                    }); 
                    return false;
                }
            }

            if($('#install_packges').val() == 'Yes')
            {
                if(parseFloat($('#bal_amount').val()) == 0)
                {
                    $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-times-circle',
                        message: 'If You Choose Installment Remaning Amount Must Be greater than zero'
                    },{
                        type: 'danger'
                    }); 
                    return false;
                }
            }


            var total_payed = parseFloat(0.00);
            length = parseFloat($('#balance_A tbody tr').length) + 1;
            for(i_nre = 1;i_nre <= length;i_nre++)
            {   
                
                if($('#added_amt'+i_nre).val() != ''){
                    
                    total_payed += parseFloat($('#added_amt'+i_nre).val());
                }
            }
            
            if(parseFloat($('#adva_payment').val()) != total_payed){
                $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-times-circle',
                        message: 'Advance Payment And Added Amount Must Be Same'
                    },{
                        type: 'danger'
                    }); 
                $('#adva_payment').focus();
                return false;
            }
                    

        });

        //Form  Error Notify 
        <?php if(!empty(validation_errors())){ ?>

            $.notify({
                title: '<strong></strong>',
                icon: 'fa fa-times-circle',
                message: 'Your Form Was Not Submmited Check Your Form'
            },{
                type: 'danger'
            }); 

        <?php } ?>
    
    });


    

    function add_Advnce_payment(){
        length = parseFloat($('#add_row tr').length) + 1;
        total = parseFloat(0);
        for(i = 1;i <= length;i++)
        {   
            if($('#added_amt'+i).val() != ''){
               total += parseFloat($('#added_amt'+i).val());
            }
        }
        $('#adva_payment').val(total);
        ramining_amount();
    }

    function sellers(){
    var seller = $('#num_of_saller').val();
    $('#Dynamic_Seller').empty();
    var _counter = 0;

        for(i = 1; i < seller; i++){
            _counter = _counter + 1;

            $('#Dynamic_Seller').append('<div class="col-md-12"><div class="card card-info"><div class="card-header"><h3 class="card-title">Sellers Details '+ (i + 1) +'</h3></div><div class="card-body"><div class="row"><div class="col-md-6"><div class="form-group"> <label>Name <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="name[]" placeholder="Name" autocomplete="off" required></div></div><div class="col-md-6"><div class="form-group"> <label>Email</label> <input class="form-control form-control-sm" type="email" name="email[]" placeholder="Email" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>Select Gurdian Type <span class="astrick">*</span> </label> <select class="form-control form-control-sm" name="gur_type[]" autocomplete="off" required><option value="">-- Select Gurdian Type --</option><option value="Father">Father</option><option value="Husband">Husband</option><option value="Gurdian">Gurdian</option> </select></div></div><div class="col-md-6"><div class="form-group"> <label><span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="gur_name[]" placeholder="Enter Gurdian Name" autocomplete="off" required></div></div><div class="col-md-6"><div class="form-group"> <label>Address <span class="astrick">*</span> </label><textarea class="form-control form-control-sm" type="text" name="address[]" placeholder="Address" autocomplete="off" required></textarea></div></div><div class="col-md-6"><div class="form-group"> <label>State <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="state[]" placeholder="State" autocomplete="off" required></div></div><div class="col-md-6"><div class="form-group"> <label>Bank Name</label> <input class="form-control form-control-sm" type="text" name="bank[]" placeholder="Bank Name" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>A/C Number</label> <input class="form-control form-control-sm" type="text" name="ac_number[]" placeholder="A/C Number" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>IFSC Code</label> <input class="form-control form-control-sm" type="text" name="ifsc_code[]" placeholder="IFSC Code" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>Mobile<span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="mobile[]" placeholder="Mobile" autocomplete="off" required></div></div><div class="col-md-6"><div class="form-group"> <label>Id Proof Type<span class="astrick">*</span></label> <select class="form-control form-control-sm select2" name="proof_type[]" autocomplete="off"><option value="">-- Select Id Proof Type --</option> <?php $proof = proof_type(); foreach ($proof as $key => $value) { ?><option value="<?= $value['type'] ?>" <?php if($value['type'] == set_value('proof_type')) { echo "selected"; } ?>><?= $value['type'] ?></option> <?php } ?> </select><?php echo form_error('proof_type'); ?></div></div><div class="col-md-6"><div class="form-group"> <label>Id Proof Number<span class="astrick">*</span></label> <input class="form-control form-control-sm" value="<?php echo set_value('proof_num'); ?>" type="text" name="proof_num[]" placeholder="Id Proof Number" autocomplete="off"> <?php echo form_error('proof_num'); ?></div></div><div class="col-md-6"><div class="form-group"> <label>Share Amount<span class="astrick">*</span></label> <input class="form-control form-control-sm" id="share_amt'+_counter.toString()+'" onkeyup="single_tototal();" type="text" name="share_amount[]" placeholder="Share Amount" autocomplete="off" required></div></div><div class="col-md-6"><div class="form-group"> <label>Advance Payment<span class="astrick">*</span></label> <input class="form-control form-control-sm" id="advnce_pay'+_counter.toString()+'" onkeyup="single_tototal();" type="text" name="advance_pay[]" placeholder="Advance Payment" autocomplete="off" required></div></div><div class="col-md-12"><div class="row"><div class="col-md-6"><div class="image-container"> <img src="<?=base_url();?>uploads/user.png" id="imgProfile1'+_counter.toString()+'" style="width: 150px; height: 150px;" class="img-thumbnail kava-image-upload"></div></div><div class="col-md-6"> <input type="file" name="my_image[]" id="'+_counter.toString()+'" onchange="img_return(this,this.id);" autocomplete="off" required></div></div></div></div></div></div></div>');
        }
        $('.select2').select2();
        
    }
     
    function purchse(){
        var seller = $('#num_of_purchaser').val();
        $('#Dynamic_Purchaser').empty();
 
         
        var _counter = 0;

        for(i = 1; i < seller; i++){
            _counter = _counter + 1;    
            $('#Dynamic_Purchaser').append('<div class="card card-info"><div class="card-header"><h3 class="card-title">Purchares Details '+ (i + 1) +'</h3></div><div class="card-body"><div class="row"><div class="col-md-6"><div class="form-group"> <label>Name <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="pu_name[]" placeholder="Name" autocomplete="off" required></div></div><div class="col-md-6"><div class="form-group"> <label>Email</label> <input class="form-control form-control-sm" type="email" name="pu_email[]" placeholder="Email" autocomplete="off"></div></div><div class="floar-right col-md-6"><div class="form-group"> <label>Select Gurdian Type</label> <select class="form-control form-control-sm" name="pu_gur_type[]"><option value="">-- Select Gurdian Type --</option><option value="Father">Father</option><option value="Husband">Husband</option><option value="Gurdian">Gurdian</option> </select></div></div><div class="col-md-6"><div class="form-group"> <label></label> <input class="form-control form-control-sm" type="text" name="pu_gur_name[]" placeholder="Enter Gurdian Name"></div></div><div class="col-md-6"><div class="form-group"> <label>Address <span class="astrick">*</span> </label><textarea class="form-control form-control-sm" type="text" name="pu_address[]" placeholder="Address" autocomplete="off" required></textarea></div></div><div class="col-md-6"><div class="form-group"> <label>State <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="pu_state[]" placeholder="State" autocomplete="off" required></div></div><div class="col-md-6"><div class="form-group"> <label>Bank Name</label> <input class="form-control form-control-sm" type="text" name="pu_bank[]" placeholder="Bank Name" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>A/C Number</label> <input class="form-control form-control-sm" type="text" name="pu_ac_number[]" placeholder="A/C Number" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>IFSC Code</label> <input class="form-control form-control-sm" type="text" name="pu_ifsc_code[]" placeholder="IFSC Code" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>Mobile<span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="pu_mobile[]" placeholder="Mobile" autocomplete="off" required></div></div><div class="col-md-6"><div class="form-group"> <label>Id Proof Type<span class="astrick">*</span></label> <select class="form-control form-control-sm select2" name="pu_proof_type[]" autocomplete="off"><option value="">-- Select Id Proof Type --</option> <?php $proof = proof_type(); foreach ($proof as $key => $value) { ?><option value="<?= $value['type'] ?>" <?php if($value['type'] == set_value('pu_proof_type')) { echo "selected"; } ?>><?= $value['type'] ?></option> <?php } ?> </select><?php echo form_error('pu_proof_type'); ?></div></div><div class="col-md-6"><div class="form-group"> <label>Id Proof Number<span class="astrick">*</span></label> <input class="form-control form-control-sm" value="<?php echo set_value('pu_proof_num'); ?>" type="text" name="pu_proof_num[]" placeholder="Id Proof Number" autocomplete="off"> <?php echo form_error('pu_proof_num'); ?></div></div><div class="col-md-12"><div class="row"><div class="col-md-6"><div class="image-container"> <img src="<?=base_url();?>uploads/user.png" id="imgProfile2'+_counter+'" style="width: 150px; height: 150px;" class="img-thumbnail kava-image-upload"></div></div><div class="col-md-6"> <input type="file" name="pu_my_image[]" id="'+_counter+'" onchange="img_return_seller(this,this.id);" required></div></div></div></div></div></div>');
        }
        $('.select2').select2();

                                                       
    }

   
    var co_i = 1;
    function add_row() {
        co_i++;
        $('#add_row').append('<tr><td><select class="form-control form-control-sm select2a" name="parter_id[]"  onchange="get_balance_ajax(this.value,'+co_i+')" id="parter_id1" required><option value="">-- Select Investor Name --</option><?php foreach($Parterners as $key => $value){ ?><option value="<?=$value['id']?>"><?=$value['fullname'].' - '.$value['user_type_id']?></option><?php } ?></select></td><td><input id="main_amt'+co_i+'" class="form-control form-control-sm" type="text" value="" readonly></td><td> <input class="form-control form-control-sm col-md-12" id="added_amt'+co_i+'" type="text" placeholder="Amount For Payment" name="paid[]" required readonly></td></tr>');
        $('.select2a').select2();
        return false;
    }

    function remove(){
        $('#add_row tr:last').remove();
        co_i--;
        return false;
    }

    function get_balance_ajax(par_id,row_id)
    {
        
        if(par_id != ''){
                $.ajax({
                type:'POST',
                url: "<?= base_url();?>transaction/get_balance",
                data: "id="+par_id,
                cache: false,
                dataType:'json',
                success: function(html){

                    $('#main_amt'+row_id).val(html.balance);
                    $('#added_amt'+row_id).val('');
                    if(html.balance > 0){
                        $('#added_amt'+row_id).removeAttr('readonly');
                    }
                    
                }
            });
        }
        else
        {
            $('#main_amt'+row_id).val('');
            $('#added_amt'+row_id).val('');
            $('#added_amt'+row_id).attr('readonly','readonly');
                    
        }
    }
        
   
</script>

<style type="text/css">
    .select2a{
        width: 100%;
    }
</style>