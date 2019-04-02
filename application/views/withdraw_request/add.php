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
            <form method="post" id="withdraw_form" action="<?= base_url(); ?>withdraw_request/save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="row">
                            <div class="col-md-12">

                                <!-- start here -->
                                <div class="card card-info"> 
                                    <div class="card-header">
                                        <h3 class="card-title">Withdraw Request Details</h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Total Balance</label>
                                                    <input class="form-control form-control-sm" type="text" name="total_amount" id="total_amount" value="<?= $total_amount['balance']; ?>" readonly>
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Withdraw Amount <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" id="withdraw_amount" type="text" name="withdraw_amount" placeholder="Withdraw Amount" value="<?php echo set_value('withdraw_amount'); ?>">
                                                    <?php echo form_error('withdraw_amount'); ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- end here -->
                            </div>
                        </div>   

                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>withdraw_request" class="btn btn-danger">Cancel</a>
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

         
        $('#withdraw_form').submit(function(){
           
            if(parseFloat($('#withdraw_amount').val()) <= 0)
            {
                $.notify({
                    title: '<strong></strong>',
                    icon: 'fa fa-times-circle',
                    message: 'Please Check Withdraw Amount.'
                },{
                    type: 'danger'
                });
                $('#withdraw_amount').focus();
                return false;
            }
            else if(parseFloat($("#total_amount").val()) < parseFloat($("#withdraw_amount").val())){
                
                $.notify({
                    title: '<strong></strong>',
                    icon: 'fa fa-times-circle',
                    message: 'Please Check Withdraw Amount.'
                },{
                    type: 'danger'
                });
                $("#withdraw_amount").focus();
                return false;
            }
        });
    });


</script>