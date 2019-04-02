<!DOCTYPE html>
<html>

<body>
<style>
    
    /***************************************
             Boot Strap Css 
    ***************************************/
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







    thead {
        display: table-header-group;
    }
    
    .table {
        border-collapse: collapse !important;
    }
    .table td,
    .table th {
        background-color: #fff !important;
    }
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ddd !important;
    }
    th {
        text-align: left;
        width: 300px;
    }
    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
    }
    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
    .table > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }
    .table > caption + thead > tr:first-child > th,
    .table > colgroup + thead > tr:first-child > th,
    .table > thead:first-child > tr:first-child > th,
    .table > caption + thead > tr:first-child > td,
    .table > colgroup + thead > tr:first-child > td,
    .table > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .table > tbody + tbody {
        border-top: 2px solid #ddd;
    }
    .table .table {
        background-color: #fff;
    }
    .table-condensed > thead > tr > th,
    .table-condensed > tbody > tr > th,
    .table-condensed > tfoot > tr > th,
    .table-condensed > thead > tr > td,
    .table-condensed > tbody > tr > td,
    .table-condensed > tfoot > tr > td {
        padding: 5px;
    }
    .table-bordered {
        border: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > th,
    .table-bordered > tfoot > tr > th,
    .table-bordered > thead > tr > td,
    .table-bordered > tbody > tr > td,
    .table-bordered > tfoot > tr > td {
        border: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > thead > tr > td {
        border-bottom-width: 2px;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }
    .table-hover > tbody > tr:hover {
        background-color: #f5f5f5;
    }
    table col[class*="col-"] {
        position: static;
        display: table-column;
        float: none;
    }
    table td[class*="col-"],
    table th[class*="col-"] {
        position: static;
        display: table-cell;
        float: none;
    }
    .table > thead > tr > td.active,
    .table > tbody > tr > td.active,
    .table > tfoot > tr > td.active,
    .table > thead > tr > th.active,
    .table > tbody > tr > th.active,
    .table > tfoot > tr > th.active,
    .table > thead > tr.active > td,
    .table > tbody > tr.active > td,
    .table > tfoot > tr.active > td,
    .table > thead > tr.active > th,
    .table > tbody > tr.active > th,
    .table > tfoot > tr.active > th {
        background-color: #f5f5f5;
    }
    .table-hover > tbody > tr > td.active:hover,
    .table-hover > tbody > tr > th.active:hover,
    .table-hover > tbody > tr.active:hover > td,
    .table-hover > tbody > tr:hover > .active,
    .table-hover > tbody > tr.active:hover > th {
        background-color: #e8e8e8;
    }
    .table > thead > tr > td.success,
    .table > tbody > tr > td.success,
    .table > tfoot > tr > td.success,
    .table > thead > tr > th.success,
    .table > tbody > tr > th.success,
    .table > tfoot > tr > th.success,
    .table > thead > tr.success > td,
    .table > tbody > tr.success > td,
    .table > tfoot > tr.success > td,
    .table > thead > tr.success > th,
    .table > tbody > tr.success > th,
    .table > tfoot > tr.success > th {
        background-color: #dff0d8;
    }
    .table-hover > tbody > tr > td.success:hover,
    .table-hover > tbody > tr > th.success:hover,
    .table-hover > tbody > tr.success:hover > td,
    .table-hover > tbody > tr:hover > .success,
    .table-hover > tbody > tr.success:hover > th {
        background-color: #d0e9c6;
    }
    .table > thead > tr > td.info,
    .table > tbody > tr > td.info,
    .table > tfoot > tr > td.info,
    .table > thead > tr > th.info,
    .table > tbody > tr > th.info,
    .table > tfoot > tr > th.info,
    .table > thead > tr.info > td,
    .table > tbody > tr.info > td,
    .table > tfoot > tr.info > td,
    .table > thead > tr.info > th,
    .table > tbody > tr.info > th,
    .table > tfoot > tr.info > th {
        background-color: #d9edf7;
    }
    .table-hover > tbody > tr > td.info:hover,
    .table-hover > tbody > tr > th.info:hover,
    .table-hover > tbody > tr.info:hover > td,
    .table-hover > tbody > tr:hover > .info,
    .table-hover > tbody > tr.info:hover > th {
        background-color: #c4e3f3;
    }
    .table > thead > tr > td.warning,
    .table > tbody > tr > td.warning,
    .table > tfoot > tr > td.warning,
    .table > thead > tr > th.warning,
    .table > tbody > tr > th.warning,
    .table > tfoot > tr > th.warning,
    .table > thead > tr.warning > td,
    .table > tbody > tr.warning > td,
    .table > tfoot > tr.warning > td,
    .table > thead > tr.warning > th,
    .table > tbody > tr.warning > th,
    .table > tfoot > tr.warning > th {
        background-color: #fcf8e3;
    }
    .table-hover > tbody > tr > td.warning:hover,
    .table-hover > tbody > tr > th.warning:hover,
    .table-hover > tbody > tr.warning:hover > td,
    .table-hover > tbody > tr:hover > .warning,
    .table-hover > tbody > tr.warning:hover > th {
        background-color: #faf2cc;
    }
    .table > thead > tr > td.danger,
    .table > tbody > tr > td.danger,
    .table > tfoot > tr > td.danger,
    .table > thead > tr > th.danger,
    .table > tbody > tr > th.danger,
    .table > tfoot > tr > th.danger,
    .table > thead > tr.danger > td,
    .table > tbody > tr.danger > td,
    .table > tfoot > tr.danger > td,
    .table > thead > tr.danger > th,
    .table > tbody > tr.danger > th,
    .table > tfoot > tr.danger > th {
        background-color: #f2dede;
    }
    .table-hover > tbody > tr > td.danger:hover,
    .table-hover > tbody > tr > th.danger:hover,
    .table-hover > tbody > tr.danger:hover > td,
    .table-hover > tbody > tr:hover > .danger,
    .table-hover > tbody > tr.danger:hover > th {
        background-color: #ebcccc;
    }
    .table-responsive {
        min-height: .01%;
        overflow-x: auto;
    }
    
    
   
    tbody:before, tbody:after {
        display: none;
    }
    .text-left {
        text-align: left;
    }
    .text-right {
        text-align: right;
    }
    .text-center {
        text-align: center;
    }
    .text-justify {
        text-align: justify;
    }
    .pull-right {
        float: right !important;
    }
    h4{
        text-align: center;
        font-size: 17px;
        margin: 7px;
    }
    h3
    {
        text-align: center;
        font-size: 22px;
        margin: 7px;
    }
    .inst th{
                width: auto;
            }
            .ins-dt{
                margin-bottom: 10px;
            }
</style>





<div>

    <h3 class="text-center">

            <img width="120px" src="./<?=$this->config->config["logoFile"]?>" alt="" class="brand-image img-circle elevation-3">

    </h3>



    <h3 class="text-center"><u><b><?php echo $page_title; ?></b></u></h3>


     
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-5">
                    Number Of Seller(s) : <?=$single_purchase[0]['num_of_sellers']; ?>
                </div>        
            </div>

            <div class="col-md-6">
                <div class="col-md-5">
                    Number Of Purchaser(s) : <?=$single_purchase[0]['num_of_purchaser']; ?>
                </div> 
            </div>
        </div>
   


















   
    <h4 class="text-left">
        Number Of Purchaser(s) : <?=$single_purchase[0]['num_of_sellers']; ?>
    </h4>   

    <div style="margin-top:30px;margin-left: auto;margin-right: auto;text-transform: capitalize;font-size: 12px; clear: both;">

       
          <?php 
                $count = 0;
                foreach ($all_purchase_dynamic as $key) { $count++; 
            ?>

                <h3>Sellers <?= $count; ?> Details</h3>
                <table class="table">

                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td><?= $key['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Father Name/Husband/Gurdian's Name</th>
                            <td><?= $key['fa_name']; ?></td>
                        </tr>
                        <tr>
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
                            <th>Aadhaar Number</th>
                            <td><?= $key['aadhaar']; ?></td>
                        </tr>
                    </tbody>
                </table>
            
        <?php   
            }
        ?>

          


        <table class="table">
            <tr>
                <td colspan="2">
                    <h3>Land Details</h3>
               </td>
            </tr>   
            <tbody>
                <tr>
                    <th>Purchase Id</th>
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
                    <th>Payment Mode</th>
                    <td><?= $purchase_land_detail[0]['payment_mode']; ?></td>
                </tr>
                <tr>
                    <th>Payment Mode Detail</th>
                    <td><?= $purchase_land_detail[0]['payment_mode_detail']; ?></td>
                </tr>
                
            </tbody>
        </table>

        <table class="table">
            <tr>
                <td colspan="2">
                    <h3 >Installment Detail</h3>
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






        <table class="table inst">
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
                <?php 
                    $install = $installment_detail[0]['install_packges'];
                    if($install == "Yes"){
                        foreach ($installment_detail as $key) { ?>        

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
                <?php } }?>

            </tbody>
        </table>


        <table class="table">
            <tr>
                <td colspan="">
                    <h3>Conditions/Remarks[if any]</h3>
                </td>
            </tr>   
            <tbody>


                <?php if(!empty($single_purchase[0]['conditions'])){ ?>
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
                        
      
                   

    </div>
</div>    
</body>
</html>
