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
            <form method="post" onsubmit="return more_lan();" action="<?= base_url(); ?>create_product/update" enctype="product/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Edit Product</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Purchase Id <span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="purchase_id" id="purchase_id" onchange="Lan_Size();" autocomplete="off">
                                                    <!-- <option value="">-- Select Plan Code --</option> -->
                                                <?php 
                                                   foreach ($get_purchase_id as $key) { 
                                                ?>

                                                        <option value="<?= $key['purchase_id'];?>" <?php if($get_product['purchase_id'] === $key['purchase_id']) { echo "selected"; } ?>>
                                                        <?= $key['purchase_id'];?>
                                                        </option>
                                                <?php } ?>
                                            </select>
                                             <?php echo form_error('purchase_id'); ?>

                                        </div>               
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Product Id <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="product_id" placeholder="Product Id" value="<?php echo set_value('product_id',$get_product['product_id'],$get_product['product_id']); ?>" autocomplete="off">
                                            <?php echo form_error('product_id'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="date" id="Idate" placeholder="Date" value="<?php echo set_value('date',date('d-m-Y',strtotime($get_product['date']))); ?>" autocomplete="off">
                                            <?php echo form_error('date'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Land area (in Sq. Yd) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="total_land_yard" id="total_land_yard" value="<?php echo set_value('total_land_yard',$get_product['total_land_yard']); ?>" placeholder="Total Land area (in Yard)" autocomplete="off" readonly>
                                            <?php echo form_error('total_land_yard'); ?>

                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Land area (in Hectares) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="total_land_ht" id="total_land_ht" placeholder="Total Land area (in Hectares)" value="<?php echo set_value('total_land_ht',$get_product['total_land_ht']); ?>" autocomplete="off" readonly>
                                            <?php echo form_error('total_land_ht'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Land area(in Sq. Ft) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="lan_size_sqft" id="lan_size_sqft" placeholder="Total Land area (in Hectares)" value="<?php echo set_value('lan_size_sqft',$get_product['lan_size_sqft']); ?>" autocomplete="off" readonly>
                                            <?php echo form_error('lan_size_sqft'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ploat Size (in Sq. Yd) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="ploat_land_yard" id="total_land_yrd" onkeyup="hecter('y',this.value); Rem_land();" value="<?php echo set_value('ploat_land_yard',$get_product['ploat_land_yard']); ?>" placeholder="Ploat Size" autocomplete="off">
                                            <?php echo form_error('ploat_land_yard'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ploat Size (in Hectares)<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="ploat_size_ht" id="total_land_hec" onkeyup="hecter('h',this.value); Rem_land();" placeholder="Ploat Size" value="<?php echo set_value('ploat_size_ht',$get_product['ploat_size_ht']); ?>" step="0.01" min="0" autocomplete="off">
                                            <?php echo form_error('ploat_size_ht'); ?>
                                        </div>
                                    </div>


                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ploat Size (in Sq. Ft)<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="ploat_size_sqft" id="lan_size_sq" onkeyup="hecter('sq',this.value);Rem_land();" placeholder="Ploat Size" value="<?php echo set_value('ploat_size_sqft',$get_product['ploat_size_sqft']); ?>" step="0.01" min="0" autocomplete="off">
                                            <?php echo form_error('ploat_size_sqft'); ?>
                                        </div>
                                    </div>

                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reamining Land area (in Sq. Yd) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="rem_land_yrd" id="rem_land_yrd" value="<?php echo set_value('rem_land_yrd',$get_product['rem_land_yrd']); ?>" placeholder="Total Land area (in Yard)" autocomplete="off" readonly>
                                            <?php echo form_error('rem_land_yrd'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reamining Land area (in Hectares) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="rem_land_ht" id="rem_land_ht" placeholder="Total Land area (in Hectares)" value="<?php echo set_value('rem_land_ht',$get_product['rem_land_ht']); ?>" autocomplete="off" readonly>
                                            <?php echo form_error('rem_land_ht'); ?>
                                        </div>
                                    </div>

                                   <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reamining Land area(in Sq. Ft) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="rem_land_sqft" id="rem_land_sqft" placeholder="Total Land area (in Hectares)" value="<?php echo set_value('rem_land_sqft',$get_product['rem_land_sqft']); ?>" autocomplete="off" readonly>
                                            <?php echo form_error('rem_land_sqft'); ?>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ploat Number <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="ploat_code" placeholder="Ploat Number" value="<?php echo set_value('ploat_code',$get_product['ploat_code']); ?>" autocomplete="off">
                                            <?php echo form_error('ploat_code'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Plan Name <span class="astrick">*</span></label>
                                            <select name="plan_code" class="form-control form-control-sm select2" autocomplete="off">
                                                <!-- <option value="">-- Select Plan Name --</option> -->

                                                <?php foreach ($get_plan_code as $key) { ?>          
                                                
                                                    <option value="<?= $key['plan_code'];?>" <?php if($get_product['plan_code'] === $key['plan_code']) { echo "selected"; } ?>>
                                                        
                                                    <?= $key['plan_code'];?>
                                                    </option>

                                                <?php } ?>
                                            </select>
                                            <?php echo form_error('plan_code'); ?>
                                             
                                        </div>
                                    </div>

                                    <input class="form-control form-control-sm" type="hidden" name="quantity" placeholder="Quantity" value="0" autocomplete="off">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Selling Amount<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="selling_amount" placeholder="Selling Amount" value="<?php echo set_value('selling_amount',$get_product['selling_amount']); ?>" autocomplete="off">
                                            <?php echo form_error('selling_amount'); ?>
                                        </div>
                                    </div>

                                    
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
                                                    <input class="form-control form-control-sm" type="text" name="direct_agent" placeholder="Direct Agent" value="<?php echo set_value('direct_agent',$get_product['direct_agent']); ?>">
                                                    <?php echo form_error('direct_agent'); ?>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Parent Of Direct Agent <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="parent_direct_agent" placeholder="Parent Of Direct Agent" value="<?php echo set_value('parent_direct_agent',$get_product['parent_direct_agent']); ?>">
                                                    <?php echo form_error('parent_direct_agent'); ?>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Other Parents <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" type="text" name="other_parent" placeholder="Other Parents" value="<?php echo set_value('other_parent',$get_product['other_parent']); ?>">
                                                    <?php echo form_error('other_parent'); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end here -->
                            </div>
                        </div>   
                        

                        <div>
                            <input type="hidden" name="id" value="<?= $get_product['id']; ?>">
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
                    $('#total_land_ht').val(html['total_land']);
                    $('#lan_size_sqft').val(html['lan_size']);
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
            message: 'Please Check Ploat Size (in Sq. Ft)'
            },{
                type: 'danger'
            }); 

            $('#lan_size_sq').focus();
            return false;
        
        }else if(total_hecter <= plt_size_hq){
            
            return true;
        }
         
    };

</script>