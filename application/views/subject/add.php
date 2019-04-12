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
            <form method="post" action="<?= base_url(); ?>subject/save" enctype="multipart/form-data">
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
                                            <label>Course Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="subject" value="<?php echo set_value('subject_name'); ?>" type="text" name="subject_name" placeholder="Course Name" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('subject_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Semester <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="subject" value="<?php echo set_value('semester'); ?>" type="text" name="semester" placeholder="Semester" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('semester'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Paper Setting Price <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="subject" value="<?php echo set_value('pep_setting_price'); ?>" type="text" name="pep_setting_price" placeholder="Paper Setting Price" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('pep_setting_price'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Paper Assessment Price <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="subject" value="<?php echo set_value('pep_assesment_price'); ?>" type="text" name="pep_assesment_price" placeholder="Paper Assessment Price" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('pep_assesment_price'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Examination Fees<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="subject" value="<?php echo set_value('examination_fees'); ?>" type="text" name="examination_fees" placeholder="Examination Fees" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('examination_fees'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Papers<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="subject" value="<?php echo set_value('total_papers'); ?>" type="text" name="total_papers" placeholder="Total Papers" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('total_papers'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Paper Moderation Price<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="subject" value="<?php echo set_value('pep_moderation_price'); ?>" type="text" name="pep_moderation_price" placeholder="Paper Moderation Price" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('pep_moderation_price'); ?>
                                        </div>
                                    </div>

                                </div>


                            </div>


                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>subject" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>

    <script type="text/javascript">
        $(function(){
            $('#subject').focus();
        })
    </script>