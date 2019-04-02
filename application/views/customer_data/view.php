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
                    <h3 class="card-title"><?php echo $page_title; ?></h3>
                </div>

                <div class="card-body">
                   

                    <div style="margin-top:30px;margin-left: auto;margin-right: auto;text-transform: capitalize;font-size: 8px; clear: both;">

                        <table class="table">

                            <tr>
                                <tr>
                                        <th>Selling Date</th>
                                        <td><?= _vdate($sale['date']); ?></td>
                                    </tr>
                            </tr>
                        </table>

                        <table class="table">

                            <tr>
                                <td colspan="2">
                                    <h5 class="text-center"><u>Installment Detail</u></h5>
                                </td>
                            </tr>

                            <tbody>
                                <tr>
                                    <th>Installment Packages</th>
                                    <td><?= $sale['install_packges']; ?></td>
                                </tr>
                                <tr>
                                    <th>No Of Installments</th>
                                    <td><?= $sale['no_of_installment']; ?></td>
                                </tr>
                                <tr>
                                    <th>Time Period</th>
                                    <td><?= $sale['time_installment']; ?></td>
                                </tr>
                                <tr>
                                    <th>Installment Amount</th>
                                    <td><?= $sale['selling_amount'] - $sale['adva_payment']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <?php if($sale['install_packges'] === "Yes") { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Due Date</th>
                                            <th>Installment Amount</th>
                                            <th>Installment Paid Amount</th>
                                            <th>Installment Remaining Amount</th>
                                            <th>Remaining Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($installment_detail as $key) { ?>        
                                            <tr>
                                                <td><?= $key['no_of_installment']; ?></td>
                                                <td><?= date('d-M-Y',strtotime($key['date'])); ?></td>
                                                <td><?= $key['instal_amount']; ?></td>
                                                <td><?= $key['instal_amount'] - $key['instal_remaining']; ?></td>
                                                <td><?= $key['instal_remaining']; ?></td>
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

                        
                        <table class="table">
                                <tr>
                                    <h5 class="text-center"><u>Customer Details</u></h5>
                                </tr>
                                <tbody>
                                    <tr>
                                        <th>Customer Id</th>
                                        <td>
                                            <?= $this->users->get_user($this->sel_product->get_co_name($sale['coust_name'])[0]['user_id'])[0]['user_type_id']; ?>
                                                
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>
                                            <?= $this->sel_product->get_co_name($sale['coust_name'])[0]['fi_name'].' '.$this->sel_product->get_co_name($sale['coust_name'])[0]['mi_name'].' '.$this->sel_product->get_co_name($sale['coust_name'])[0]['la_name']; ?>
                                                
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Birth Date</th>
                                        <td><?= _vdate($this->sel_product->get_co_name($sale['coust_name'])[0]['bdate']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td><?= $this->sel_product->get_co_name($sale['coust_name'])[0]['mobile'].' , '.$this->sel_product->get_co_name($sale['coust_name'])[0]['mobile2']; ?></td>
                                    </tr>
                                    <tr class="address">
                                        <th>Address</th>
                                        <td><?= nl2br($this->sel_product->get_co_name($sale['coust_name'])[0]['address']); ?></td>
                                    </tr>
                                    <tr class="">
                                        <th>City</th>
                                        <td><?= $this->sel_product->get_co_name($sale['coust_name'])[0]['city']; ?></td>
                                    </tr>
                                    <tr class="">
                                        <th>Pincode</th>
                                        <td><?= $this->sel_product->get_co_name($sale['coust_name'])[0]['pin_code']; ?></td>
                                    </tr>
                                    <tr class="">
                                        <th>State</th>
                                        <td><?= $this->sel_product->get_co_name($sale['coust_name'])[0]['state']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Photo</th>
                                        <td><img src="<?= base_url();?>uploads/<?= $this->users->get_user($this->sel_product->get_co_name($sale['coust_name'])[0]['user_id'])[0]['image']; ?>" style="width: 100px; height: 110px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        
                        <table class="table">

                            <tr>
                                <h5 class="text-center"><u>Product Details</u></h5>
                            </tr>

                            <tbody>
                                 <tr>
                                    <th>Product Id</th>
                                    <td><?= $this->sel_product->get_product_row($sale['product_id'])[0]['product_id']; ?></td>
                                </tr>
                                <tr>
                                    <th>Ploat Size(in Sq. Yd)</th>
                                    <td><?= $this->sel_product->get_product_row($sale['product_id'])[0]['ploat_land_yard']; ?></td>
                                </tr>
                                <tr>
                                    <th>Ploat Size(Hectares)</th>
                                    <td><?= $this->sel_product->get_product_row($sale['product_id'])[0]['ploat_size_ht']; ?></td>
                                </tr>
                                <tr>
                                    <th>Ploat Size(in Sq. Ft)</th>
                                    <td><?= $this->sel_product->get_product_row($sale['product_id'])[0]['ploat_size_sqft']; ?></td>
                                </tr>

                                <tr>
                                    <th>Plan Name</th>
                                    <td><?= $this->sel_product->get_product_row($sale['product_id'])[0]['plan_code']; ?></td>
                                </tr>
                                
                                
                            </tbody>
                        </table>

                        <table class="table">

                            <tr>
                                <h5 class="text-center"><u>Payment Details</u></h5>
                            </tr>

                            <tbody>
                                 <tr>
                                    <th>Selling Amount</th>
                                    <td><?= $sale['selling_amount']; ?></td>
                                </tr>
                                <tr>
                                    <th>Advance Payment</th>
                                    <td><?= $sale['adva_payment']; ?></td>
                                </tr>
                                <tr>
                                    <th>Remaining Amount</th>
                                    <td><?= $sale['selling_amount'] - $sale['adva_payment']; ?></td>
                                </tr>
                                <tr>
                                    <th>Payment Mode</th>
                                    <td><?= $sale['payment_mode']; ?></td>
                                </tr>
                                <tr>
                                    <th>Payment Mode Detail</th>
                                    <td><?= nl2br($sale['pay_detail']); ?></td>
                                </tr>
                                
                                
                            </tbody>
                        </table>

                        <table class="table">

                            <tr>
                                <h5 class="text-center"><u>Receipt Detail</u></h5>
                            </tr>

                            <tbody>
                                 <tr>
                                    <th>First Receipt Date</th>
                                    <td><?= _vdate($sale['first_receipt_date']); ?></td>
                                </tr>
                                <tr>
                                    <th>Receipt No</th>
                                    <td><?= $sale['receipt_no']; ?></td>
                                </tr>
                                <tr>
                                    <th>Book No./SR No</th>
                                    <td><?= $sale['book_no']; ?></td>
                                </tr>
                                <tr>
                                    <th>Agent Id</th>
                                    <td><?= $this->sel_product->get_agent_id($sale['created_by'])['user_type_id']; ?></td>
                                </tr>
                                
                                
                            </tbody>
                        </table>

                        <p></p>

                        <hr>
                        
                        <table>
                            <tr>
                                <th>Remarks</th>
                                <td><?= nl2br($sale['remarks']); ?></td>
                            </tr>
                        </table>

                        

                        
                    </div>

                </div>
            </div>    
       
    </div>
</section>


















