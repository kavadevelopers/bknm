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
            <form method="post" action="<?= base_url(); ?>setting/save_code" enctype="product/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Authentication Codes</h3>
                            </div>


                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Admin Code <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="admin" placeholder="Admin Code" value="<?php echo set_value('admin',$code[0]['code']); ?>" >
                                            <?php echo form_error('admin'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Investor Code <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="investor" placeholder="Investor Code" value="<?php echo set_value('investor',$code[1]['code']); ?>" >
                                            <?php echo form_error('investor'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Agent Code <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="agent" placeholder="Agent Code" value="<?php echo set_value('agent',$code[2]['code']); ?>" >
                                            <?php echo form_error('agent'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Customer Code <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="customer" placeholder="Customer Code" value="<?php echo set_value('customer',$code[3]['code']); ?>" >
                                            <?php echo form_error('customer'); ?>
                                        </div>
                                    </div>


                                  </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
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