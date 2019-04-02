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
            <form method="post" onsubmit="return more_lan();" action="<?= base_url(); ?>create_product/save" enctype="product/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Create/Add Product</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Land Location/Name <span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="purchase_id" id="purchase_id" onchange="Lan_Size();" autocomplete="off" required>
                                                <?php 
                                                    $row = count($get_purchase_id);

                                                    if($row >= 1){ ?>
                                                        <option value="">-- Select Land Location/Name --</option>
                                                       <?php foreach ($get_purchase_id as $key) { ?>

                                                        
                                                        <option value="<?= $key['purchase_id'];?>" <?php if($key['purchase_id'] == set_value('purchase_id')) { echo "selected"; } ?>>
                                                        <?= $key['purchase_id'];?>
                                                        </option>
                                                  
                                                <?php 
                                                            } 
                                                    }
                                                    else
                                                    {   
                                                ?>
                                                    <option value="">Purchase Id Not Found Please Add Purchase</option>
                                                        
                                                <?php } ?>
                                            </select>
                                          <?php echo form_error('purchase_id'); ?>
                                        </div>               
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Id <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="product_id" placeholder="Product Id" value="<?php echo set_value('product_id'); ?>" autocomplete="off" required>
                                            <?php echo form_error('product_id'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="date" id="Idate" placeholder="Date" value="<?php echo set_value('date'); ?>" autocomplete="off" required>
                                            <?php echo form_error('date'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Land area (in Sq. Yd) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="total_land_yard" id="total_land_yard" value="<?php echo set_value('total_land_yard'); ?>" placeholder="Total Land area (in Yard)" autocomplete="off" readonly >
                                            <?php echo form_error('total_land_yard'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Land area (in Hectares) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="total_land_ht" id="total_land_ht" placeholder="Total Land area (in Hectares)" value="<?php echo set_value('total_land_ht'); ?>" autocomplete="off" readonly>
                                            <?php echo form_error('total_land_ht'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Land area(in Sq. Ft) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="lan_size_sqft" id="lan_size_sqft" placeholder="Total Land area (in Hectares)" value="<?php echo set_value('lan_size_sqft'); ?>" autocomplete="off" readonly>
                                            <?php echo form_error('lan_size_sqft'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Plot Size (in Sq. Yd) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="ploat_land_yard" id="total_land_yrd" onkeyup="hecter('y',this.value); Rem_land();" value="<?php echo set_value('ploat_land_yard'); ?>" placeholder="Total Land area (in Yard)" autocomplete="off" required>
                                            <?php echo form_error('ploat_land_yard'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Plot Size (in Hectares)<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="ploat_size_ht" id="total_land_hec" onkeyup="hecter('h',this.value); Rem_land();" placeholder="Plot Size" value="<?php echo set_value('ploat_size_ht'); ?>" step="0.01" min="0" autocomplete="off" required>
                                            <?php echo form_error('ploat_size_ht'); ?>
                                        </div>
                                    </div>


                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Plot Size (in Sq. Ft)<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="ploat_size_sqft" id="lan_size_sq" onkeyup="hecter('sq',this.value);Rem_land();" placeholder="Plot Size" value="<?php echo set_value('ploat_size_sqft'); ?>" step="0.01" min="0" autocomplete="off" required>
                                            <?php echo form_error('ploat_size_sqft'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reamining Land area (in Sq. Yd) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="rem_land_yrd" id="rem_land_yrd" value="<?php echo set_value('rem_land_yrd'); ?>" placeholder="Total Land area (in Yard)" autocomplete="off" readonly >
                                            <?php echo form_error('rem_land_yrd'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reamining Land area (in Hectares) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="rem_land_ht" id="rem_land_ht" placeholder="Total Land area (in Hectares)" value="<?php echo set_value('rem_land_ht'); ?>" autocomplete="off" readonly>
                                            <?php echo form_error('rem_land_ht'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reamining Land area(in Sq. Ft) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="rem_land_sqft" id="rem_land_sqft" placeholder="Total Land area (in Hectares)" value="<?php echo set_value('rem_land_sqft'); ?>" autocomplete="off" readonly>
                                            <?php echo form_error('rem_land_sqft'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Plot Number <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="ploat_code" placeholder="Plot Number" value="<?php echo set_value('ploat_code'); ?>" autocomplete="off" required>
                                            <?php echo form_error('ploat_code'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gross Amount<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="gross_amount" placeholder="Gross Amount" value="<?php echo set_value('gross_amount'); ?>" autocomplete="off" required>
                                            <?php echo form_error('gross_amount'); ?>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Selling Amount<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="selling_amount" placeholder="Selling Amount" value="<?php echo set_value('selling_amount'); ?>" autocomplete="off" required>
                                            <?php echo form_error('selling_amount'); ?>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ploat Type<span class="astrick">*</span></label><br>
                                            <label style="cursor: pointer;">
                                                <input type="radio" name="type_pro" value="0" class="flat-red" checked>
                                                For Sale
                                            </label>
                                            &nbsp;&nbsp;
                                            <label style="cursor: pointer;">
                                                <input type="radio" name="type_pro" value="1" class="flat-red">
                                                Only For Booking
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="plan_code" id="plan_code" value="1">
                                    <input type="hidden" name="location" id="location" value="1">
                                      

                                    <input class="form-control form-control-sm" type="hidden" name="quantity" placeholder="Quantity" value="0" autocomplete="off">



                                    
                                    
                                
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">

                                <!-- start here -->
                                <div class="card card-info"> 
                                    <div class="card-header">
                                        <h3 class="card-title">Agent Commission Details</h3>
                                    </div>


                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Direct Agent <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="direct_agent" placeholder="Direct Agent" value="<?php echo set_value('direct_agent'); ?>" required>
                                                    <?php echo form_error('direct_agent'); ?>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Parent Of Direct Agent <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="parent_direct_agent" placeholder="Parent Of Direct Agent" value="<?php echo set_value('parent_direct_agent'); ?>" required>
                                                    <?php echo form_error('parent_direct_agent'); ?>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Other Parents <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="other_parent" placeholder="Other Parents" value="<?php echo set_value('other_parent'); ?>" required>
                                                    <?php echo form_error('other_parent'); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end here -->
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">

                                <!-- start here -->
                                <div class="card card-info"> 
                                    <div class="card-header">
                                        <h3 class="card-title">Investor Commission Details</h3>
                                    </div>


                                    <div class="card-body">
                                        <div class="row">
                                            <table class="table" id="balance_A">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 300px;">Investor Name</th>
                                                        <th>Invested Amount</th>
                                                        <th>Share In (%)</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <select class="form-control form-control-sm select2" name="parter_id[]" id="parter_id1" required>
                                                                <option value="">-- Select Investor Name --</option>
                                                                <?php foreach($Parterners as $key => $value){ ?>
                                                                    <option value="<?=$value['id']?>"><?=$value['fullname'].' - '.$value['user_type_id']?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input class="form-control form-control-sm" type="text" name="share_amount[]" value="" placeholder="Invested Amount" required>
                                                        </td>
                                                        <td>
                                                            <input class="form-control form-control-sm" id="added_amt1" type="text" placeholder="Share Percentage" name="share_per[]" value="" required>
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

                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>create_product" class="btn btn-danger">Cancel</a>
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
     
    $(function(){

        //  Date Created
        $('#Idate').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        });


       $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
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


    function Lan_Size(){

        var plan_code =  $('#purchase_id').val();
        
        if(plan_code != ''){
                $.ajax({
                type:'POST',
                url: "<?= base_url();?>create_product/lan_size",
                data: "id="+plan_code,
                cache: false,
                dataType:'json',
                success: function(html){
                    $('#total_land_yard').val(html['rem_land_yrd']);
                    $('#total_land_ht').val(html['rem_land_ht']);
                    $('#lan_size_sqft').val(html['rem_land_sqft']);
                     Rem_land();
                    
                }
            });
        }
        else{
            $('#total_land_yard').val('');
            $('#total_land_ht').val('');
            $('#lan_size_sqft').val('');
            
            $('#total_land_yrd').val('');
            $('#total_land_hec').val('');
            $('#lan_size_sq').val('');
            
            $('#rem_land_yrd').val('');
            $('#rem_land_ht').val('');
            $('#rem_land_sqft').val('');

        }

    }

    function Rem_land(){
        
        total_yard = parseFloat($('#total_land_yard').val());
        total_hecter = parseFloat($('#total_land_ht').val());
        total_sqft = parseFloat($('#lan_size_sqft').val());

        var plt_size_yrd = parseFloat($('#total_land_yrd').val());
        var plt_size_hq = parseFloat($('#total_land_hec').val());
        var plt_size_sqft = parseFloat($('#lan_size_sq').val());

        if(total_yard !== '' || total_hecter !== '' || total_sqft !== '')
        {
            
            
            if($('#total_land_yrd').val() == '' || $('#total_land_hec').val() == '' || $('#lan_size_sq').val() == '')
            {   
                $('#rem_land_yrd').val('');
                $('#rem_land_ht').val('');
                $('#rem_land_sqft').val('');

                $('#rem_land_yrd').val(total_yard);
                $('#rem_land_ht').val(total_hecter);
                $('#rem_land_sqft').val(total_sqft);

            }

            else if(plt_size_yrd != '' || plt_size_hq != '' || plt_size_sqft != '')
            {
                rem_yard = total_yard - plt_size_yrd;
                rem_hecter = total_hecter - plt_size_hq;
                rem_sqft = total_sqft - plt_size_sqft;

                $('#rem_land_yrd').val(rem_yard);
                $('#rem_land_ht').val(rem_hecter);
                $('#rem_land_sqft').val(rem_sqft);

            }
            
        }

    }

    function more_lan(){
        total_yard = parseFloat($('#total_land_yard').val());
        total_hecter = parseFloat($('#total_land_ht').val());
        total_sqft = parseFloat($('#lan_size_sqft').val());

        plt_size_yard = parseFloat($('#total_land_yrd').val());
        plt_size_hq = parseFloat($('#total_land_hec').val());
        plt_size_sqft = parseFloat($('#lan_size_sq').val());

        if(total_hecter < plt_size_hq){
            
            $.notify({
            title: '<strong></strong>',
            icon: 'fa fa-times-circle',
            message: 'Please Check Plot Size (in Sq. Ft)'
            },{
                type: 'danger'
            }); 

            $('#lan_size_sq').focus();
            return false;
        
        }else{
            
            var total_payed = parseFloat(0);
            length = parseFloat($('#balance_A tbody tr').length) + 1;
            for(i_nre = 1;i_nre <= length;i_nre++)
            {   
                
                if($('#added_amt'+i_nre).val() != ''){
                    
                    total_payed += parseFloat($('#added_amt'+i_nre).val());
                }
            }

            if(total_payed != 100){
                $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-times-circle',
                        message: 'Share In (%) Total Must Be 100% '
                    },{
                        type: 'danger'
                    }); 
                $('#adva_payment').focus();
                return false;
            }

            

        }
    };

    var co_i = 1;
    function add_row() {
        co_i++;
        $('#add_row').append('<tr><td><select class="form-control form-control-sm select2a" name="parter_id[]" required><option value="">-- Select Investor Name --</option><?php foreach($Parterners as $key => $value){ ?><option value="<?=$value['id']?>"><?=$value['fullname'].' - '.$value['user_type_id']?></option><?php } ?></select></td><td> <input class="form-control form-control-sm" type="text" name="share_amount[]" value="" placeholder="Invested Amount" required></td><td> <input class="form-control form-control-sm" type="text" id="added_amt'+co_i+'" placeholder="Share Percentage" name="share_per[]" value="" required></td></tr>');
        $('.select2a').select2();
        return false;
    }

    function remove(){
        $('#add_row tr:last').remove();
        co_i--;
        return false;
    }


    function PartnerShare(){
        $('#share_per').val();

    }
</script>