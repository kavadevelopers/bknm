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
            <form method="post" action="<?= base_url(); ?>setting/save_promotion" enctype="product/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Promotion Details</h3>
                            </div>


                            <div class="card-body">
                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Silver Personality (1 unit = 100 sq.yard) <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="silver" placeholder="Silver Personality (add unit)" value="<?php echo set_value('silver',$percent['silver'] / 100); ?>" >
                                                <?php echo form_error('silver'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Silver Commission In (%)<span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="silver_commission" placeholder="Silver Commission" value="<?php echo set_value('silver_commission',$percent['silver_commission']); ?>" >
                                                <?php echo form_error('silver_commission'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gold Personality (1 unit = 100 sq.yard)<span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="gold" placeholder="Gold Personality (add unit)" value="<?php echo set_value('gold',$percent['gold'] / 100); ?>" >
                                                <?php echo form_error('gold'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gold Commission In (%)<span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="gold_commission" placeholder="Gold Commission" value="<?php echo set_value('gold_commission',$percent['gold_commission']); ?>" >
                                                <?php echo form_error('gold_commission'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Diamond Personality (1 unit = 100 sq.yard)<span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="diamond" placeholder="Diamond Personality (add unit)" value="<?php echo set_value('diamond',$percent['diamond'] / 100); ?>" >
                                                <?php echo form_error('diamond'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Diamond Commission In (%)<span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="diamond_commission" placeholder="Diamond Commission (add unit)" value="<?php echo set_value('diamond_commission',$percent['diamond_commission']); ?>" >
                                                <?php echo form_error('diamond_commission'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Superb Personality (1 unit = 100 sq.yard)<span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="super" placeholder="Superb Personality" value="<?php echo set_value('super',$percent['super'] / 100); ?>" >
                                                <?php echo form_error('super'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Superb Commission In (%)<span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" type="text" name="super_commission" placeholder="Superb Commission" value="<?php echo set_value('super_commission',$percent['super_commission']); ?>" >
                                                <?php echo form_error('super_commission'); ?>
                                            </div>
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