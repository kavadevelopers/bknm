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

        	<div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                    <img src="<?=base_url();?>uploads/<?=$user['image']?>" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                </div>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">
                                        <?=$detail['fi_name'].' '.$detail['la_name']?>        
                                    </h2>
                                    <h6 class="d-block"><?=$user['user_type_id']?></h6>
                                    <h6 class="d-block">Agent</h6>
                                    <h6 class="d-block"><?=$this->auth->promotion_level_byid($user['user_type_id']);?></h6>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Personal Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Contact Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#bankdetails" role="tab" aria-controls="connectedServices" aria-selected="false">Bank Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#account" role="tab" aria-controls="connectedServices" aria-selected="false">Account Detail</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#sale" role="tab" aria-controls="connectedServices" aria-selected="false">Sales</a>
                                    </li>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Username</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$user['user_name']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Full Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['fi_name'].' '.$detail['mi_name'].' '.$detail['la_name']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Agent Id</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$user['user_type_id']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Sex</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['sex']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;"><?=$detail['gur_type']?> Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['gur_name']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Mother Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['mo_name']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Birth Date</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=date('d-m-Y',strtotime($detail['bdate'])).' - '.$detail['year'].' Years';?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;"><?=$detail['proof_type']?></label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['proof_num']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Qualification</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['quali']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Designation</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['desig']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Joining Date</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=date('d-m-Y',strtotime($detail['jdate']))?>
                                            </div>
                                        </div>
                                        
                                        
                                        

                                    </div>
                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                        

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Email</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['email']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Mobile</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['mobile']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Mobile 2</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['mobile2']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">City</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['city']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">State</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['state']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Zip code</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['zip']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Address</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=nl2br($detail['address'])?>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="tab-pane fade" id="bankdetails" role="tabpanel" aria-labelledby="BankDetails-tab">

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Bank Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['bank']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">A/C Number</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['ac_number']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">IFSC Code</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['ifsc_code']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Branch Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['branch_name']?>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="BankDetails-tab">
                                        <div class="row">
                                          <div class="col-md-4 col-sm-6 col-12">
                                            <div class="info-box bg-secondary-gradient">
                                              <span class="info-box-icon"><i class="fa fa-plus"></i></span>

                                              <div class="info-box-content">
                                                <span class="info-box-text">Total Credit Amount</span>
                                                
                                                <span class="info-box-number"><?= moneyFormatIndia($this->all_model->agent_total_credit($agent_id)); ?></span>
                                              </div>
                                              <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                          </div>
                                          <!-- /.col -->
                                          <div class="col-md-4 col-sm-6 col-12">
                                            <div class="info-box bg-success-gradient">
                                              <span class="info-box-icon"><i class="fa fa-flask"></i></span>

                                              <div class="info-box-content">
                                                <span class="info-box-text">Total Withdraw Amount</span>
                                                <span class="info-box-number"><?= moneyFormatIndia($this->all_model->agent_total_debit($agent_id)); ?></span>
                                              </div>
                                              <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                          </div>
                                          <!-- /.col -->
                                          <div class="col-md-4 col-sm-6 col-12">
                                            <div class="info-box bg-info-gradient">
                                              <span class="info-box-icon"><i class="fa fa-sticky-note-o"></i></span>

                                              <div class="info-box-content">
                                                <span class="info-box-text">Balance Amount</span>
                                                <span class="info-box-number"><?= moneyFormatIndia($this->all_model->agent_balance($agent_id)); ?></span>
                                              </div>
                                              <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                          </div>
                                         
                                        </div>


                                        <div class="row">

                                        <div class="col-md-6">
                                          <div class="card card-secondary">
                                            <div class="card-header">
                                              <h3 class="card-title">Monthly</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                              <div class="callout callout-danger">
                                                <h5>Reffered</h5>
                                                <p><?= $monthly_reffered; ?></p>
                                              </div>
                                              <div class="callout callout-info">
                                                <h5>Sale</h5>
                                                <p><?= $monthly_sale; ?></p>
                                              </div>
                                              <div class="callout callout-warning">
                                                <h5>Direct Income</h5>
                                                <p><?php if(!empty($monthly_direct_income)){ echo moneyFormatIndia($monthly_direct_income); }else{ echo '0.00'; }; ?></p>
                                              </div>
                                              <div class="callout callout-success">
                                                <h5>Indirect Income</h5>
                                                <p><?php if(!empty($monthly_indirect_income)){ echo moneyFormatIndia($monthly_indirect_income); }else{ echo '0.00'; }; ?></p>
                                              </div>
                                              <div class="callout callout-danger">
                                                <h5>Bonus Income</h5>
                                                <p><?php if(!empty($monthly_bonus_income)){ echo moneyFormatIndia($monthly_bonus_income); }else{ echo '0.00'; }; ?></p>
                                                
                                              </div>
                                              <div class="callout callout-info">
                                                <h5>Promotion Income</h5>
                                                <p><?php if(!empty($monthly_promotion_income)){ echo moneyFormatIndia($monthly_promotion_income); }else{ echo '0.00'; }; ?></p>
                                              </div>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>
                                        <div class="col-md-6">
                                          <div class="card card-secondary">
                                            <div class="card-header">
                                              <h3 class="card-title">Total</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                              <div class="callout callout-danger">
                                                <h5>Reffered</h5>
                                                <p><?= $total_reffered; ?></p>
                                              </div>
                                              <div class="callout callout-info">
                                                <h5>Sale</h5>
                                                <p><?= $total_sale; ?></p>
                                              </div>
                                              <div class="callout callout-warning">
                                                <h5>Direct Income</h5>
                                                <p><?php if(!empty($total_direct_income)){ echo moneyFormatIndia($total_direct_income); }else{ echo '0.00'; }; ?></p>
                                              </div>
                                              <div class="callout callout-success">
                                                <h5>Indirect Income</h5>
                                                <p><?php if(!empty($total_indirect_income)){ echo moneyFormatIndia($total_indirect_income); }else{ echo '0.00'; }; ?></p>
                                              </div>
                                              <div class="callout callout-danger">
                                                <h5>Bonus Income</h5>
                                                <p><?php if(!empty($total_bonus_income)){ echo moneyFormatIndia($total_bonus_income); }else{ echo '0.00'; }; ?></p>
                                              </div>
                                              <div class="callout callout-info">
                                                <h5>Promotion Income</h5>
                                                <p><?php if(!empty($total_promotion_income)){ echo moneyFormatIndia($total_promotion_income); }else{ echo '0.00'; }; ?></p>
                                              </div>
                                            </div>
                                            <!-- /.card-body -->
                                          </div>
                                          <!-- /.card -->
                                        </div>

                                        
                                      </div>

                                    </div>
                                    <div class="tab-pane fade" id="sale" role="tabpanel" aria-labelledby="BankDetails-tab">

                                        <div class="row">
                                            <table class="table table-bordered table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Sale</th>
                                                        <th>Product ID</th>
                                                        <th>Plot Size Sq.ft</th>
                                                        <th>selling Amount</th>
                                                        <th>Date</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>   
                                                    <?php foreach ($this->all_model->sale_get_byid($agent_id) as $key => $row) { ?>
                                                        <tr>
                                                            <td><?= $this->users->customer_detail($row['coust_name'])[0]['fi_name'].' '.$this->users->customer_detail($row['coust_name'])[0]['la_name']; ?></td>
                                                            <td><?=$row['id'];?></td>
                                                            <td><?= $this->add_product->get_product_del($row['product_id'])[0]['product_id']; ?></td>
                                                            <td><?= $row['ploat_size']; ?></td>
                                                            <td><?= $row['selling_amount']; ?></td>
                                                            <td><?= date('d-m-Y',strtotime($row['date'])); ?></td>
                                                            

                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>








       	</div>
    </section>
<!-- /.container-fluid -->

<script type="text/javascript">
    $(function(){
        $('.table').DataTable({
            "dom": "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
           
            
        });
    })
</script>