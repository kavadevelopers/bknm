<style type="text/css">
    .row .col-md-6 table th{
        width: 220px !important;
    }

    th{
        font-size: 15px;
    }
    tr{
        font-size: 15px;
    }
    th {
        text-align: left;
        width: 500px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -7.5px;
        margin-left: -7.5px;
    }
    .text-center {
        text-align: center;
    }
    .col-md-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
    .col-md-5 {
        flex: 0 0 41.666667%;
        max-width: 41.666667%;
    }
    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    .pull-right {
        float: right !important;
    }
</style>

<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>






<section class="content-header">
    <div class="container-fluid">
       
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Purchase View</h3>
                </div>



                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-5">
                                Number Of Seller(s) : <?=$single_purchase[0]['num_of_sellers']; ?>
                            </div>        
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="col-md-5">
                                Number Of Purchaser(s) : <?=$single_purchase[0]['num_of_purchaser']; ?>
                            </div> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?php 
                            $count = 0;
                            foreach ($all_seller_dynamic as $key) { $count++; 
                        ?>
                        <h5 class="text-center"><u>Sellers <?= $count; ?> Details</u></h5>
                        <table class="table">

                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td><?= $key['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gurdian Type</th>
                                        <td><?= $key['gur_type']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gurdian Name</th>
                                        <td><?= $key['gur_name']; ?></td>
                                    </tr>
                                    <tr class="address">
                                        <th>Address</th>
                                        <td><?= $key['address']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td><?= $key['state']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Bank Name</th>
                                        <td><?= $key['bank']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>A/C Number</th>
                                        <td><?= $key['ac_number']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>IFSC Code</th>
                                        <td><?= $key['ifsc_code']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= $key['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td><?= $key['mobile']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= $key['proof_type']; ?></th>
                                        <td><?= $key['proof_num']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Share Amount</th>
                                        <td><?= $key['share']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Advance Amount</th>
                                        <td><?= $key['advance']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Photo</th>
                                        <td><img src="<?= base_url();?>uploads/<?= $key['my_image']; ?>" style="width: 100px; height: 105px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php 
                            if($this->purchase->installment_purchase($key['id'])) { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Due Date</th>
                                            <th>Installment Amount</th>
                                            <th>Remaining Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($this->purchase->installment_purchase($key['id']) as $value => $key) { ?>        

                                            <tr>
                                                <td><?= $key['no_of_installment']; ?></td>
                                                <td><?= date('d-M-Y',strtotime($key['date'])); ?></td>
                                                <td><?= $key['instal_amount']; ?></td>
                                                <td><?= $key['remaining_amount']; ?></td>
                                                <?php if($key['status'] == 0){ ?>
                                                    <td>Unpaid</td>
                                                <?php } else { ?>
                                                    <td>Paid</td>
                                                <?php } ?>
                                            </tr>

                                        <?php } ?>

                                    </tbody>
                                </table>

                        <?php } ?>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php 
                            $count = 0;
                            foreach ($all_purchaser_dynamic as $key) { $count++; 
                        ?>
                        <h5 class="text-center"><u>Purchares  <?= $count; ?> Details</u></h5>
                        <table class="table">

                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td><?= $key['pu_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gurdian Type</th>
                                        <td><?= $key['pu_gur_type']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Gurdian Name</th>
                                        <td><?= $key['pu_gur_name']; ?></td>
                                    </tr>
                                    <tr class="address">
                                        <th>Address</th>
                                        <td><?= nl2br($key['pu_address']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>State</th>
                                        <td><?= $key['pu_state']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Bank Name</th>
                                        <td><?= $key['pu_bank']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>A/C Number</th>
                                        <td><?= $key['pu_ac_number']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>IFSC Code</th>
                                        <td><?= $key['pu_ifsc_code']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= $key['pu_email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td><?= $key['pu_mobile']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= $key['pu_proof_type']; ?></th>
                                        <td><?= $key['pu_proof_num']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Photo</th>
                                        <td><img src="<?= base_url();?>uploads/<?= $key['pu_my_image']; ?>" style="width: 100px; height: 105px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php
                            }
                        ?> 
                    </div>

                </div>




















                <div class="card-body">
                   

                    <div style="margin-top:30px;margin-left: auto;margin-right: auto;text-transform: capitalize;font-size: 8px; clear: both;">

           
                       
                        <table class="table">

                            <tr>
                                <h5 class="text-center"><u>Land Details</u></h5>
                            </tr>

                            <tbody>
                                 <tr>
                                    <th>Land Location/Name</th>
                                    <td><?= $purchase_land_detail[0]['purchase_id']; ?></td>
                                </tr>
                                <tr>
                                    <th>Land Details</th>
                                    <td><?= $purchase_land_detail[0]['land_detail']; ?></td>
                                </tr>
                                <tr>
                                    <th>Mouza</th>
                                    <td><?= $purchase_land_detail[0]['mouza']; ?></td>
                                </tr>
                                <tr>
                                    <th>Tehsil</th>
                                    <td><?= $purchase_land_detail[0]['tehsil']; ?></td>
                                </tr>
                                <tr>
                                    <th>District</th>
                                    <td><?= $purchase_land_detail[0]['district']; ?></td>
                                </tr>
                                <tr>
                                    <th>Khasra/Arazi No.</th>
                                    <td><?= $purchase_land_detail[0]['khasra']; ?></td>
                                </tr>
                                <tr>
                                    <th>Land Type</th>
                                    <td><?= $purchase_land_detail[0]['land_type']; ?></td>
                                </tr>
                                <tr>
                                    <th>Location</th>
                                    <td><?= $purchase_land_detail[0]['land_location']; ?></td>
                                </tr>
                                <tr>
                                    <th>Account Number(land)</th>
                                    <td><?= $purchase_land_detail[0]['ac_num_land']; ?></td>
                                </tr>
                                <tr>
                                    <th>Total Land area (in Sq. Yd)</th>
                                    <td><?= $purchase_land_detail[0]['total_land_yrd']; ?></td>
                                </tr>
                                <tr>
                                    <th>Total Land area (in Hectares)</th>
                                    <td><?= $purchase_land_detail[0]['total_land']; ?></td>
                                </tr>
                                <tr>
                                    <th>Per Person share</th>
                                    <td><?= $purchase_land_detail[0]['per_unit_share']; ?></td>
                                </tr>
                                <tr>
                                    <th>Purchase Amount</th>
                                    <td><?= $purchase_land_detail[0]['purchase_amount']; ?></td>
                                </tr>
                                <tr>
                                    <th>Purchase Date</th>
                                    <td><?= date('d-m-Y',strtotime($purchase_land_detail[0]['purchase_date'])); ?></td>
                                </tr>
                                <tr>
                                    <th>Land Size(in Sq. Ft)</th>
                                    <td><?= $purchase_land_detail[0]['lan_size']; ?></td>
                                </tr>
                                <tr>
                                    <th>First Payment[Advance]</th>
                                    <td><?= $purchase_land_detail[0]['adva_payment']; ?></td>
                                </tr>
                                <tr>
                                    <th>First Payment Date</th>
                                    <td><?= date('d-m-Y',strtotime($purchase_land_detail[0]['adva_pay_date'])); ?></td>
                                </tr>
                                <tr>
                                    <th>Remaning Amount</th>
                                    <td><?= $purchase_land_detail[0]['bal_amount']; ?></td>
                                </tr>
                                <tr>
                                    <th>Time Ward Land Agreement</th>
                                    <td><?= $purchase_land_detail[0]['time_ward_land']; ?></td>
                                </tr>
                                <tr>
                                <tr>
                                    <th>Payment Mode</th>
                                    <td><?= $purchase_land_detail[0]['payment_mode']; ?></td>
                                </tr>
                                <tr>
                                    <th>Payment Mode Detail</th>
                                    <td><?= $purchase_land_detail[0]['payment_mode_detail']; ?></td>
                                </tr>
                                
                            </tbody>
                        </table>

                        <p></p>

                        <hr>

                        <table class="table">

                            <tr>
                                <td colspan="2">
                                    <h5 class="text-center"><u>Installment Detail</u></h5>
                                </td>
                            </tr>

                            <tbody>
                                <tr>
                                    <th>Installment Packages</th>
                                    <td><?= $single_purchase[0]['install_packges']; ?></td>
                                </tr>
                                <tr>
                                    <th>No Of Installments</th>
                                    <td><?= $single_purchase[0]['no_of_installment']; ?></td>
                                </tr>
                                <tr>
                                    <th>Time Period</th>
                                    <td><?= $single_purchase[0]['time_installment']; ?></td>
                                </tr>
                                <tr>
                                    <th>Installment Amount</th>
                                    <td><?= $purchase_land_detail[0]['bal_amount']; ?></td>
                                </tr>
                            </tbody>
                        </table>



                                
                        
                        <table class="table">
                            <tr>
                                <h5 class="text-center"><u>Conditions/Remarks[if any]</u></h5>
                            </tr>
                            <tbody>
                                <?php 
                                    $condition = $single_purchase[0]['conditions'];
                                    if(!empty($condition)){
                                ?>
                                    <tr>
                                        <td><?= nl2br($single_purchase[0]['conditions']); ?></td>
                                    </tr>    
                                <?php } else { ?>
                                    <tr>
                                        <td>No Conditions/Remarks</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>


                        <?php $total_amt = 0; ?>
                        <table class="table" style="margin-top: 50px;">
                            
                            <thead>
                                <tr>
                                    <td colspan="4">
                                        <h5 class="text-center"><u>Expenses </u></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_amt += $purchase_land_detail[0]['purchase_amount']; ?>
                                <tr>
                                    <td>Purchase</td>
                                    <td>Land Purchase</td>
                                    <td><?=$purchase_land_detail[0]['purchase_amount']?></td>
                                    <td><?= date('d-m-Y',strtotime($purchase_land_detail[0]['purchase_date'])); ?></td>
                                </tr>


                                <?php foreach ($this->purchase->get_expenses($single_purchase[0]['id']) as $key => $value) { ?>
                                    <?php $total_amt += $value['amount']; ?>
                                    <tr>
                                        <td>Expense</td>
                                        <td><?=$value['desc']?></td>
                                        <td><?=$value['amount']?></td>
                                        <td><?= date('d-m-Y',strtotime($value['date'])); ?></td>
                                    </tr>
                                <?php } ?>


                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td style="text-align: right;"></td>
                                    <td><h5>Total - <?=$total_amt;?></h5></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>

                        <table class="table" style="margin-top: 50px;">
                            
                            <thead>
                                <tr>
                                    <td colspan="4">
                                        <h5 class="text-center"><u>Witness Details </u></h5>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td><?= $single_purchase[0]['w_name'] ?></td>
                                    <td><?= $single_purchase[0]['w_mobile'] ?></td>
                                    <td><?= $single_purchase[0]['w_address'] ?></td>
                                </tr>

                                <tr>
                                    <td><?= $single_purchase[0]['w2_name'] ?></td>
                                    <td><?= $single_purchase[0]['w2_mobile'] ?></td>
                                    <td><?= $single_purchase[0]['w2_add'] ?></td>
                                </tr>


                            </tbody>
                        </table>


                    </div>

                </div>
            </div>    
       
    </div>
</section>


















