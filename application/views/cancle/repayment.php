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
    

            <form method="post" id="sell_form" action="<?= base_url();?>cancled/save_pay" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Plan Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Selling Amount</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Selling Amount" value="<?php echo $sell['selling_amount']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Advance Payment</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Advance Payment" value="<?php echo $sell['adva_payment']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Paid Amount</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Paid Amount" value="<?php echo (($sell['selling_amount'] - $sell['adva_payment']) - $sell['rem_amount']) + $sell['adva_payment']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Repayment Amount</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Paid Amount" value="<?php echo (($sell['selling_amount'] - $sell['adva_payment']) - $sell['rem_amount']) + $sell['adva_payment']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Total Repayments</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Paid Amount" value="<?php echo $repay; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Remaning Repayments</label>
                                            <input class="form-control form-control-sm" type="text" id="remaning" placeholder="Paid Amount" value="<?php echo ((($sell['selling_amount'] - $sell['adva_payment']) - $sell['rem_amount']) + $sell['adva_payment']) - $repay; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                </div>

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
                                  <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <input type="hidden" name="sell_id" value="<?=$sell['id']?>">
                <input type="hidden" name="type" value="<?=$type;?>">

            </form>



        </div>
    </section>

<script type="text/javascript">
  $(function(){
        
        $('#sell_form').submit(function(){
           
            if(parseFloat($('#remaning').val()) < $('#instal_remaining').val())
            {
                $.notify({
                    title: '<strong></strong>',
                    icon: 'fa fa-times-circle',
                    message: 'Please Check Payment Amount'
                },{
                    type: 'danger'
                });
                $('#instal_remaining').focus();
                return false;
            }

    });
});
</script>
