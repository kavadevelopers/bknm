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
            <form method="post" id="sell_form" action="<?= base_url();?>payment/sell_pay" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                    	<div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Installment Detail / Sell Detail</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                
                                	<div class="col-md-3">
                                        <div class="form-group">
                                            <label>Selling Amount</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Selling Amount" value="<?php echo $sell_data['selling_amount']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Advance Payment</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Advance Payment" value="<?php echo $sell_data['adva_payment']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Paid Amount</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Paid Amount" value="<?php echo $payment; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Remaining Amount</label>
                                            <input class="form-control form-control-sm" type="text" name="sale_remaning_amt" placeholder="Remaining Amount" value="<?php echo $sell_data['rem_amount']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Installment No.</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Installment No." value="<?php echo $get_installment['no_of_installment']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Due Date" value="<?php echo _vdate($get_installment['date']); ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Time</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Time" value="<?php echo $get_installment['time']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Installment Amount</label>
                                                    <input class="form-control form-control-sm" type="text" name="amount_install"  id="amount_install" placeholder="Installment Amount" value="<?php echo $get_installment['instal_amount']; ?>" autocomplete="off" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Paid Amount</label>
                                                    <input class="form-control form-control-sm" type="text" name="amount_install"  id="amount_install" placeholder="Paid Amount" value="<?php echo $get_installment['instal_amount'] - $get_installment['instal_remaining']; ?>" autocomplete="off" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Installment Remaining Amount</label>
                                                    <input class="form-control form-control-sm" type="text" name="remaning_ins_pay"  id="remaning_ins_pay" placeholder="Installment Remaining Amount" value="<?php echo $get_installment['instal_remaining']; ?>" autocomplete="off" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </div>


                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Payment Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Payment Amount <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="instal_remaining" id="instal_remaining" placeholder="Payment Amount" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Payment Date <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm datepicker" type="text" name="date" placeholder="Payment Date" value="<?= date('d-m-Y'); ?>" autocomplete="off" readonly required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Payment Mode <span class="astrick">*</span></label>
                                            <select name="payment_mode" class="form-control form-control-sm"  required>
                                                <option value="">-- Select Payment Mode  --</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="Bank Transfer">Bank Transfer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Payment Mode Detail <span class="astrick">*</span></label>
                                            <textarea class="form-control form-control-sm" id="payment_mode_detail" type="text" name="payment_mode_detail" placeholder="Payment Mode Detail Ex. (Cheque No., Ref.No.)" autocomplete="off" required></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Late Charges <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="number" name="late_charge" placeholder="Late Charges" step="0.01" value="0" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <input type="hidden" name="installment_id" value="<?=$get_installment['id']?>">
                                    <input type="hidden" name="sell_id" value="<?=$get_installment['sell_product_id']?>">
                                    <input type="hidden" name="rem_amount" value="<?=$get_installment['remaining_amount']?>">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>payment/sell" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
<!-- Main content -->

<script type="text/javascript">
  $(function(){
        
        $('#sell_form').submit(function(){
           
            if(parseFloat($('#remaning_ins_pay').val()) < $('#instal_remaining').val())
            {
                $.notify({
                    title: '<strong></strong>',
                    icon: 'fa fa-times-circle',
                    message: 'Please Check Payment Amount'
                },{
                    type: 'danger'
                });
                $('#purchase_amount').focus();
                return false;
            }

    });
});
</script>