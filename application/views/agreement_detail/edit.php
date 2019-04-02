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
            <form method="post" id="purchase_form" action="<?= base_url('num_sellers/update');?>" enctype="multipart/form-data" autocomplete="off">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                 
                                                <button type="button" class="btn btn-warning">
                                                    Number Of Seller(s)
                                                </button>&nbsp;
                                                <select class="form-control" name="num_of_saller" id="num_of_saller" onchange="sellers();" autocomplete="off">
                                                    <option value="1" <?php if($single_purchase[0]['num_of_sellers'] == 1){ echo "selected"; } ?>>1</option>
                                                    <option value="2" <?php if($single_purchase[0]['num_of_sellers'] == 2){ echo "selected"; } ?>>2</option>
                                                     <option value="3" <?php if($single_purchase[0]['num_of_sellers'] == 3){ echo "selected"; } ?>>3</option>
                                                    <option value="4" <?php if($single_purchase[0]['num_of_sellers'] == 4){ echo "selected"; } ?>>4</option>
                                                    <option value="5" <?php if($single_purchase[0]['num_of_sellers'] == 5){ echo "selected"; } ?>>5</option>
                                                    <option value="6" <?php if($single_purchase[0]['num_of_sellers'] == 6){ echo "selected"; } ?>>6</option>
                                                    <option value="7" <?php if($single_purchase[0]['num_of_sellers'] == 7){ echo "selected"; } ?>>7</option>
                                                    <option value="8" <?php if($single_purchase[0]['num_of_sellers'] == 8){ echo "selected"; } ?>>8</option>
                                                    <option value="9" <?php if($single_purchase[0]['num_of_sellers'] == 9){ echo "selected"; } ?>>9</option>
                                                    <option value="10" <?php if($single_purchase[0]['num_of_sellers'] == 10){ echo "selected"; } ?>>10</option>
                                                </select> 

                                            </div>
                                        </div>
                                    </div><!-- // col-md-6 -->

                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group col-md-4">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-warning">
                                                  Number Of Purchaser(s)
                                                </button>&nbsp;
                                                <select class="form-control dp-2" name="num_of_purchaser" id="num_of_purchaser" onchange="purchse();" autocomplete="off" required>
                                                    <option value="1" <?php if($single_purchase[0]['num_of_purchaser'] == 1){ echo "selected"; } ?>>1</option>
                                                    <option value="2" <?php if($single_purchase[0]['num_of_purchaser'] == 2){ echo "selected"; } ?>>2</option>
                                                </select> 

                                            </div>
                                        </div>
                                    </div> <!-- // col-md-6 -->   
                                </div> <!-- // row -->
                            </div>
                        </div>


                        <!-- start here -->
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
                                                        <input class="form-control form-control-sm" type="text" name="name[]" placeholder="Name" value="<?= $seller_dynamic[0]['name'] ?>" autocomplete="off">
                                                    </div>
                                                </div>


                                                <div class="col-md-12">    
                                                    <div class="row"> 
                                                        <div class="col-md-6">    
                                                            <div class="form-group">
                                                                <label>Select Gurdian Type <span class="astrick">*</span></label>
                                                                <select class="form-control form-control-sm select2"  name="gur_type[]" autocomplete="off" required>
                                                                    <option value="Father" <?php if($seller_dynamic[0]['gur_type'] == 'Father'){ echo "selected"; } ?>>Father</option>
                                                                    <option value="Husband" <?php if($seller_dynamic[0]['gur_type'] == 'Husband'){ echo "selected"; } ?>>Husband</option>
                                                                    <option value="Gurdian" <?php if($seller_dynamic[0]['gur_type'] == 'Gurdian'){ echo "selected"; } ?>>Gurdian</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><span class="astrick">*</span></label>
                                                                <input class="form-control form-control-sm" type="text" name="gur_name[]" value="<?= $seller_dynamic[0]['gur_name'] ?>" placeholder="Enter Gurdian Name" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                    </div> <!-- // row -->
                                                </div> <!-- // col-md-12 -->   

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Address <span class="astrick">*</span></label>
                                                        <textarea class="form-control form-control-sm" type="text" name="address[]" placeholder="Address" autocomplete="off"><?= $seller_dynamic[0]['address'] ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>State <span class="astrick">*</span></label>
                                                        <input class="form-control form-control-sm" type="text" name="state[]" placeholder="State" value="<?= $seller_dynamic[0]['state'] ?>" autocomplete="off">
                                                    
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Bank Name </label>
                                                        <input class="form-control form-control-sm" type="text" name="bank[]" placeholder="Bank Name" value="<?= $seller_dynamic[0]['bank'] ?>" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>A/C Number</label>
                                                        <input class="form-control form-control-sm" type="text" name="ac_number[]" placeholder="A/C Number" value="<?= $seller_dynamic[0]['ac_number'] ?>" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>IFSC Code </label>
                                                        <input class="form-control form-control-sm" type="text" name="ifsc_code[]" placeholder="IFSC Code" value="<?= $seller_dynamic[0]['ifsc_code'] ?>" autocomplete="off">
                                                    </div>
                                                </div>

                                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control form-control-sm" type="email" name="email[]" placeholder="Email" value="<?= $seller_dynamic[0]['email'] ?>" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mobile<span class="astrick">*</span></label>
                                                        <input class="form-control form-control-sm" type="text" name="mobile[]" placeholder="Mobile" value="<?= $seller_dynamic[0]['mobile'] ?>" autocomplete="off">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Aadhaar Number<span class="astrick">*</span></label>
                                                        <input class="form-control form-control-sm" type="text" name="aadhaar[]" placeholder="Aadhaar Number" value="<?= $seller_dynamic[0]['aadhaar'] ?>" autocomplete="off" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="image-container">
                                                                <img src="<?= base_url();?>uploads/<?= $seller_dynamic[0]['my_image'] ?>" id="imgProfile1" style="width: 150px; height: 150px;" class="img-thumbnail kava-image-upload">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="file" name="my_image[]" id="" onchange="img_return(this,'');" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                                                  
                                            </div><!-- // row -->
                                        </div> <!-- // card - body -->
                                </div><!-- // card-info -->
                            </div> <!-- // col-md-6 -->

                            <div class="col-md-6">
                                <div class="card card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">Number of Purchares</h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="pu_name[]" value="<?= $purchaser_dynamic[0]['pu_name'] ?>" placeholder="Name" autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">    
                                                    <div class="floar-right col-md-6">
                                                        <div class="form-group">
                                                            <label>Select Gurdian Type <span class="astrick">*</span></label>
                                                            <select class="form-control form-control-sm select2" name="pu_gur_type[]" required>
                                                                
                                                                <option value="Father" <?php if($purchaser_dynamic[0]['pu_gur_type'] == 'Father'){ echo "selected"; } ?>>Father</option>
                                                                <option value="Husband" <?php if($purchaser_dynamic[0]['pu_gur_type'] == 'Husband'){ echo "selected"; } ?>>Husband</option>
                                                                <option value="Gurdian" <?php if($purchaser_dynamic[0]['pu_gur_type'] == 'Gurdian'){ echo "selected"; } ?>>Gurdian</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><span class="astrick">*</span></label>
                                                            <input class="form-control form-control-sm" type="text" name="pu_gur_name[]" value="<?= $purchaser_dynamic[0]['pu_gur_name'] ?>" placeholder="Enter Gurdian Name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address <span class="astrick">*</span></label>
                                                    <textarea class="form-control form-control-sm" type="text" name="pu_address[]" placeholder="Address" autocomplete="off" required><?= $purchaser_dynamic[0]['pu_address'] ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>State <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="pu_state[]" value="<?= $purchaser_dynamic[0]['pu_state'] ?>" placeholder="State" autocomplete="off" required>
                                                
                                                </div>
                                            </div>

                                           <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Bank Name </label>
                                                    <input class="form-control form-control-sm" type="text" name="pu_bank[]" value="<?= $purchaser_dynamic[0]['pu_bank'] ?>" placeholder="Bank Name" autocomplete="off" >
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>A/C Number </label>
                                                    <input class="form-control form-control-sm" type="text" name="pu_ac_number[]" value="<?= $purchaser_dynamic[0]['pu_ac_number'] ?>" placeholder="A/C Number" autocomplete="off" >
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>IFSC Code</label>
                                                    <input class="form-control form-control-sm" type="text" name="pu_ifsc_code[]" value="<?= $purchaser_dynamic[0]['pu_ifsc_code'] ?>" placeholder="IFSC Code" autocomplete="off">
                                                   
                                                </div>
                                            </div>

                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control form-control-sm" type="email" name="pu_email[]" value="<?= $purchaser_dynamic[0]['pu_email'] ?>" placeholder="Email" autocomplete="off" >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mobile<span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="pu_mobile[]" value="<?= $purchaser_dynamic[0]['pu_mobile'] ?>" placeholder="Mobile" autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Aadhaar Number<span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="pu_aadhaar[]" value="<?= $purchaser_dynamic[0]['pu_aadhaar'] ?>" placeholder="Aadhaar Number" autocomplete="off" required>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="image-container">
                                                            <img src="<?= base_url();?>uploads/<?= $purchaser_dynamic[0]['pu_my_image'] ?>" id="imgProfile2" style="width: 150px; height: 150px;" class="img-thumbnail kava-image-upload">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="file" name="pu_my_image[]" id="" onchange="img_return_seller(this,'');" required>
                                                    </div>
                                                </div>
                                            </div>
                                                                           
                                        </div><!-- // row -->
                                    </div>
                                </div><!--  // card-info -->
                            </div>

                        </div><!-- // div  row -->

                                    








                        <div class="row">




                            <div class="col-md-6">
                                <div id="Dynamic_Seller">
                                    <?php $_counter = 0; $arr = 1;
                                        foreach ($seller_dynamic_seller as $key) { $_counter++; $arr++;
                                    ?>
                                        <div class="card card-info">

                                            <div class="card-header">
                                                <h3 class="card-title">Sellers Details <?= $arr;?></h3>
                                            </div>

                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Name <span class="astrick">*</span></label>
                                                            <input class="form-control form-control-sm" type="text" name="name[]" placeholder="Name" value="<?= $key['name']; ?>" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">    
                                                        <div class="row"> 
                                                            <div class="col-md-6">    
                                                                <div class="form-group">
                                                                    <label>Select Gurdian Type <span class="astrick">*</span></label>
                                                                    <select class="form-control form-control-sm select2"  name="gur_type[]" autocomplete="off" required>
                                                                        <option value="Father" <?php if($key['gur_type'] == 'Father'){ echo "selected"; } ?>>Father</option>
                                                                        <option value="Husband" <?php if($key['gur_type'] == 'Husband'){ echo "selected"; } ?>>Husband</option>
                                                                        <option value="Gurdian" <?php if($key['gur_type'] == 'Gurdian'){ echo "selected"; } ?>>Gurdian</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label><span class="astrick">*</span></label>
                                                                    <input class="form-control form-control-sm" type="text" name="gur_name[]" value="<?= $key['gur_name'] ?>" placeholder="Enter Gurdian Name" autocomplete="off" required>
                                                                </div>
                                                            </div>
                                                        </div> <!-- // row -->
                                                    </div> <!-- // col-md-12 -->   

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Address <span class="astrick">*</span></label>
                                                            <textarea class="form-control form-control-sm" type="text" name="address[]" placeholder="Address" autocomplete="off"><?= $key['address'] ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>State <span class="astrick">*</span></label>
                                                            <input class="form-control form-control-sm" type="text" name="state[]" placeholder="State" value="<?= $key['state'] ?>" autocomplete="off">
                                                        
                                                        </div>
                                                    </div>

                                               
                                                
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Bank Name</label>
                                                            <input class="form-control form-control-sm" type="text" name="bank[]" placeholder="Bank Name" value="<?= $key['bank'] ?>" autocomplete="off">
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>A/C Number</label>
                                                            <input class="form-control form-control-sm" type="text" name="ac_number[]" placeholder="A/C Number" value="<?= $key['ac_number'] ?>" autocomplete="off">
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>IFSC Code </label>
                                                            <input class="form-control form-control-sm" type="text" name="ifsc_code[]" placeholder="IFSC Code" value="<?= $key['ifsc_code'] ?>" autocomplete="off">
                                                           
                                                        </div>
                                                    </div>

                                                
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control form-control-sm" type="text" name="email[]" placeholder="Email" value="<?= $key['email'] ?>" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Mobile<span class="astrick">*</span></label>
                                                            <input class="form-control form-control-sm" type="text" name="mobile[]" placeholder="Mobile" value="<?= $key['mobile'] ?>" autocomplete="off">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Aadhaar Number<span class="astrick">*</span></label>
                                                            <input class="form-control form-control-sm" type="text" name="aadhaar[]" value="<?= $key['aadhaar'] ?>" placeholder="Aadhaar Number" autocomplete="off" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="image-container">
                                                                    <img src="<?= base_url();?>uploads/<?= $key['my_image'] ?>" id="imgProfile10<?=$_counter?>" style="width: 150px; height: 150px;" class="img-thumbnail kava-image-upload">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="file" name="my_image[]" id="" onchange="img_return(this,'0<?=$_counter?>');" autocomplete="off" >
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!-- // Row-->    
                                            </div><!-- // Card body-->    
                                        </div><!-- // Card info-->    
                                    <?php   
                                        }
                                    ?>
                                </div>
                            </div><!-- // col-md-6 -->    






                            <div class="col-md-6">
                                <div id="Dynamic_Purchaser">
                                    <?php $_counter = 0; $arr = 1;
                                       foreach ($purchase_dynamic_purchaser as $key) { $_counter++; $arr++;
                                    ?>
                                    <div class="card card-info">
                                        <div class="card-header">
                                           <h3 class="card-title">Number of Purchares <?= $arr; ?></h3>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                               
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name <span class="astrick">*</span></label>
                                                        <input class="form-control form-control-sm" type="text" name="pu_name[]" value="<?= $key['pu_name'] ?>" placeholder="Name" autocomplete="off" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">    
                                                        <div class="floar-right col-md-6">
                                                            <div class="form-group">
                                                                <label>Select Gurdian Type <span class="astrick">*</span></label>
                                                                <select class="form-control form-control-sm select2" name="pu_gur_type[]" required>
                                                                    
                                                                    <option value="Father" <?php if($key['pu_gur_type'] == 'Father'){ echo "selected"; } ?>>Father</option>
                                                                    <option value="Husband" <?php if($key['pu_gur_type'] == 'Husband'){ echo "selected"; } ?>>Husband</option>
                                                                    <option value="Gurdian" <?php if($key['pu_gur_type'] == 'Gurdian'){ echo "selected"; } ?>>Gurdian</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><span class="astrick">*</span></label>
                                                                <input class="form-control form-control-sm" type="text" name="pu_gur_name[]" value="<?= $key['pu_gur_name'] ?>" placeholder="Enter Gurdian Name" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Address <span class="astrick">*</span></label>
                                                        <textarea class="form-control form-control-sm" type="text" name="pu_address[]" placeholder="Address" autocomplete="off" required><?= $key['pu_address'] ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>State <span class="astrick">*</span></label>
                                                        <input class="form-control form-control-sm" type="text" name="pu_state[]" value="<?= $key['pu_state'] ?>" placeholder="State" autocomplete="off" required>
                                                    
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Bank Name </label>
                                                        <input class="form-control form-control-sm" type="text" name="pu_bank[]" value="<?= $key['pu_bank'] ?>" placeholder="Bank Name" autocomplete="off" >
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>A/C Number </label>
                                                        <input class="form-control form-control-sm" type="text" name="pu_ac_number[]" value="<?= $key['pu_ac_number'] ?>" placeholder="A/C Number" autocomplete="off" >
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>IFSC Code</label>
                                                        <input class="form-control form-control-sm" type="text" name="pu_ifsc_code[]" value="<?= $key['pu_ifsc_code'] ?>" placeholder="IFSC Code" autocomplete="off">
                                                       
                                                    </div>
                                                </div>

                                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control form-control-sm" type="email" name="pu_email[]" value="<?= $key['pu_email'] ?>" placeholder="Email" autocomplete="off" >
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mobile<span class="astrick">*</span></label>
                                                        <input class="form-control form-control-sm" type="text" name="pu_mobile[]" value="<?= $key['pu_mobile'] ?>" placeholder="Mobile" autocomplete="off" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Aadhaar Number<span class="astrick">*</span></label>
                                                        <input class="form-control form-control-sm" type="text" name="pu_aadhaar[]" value="<?= $key['pu_aadhaar'] ?>" placeholder="Aadhaar Number" autocomplete="off" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="image-container">
                                                                <img src="<?= base_url();?>uploads/<?= $key['pu_my_image'] ?>" id="imgProfile20<?=$_counter?>" style="width: 150px; height: 150px;" class="img-thumbnail kava-image-upload">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="file" name="pu_my_image[]" id="" onchange="img_return_seller(this,'0<?=$_counter?>');" >
                                                        </div>
                                                    </div>
                                                </div>
                                                                               
                                            </div><!-- row -->
                                        </div>
                                    </div><!--  card-info -->
                                
                                <?php   
                                    }
                                ?>
                                </div>
                            </div>






                        </div>   <!-- // row -->







                       

                        <!--******************************************************************************
                                                  Start Land Details
                        ********************************************************************************-->
                        <div class="card card-info">
                            
                            <div class="card-header">
                                <h3 class="card-title">Land Details</h3>
                            </div>

                                <div class="card-body">
                                    <div class="row">
                                        
                                         <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Purchase Id <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="purchase_id" placeholder="Purchase Id" value="<?= $purchase_land_detail[0]['purchase_id'] ?>" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Land Details <span class="astrick">*</span></label>
                                                <textarea class="form-control form-control-sm" type="text" name="land_detail" placeholder="Land Details" value="" autocomplete="off" required><?= $purchase_land_detail[0]['land_detail'] ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Mouza <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="mouza" placeholder="Mouza" value="<?= $purchase_land_detail[0]['mouza'] ?>" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tehsil <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="tehsil" placeholder="Tehsil" value="<?= $purchase_land_detail[0]['tehsil'] ?>" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>District <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="district" placeholder="District" value="<?= $purchase_land_detail[0]['district'] ?>" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Khasra/Arazi No. <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="khasra" placeholder="Khasra/Arazi No." value="<?= $purchase_land_detail[0]['khasra'] ?>" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Land Type <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="land_type" placeholder="Land Type" value="<?= $purchase_land_detail[0]['land_type'] ?>" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Location <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="land_location" placeholder="Location" value="<?= $purchase_land_detail[0]['land_location'] ?>" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Account Number(land) <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="ac_num_land" placeholder="Account Number(land)" value="<?= $purchase_land_detail[0]['ac_num_land'] ?>" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Total Land area (in Hectares) <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="number" name="total_land" placeholder="Total Land area (in Hectares)" value="<?= $purchase_land_detail[0]['total_land'] ?>" step="0.1" min="1" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Per Person share <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="number" name="per_unit_share" placeholder="Per Person share" value="<?= $purchase_land_detail[0]['per_unit_share'] ?>" step="0.1" min="1" autocomplete="off" required>
                                            </div>
                                        </div>

                                    </div><!-- // row -->
                                </div>
                        </div><!--  //card-info -->


                        <!--*******************************************************************************
                                                    Start Payment Detail
                        ********************************************************************************-->
                        <div class="card card-info">
                            
                            <div class="card-header">
                                <h3 class="card-title">Payment Detail</h3>
                            </div>

                                <div class="card-body">
                                    <div class="row"> 

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Purchase Amount <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="number" name="purchase_amount" step="0.01" min="1" id="purchase_amount" onkeyup="ramining_amount()" placeholder="Purchase Amount" value="<?= $purchase_land_detail[0]['purchase_amount'] ?>" autocomplete="off" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Purchase Date <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" id="purchase_date" type="text" name="purchase_date" placeholder="Purchase Date" value="<?= date('d-m-Y',strtotime($purchase_land_detail[0]['purchase_date'])) ?>" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Land Size(in Sq. Ft) <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="lan_size" placeholder="Land Size(in Sq. Ft)" value="<?= $purchase_land_detail[0]['lan_size'] ?>" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>First Payment[Advance] <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="number" name="adva_payment" id="adva_payment" step="0.01" onkeyup="ramining_amount()" placeholder="First Payment[Advance]" step="0.01" min="1" value="<?= $purchase_land_detail[0]['adva_payment'] ?>" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>First Payment Date <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" id="adva_pay_date" type="text" name="adva_pay_date" placeholder="First Payment Date" value="<?= date('d-m-Y',strtotime($purchase_land_detail[0]['adva_pay_date'])) ?>" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Remaning Amount <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="bal_amount" id="bal_amount" step="0.01" placeholder="Remaning Amount" value="<?= $purchase_land_detail[0]['bal_amount'] ?>" autocomplete="off" required readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Time Ward Land Agreement <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="time_ward_land" placeholder="Time Ward Land Agreement" value="<?= $purchase_land_detail[0]['time_ward_land'] ?>" autocomplete="off" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Payment Mode <span class="astrick">*</span></label>
                                                <select name="payment_mode" class="form-control form-control-sm" required>
                                                    <option value="">-- Select Payment Mode  --</option>
                                                    <option value="Cash" <?php if($purchase_land_detail[0]['payment_mode'] == 'Cash') { echo 'selected'; } ?>>Cash</option>
                                                    <option value="Cheque" <?php if($purchase_land_detail[0]['payment_mode'] == 'Cheque') { echo 'selected'; } ?>>Cheque</option>
                                                    <option value="Bank Transfer" <?php if($purchase_land_detail[0]['payment_mode'] == 'Bank Transfer') { echo 'selected'; } ?>>Bank Transfer</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Payment Mode Detail <span class="astrick">*</span></label>
                                                <textarea class="form-control form-control-sm" id="payment_mode_detail" type="text" name="payment_mode_detail" placeholder="Payment Mode Detail Ex. (Cheque No., Ref.No.)" autocomplete="off" required><?= $purchase_land_detail[0]['payment_mode_detail'] ?></textarea>
                                            </div>
                                        </div>

                                    </div><!-- // row -->
                                </div>
                        </div><!--  //card-info -->

                        <div class="card card-info">
                            
                            <div class="card-header">
                                    <h3 class="card-title">Installment Detail</h3>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Installment Packages <span class="astrick">*</span></label>
                                                <select name="install_packges" class="form-control form-control-sm" id="install_packges" onchange="Install_Detail();" required>
                                                    <option value="">-- Select Installment Packages --</option>
                                                    <option value="Yes" <?php if($single_purchase[0]['install_packges'] == 'Yes') { echo 'selected'; } ?>>Yes</option>
                                                    <option value="No" <?php if($single_purchase[0]['install_packges'] == 'No') { echo 'selected'; } ?>>No</option>
                                                   
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row" id="installment">
                                            
                                            <?php if($single_purchase[0]['install_packges'] == 'Yes') { ?>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>No. of Installment <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="no_of_installment" placeholder="No. of Installment" autocomplete="off" value="<?= $single_purchase[0]['no_of_installment'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Time <span class="astrick">*</span></label>
                                                    <select name="time" class="form-control form-control-sm" required>
                                                        <option value="">-- Select Time --</option>
                                                        <option value="Monthly" <?php if($single_purchase[0]['time_installment'] == 'Monthly') { echo 'selected'; } ?>>Monthly</option>
                                                        <option value="Quarterly" <?php if($single_purchase[0]['time_installment'] == 'Quarterly') { echo 'selected'; } ?>>Quarterly</option>
                                                        <option value="Half Yearly" <?php if($single_purchase[0]['time_installment'] == 'No') { echo 'selected'; } ?>>Half Yearly</option>
                                                        <option value="Yearly" <?php if($single_purchase[0]['time_installment'] == 'Yearly') { echo 'selected'; } ?>>Yearly</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Deal Amount / Total Amount <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="deal_amount" placeholder="Deal Amount / Total Amount" autocomplete="off" value="<?= $purchase_land_detail[0]['purchase_amount']; ?>" required readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Advance Payment <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="adva_payment" placeholder="Advance Payment" autocomplete="off" value="<?= $purchase_land_detail[0]['adva_payment']; ?>" required readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Installment Amount / Reamaning Amount <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="instal_amount" placeholder="Installment Amount / Reamaning Amount" autocomplete="off" value="<?= $purchase_land_detail[0]['bal_amount']; ?>" required readonly>
                                                </div>
                                            </div>
                                            
                                            <?php } ?>

                                        </div>
                                        
                                                                   
                                    </div><!-- row -->
                                
                            </div>
                        </div><!--  card-info -->

                        <div>
                            <input type="hidden" name="id" value="<?= $single_purchase[0]['id']; ?>">
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Conditions/Remarks[if any]</label>
                                            <textarea rows="5" class="form-control form-control-sm" id="conditions" type="text" name="conditions" placeholder="Conditions/Remarks[if any]" autocomplete="off"><?= $single_purchase[0]['conditions']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    


                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>num_sellers" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-save"></i>&nbsp;Save</button>
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
        
        //Initialize Select2 Elements
        $('.select2').select2()


         //  Date Created
        $('#date_created').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        });

        // Purchase Date 
        $('#purchase_date').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        });

        // Advance  Payment Date 
        $('#adva_pay_date').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        });
        
      
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
            else if($('#install_packges').val() == 'Yes'){
                if(parseFloat($('#bal_amount').val()) <= 0)
                {
                    $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-times-circle',
                        message: 'If You Choose Installment Remaning Amount Must be Greater Than 0'
                    },{
                        type: 'danger'
                    });
                    return false;
                }
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
    })

</script>

<script type="text/javascript">

    // Get Ramining Amount
    function ramining_amount(){
           
           if($('#purchase_amount').val() != '' && $('#adva_payment').val() != '')
           {
               
                var purchse = parseFloat($('#purchase_amount').val());
                var advnce = parseFloat($('#adva_payment').val());
                $('#bal_amount').val(purchse - advnce);
                add_ins_amounts();
           }
           else{
                $('#bal_amount').val('');
                add_ins_amounts();
           }
    } 

    function add_ins_amounts(){
        if($('#adva_paymenta').val() != '')
                {
                    $("[name='deal_amount']").val($('#purchase_amount').val());
                    $("[name='adva_payment']").val($('#adva_payment').val());
                    $("[name='instal_amount']").val($('#bal_amount').val());

                }else{
                    $("[name='deal_amount']").val('');
                    $("[name='adva_payment']").val('');
                    $("[name='instal_amount']").val('');

                }
    }
    // Installment Detail
    function Install_Detail(){
        var installment = $('#install_packges').val();
        $('#installment').html('');
        if(installment === 'Yes'){
            $('#installment').append('<div class="col-md-4"><div class="form-group"><label>No. of Installment <span class="astrick">*</span></label><input class="form-control form-control-sm" type="text" name="no_of_installment" placeholder="No. of Installment" autocomplete="off" required></div></div><div class="col-md-4"><div class="form-group"><label>Time <span class="astrick">*</span></label><select name="time" class="form-control form-control-sm" required><option value="">-- Select Time --</option><option value="Monthly">Monthly</option><option value="Quarterly">Quarterly</option><option value="half Yearly">half Yearly</option><option value="Yearly">Yearly</option></select></div></div><div class="col-md-4"><div class="form-group"><label>Deal Amount / Total Amount <span class="astrick">*</span></label><input class="form-control form-control-sm" type="text" name="deal_amount" placeholder="Deal Amount / Total Amount" autocomplete="off" required readonly></div></div><div class="col-md-4"><div class="form-group"><label>Advance Payment <span class="astrick">*</span></label><input class="form-control form-control-sm" type="text" name="adva_payment" placeholder="Advance Payment" autocomplete="off" required readonly></div></div><div class="col-md-4"><div class="form-group"><label>Installment Amount / Reamaning Amount <span class="astrick">*</span></label><input class="form-control form-control-sm" type="text" name="instal_amount" id="rem_amount" placeholder="Installment Amount / Reamaning Amount" autocomplete="off" required readonly></div></div>');
                add_ins_amounts();
           return false;
        }
        else
        {
            $('#installment').html('');
           
        }

    }

    function sellers(){
        var seller = $('#num_of_saller').val();
        $('#Dynamic_Seller').html('');
        var _counter = 0;

        for(i = 1; i < seller; i++){
            _counter = _counter + 1;

            $('#Dynamic_Seller').append('<div class="card card-info"><div class="card-header"><h3 class="card-title">Sellers Details '+ (i + 1) +'</h3></div><div class="card-body"><div class="row"><div class="col-md-6"><div class="form-group"> <label>Name <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="name[]" placeholder="Name" required></div></div><div class="col-md-12"><div class="row"><div class="col-md-6"><div class="form-group"> <label>Select Gurdians Type <span class="astrick">*</span> </label> <select class="form-control form-control-sm select2" name="gur_type[]" required><option value="">-- Select Gurdians Type --</option><option value="Father">Father</option><option value="Husband">Husband</option><option value="Gurdian">Gurdian</option> </select></div></div><div class="col-md-6"><div class="form-group"> <label><span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="gur_name[]" placeholder="Enter Gurdian Name" required></div></div></div></div><div class="col-md-6"><div class="form-group"> <label>Address <span class="astrick">*</span> </label><textarea class="form-control form-control-sm" type="text" name="address[]" placeholder="Address" required></textarea></div></div><div class="col-md-6"><div class="form-group"> <label>State <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="state[]" placeholder="State" required></div></div><div class="col-md-6"><div class="form-group"> <label>Bank Name</label> <input class="form-control form-control-sm" type="text" name="bank[]" placeholder="Bank Name"></div></div><div class="col-md-6"><div class="form-group"> <label>A/C Number</label> <input class="form-control form-control-sm" type="text" name="ac_number[]" placeholder="A/C Number" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group" required> <label>IFSC Code</label> <input class="form-control form-control-sm" type="text" name="ifsc_code[]" placeholder="IFSC Code" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>Email</label> <input class="form-control form-control-sm" type="email" name="email[]" placeholder="Email" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>Mobile<span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="mobile[]" placeholder="Mobile" autocomplete="off" required></div></div><div class="col-md-6"><div class="form-group"> <label>Aadhaar Number<span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="aadhaar[]" placeholder="Aadhaar Number" autocomplete="off" required></div></div><div class="col-md-12"><div class="row"><div class="col-md-6"><div class="image-container"> <img src="<?= base_url();?>uploads/user.png" id="imgProfile1'+_counter.toString()+'" style="width: 150px;height:150px;" class="img-thumbnail kava-image-upload"></div></div><div class="col-md-6"> <input type="file" name="my_image[]" id="'+_counter.toString()+'" onchange="img_return(this,this.id);" required></div></div></div></div></div></div>');
        }
    }
     
        function purchse(){
        var seller = $('#num_of_purchaser').val();
        $('#Dynamic_Purchaser').html('');
 
        var _counter = 0;

        for(i = 1; i < seller; i++){
            _counter = _counter + 1;    
            $('#Dynamic_Purchaser').append('<div class="card card-info"><div class="card-header"><h3 class="card-title">Number of Purchares '+ (i + 1) +'</h3></div><div class="card-body"><div class="row"><div class="col-md-6"><div class="form-group"> <label>Name <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="pu_name[]" placeholder="Name" autocomplete="off" required></div></div><div class="col-md-12"><div class="row"><div class="floar-right col-md-6"><div class="form-group"> <label>Select Gurdian Type <span class="astrick">*</span> </label> <select class="form-control form-control-sm select2" name="pu_gur_type[]" required><option value="">-- Select Gurdian Type --</option><option value="Father">Father</option><option value="Husband">Husband</option><option value="Gurdian">Gurdian</option> </select></div></div><div class="col-md-6"><div class="form-group"> <label><span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="pu_gur_name[]" placeholder="Enter Gurdian Name" required></div></div></div></div><div class="col-md-6"><div class="form-group"> <label>Address <span class="astrick">*</span> </label><textarea class="form-control form-control-sm" type="text" name="pu_address[]" placeholder="Address" autocomplete="off" required></textarea></div></div><div class="col-md-6"><div class="form-group"> <label>State <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="pu_state[]" placeholder="State" autocomplete="off" required></div></div><div class="col-md-6"><div class="form-group"> <label>Bank Name</label> <input class="form-control form-control-sm" type="text" name="pu_bank[]" placeholder="Bank Name" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>A/C Number</label> <input class="form-control form-control-sm" type="text" name="pu_ac_number[]" placeholder="A/C Number" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>IFSC Code</label> <input class="form-control form-control-sm" type="text" name="pu_ifsc_code[]" placeholder="IFSC Code" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>Email</label> <input class="form-control form-control-sm" type="email" name="pu_email[]" placeholder="Email" autocomplete="off"></div></div><div class="col-md-6"><div class="form-group"> <label>Mobile<span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="pu_mobile[]" placeholder="Mobile" autocomplete="off" required></div></div><div class="col-md-6"><div class="form-group"> <label>Aadhaar Number<span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="pu_aadhaar[]" placeholder="Aadhaar Number" autocomplete="off" required></div></div><div class="col-md-12"><div class="row"><div class="col-md-6"><div class="image-container"> <img src="<?= base_url();?>uploads/user.png" id="imgProfile2'+_counter+'" style="width: 150px; height: 150px;" class="img-thumbnail kava-image-upload"></div></div><div class="col-md-6"> <input type="file" name="pu_my_image[]" id="'+_counter+'" onchange="img_return_seller(this,this.id);" required></div></div></div></div></div></div></div>');
        }

                                                       
    }
</script>