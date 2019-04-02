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
            <form method="post" id="selling_form" action="<?= base_url();?>sell_product/save" enctype="product/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="card card-info"> 
                                <div class="card-header">
                                    <h3 class="card-title">Customer And Product Detail</h3>
                                </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                           
                                            <label>Coustmer Name <span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="coust_name" onchange="add_booking(this.value);" autocomplete="off" required>
                                                
                                                
                                                <?php 
                                                    $row = count($customer);
                                                    echo $row;
                                                    if($row >= 1){ ?>
                                                        <option value="">-- Select Coustmer Name --</option>
                                                    <?php   foreach ($customer as $key) { 
                                                            $customer_details = $this->users->customer_detail($key['id']);
                                                    ?>
                                                        <option value="<?= $key['id'];?>" <?php if($key['id'] == set_value('coust_name')) { echo "selected"; } ?>>
                                                        <?= $customer_details[0]['fi_name'].' '.$customer_details[0]['la_name'];?>
                                                        </option>
                                                  
                                                <?php 
                                                            } 
                                                    }
                                                    else
                                                    {
                                                ?>
                                                    <option value="">Coustmer Name Not Found Please Add Coustmer</option> 
                                                <?php } ?>

                                          </select>
                                          
                                        </div>               
                                    </div>
                                    
                                    

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Id<span class="astrick">*</span></label>
                                            <select name="product_id" id="Product" class="form-control form-control-sm select2" onchange="Produ_id(this.value)" required>
                                                <?php 
                                                    $row = count($get_product_all);
                                                    echo $row;

                                                    if($row >= 1){ ?>
                                                        <option value="">-- Select Product Id --</option>
                                                <?php   foreach ($get_product_all as $key) { 

                                                ?>

                                                        
                                                        <option value="<?= $key['id'];?>" <?php if($key['product_id'] == set_value('product')) { echo "selected"; } ?>>
                                                        <?= $key['product_id'];?>
                                                        </option>
                                                  
                                                <?php 
                                                            } 
                                                    }
                                                    else
                                                    {   
                                                ?>
                                                    <option value="">Product Id Not Found Please Add Product</option>
                                                        
                                                <?php } ?>
                                            </select>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="date" id="Idate" placeholder="Date" value="<?= date('d-m-Y');?>" required readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Plot Size(in Sq. Yd) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="ploat_size_yrd" type="text" name="ploat_size_yrd" placeholder="Plot Size(in Sq. Yd)" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Plot Size(Hectares) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="ploat_size_h" type="text" name="ploat_size_h" placeholder="Plot Size(Hectares)" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Plot Size(in Sq. Ft) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="ploat_size" type="text" name="ploat_size" placeholder="Plot Size(in Sq. Ft)" autocomplete="off" readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Booking</label>
                                            <select name="booking" id="booking" class="form-control form-control-sm" onchange="get_booking_data(this.value);">
                                                
                                                <option value="">No Bookings</option>        
                                                
                                            </select>
                                            
                                        </div>
                                    </div>
                                    

                                    

                                </div><!-- // Row -->
                            </div><!-- // Card Body -->
                        </div><!-- // Card Info -->


                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Payment Detail</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Selling Amount<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="selling_amount" type="text" name="selling_amount" placeholder="Selling Amount" value="<?= set_value('selling_amount');?>" readonly>
                                            <?php echo form_error('selling_amount'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Advance Payment <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="adva_payment" onkeyup="sell_ramining_amount()" onblur="" id="adva_payment" placeholder="Advance Payment" autocomplete="off" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Remaining Amount <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="rem_amount" type="text" name="rem_amount" placeholder="Remaining Amount" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Payment Mode <span class="astrick">*</span></label>
                                            <select name="payment_mode" class="form-control form-control-sm" required>
                                                <option value="">-- Select Payment Mode  --</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="Bank Transfer">Bank Transfer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Payment Mode Detail <span class="astrick">*</span></label>
                                            <textarea class="form-control form-control-sm" id="payment_mode_detail" type="text" name="payment_mode_detail" placeholder="Payment Mode Detail Ex. (Cheque No., Ref.No.)" autocomplete="off" required=""></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">     
                                        <div class="form-group">
                                          <label>Plan Name <span class="astrick">*</span></label>
                                          <select class="form-control-sm select2" name="plan_code" id="plan_code" onchange="data_get();" style="width: 100%;" autocomplete="off" required>
                                           
                                            <?php 

                                                $row = count($get_plan_code);

                                                if($row >= 1){ ?>
                                                    <option value="">-- Select Plan Name --</option>

                                                    <?php foreach ($get_plan_code as $key) { ?>          
                                                        
                                                        <option value="<?= $key['id'];?>" <?php if($key['plan_code'] == set_value('plan_code')) { echo "selected"; } ?>>
                                                        <?= $key['plan_code'];?>
                                                        </option>

                                            <?php 
                                                        } 
                                                }
                                                else
                                                {   
                                            ?>
                                                <option value="">Plan Code Not Found Please Add Plan Code</option>
                                                    
                                            <?php } ?>
                                            

                                          </select>
                                          <?php echo form_error('plan_code'); ?>
                                        </div>
                                    </div>   

                                </div>
                            </div>
                        </div>


                          <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Receipt Detail</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>First Receipt Date<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?= date('d-m-Y'); ?>" type="text" name="first_receipt_date" id="first_receipt_date" placeholder="First Receipt Date" readonly required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Receipt No. <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="receipt_no" placeholder="Receipt No." autocomplete="off" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Book No./SR No. <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="book_no" placeholder="Receipt No." autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Agent Id</label>
                                            <input class="form-control form-control-sm" type="text" name="" placeholder="Agent Id" autocomplete="off" value="<?= $this->session->userdata('user_type_id'); ?>" readonly>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <input type="hidden" name="" id="hidden_month" value="">
                        <div class="card card-info">
                            
                            <div class="card-header">
                                    <h3 class="card-title">Installment Detail</h3>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                         
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Installment Packages <span class="astrick">*</span></label>
                                                <select name="install_packges" class="form-control form-control-sm" id="install_packges" onchange="" required>
                                                   <option value="No">No</option>
                                                   
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row" id="installment">
                                            
                                        </div>
                                        
                                                                   
                                    </div><!-- row -->
                                </div>
                        </div><!--  card-info -->     


                        <div class="card card-info">
                            
                            <div class="card-header">
                                <h3 class="card-title">Remarks</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Remarks or Condition</label>
                                            <textarea class="form-control form-control-sm" rows="4" type="text" name="remarks" placeholder="Remarks or Condition" autocomplete="off" ></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>  

                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>sell_product" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                        <!-- end here -->

                    </div>
                </div><!-- // Row -->
            </form>    
        </div><!-- // container-fluid -->
    </section>
<!-- /.container-fluid -->

<script type="text/javascript">
    
     
    $(function(){
        
        //Initialize Select2 Elements
        $('.select2').select2()

        //First Receipt Date
        $('#first_receipt_date').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        });

        //  Date Created
        $('#Idate').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        });

        $('#selling_form').submit(function(){
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
        })

    });    

    // Product Id 
    function Produ_id(id){
        if(id != '')
        {
            $.ajax({
                type:'POST',
                url: "<?= base_url();?>sell_product/get_product_data",
                data: "id="+id,
                cache: false,
                dataType:'json',
                success: function(html){
                    $("#selling_amount").val(parseFloat(html[0][0].selling_amount));
                    $("#ploat_size_yrd").val(html[0][0].ploat_land_yard);
                    $("#ploat_size").val(html[0][0].ploat_size_sqft);
                    $("#ploat_size_h").val(html[0][0].ploat_size_ht);
                    //$("#hidden_month").val(html[1][0].month);
                    sell_ramining_amount();
                    
                }
            });
        }
        else
        {
            $("#selling_amount").val('');
            $("#ploat_size_yrd").val('');
            $("#ploat_size").val('');
            $("#ploat_size_h").val('');
            //$("#hidden_month").val(0);
            sell_ramining_amount();
        }
    } 

    // Get Ramining Amount
    function sell_ramining_amount(){
       
       if($('#selling_amount').val() != '' && $('#adva_payment').val() != '')
       {
            var advnce = parseFloat($('#adva_payment').val());
            var selling_amt = parseFloat($('#selling_amount').val());
            $('#rem_amount').val(selling_amt - advnce);
            //Installment_Sell();
            add_ins_amounts_sell();
       }
       else{
            $('#rem_amount').val('');
            //Installment_Sell();
            add_ins_amounts_sell();
       }
    }   


    <?php if(!empty(validation_errors())){ ?>

        $.notify({
            title: '<strong></strong>',
            icon: 'fa fa-times-circle',
            message: 'Your Form Was Not Submmited Check Your Form'
        },{
            type: 'danger'
        }); 
    <?php } ?>






    function data_get()
    {
        $.ajax({
                type:'POST',
                url: "<?= base_url();?>sell_product/get_plan_data",
                data: "id="+$('#plan_code').val(),
                cache: false,
                dataType:'json',
                success: function(html){
                    Installment_Sell(html[0].month);
                    $('#hidden_month').val(html[0].month);
                }
            });
            
    }
     function Installment_Sell(valu){
        if(valu != ""){
            var time_ward = valu;
            

            if(time_ward > 0 && time_ward != ''){

                
                    $('#install_packges').html('');
                    $('#install_packges').append('<option value="Yes">Yes</option>');

                 
                        if(time_ward <= 2){
                            op_time = '<option value="Monthly" >Monthly</option>';
                        }

                        if(time_ward <= 5 && time_ward > 2){
                            op_time = '<option value="Monthly">Monthly</option><option value="Quarterly">Quarterly</option>';
                        }

                        if(time_ward <= 11 && time_ward > 5){
                            op_time = '<option value="Monthly">Monthly</option><option value="Quarterly">Quarterly</option><option value="Half Yearly">Half Yearly</option>';
                        }

                        if(time_ward >= 12 && time_ward > 11){
                            op_time = '<option value="Monthly">Monthly</option><option value="Quarterly">Quarterly</option><option value="Half Yearly">Half Yearly</option><option value="Yearly">Yearly</option>';
                        }

                            $('#installment').html('');
                            $('#installment').append('<div class="col-md-4"> <div class="form-group"> <label>Time <span class="astrick">*</span> </label> <select name="time" class="form-control form-control-sm" id="time" onchange="Install_Time_Cell();" required> <option value="">-- Select Time --</option> '+op_time+' </select> </div></div><div class="col-md-4"> <div class="form-group"> <label>No. of Installment <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="number" name="no_of_installment" id="no_of_installment" placeholder="No. of Installment" autocomplete="off" readonly></div></div><div class="col-md-4"> <div class="form-group"> <label>Installment Amount <span class="astrick">*</span> </label> <input id="ins_amount_count" class="form-control form-control-sm" type="text" name="" placeholder="Installment Amount" autocomplete="off" readonly></div></div><div class="col-md-4"> <div class="form-group"> <label>Deal Amount / Total Amount <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="deal_amount" placeholder="Deal Amount / Total Amount" autocomplete="off" required readonly></div></div><div class="col-md-4"> <div class="form-group"> <label>Advance Payment <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="adva_payment" placeholder="Advance Payment" autocomplete="off" required readonly></div></div><div class="col-md-4"> <div class="form-group"> <label>Installment Amount / Reamaning Amount <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="instal_amount" id="rem_amount" placeholder="Installment Amount / Reamaning Amount" autocomplete="off" required readonly></div></div>');
                                add_ins_amounts_sell();
                   

            }
            else
            {
                $('#install_packges').html('');
                $('#install_packges').append('<option value="No">No</option>');
                $('#installment').html('');
            }
        }
        else
        {
            alert();
            $('#install_packges').html('');
            $('#install_packges').append('<option value="No">No</option>');
            $('#installment').html('');
        }

    }

    function add_ins_amounts_sell(){
      if($('#adva_payment').val() != '')
          {

              $("[name='deal_amount']").val($('#selling_amount').val());
              $("[name='adva_payment']").val($('#adva_payment').val());
              $("[name='instal_amount']").val($('#rem_amount').val());

          }else{
              $("[name='deal_amount']").val('');
              $("[name='adva_payment']").val('');
              $("[name='instal_amount']").val('');

          }
    }

     function Install_Time_Cell(){
        
        var time = $('#time').val();
        var time_ward = parseFloat($('#hidden_month').val());

        if(time == 'Monthly'){

            $('#no_of_installment').val(time_ward);
            $('#ins_amount_count').val(parseFloat($('#rem_amount').val()) / time_ward );
        }
        
        if(time == 'Quarterly'){

            round = time_ward / 3;
            $('#ins_amount_count').val(parseFloat($('#rem_amount').val()) / parseInt(round) );
            $('#no_of_installment').val(parseInt(round));
        }

        if(time == 'Half Yearly'){

            round = time_ward / 6;
            $('#ins_amount_count').val(parseFloat($('#rem_amount').val()) / parseInt(round) );
            $('#no_of_installment').val(parseInt(round));
        }

        if(time == 'Yearly'){

            round = time_ward / 12;
            $('#ins_amount_count').val(parseFloat($('#rem_amount').val()) / parseInt(round) );
            $('#no_of_installment').val(parseInt(round));
        }


    }

    function add_booking(value)
    {
        $.ajax({
            type:'POST',
            url: "<?= base_url();?>sell_product/get_bookings",
            data: "id="+value,
            success: function(html){
                $('#booking').html('');
                $('#booking').html(html);
            }
        });
    }

    function get_booking_data(id)
    {
        if(id != '')
        {
            $.ajax({
                type:'POST',
                url: "<?= base_url();?>sell_product/get_booking_data",
                data: "id="+id,
                cache: false,
                dataType:'json',
                success: function(json){

                    
                    $('#adva_payment').val(parseFloat(json[0].adva_payment) + ((parseFloat(json[0].selling_amount) - parseFloat(json[0].adva_payment)) - parseFloat(json[0].rem_amount)));
                    $('#adva_payment').attr('readonly',true);
                    sell_ramining_amount();

                }
            });
        }
        else{

            $('#adva_payment').val('');
            $('#adva_payment').removeAttr('readonly');
            sell_ramining_amount();
        }

    }






     // Installment Detail
   
</script>   