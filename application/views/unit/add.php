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
            <form method="post" action="#" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                    <!-- start here -->
                     <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Unit Discription</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Unit Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('unit_name'); ?>" type="text" name="unit_name" id="unit_name" placeholder="Unit Name" >
                                            <?php echo form_error('unit_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Unit Discription <span class="astrick">*</span></label>
                                            <textarea class="form-control form-control-sm" type="text" name="unit_discription" id="unit_discription" placeholder="Unit Discription" ><?php echo set_value('unit_discription'); ?></textarea>
                                            <?php echo form_error('unit_discription'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                    

                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>business" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                    <!-- end here -->

                    </div>
                </div>
            </form>    
        </div><!-- // container-fluid -->
    </section>
<!-- /.container-fluid -->
