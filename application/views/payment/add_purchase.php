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
            <form method="post" action="<?= base_url();?>payment/purchase_pay" id="sell_form" enctype="multipart/form-data">
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
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Selling Amount" value="<?php echo $purchase['share']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Advance Payment</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Advance Payment" value="<?php echo $purchase['advance']; ?>" autocomplete="off" readonly>
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
                                            <input class="form-control form-control-sm" type="text" name="sale_remaning_amt" placeholder="Remaining Amount" value="<?php echo $purchase['balance']; ?>" autocomplete="off" readonly>
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

                                </div>


                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Installment Amount</label>
                                                <input class="form-control form-control-sm" type="text" name="amount_install" placeholder="Installment Amount" value="<?php echo $get_installment['instal_amount']; ?>" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Paid Amount</label>
                                                <input class="form-control form-control-sm" type="text" name="amount_install"  id="amount_install" placeholder="Paid Amount" value="<?php echo $get_installment['instal_amount'] - $get_installment['instl_remaning']; ?>" autocomplete="off" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Installment Remaining Amount</label>
                                                <input class="form-control form-control-sm" type="text" name="remaning_ins_pay"  id="remaning_ins_pay" placeholder="Installment Remaining Amount" value="<?php echo $get_installment['instl_remaning']; ?>" autocomplete="off" readonly>
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

                                    <input class="form-control form-control-sm" type="hidden" name="late_charge" placeholder="Late Charges" value="0" autocomplete="off">

                                    <input type="hidden" name="installment_id" value="<?=$get_installment['id']?>">
                                    <input type="hidden" name="purchase_id" value="<?=$get_installment['purchase_main_id']?>">
                                    <input type="hidden" name="rem_amount" value="<?=$get_installment['remaining_amount']?>">
                                    <input type="hidden" name="saler_id" value="<?= $id; ?>">

                                </div>
                            </div>
                        </div>

                        <div class="card card-info">

                            <div class="card-body">

                        <div class="col-md-12">
                                    <div class="row">
                                        <table class="table" id="balance_A">
                                            <thead>
                                                <tr>
                                                    <th style="width: 33.33%;">Investor Name</th>
                                                    <th style="width: 33.33%;">Balance</th>
                                                    <th style="width: 33.33%;">Amount For Payment</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select class="form-control form-control-sm select2" onchange="get_balance_ajax(this.value,'1')" name="parter_id[]" id="parter_id1" required>
                                                            <option value="">-- Select Investor Name --</option>
                                                            <?php foreach($Parterners as $key => $value){ ?>
                                                                <option value="<?=$value['id']?>"><?=$value['fullname'].' - '.$value['user_type_id']?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input id="main_amt1" class="form-control form-control-sm" type="text" value="" readonly>
                                                    </td>
                                                    <td>
                                                        <input class="form-control form-control-sm" id="added_amt1" type="text" placeholder="Amount For Payment"  name="paid[]" required readonly>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody id="add_row">
                                            
                                    
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" style="text-align: right;">
                                                        <button type="button" class="btn btn-success btn-sm" onclick="add_row();" title="Add Row"><i class="fa fa-plus"></i> Add Row</button>
                                                        <button type="button" class="btn btn-sm btn-danger" id="remove_row'+i+'" onclick="remove()"><i class="fa fa-close"></i> Remove Last</button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
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
                                  <a href="<?= base_url(); ?>payment/purchase" class="btn btn-danger">Cancel</a>
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

            var total_payed = parseFloat(0.00);
            length = parseFloat($('#balance_A tbody tr').length) + 1;
            for(i_nre = 1;i_nre <= length;i_nre++)
            {   
                
                if($('#added_amt'+i_nre).val() != ''){
                    
                    total_payed += parseFloat($('#added_amt'+i_nre).val());
                }
            }
            
            if(parseFloat($('#instal_remaining').val()) != total_payed){
                $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-times-circle',
                        message: 'Payment Amount And Added Amount Must Be Same'
                    },{
                        type: 'danger'
                    }); 
                $('#instal_remaining').focus();
                return false;
            }

    });
});


  var co_i = 1;
    function add_row() {
        co_i++;
        $('#add_row').append('<tr><td><select class="form-control form-control-sm select2a" name="parter_id[]"  onchange="get_balance_ajax(this.value,'+co_i+')" id="parter_id1" required><option value="">-- Select Investor Name --</option><?php foreach($Parterners as $key => $value){ ?><option value="<?=$value['id']?>"><?=$value['fullname'].' - '.$value['user_type_id']?></option><?php } ?></select></td><td><input id="main_amt'+co_i+'" class="form-control form-control-sm" type="text" value="" readonly></td><td> <input class="form-control form-control-sm col-md-12" id="added_amt'+co_i+'" type="text" placeholder="Amount For Payment" name="paid[]" required readonly></td></tr>');
        $('.select2a').select2();
        return false;
    }

    function remove(){
        $('#add_row tr:last').remove();
        co_i--;
        return false;
    }

    function get_balance_ajax(par_id,row_id)
    {
        
        if(par_id != ''){
                $.ajax({
                type:'POST',
                url: "<?= base_url();?>transaction/get_balance",
                data: "id="+par_id,
                cache: false,
                dataType:'json',
                success: function(html){

                    $('#main_amt'+row_id).val(html.balance);
                    $('#added_amt'+row_id).val('');
                    if(html.balance > 0){
                        $('#added_amt'+row_id).removeAttr('readonly');
                    }
                    
                }
            });
        }
        else
        {
            $('#main_amt'+row_id).val('');
            $('#added_amt'+row_id).val('');
            $('#added_amt'+row_id).attr('readonly','readonly');
                    
        }
    }
</script>
