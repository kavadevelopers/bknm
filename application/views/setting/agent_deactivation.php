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
            <form method="post" action="<?= base_url(); ?>setting/save_agent_deactivation" enctype="product/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Agent Deactivation Details</h3>
                            </div>


                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Number Of Agents (In 1. Month) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="agent" value="<?php echo set_value('agent',$deactivation['agent']); ?>" placeholder="Number Of Agents" required>
                                            <?php echo form_error('agent'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Number Of Sale (In 1. Month) <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="saller" value="<?php echo set_value('saller',$deactivation['saller']); ?>" placeholder="Number Of Sale" required>
                                            <?php echo form_error('saller'); ?>
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

