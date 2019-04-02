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
            <form method="post" action="<?= base_url(); ?>setting/plan_code_save" enctype="product/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Plan Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Plan Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="plan_code" placeholder="Plan Name" value="<?php echo set_value('plan_code'); ?>">
                                            <?php echo form_error('plan_code'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Month <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="month" placeholder="Month" value="<?php echo set_value('month'); ?>">
                                            <?php echo form_error('month'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Year <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="year" placeholder="Year" value="<?php echo set_value('year'); ?>">
                                            <?php echo form_error('year'); ?>
                                        </div>
                                    </div>

                                  </div>
                            </div>
                        </div>
                                    

                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>setting/plan_codes" class="btn btn-danger">Cancel</a>
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
</script>