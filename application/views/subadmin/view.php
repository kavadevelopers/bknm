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
                                    <img src="<?=base_url();?>uploads/<?=$user['image']?>" id="imgProfile" style="width: 150px; height: 150px;" class="img-thumbnail" />
                                </div>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">
                                        <?=$detail['first_name'].' '.$detail['middle_name'].' '.$detail['last_name']?>        
                                    </h2>
                                    <h6 class="d-block"><?=$user['user_type_id']?></h6>
                                    <h6 class="d-block">Admin</h6>
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
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#sale" role="tab" aria-controls="connectedServices" aria-selected="false">Sale</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#saleinstallment" role="tab" aria-controls="connectedServices" aria-selected="false">Sale Installment</a>
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
                                                <?=$detail['first_name'].' '.$detail['middle_name'].' '.$detail['last_name']?>
                                            </div>
                                        </div>
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Sub Admin Id</label>
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
                                                <label style="font-weight:bold;">Created At</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?=date('d-m-Y h:i A',strtotime($user['created_at']))?>
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

                                    <div class="tab-pane fade" id="sale" role="tabpanel" aria-labelledby="ConnectedServices-tab">

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
                                                    <?php foreach ($this->all_model->sale_get_byid($admin) as $key => $row) { ?>
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

                                    <div class="tab-pane fade" id="saleinstallment" role="tabpanel" aria-labelledby="ConnectedServices-tab">


                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <table class="table table-bordered table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Customer Name</th>
                                                                    <th>Product</th>
                                                                    <th>No Of Installment</th>
                                                                    <th>Installment Amount</th>
                                                                    <th>Late Charges</th>
                                                                    <th>Payment Type</th>
                                                                    <th>Payment Details</th>
                                                                    <th>Pay Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>


                                                                <?php foreach ($data as $key) { ?>

                                                                    <tr>
                                                                        <td>
                                                                            <?= $this->payment_model->get_customer($this->payment_model->get_sell($key['main_id'])['coust_name']); ?>   
                                                                        </td>
                                                                        <td>
                                                                            <?= $this->payment_model->get_product($this->payment_model->get_sell($key['main_id'])['product_id']); ?>        
                                                                        </td>
                                                                        <td>
                                                                            <?= $this->payment_model->get_sell_installment_by_id($key['installment_id'])['no_of_installment']; ?>        
                                                                        </td>
                                                                        <td><?= $key['amount_install']; ?></td>
                                                                        <td><?= $key['late_charge']; ?></td>
                                                                        <td><?= $key['pay_type']; ?></td>
                                                                        <td><?= nl2br($key['pay_detail']); ?></td>
                                                                        <td style="min-width: 80px;"><?= _vdate($key['date']); ?></td>
                                                                        
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