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
                                    <h6 class="d-block">Investor</h6>
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
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#account" role="tab" aria-controls="connectedServices" aria-selected="false">Account Details</a>
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
                                                <label style="font-weight:bold;">Business Partner Id</label>
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
                                                <label style="font-weight:bold;">Father Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=$detail['fa_name']?>
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
                                                <?=date('d-m-Y',strtotime($detail['bdate'])).' - '.$detail['age'].' Years';?>
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
                                                <span class="info-box-text">Total Profit Amount</span>
                                                
                                                <span class="info-box-number"><?= moneyFormatIndia($this->all_model->business_total_credit($business_id)); ?></span>
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
                                                <span class="info-box-number"><?= moneyFormatIndia($this->all_model->business_total_debit($business_id)); ?></span>
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
                                                <span class="info-box-number"><?= moneyFormatIndia($this->all_model->business_balance($business_id)); ?></span>
                                              </div>
                                              <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                          </div>
                                         
                                        </div>

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="card card-info">
                                                    <div class="card-header border-transparent">
                                                        <h3 class="card-title">Your Transactions</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="product" class="table table-bordered table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Type</th>
                                                                        <th>Description</th>
                                                                        <th>Credit</th>
                                                                        <th>Debit</th>
                                                                        <th>Date</th>
                                                                        <th>Credit/Debit</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($business_trans as $key) {  ?>
                                                                        <tr>
                                                                            <td><?= ucfirst($key['type']); ?></td>
                                                                            <?php if($key['type'] == 'expense'){ ?>
                                                                                <td><?= $this->partner_transact->get_expense_type($key['investment_id'])['desc']; ?></td>
                                                                            <?php }else if($key['type'] == 'purchase'){  ?>
                                                                                <td><?= $this->partner_transact->get_purchase_id($key['investment_id'])['purchase_id']; ?></td>
                                                                            <?php }else{ ?>
                                                                                <td>-</td>
                                                                            <?php } ?>
                                                                            <td><?= $key['credit']; ?></td>
                                                                            <td><?= $key['debit']; ?></td>
                                                                            <td><?= _vdate($key['date']); ?></td>
                                                                            <td class="text-center">
                                                                                <?php if($key['credit'] == '0'){ echo '<span class="badge badge-danger">Debit</span>'; }else{ echo '<span class="badge badge-success">Credit</span>'; } ?>        
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="info-box mb-3 bg-warning">
                                                  <span class="info-box-icon"><i class="fa fa-handshake-o"></i></span>

                                                  <div class="info-box-content">
                                                    <span class="info-box-text">Total Investment</span>
                                                    <span class="info-box-number"><?= moneyFormatIndia($this->transaction_model->get_parterner_total_investment($business_id)['balance']); ?></span>
                                                  </div>
                                                </div>

                                                <div class="info-box mb-3 bg-secondary">
                                                  <span class="info-box-icon"><i class="fa fa-minus"></i></span>

                                                  <div class="info-box-content">
                                                    <span class="info-box-text">Total Debit</span>
                                                    <span class="info-box-number"><?= moneyFormatIndia($this->transaction_model->get_parterner_debit($business_id)['balance']); ?></span>
                                                  </div>
                                                </div>

                                                <div class="info-box mb-3 bg-info">
                                                  <span class="info-box-icon"><i class="fa fa-plus"></i></span>

                                                  <div class="info-box-content">
                                                    <span class="info-box-text">Total Credit</span>
                                                    <span class="info-box-number"><?= moneyFormatIndia($this->transaction_model->get_parterner_credit($business_id)['balance']); ?></span>
                                                  </div>
                                                </div>

                                                <div class="info-box mb-3 bg-success">
                                                  <span class="info-box-icon"><i class="fa fa-bank"></i></span>

                                                  <div class="info-box-content">
                                                    <span class="info-box-text">Balance</span>
                                                    <span class="info-box-number"><?= moneyFormatIndia($this->transaction_model->get_parterner_balance($business_id)['balance']); ?></span>
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
            </div>
        </div>








       	</div>
    </section>
<!-- /.container-fluid -->
<script type="text/javascript">
    $(function(){
        $('#product').DataTable({
            "dom": "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
            
            order : [],
            "aLengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
            
        });
    });
</script>