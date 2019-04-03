    <title><?=$this->config->config["projectTitle"]?> | <?= $_title; ?></title>


   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?= $_title; ?></h1>
          		</div>
        	</div>
      	</div>
    </div>

    <section class="content">
      	<div class="container-fluid">
            <form method="post" action="<?= base_url(); ?>subject/update" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">

                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Subject Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Subject Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('subject_name',$subject['name']); ?>" type="text" name="subject_name" placeholder="Subject Name" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('subject_name'); ?>
                                        </div>
                                    </div>

                                </div>
                                <input type="hidden" name="id" value="<?php echo set_value('id',$subject['id']); ?>">

                            </div>


                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>subject" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Save</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>