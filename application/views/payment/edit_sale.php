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
            <form method="post" action="<?= base_url();?>payment/sale_update" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                    	<div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Installment Detail</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <?php 
                                        $_bal_amount = $sale['deal_amount'] - $sale['adva_payment'];
                                        $_rem_amount = ($sale['remaining_amount'] + $sale['instal_amount']);
                                        $_paid_amount = $_bal_amount - $_rem_amount;
                                    ?>
                                	<div class="col-md-3">
                                        <div class="form-group">
                                            <label>Selling Amount</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Selling Amount" value="<?php echo $sale['deal_amount']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Advance Payment</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Advance Payment" value="<?php echo $sale['adva_payment']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Paid Amount</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Paid Amount" value="<?php echo $_paid_amount; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Remaining Amount</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Remaining Amount" value="<?php echo $_rem_amount; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Installment No.</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Installment No." value="<?php echo $sale['no_of_installment']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Installment Amount</label>
                                            <input class="form-control form-control-sm" type="text" name="amount_install" placeholder="Installment Amount" value="<?php echo $sale['instal_amount']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Due Date" value="<?php echo _vdate($sale['date']); ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Time</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Time" value="<?php echo $sale['time']; ?>" autocomplete="off" readonly>
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
                                            <label>Payment Date <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm datepicker" type="text" name="date" placeholder="Payment Date" value="<?= _vdate($payment['date']); ?>" autocomplete="off" readonly required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Payment Mode <span class="astrick">*</span></label>
                                            <select name="payment_mode" class="form-control form-control-sm"  required>
                                                <option value="">-- Select Payment Mode  --</option>
                                                <option value="Cash" <?php if($payment['pay_type'] == 'Cash'){ echo "selected"; } ?>>Cash</option>
                                                <option value="Cheque" <?php if($payment['pay_type'] == 'Cheque'){ echo "selected"; } ?>>Cheque</option>
                                                <option value="Bank Transfer" <?php if($payment['pay_type'] == 'Bank Transfer'){ echo "selected"; } ?>>Bank Transfer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Payment Mode Detail <span class="astrick">*</span></label>
                                            <textarea class="form-control form-control-sm" id="payment_mode_detail" type="text" name="payment_mode_detail" placeholder="Payment Mode Detail Ex. (Cheque No., Ref.No.)" autocomplete="off" required><?=$payment['pay_detail']?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Late Charges <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="number" name="late_charge" placeholder="Late Charges" step="0.01" value="<?=$payment['late_charge']?>" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id" value="<?=$payment['id']?>">
                                    

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
                                  <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-save"></i>&nbsp;Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
<!-- Main content -->
