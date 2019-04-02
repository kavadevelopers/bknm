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
            <form method="post" action="<?= base_url(); ?>expense/save" id="expence_form" enctype="product/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Expense Detail</h3>
                            </div>


                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            
                                            <label>Select Purchase Id<span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="purchase_id" autocomplete="off" required>
                                                <option value="">-- Select Purchase Id --</option>

                                                <?php foreach ($purchase_id as $key => $value) { ?>
                                                    <option value="<?= $purchase_id[$key]['id']; ?>" ><?= $purchase_id[$key]['purchase_id']; ?></option>
                                                <?php } ?>
                                                
                                            </select>
                                            <?php echo form_error('purchase_id'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Description <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="desc" placeholder="Description" value="<?php echo set_value('desc'); ?>" autocompleate="off" required>
                                            <?php echo form_error('desc'); ?>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Amount <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="amount" id="amount" placeholder="Amount" value="<?php echo set_value('amount'); ?>" autocompleate="off" readonly>
                                            <?php echo form_error('amount'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Date <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm datepicker" type="text" name="date" placeholder="Date" value="<?= set_value('date',date('d-m-Y'));?>" autocompleate="off" required readonly>
                                            <?php echo form_error('date'); ?>

                                        </div>
                                    </div>

                                    
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
                                                            <input class="form-control form-control-sm" id="added_amt1" type="text" placeholder="Amount For Payment" onkeyup="add_Advnce_payment();" name="paid[]" required readonly>
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
                            <div class="card-footer">
                                <div class="float-right">
                                  
                                  <a href="<?= base_url(); ?>expense" class="btn btn-danger">Cancel</a>

                                  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                    <!-- end here -->

                   
                </div>
            </form>    
        </div><!-- // container-fluid -->
    </section>
<!-- /.container-fluid -->

<script type="text/javascript">


function add_Advnce_payment(){
    length = parseFloat($('#add_row tr').length) + 1;
    total = parseFloat(0);
    for(i = 1;i <= length;i++)
    {   
        if($('#added_amt'+i).val() != ''){
           total += parseFloat($('#added_amt'+i).val());
        }
    }
    $('#amount').val(total);
}

var co_i = 1;
    function add_row() {
        co_i++;
        $('#add_row').append('<tr><td><select class="form-control form-control-sm select2a" name="parter_id[]"  onchange="get_balance_ajax(this.value,'+co_i+')" id="parter_id1" required><option value="">-- Select Investor Name --</option><?php foreach($Parterners as $key => $value){ ?><option value="<?=$value['id']?>"><?=$value['fullname'].' - '.$value['user_type_id']?></option><?php } ?></select></td><td><input id="main_amt'+co_i+'" class="form-control form-control-sm" type="text" value="" readonly></td><td> <input class="form-control form-control-sm col-md-12" id="added_amt'+co_i+'" type="text" placeholder="Amount For Payment" name="paid[]" onkeyup="add_Advnce_payment();" required readonly></td></tr>');
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
                url: "<?= base_url();?>Transaction/get_balance",
                data: "id="+par_id,
                cache: false,
                dataType:'json',
                success: function(html){

                    $('#main_amt'+row_id).val(html.balance);
                    $('#added_amt'+row_id).val('');
                    $('#added_amt'+row_id).removeAttr('readonly');
                }
            });
        }
        else
        {
            $('#main_amt'+row_id).val('');
            $('#added_amt'+row_id).val('');
            $('#added_amt'+row_id).attr('readonly','readonly');
            add_Advnce_payment();
        }
    }
        
   
</script>

<style type="text/css">
    .select2a{
        width: 100%;
    }
</style>

<script type="text/javascript">
  $(function(){
        
        $('#expence_form').submit(function(){
        length = parseFloat($('#add_row tr').length) + 1;
            for(i_new = 1;i_new <= length;i_new++)
            {   
                if(parseFloat($('#main_amt'+i_new).val()) < parseFloat($('#added_amt'+i_new).val())){
                    $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-times-circle',
                        message: 'Please Check Amount For Payment'
                    },{
                        type: 'danger'
                    }); 
                    $('#added_amt'+i_new).focus();
                    return false;
                }
            }

        });
    });
</script>
