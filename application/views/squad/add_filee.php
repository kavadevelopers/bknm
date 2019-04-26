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
            <form method="post" action="<?= base_url(); ?>squad/add_file" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-info"> 

                            <div class="card-body">
                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>File Title <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="title" value="<?php echo set_value('title'); ?>" type="text" name="title" placeholder="File Title" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('title'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Message <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="message" value="<?php echo set_value('message'); ?>" type="text" name="message" placeholder="Message" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('message'); ?>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>squad" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>