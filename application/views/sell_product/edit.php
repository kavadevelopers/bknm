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
            <form method="post" id="selling_form" action="<?= base_url(); ?>sell_product/update" enctype="product/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Create/Add Prodect</h3>
                            </div>
                            
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Coustmer Name <span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="coust_name" autocomplete="off">
                                            
                                                <?php 
                                                    foreach ($customer as $key) { 
                                                        $customer_details = $this->users->customer_detail($key['id']);

                                                ?>
                                                    <option value="<?= $key['id']; ?>" <?php if($cust[0]['coust_name'] == $key['id']){ echo "selected"; }?>> 
                                                        <?= $customer_details[0]['fi_name'].' '.$customer_details[0]['la_name'];?>
                                                    </option>
                                                <?php }  ?>
                                            
                                            </select>
                                        </div>               
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Id<span class="astrick">*</span></label>
                                            <select name="product_id" id="Product" class="form-control form-control-sm select2" onchange="Produ_id(this.value)" required>
                                                <?php   
                                                    foreach ($get_product_all as $key) { 
                                                ?>

                                                        
                                                        <option value="<?= $key['id'];?>" <?php if($cust[0]['product_id'] == $key['id']) { echo "selected"; } ?>>
                                                        <?= $key['product_id'];?>
                                                        </option>
                                                  
                                                <?php } ?>
                                                 
                                            </select>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Selling Amount<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="selling_amount" type="text" name="selling_amount" placeholder="Selling Amount" value="<?= $cust[0]['selling_amount']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ploat Size(in Sq. Ft) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="ploat_size" type="text" name="ploat_size" placeholder="Ploat Size(in Sq. Ft)" value="<?= $cust[0]['ploat_size']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Advance Payment <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="adva_payment" onkeyup="ramining_amount()" id="adva_payment" placeholder="Advance Payment" value="<?= $cust[0]['adva_payment']; ?>" autocomplete="off" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Remaining Amount <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="rem_amount" type="text" name="rem_amount" value="<?= $cust[0]['rem_amount']; ?>" placeholder="Remaining Amount" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Payment Mode <span class="astrick">*</span></label>
                                            <select name="payment_mode" class="form-control form-control-sm" required>
                                                <option value="">-- Select Payment Mode  --</option>
                                                <option value="Cash" <?php if($cust[0]['payment_mode'] == "Cash") { echo "selected"; } ?>>Cash</option>
                                                <option value="Cheque" <?php if($cust[0]['payment_mode'] == "Cheque") { echo "selected"; } ?>>Cheque</option>
                                                <option value="Bank Transfer" <?php if($cust[0]['payment_mode'] == "Bank Transfer") { echo "selected"; } ?>>Bank Transfer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="date" id="Idate" placeholder="Date" value="<?= date('d-m-Y',strtotime($cust[0]['date'])); ?>" required>
                                        </div>
                                    </div>

                               
                                </div>
                            </div>
                        </div>

                        <div class="card card-info">
                            
                            <div class="card-header">
                                    <h3 class="card-title">Installment Detail</h3>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Installment Packages <span class="astrick">*</span></label>
                                                <select name="install_packges" class="form-control form-control-sm" id="install_packges" onchange="Install_Detail();" required>
                                                    <option value="">-- Select Installment Packages --</option>
                                                    <option value="Yes" <?php if($cust[0]['install_packges'] == 'Yes') { echo 'selected'; } ?>>Yes</option>
                                                    <option value="No" <?php if($cust[0]['install_packges'] == 'No') { echo 'selected'; } ?>>No</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="row" id="installment">
                                            <?php if($cust[0]['install_packges'] == 'Yes') { ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>No. of Installment <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="no_of_installment" placeholder="No. of Installment" autocomplete="off" value="<?= $cust[0]['no_of_installment'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Time <span class="astrick">*</span></label>
                                                    <select name="time" class="form-control form-control-sm" required>
                                                        <option value="">-- Select Time --</option>
                                                        <option value="Monthly" <?php if($cust[0]['time_installment'] == 'Monthly') { echo 'selected'; } ?>>Monthly</option>
                                                        <option value="Quarterly" <?php if($cust[0]['time_installment'] == 'Quarterly') { echo 'selected'; } ?>>Quarterly</option>
                                                        <option value="Half Yearly" <?php if($cust[0]['time_installment'] == 'No') { echo 'selected'; } ?>>Half Yearly</option>
                                                        <option value="Yearly" <?php if($cust[0]['time_installment'] == 'Yearly') { echo 'selected'; } ?>>Yearly</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Deal Amount / Total Amount <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="deal_amount" placeholder="Deal Amount / Total Amount" autocomplete="off" value="<?= $cust[0]['selling_amount'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Advance Payment <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="adva_payment" placeholder="Advance Payment" autocomplete="off" value="<?= $cust[0]['adva_payment'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Installment Amount / Reamaning Amount <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="instal_amount" placeholder="Installment Amount / Reamaning Amount" autocomplete="off" value="<?= $cust[0]['rem_amount'] ?>" required>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        </div>
                                        
                                                                   
                                    </div><!-- row -->
                                </div>
                        </div><!--  card-info -->

                        <div>
                            <input type="hidden" name="id" value="<?= $cust[0]['id']; ?>">
                        </div>          

                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>create_product" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Save</button>
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
     
    $(function(){
        //Initialize Select2 Elements
        $('.select2').select2()

        //  Date Created
        $('#Idate').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        });

        $('#selling_form').submit(function(){
            if($('#install_packges').val() == 'Yes'){
                if($('#rem_amount').val() <= 0)
                {
                    $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-times-circle',
                        message: 'Please Check Remaining Amount'
                    },{
                        type: 'danger'
                    });
                    return false;
                }
            }
            else
            {
                if($('#rem_amount').val() < 0)
                {
                    $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-times-circle',
                        message: 'Please Check Remaining Amount'
                    },{
                        type: 'danger'
                    });
                    return false;
                }
            }
        })

    });    

    //Form  Error Notify 
    <?php if(!empty(validation_errors())){ ?>

        $.notify({
            title: '<strong></strong>',
            icon: 'fa fa-times-circle',
            message: 'Your Form Was Not Submmited Check Your Form'
        },{
            type: 'danger'
        }); 
    <?php } ?>

    
    // Product Id 
    function Produ_id(id){
        $.ajax({
            type:'POST',
            url: "<?= base_url();?>sell_product/get_product_data",
            data: "id="+id,
            cache: false,
            dataType:'json',
            success: function(html){
                $("#selling_amount").val(parseFloat(html[0].selling_amount));
                $("#ploat_size").val(html[0].ploat_size);
                ramining_amount();
            }
        });
    } 

    // Get Ramining Amount
    function ramining_amount(){
       
       if($('#selling_amount').val() != '' && $('#adva_payment').val() != '')
       {
            var advnce = parseFloat($('#adva_payment').val());
            var selling_amt = parseFloat($('#selling_amount').val());
            $('#rem_amount').val(selling_amt - advnce);
            Install_Detail();
       }
       else{
            $('#rem_amount').val('');
            Install_Detail();
       }
    }     



    // Installment Detail
    function Install_Detail(){
        var installment = $('#install_packges').val();
        $('#installment').html('');
        if(installment == 'Yes'){
            $('#installment').append('<div class="col-md-4"><div class="form-group"><label>No. of Installment <span class="astrick">*</span></label><input class="form-control form-control-sm" type="text" name="no_of_installment" placeholder="No. of Installment" autocomplete="off" required></div></div><div class="col-md-4"><div class="form-group"><label>Time <span class="astrick">*</span></label><select name="time" class="form-control form-control-sm" required><option>-- Select Time --</option><option value="Monthly">Monthly</option><option value="Quarterly">Quarterly</option><option value="Half Yearly">Half Yearly</option><option value="Yearly">Yearly</option></select></div></div><div class="col-md-4"><div class="form-group"><label>Deal Amount / Total Amount <span class="astrick">*</span></label><input class="form-control form-control-sm" type="text" name="deal_amount" placeholder="Deal Amount / Total Amount" autocomplete="off" required readonly></div></div><div class="col-md-4"><div class="form-group"><label>Advance Payment <span class="astrick">*</span></label><input class="form-control form-control-sm" type="text" name="adva_paymenta" placeholder="Advance Payment" autocomplete="off" required readonly></div></div><div class="col-md-4"><div class="form-group"><label>Installment Amount / Reamaning Amount <span class="astrick">*</span></label><input class="form-control form-control-sm" type="text" name="instal_amount" placeholder="Installment Amount / Reamaning Amount" autocomplete="off" required readonly></div></div>');
                if($('#adva_paymenta').val() != '')
                {
                    $("[name='adva_paymenta']").val($('#adva_payment').val());
                    $("[name='deal_amount']").val($('#selling_amount').val());
                    $("[name='instal_amount']").val($('#rem_amount').val());
                }else{
                    $("[name='adva_paymenta']").val('');
                    $("[name='deal_amount']").val('');
                    $("[name='instal_amount']").val('');
                }
           return false;
        }

    }
</script>