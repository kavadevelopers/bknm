<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>image/favicon.png" type="image/png"/>
    <title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">

    <style type="text/css">
        @media print {
            @page { margin: 0; }
        }

        html,body{
            page-break-after: avoid;
            page-break-before: avoid;
        }

        .watermark{
            position: absolute;
            width: 600px;
            opacity: 0.2;
            transform: translate(35%,140%);
        }

        .watermark-2{
            position: absolute;
            width: 600px;
            opacity: 0.2;
            transform: translate(35%,120%);
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

<body style="margin:1.6cm;">
    
    <div class="watermark"><img src="<?= base_url(); ?>image/logo.png" style="width: 100%;"></div>
    <div class="col-md-12 pagebreak" style="padding: 20px; margin-top: 150px;" >
        <div class="row">

            <div class="col-md-12">
                <h4 style="padding:170px 0;text-align: center;"></h4>

                <img src="<?= base_url(); ?>image/purchase1.png" class="img-responsive" style="width: 100%; height: 100px;">

                <h3 style="color: #a50b12; text-align: center;"><b>LAND AGREEMENT PAPER</b></h3>

            </div>

            <div class="col-md-12" style="border: groove;">
                <div class="row">
                    <div class="col-md-12">

                        <h4 class="text-center">PAGE: 1</h4>

                        <h4 class="text-center"><b>AGREEMENT ID: </b>
                            <span class="_data"><?= $purchase_land_detail[0]['purchase_id']; ?></span>
                        </h4>

                        <div class="row" style="margin: 20px;">
                                <div class="col-md-6">
                                    <h4 style="text-align: center;padding-bottom: 7px;"><b>SELLER</b></h4>
                                    
                                    
                                        <?php 
                                            $count = 0;
                                            foreach ($all_seller_dynamic as $key) { $count++; 
                                        ?>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-md-2">
                                                
                                                <img src="<?= base_url();?>uploads/<?= $key['my_image']; ?>" height="130px" width="100px">

                                            </div>

                                            <div class="col-md-10">
                                                <div class="my_padding">    
                                                    <h6>Name : <?= $key['name']; ?></h6>
                                                    <h6><?= $key['gur_type']; ?>'s Name : <?= $key['gur_name']; ?></h6>
                                                    <h6>Address : <?= $key['address']; ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    

                                    
                                </div>

                                <div class="col-md-6">
                                    <h4 style="text-align: center;padding-bottom: 7px;"><b>PURCHASER</b></h4>

                                    <div class="row">
                                        <?php 
                                            $count = 0;
                                            foreach ($all_purchaser_dynamic as $key) { $count++; 
                                        ?>
                                        <div class="col-md-2">
                                            
                                            <img src="<?= base_url();?>uploads/<?= $key['pu_my_image']; ?>" height="130px" width="100px">

                                        </div>

                                        <div class="col-md-10">
                                            <div class="my_padding">   
                                                <h6>Name : <?= $key['pu_name']; ?></h6>
                                                <h6><?php if(!empty($key['pu_gur_type'])){ echo $key['pu_gur_type'].'s Name : '.$key['pu_gur_name']; } ?></h6>
                                                <h6>Address : <?= nl2br($key['pu_address']); ?></h6>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                        </div>

                        <div class="row" style="margin:20px">

                            <h4><b>CONDITIONS/REMARKS (if any):</b></h4>
                            <div class="col-md-12" style="min-height: 100px;border: groove;"><p><?= nl2br($single_purchase[0]['conditions']); ?></p></div>
                            
                            <div class="col-md-12">
                                <h4><b>SIGNATURE & THUMB</b></h4>
                                <div class="row">

                                    <div class="col-md-7" style="min-height: 150px;border: groove;"><p>Sellers(s)</p></div>
                                    
                                    <div class="col-md-4 offset-1" style="min-height: 150px; float:right;border: groove;"><p>Purchaser(s)</p></div>
                                    
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>    
    </div>





    <div class="watermark-2"><img src="<?= base_url(); ?>image/logo.png" style="width: 100%;"></div>
    <div style="padding-top: 10px;padding: 20px 20px 0 20px;">
        <div class="row">
            <div class="col-md-12" style="border: groove;"> 
                
                <img src="<?= base_url(); ?>image/ag2.jpeg" class="img-responsive" style="width: 100%;">
                
                <h1 style="color: #a50b12; text-align: center;"><b>LAND AGREEMENT PAPER</b></h1>

                <p style="font-size: 12px;text-align: center;">CERTTFIED that the associale described in Schedule here to Registered Joint Venture Of Consideration as shown in Schedule under Plan of Company subject to the regular payment of subscription(s) has mentioned in the said schedule and also subject to "general terms & conditions"printed over leaf and terms and conditions as per rules book. as may be amendment from time to time. and compay shall pay in Indian currency at its associate service center through corp.Office, the amount due under certificatc in accordance with terms of said schedule of the person whome the same in here in express to payable.It is hereby declared that schedule "general terms & condition" and other terms of rules book as amended from time to time, shall be deemed to be a part of This certificate.</p>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="border: groove;">
                <div style="margin: 20px;">
                    <h4 class="text-center">PAGE: 2</h4>
                    
                    <h4 class="text-center"><b>AGREEMENT ID: </b>
                        <span class="_data"><?= $purchase_land_detail[0]['purchase_id']; ?></span>
                    </h4>

                     <div class="row">
                        <div class="col-md-6">
                            <h4><b>LAND DETAIL:</b></h4>
                        </div>
                        <div class="col-md-6">
                            <h4 class="right">
                                <b>Total Number of Sellers: </b><span class="_data"><?=$single_purchase[0]['num_of_sellers']; ?></span>
                            </h4>
                            <h4 class="right">
                                <b>Total Number of Purchasers: </b><span class="_data"><?=$single_purchase[0]['num_of_purchaser']; ?></span>
                            </h4>   
                        </div>      
                    </div>
                </div>


                <div class="row" style="margin:0 20px">
                    <div class="col-md-12" style="border: groove;">

                        <div class="row">
                            
                            <div class="col-md-3">
                                <h5 class="text-center"><b>KHASRA/ARAZI NO.</b></h5>
                                <p class="text-center"><span class="_data"><?= $purchase_land_detail[0]['khasra']; ?></span></p>
                            </div>

                            <div class="col-md-3">
                                <h5 class="text-center"><b>MOUZA</b></h5>
                                <p class="text-center"><span class="_data"><?= $purchase_land_detail[0]['mouza']; ?></span></p>
                            </div>
                            
                            <div class="col-md-3">
                                <h5 class="text-center"><b>TEHSIL</b></h5>
                                <p class="text-center"><span class="_data"><?= $purchase_land_detail[0]['tehsil']; ?></span></p>
                            </div>
                            
                            <div class="col-md-3">
                                <h5 class="text-center"><b>DISTRICT</b></h5>
                                <p class="text-center"><span class="_data"><?= $purchase_land_detail[0]['district']; ?></span></p>
                            </div>


                            <div class="col-md-3">
                                <h5 class="text-center"><b>CATEGORY/TYPE</b></h5>
                                <p class="text-center"><span class="_data"><?= $purchase_land_detail[0]['land_type']; ?></span></p>
                            </div>

                            <div class="col-md-3">
                                <h5 class="text-center"><b>AREA(in Hectares)</b></h5>
                                <p class="text-center"><span class="_data"><?= $purchase_land_detail[0]['total_land']; ?></span></p>
                            </div>
                            
                            
                            
                            <div class="col-md-3">
                                <h5 class="text-center"><b>LAND ACCOUNT NO.</b></h5>
                                <p class="text-center"><span class="_data"><?= $purchase_land_detail[0]['ac_num_land']; ?></span></p>
                            </div>
                            
                            <div class="col-md-3">
                                <h5 class="text-center"><b>LOCATION</b></h5>
                                <p class="text-center"><span class="_data"><?= $purchase_land_detail[0]['land_location']; ?></span></p>
                            </div>
                        </div>   

                        <div class="row">

                            
                            
                            <div class="col-md-12">
                                <h5 class="text-center"><b>LAND DETAILS(All Sides)</b></h5>
                                <p class="text-center"><span class="_data"><?= $purchase_land_detail[0]['land_detail']; ?></span></p>
                            </div>

                        </div>
                    </div>
                </div>

        
                <h4 style="margin:0 20px;"><b>PAYMENT DETAIL:</b></h4>


                <div class="row" style="margin:0 20px;">
                    <div class="col-md-12" style="border: groove;">
                            <div class="row">

                                <div class="col-md-3">
                                    <h5 class="text-center"><b>PURCHASE DATE</b></h5>
                                    <p class="text-center"><span class="_data"><?= date('d-m-Y',strtotime($purchase_land_detail[0]['purchase_date'])); ?></span></p>
                                </div>

                                <div class="col-md-3">
                                    <h5 class="text-center"><b>TOTAL AMOUNT</b></h5>
                                    <p class="text-center"><span class="_data"><?= moneyFormatIndia($purchase_land_detail[0]['purchase_amount']); ?></span></p>
                                </div>
                                
                                <div class="col-md-3">
                                    <h5 class="text-center"><b>1st PAYMENT (Advance)</b></h5>
                                    <p class="text-center"><span class="_data"><?= moneyFormatIndia($purchase_land_detail[0]['adva_payment']); ?></span></p>
                                </div>
                                
                                <div class="col-md-3">
                                    <h5 class="text-center"><b>REMAINING AMOUNT</b></h5>
                                    <p class="text-center"><span class="_data"><?= moneyFormatIndia($purchase_land_detail[0]['bal_amount']); ?></span></p>
                                </div>


                                <div class="col-md-3">
                                    <h5 class="text-center"><b>PAYMENT MODE</b></h5>
                                    <p class="text-center"><span class="_data"><?= $purchase_land_detail[0]['payment_mode']; ?></span></p>
                                </div>

                                <div class="col-md-3">
                                    <h5 class="text-center"><b>PAYMENT MODE DETAIL</b></h5>
                                    <p class="text-center"><span class="_data"><?= $purchase_land_detail[0]['payment_mode_detail']; ?></span></p>
                                </div>
                                
                                <div class="col-md-3">
                                    <h5 class="text-center"><b>1st PAYMENT DATE</b></h5>
                                    <p class="text-center"><span class="_data"><?= date('d-m-Y',strtotime($purchase_land_detail[0]['adva_pay_date'])); ?></span></p>
                                </div>
                                

                                <div class="col-md-3">
                                    <h5 class="text-center"><b>TIME WARD</b></h5>
                                    <p class="text-center"><span class="_data"><?= $purchase_land_detail[0]['time_ward_land']; ?> Months</span></p>
                                </div>

                            </div>
                    </div>   
                </div>

                <div class="row" style="margin:0 20px">

                    <h4><b>CONDITIONS/REMARKS (if any):</b></h4>
                    <div class="col-md-12" style="min-height: 100px;border: groove;"><p><?= nl2br($single_purchase[0]['conditions']); ?></p></div>
                    
                    <div class="col-md-12">
                        <h4><b>SIGNATURE & THUMB</b></h4>
                        <div class="row">

                            <div class="col-md-7" style="min-height: 120px;border: groove;"><p>Sellers(s)</p></div>
                            
                            <div class="col-md-4 offset-1" style="min-height: 120px; float:right;border: groove;"><p>Purchaser(s)</p></div>
                            
                            
                        </div>
                    </div>
                </div>

                <h4 style="margin: 0 20px;"><b>WITNESS DETAIL:</b></h4>


                <div class="row" style="margin:0 20px 3px 20px">
                    <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-3">
                                    <h5 class="text-center"><b>WITNESS NAME</b></h5>
                                    <p class="text-center"><span class="_data"><?= $single_purchase[0]['w_name']; ?></span></p>
                                </div>

                                <div class="col-md-3">
                                    <h5 class="text-center"><b>WITNESS MOBILE</b></h5>
                                    <p class="text-center"><span class="_data"><?= $single_purchase[0]['w_mobile']; ?></span></p>
                                </div>
                                
                                <div class="col-md-3">
                                    <h5 class="text-center"><b>WITNESS ADDRESS</b></h5>
                                    <p class="text-center" style="font-size: 8px;"><span class="_data"><?= nl2br($single_purchase[0]['w_address']); ?></span></p>
                                </div>

                                <div class="col-md-3" style="min-height: 90px; float:right;border: groove;"><p>SIGNATURE & THUMB</p></div>
                                

                            </div>
                    </div>   
                </div>
                <div class="row" style="margin:3px 20px 0 20px">
                    <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-3">
                                    <h5 class="text-center"><b>WITNESS NAME</b></h5>
                                    <p class="text-center"><span class="_data"><?= $single_purchase[0]['w2_name']; ?></span></p>
                                </div>

                                <div class="col-md-3">
                                    <h5 class="text-center"><b>WITNESS MOBILE</b></h5>
                                    <p class="text-center"><span class="_data"><?= $single_purchase[0]['w2_mobile']; ?></span></p>
                                </div>
                                
                                <div class="col-md-3">
                                    <h5 class="text-center"><b>WITNESS ADDRESS</b></h5>
                                    <p class="text-center" style="font-size: 8px;"><span class="_data"><?= nl2br($single_purchase[0]['w2_add']); ?></span></p>
                                </div>

                                <div class="col-md-3" style="min-height: 90px; float:right;border: groove;"><p>SIGNATURE & THUMB</p></div>
                                

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