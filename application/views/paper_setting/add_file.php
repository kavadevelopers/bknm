	<title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>


   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $_title; ?></h1>
          		</div>
        	</div>
      	</div>
    </div>


    <section class="content">
        <div class="container-fluid">
            
                <div class="row">


                	<div class="col-md-12">
                        <form method="post" action="<?= base_url(); ?>setting/save_head" enctype="multipart/form-data">
                            <div class="card card-info"> 

                                <div class="card-header">
                                    <h3 class="card-title">Add Head</h3>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>File No. <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" value="<?php echo set_value('file_no'); ?>" type="text" name="file_no" placeholder="Head Name" autocomplete="off" spellcheck="false">
                                                <?php echo form_error('file_no'); ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

    
                </div>
    
            </div>
    </section>