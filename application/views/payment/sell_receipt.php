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
    <style type="text/css">
        .text-my{
            font-family: courier new;
        }
        h5 h6 h4 h3{
            font-weight: 300;
        }
        ._data
        {
            border-bottom: solid 1px;
            font-style: italic;
            font-weight: 800;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12" style="padding-bottom: 1rem!important;">
                <div class="row text-my" style="border:groove; background: #fff;">

                    <img src="<?=base_url();?>image/Customer-Installment-receipt.png" class="img-responsive" style="width: 100%; border-bottom: groove;">
                    <h1 style="text-align: center; color: #a50b12;width: 100%;"><b>INSTALLMENT RECEIPT</b></h1>
                    <div class="col-md-12">
                    <div class="row" style="padding: 10px 30px;">
                        
                            
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 style="font-family: courier new;">
                                            RECEIPT NO. : <span class="_data"><?= $sell_payment['id'];?></span>
                                        </h3>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 style="font-family: courier new; text-align: right;">
                                            DATE : <span class="_data"><?= _vdate($sell_payment['date']);?></span>
                                        </h3>
                                    </div>
                                </div>


                                <div class="row" style="margin-top: 20px; padding:10px 20px;">
                                    <h5 style="font-family: courier new;">Installment received from <span class="_data"><?= $this->payment_model->get_customer($this->payment_model->get_sell($sell_payment['main_id'])['coust_name']); ?></span> the amount of <span class="_data"><?= $sell_payment['amount_install'];?></span> For the month and year of <span class="_data"><?= date('F Y',strtotime($this->payment_model->get_sell_installment_by_id($sell_payment['installment_id'])['date'])); ?></span>.
                                </div>

                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-md-3">
                                        <h6 class="text-center"><b>CUSTOMER ID</b></h6>
                                        <p class="text-center">
                                            <span class="_data">
                                                <?= $this->users->get_user($this->payment_model->get_sell($sell_payment['main_id'])['coust_name'])[0]['user_type_id'];?>          
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="text-center"><b>INSTALLMENT NUMBER</b></h6>
                                        <p class="text-center">
                                            <span class="_data">
                                                <?= _suffix($this->payment_model->get_sell_installment_by_id($sell_payment['installment_id'])['no_of_installment']); ?>         
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="text-center"><b>DUE DATE</b></h6>
                                        <p class="text-center">
                                            <span class="_data">
                                                <?= _vdate($this->payment_model->get_sell_installment_by_id($sell_payment['installment_id'])['date']); ?>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="text-center"><b>NEXT DUE DATE</b></h6>
                                        <p class="text-center">
                                            <span class="_data">
                                                <?=$this->payment_model->get_next_due($sell_payment['main_id'],$sell_payment['installment_id'])?>
                                            </span>
                                        </p>
                                    </div>
                                </div>


                                <div class="row" style="margin-top: 25px;">
                                    <div class="col-md-3">
                                        <h6 class="text-center"><b>PLAN NAME</b></h6>
                                        <p class="text-center">
                                            <span class="_data">
                                                <?=$this->payment_model->get_product_row($sell_payment['main_id'])['plan_code']?>
                                            </span>            
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="text-center"><b>PLOT NUMBER</b></h6>
                                        <p class="text-center">
                                            <span class="_data">
                                                <?=$this->payment_model->get_product_row($sell_payment['main_id'])['ploat_code']?>
                                            </span> 
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="text-center"><b>PLOT SIZE (Sq.Ft)</b></h6>
                                        <p class="text-center">
                                            <span class="_data">
                                                <?=$this->payment_model->get_product_row($sell_payment['main_id'])['lan_size_sqft']?>
                                            </span> 
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <h6 class="text-center"><b>LATE CHARGES</b></h6>
                                        <p class="text-center">
                                            <span class="_data">
                                                <?= $sell_payment['late_charge'];?>        
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 25px; padding: 10px 30px;">

                                    <h6 style="margin-bottom: 15px;"><b>EXPECTED LAND VALUE AT THE END OF TERM (in Indian Rupees):
                                        <span class="_data">
                                            <?= getIndianCurrency_inwords($this->payment_model->get_sell($sell_payment['main_id'])['selling_amount']).' Only.'; ?>
                                        </span></b>
                                    </h6>

                                    <h6 style="margin-bottom: 15px;"><b>SUBSCRIPTION AMOUNT IN EACH INSTALLMENT: 
                                        <span class="_data">
                                            <?= $sell_payment['amount_install'].' ('.$this->payment_model->get_sell_installment_by_id($sell_payment['installment_id'])['time'].')'; ?>
                                        </span>
                                    </h6>

                                </div>

                                <div class="row" style="">

                                    <h6 style="margin-bottom: 15px;"><b>Amount in words: 
                                        <span class="_data">
                                            <?= getIndianCurrency_inwords($sell_payment['amount_install']).' Only.'; ?>
                                        </span></b>
                                    </h6>

                                    <h6 style="margin-bottom: 15px;"><b>Total Amount Received (including late charges):
                                        <span class="_data">
                                            <?= getIndianCurrency_inwords($sell_payment['amount_install'] + $sell_payment['late_charge']).' Only.'; ?>
                                        </span></b></h6>

                                </div>

                                


                            </div>




                        </div>
                        <div class="row" style="margin-top: 50px;">
                            <h6 style="text-align: right; width: 100%;">AUTHORISED SIGNATORY &nbsp;</h6>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>