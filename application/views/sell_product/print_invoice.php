<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>image/favicon.png" type="image/png"/>
    <title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">

    <style type="text/css">
        @media print {
            @page { margin: 0 10px 0 10px; }

            ._bg{ 
            	background-color: #a90e10 !important;
            	color: white;
        		-webkit-print-color-adjust: exact; 
            }
        }

        .watermark-2{
            position: absolute;
            width: 600px;
            opacity: 0.2;
            transform: translate(45%,120%);
        }

        .pagebreak { page-break-after: always; }

        ._data
        {
            border-bottom: solid 1px;
            font-style: italic;
            
        }
        .right{
            text-align: right;
        }

        .col-md-3 p{ font-size: 18px; }

        .my_padding{
            padding-left: 30px !important;
        }

    </style>

</head>

<body>
	<div class="watermark-2"><img src="<?= base_url(); ?>image/logo.png" style="width: 100%;"></div>
	<div class="col-md-12" style="padding-top: 10px;padding: 20px;">
        
        <div class="row">
			<div class="col-md-12" style="border: groove;">
                <img src="<?= base_url(); ?>image/ag2.jpeg" class="img-responsive" style="width: 100%;">

            	<h1 style="color: #a50b12; text-align: center;"><b>CERTIFICATE</b></h1>

                <p style="font-size: 12px;text-align: center;">CERTTFIED that the associale described in Schedule here to Registered Joint Venture Of Consideration as shown in Schedule under Plan of Company subject to the regular payment of subscription(s) has mentioned in the said schedule and also subject to "general terms & conditions"printed over leaf and terms and conditions as per rules book. as may be amendment from time to time. and compay shall pay in Indian currency at its associate service center through corp.Office, the amount due under certificatc in accordance with terms of said schedule of the person whome the same in here in express to payable.It is hereby declared that schedule "general terms & condition" and other terms of rules book as amended from time to time, shall be deemed to be a part of This certificate.</p>
            
                <div class="row text-center">
                	<div class="col-md-3">
                		<p><b>BANK:</b> <?= $this->setting_model->get_bank()['bank']; ?></p>
                	</div>
                	<div class="col-md-3">
                		<p><b>NAME:</b> <?= $this->setting_model->get_bank()['ac_name']; ?></p>
                	</div>
                	<div class="col-md-3">
                		<p><b>ACCOUNT NO.:</b> <?= $this->setting_model->get_bank()['ac_no']; ?></p>
                	</div>
                	<div class="col-md-3">
                		<p><b>IFSC:</b> <?= $this->setting_model->get_bank()['ifsc']; ?></p>
                	</div>
                </div>
            </div>
        </div>


        <div class="row">
			<div class="col-md-12" style="border: groove;">
				
				<div class="col-md-12" style="margin-top: 20px;">
					
					<div class="row"> 
							<div class="col-md-6">
								<h4><span class="_bg" style="padding: 0 10px;"><b>PERSONAL DETAILS:</b></span></h4>

								<div class="row" style="margin:0 20px;">
                                       
                                    <div class="col-md-2">
                                        
                                        <img src="<?= base_url();?>uploads/<?= $coust_photo['image']; ?>" height="130px" width="100px">

                                    </div>

                                    <div class="col-md-10">
                                        <div class="my_padding">    

                                            <h6>Name : <?= $coust_detail['fi_name'].' '.$coust_detail['mi_name'].' '.$coust_detail['la_name']; ?></h6>
                                            <h6><?= $coust_detail['gur_type']; ?> Name : <?= $coust_detail['gur_name']; ?></h6>
                                            <h6>Date of Birth : <?= _vdate($coust_detail['bdate']); ?></h6>
                                            <h6>Address : <?= $coust_detail['address']; ?></h6>
                                        </div>
                                    </div>
                                       
                                </div>
							</div>

							<div class="col-md-6">
								<h4 ><span class="_bg" style="padding: 0 10px;"><b>NOMINEE'S DETAILS:</b></span></h4>

								<div class="row">
                                       
                                    <div class="col-md-12">
                                        <div class="my_padding">    

                                            <h6>Name : <?= $coust_detail['no_fi_name'].' '.$coust_detail['no_mi_name'].' '.$coust_detail['no_la_name']; ?></h6>
                                            <h6><?= $coust_detail['no_gur_type']; ?> Name : <?= $coust_detail['no_gur_name']; ?></h6>
                                            <h6>Date of Birth : <?= _vdate($coust_detail['no_bdate']); ?></h6>
                                            <h6>Address : <?= $coust_detail['no_address']; ?></h6>
                                        </div>
                                    </div>
                                       
                                </div>
							</div>
					</div>
				</div>

				

				<div class="col-md-12" style="margin-top: 20px;">
					<div class="row"> 
						
						<div class="col-md-12">
							<h4><span class="_bg" style="padding: 0 10px;"><b>PLAN DETAILS:</b></span></h4>
						
								<div class="row _bg" style="margin:0 20px;">
									
									<div class="col-md-3">
										<h5 class="text-center">REGISTRATION NO.</h5>
									</div>

									<div class="col-md-3">
										<h5 class="text-center">COMMENCEMENT DATE</h5>
									</div>

									<div class="col-md-3">
										<h5 class="text-center">PLAN NAME</h5>
									</div>

									<div class="col-md-3">
										<h5 class="text-center">PLAN DURATION</h5>
									</div>

								</div>
								<div class="row" style="margin:0 20px;">
									
									<div class="col-md-3">
										<p class="text-center"><span class="_data"><?= $this->users->get_user($this->sel_product->get_co_name($sale['coust_name'])[0]['user_id'])[0]['user_type_id']; ?></span></p>
									</div>

									<div class="col-md-3">
										<p class="text-center"><span class="_data"><?= _vdate($sale['date']); ?></span></p>
									</div>

									<div class="col-md-3">
										<p class="text-center"><span class="_data"><?= $this->setting_model->edit_plan_code($sale['plan_id'])[0]['plan_code']; ?></span></p>
									</div>

									<div class="col-md-3">
										<p class="text-center"><span class="_data"><?= $this->setting_model->edit_plan_code($sale['plan_id'])[0]['month']; ?> Months</span></p>
									</div>

								</div>


								<div class="row"> 
									<div class="col-md-12">

										<div class="row _bg" style="margin:0 20px;">
									
											<div class="col-md-3">
												<h5 class="text-center">PLOT NUMBER</h5>
											</div>

											<div class="col-md-3">
												<h5 class="text-center">PLOT SIZE</h5>
											</div>

											<div class="col-md-3">
												<h5 class="text-center">CONSIDERATION AMOUNT</h5>
											</div>

											<div class="col-md-3">
												<h5 class="text-center">INSTALLMENT TERM</h5>
											</div>

										</div>
										<div class="row" style="margin:0 20px;">
											
											<div class="col-md-3">
												<p class="text-center"><span class="_data"><?= $product_detail[0]['ploat_code']; ?></span></p>
											</div>

											<div class="col-md-3">
												<p class="text-center"><span class="_data"><?= $sale['ploat_size']; ?> Sq.Ft.</span></p>
											</div>

											<div class="col-md-3">
												<p class="text-center"><span class="_data"><?= moneyFormatIndia($sale['selling_amount']); ?></span></p>
											</div>

											<div class="col-md-3">
												<p class="text-center"><span class="_data"><?= $sale['install_packges']; ?></span></p>
											</div>

										</div>

									</div>
								</div>


								<div class="row"> 
									<div class="col-md-12">

										<div class="row _bg" style="margin:0 20px;">
									
											<div class="col-md-3">
												<h5 class="text-center">TOTAL INSTALLMENT</h5>
											</div>

											<div class="col-md-3">
												<h5 class="text-center">INSTALLMENT DUE DATE</h5>
											</div>

											<div class="col-md-3">
												<h5 class="text-center">INSTALLMENT AMOUNT</h5>
											</div>

											<div class="col-md-3">
												<h5 class="text-center">PLAN EXPIRE DATE</h5>
											</div>

										</div>
										<div class="row" style="margin:0 20px;">
											
											<div class="col-md-3">
												<p class="text-center"><span class="_data"><?php if(!empty($sale['no_of_installment'])){ echo $sale['no_of_installment']; }else{ echo "NA"; }; ?></span></p>
											</div>

											<div class="col-md-3">
												<p class="text-center"><span class="_data"><?= $installment_due; ?></span></p>
											</div>
											<?php 
												$total = $sale['selling_amount'];
												$advance = $sale['adva_payment'];
												$remaining = $total - $advance;
											?>


											<?php 
												if($sale['install_packges'] == 'Yes')
												{
													$ins_amount = ($sale['selling_amount'] - $sale['adva_payment']) / $sale['no_of_installment'];
													$time_period = '<small>-'.$sale['time_installment'].'</small>';
												}
												else
												{
													$ins_amount = 0;
													$time_period = '';
												}
											?>
											<div class="col-md-3">
												<p class="text-center"><span class="_data"><?= moneyFormatIndia($ins_amount); ?><?=$time_period?></span></p>
											</div>


											<div class="col-md-3">
												<p class="text-center"><span class="_data"><?= $installment_expire; ?></span></p>
											</div>

										</div>

									</div>
								</div>



								<div class="row"> 
									<div class="col-md-12">

										<div class="row _bg" style="margin:0 20px;">
									
											<div class="col-md-3">
												<h5 class="text-center">FIRST RECEIPT DATE</h5>
											</div>

											<div class="col-md-3">
												<h5 class="text-center">RECEIPT NO.</h5>
											</div>

											<div class="col-md-3">
												<h5 class="text-center">BOOK NO./SR NO.</h5>
											</div>

											<div class="col-md-3">
												<h5 class="text-center">AGENT ID</h5>
											</div>

										</div>
										<div class="row" style="margin:0 20px;">
											
											<div class="col-md-3">
												<p class="text-center"><span class="_data"><?= _vdate($sale['first_receipt_date']); ?></span></p>
											</div>

											<div class="col-md-3">
												<p class="text-center"><span class="_data"><?= $sale['receipt_no']; ?></span></p>
											</div>

											<div class="col-md-3">
												<p class="text-center"><span class="_data"><?= $sale['book_no']; ?></span></p>
											</div>

											<div class="col-md-3">
												<p class="text-center"><span class="_data"><?= $this->sel_product->get_agent_id($sale['created_by'])['user_type_id']; ?></span></p>
											</div>

										</div>

									</div>
								</div>

						</div>
					</div>
				</div>
				<hr>

				<div class="col-md-12" style="margin-top: 20px;">
					<div class="row"> 
						<div class="col-md-12">
							<b style="margin-left:20px;padding: 0 0 10px 10px !important;">The expected sum payable to associate or his/her successor/ Nominee or Legal </b>
						</div>

							<div class="col-md-12">

								<div class="row _bg" style="margin:0 20px;">
							
									<div class="col-md-3">
										<h5 class="text-center">EXPECTED SUM PAYABLE RUPEES</h5>
									</div>

									<div class="col-md-3">
										<h5 class="text-center">DATE</h5>
									</div>

									<div class="col-md-3">
										<h5 class="text-center">AGENT NAME</h5>
									</div>

									<div class="col-md-3">
										<h5 class="text-center">AGENT ID</h5>
									</div>

								</div>
								<div class="row" style="margin:0 20px;">
									
									<div class="col-md-3">
										<p class="text-center"><span class="_data"><?= moneyFormatIndia($sale['selling_amount']); ?></span></p>
									</div>

									<div class="col-md-3">
										<p class="text-center"><span class="_data"><?= _vdate($sale['date']); ?></span></p>
									</div>

									<div class="col-md-3">
										<p class="text-center"><span class="_data">
											<?= $this->sel_product->get_agent_name($sale['created_by']); ?>
										</span></p>
									</div>

									<div class="col-md-3">
										<p class="text-center"><span class="_data"><?= $this->sel_product->get_agent_id($sale['created_by'])['user_type_id']; ?></span></p>
									</div>

								</div>


								<div class="row" style="margin:20px">

		                            <h4><b>REMARKS (if any):</b></h4>
		                            <div class="col-md-12" style="min-height: 100px;border: groove;"><p><?= nl2br($sale['remarks']); ?></p></div>
		                            <div class="col-md-12" style="padding: 25px 0;">
		                            	<div class="row">

				                           <div class="col-md-4">
												<h5 class="text-center">Seal with Stamp</h5>
											</div>

											<div class="col-md-4">
												<h5 class="text-center">Authorised By</h5>
											</div>

											<div class="col-md-4">
												<h5 class="text-center">Authorised Signatory</h5>
											</div>
										</div>		
		                        	</div>


								</div>
					</div>
				</div>



			</div>
		</div>



    </div>

    <script>
        window.onload = function () {
            window.print();
            setTimeout(window.close, 0);
        }
	</script>

</body>
</html>
