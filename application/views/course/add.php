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

	<section class="content">
        <div class="container-fluid">
            <form method="post" action="<?= base_url(); ?>course/save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Course Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">


                                	<div class="col-md-4">
                                        <div class="form-group">
                                            <label>Course<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" spellcheck="false" value="<?php echo set_value('course'); ?>" type="text" name="course" placeholder="Course" autocomplete="off">
                                            <?php echo form_error('course'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Amount<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" spellcheck="false" value="<?php echo set_value('amount'); ?>" type="text" name="amount" placeholder="Amount" autocomplete="off">
                                            <?php echo form_error('amount'); ?>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>person" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

