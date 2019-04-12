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
            <form method="post" action="<?= base_url(); ?>ifsc/save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Ifsc Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ifsc Code <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('ifsc'); ?>" type="text" name="ifsc" placeholder="Ifsc Code" autocomplete="off" id="ifsc" spellcheck="false">
                                            <?php echo form_error('ifsc'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Branch Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('branch'); ?>" type="text" name="branch" placeholder="Branch Name" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('branch'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address <span class="astrick">*</span></label>
                                            <textarea class="form-control form-control-sm" value="" type="text" name="address" placeholder="Address" autocomplete="off" spellcheck="false"><?php echo set_value('address'); ?></textarea>
                                            <?php echo form_error('address'); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('city'); ?>" type="text" name="city" placeholder="City" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('city'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>District <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('district'); ?>" type="text" name="district" placeholder="District" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('district'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bank <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('bank'); ?>" type="text" name="bank" placeholder="Bank" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('bank'); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bank Short Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('bank_short'); ?>" type="text" name="bank_short" placeholder="Bank Short Name" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('bank_short'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Micr Code </label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('micr'); ?>" type="text" name="micr" placeholder="Micr Code" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('micr'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contact </label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('contact'); ?>" type="text" name="contact" placeholder="Contact" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('contact'); ?>
                                        </div>
                                    </div>

                                    

                                </div>

                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('state','gujarat'); ?>" type="text" name="state" placeholder="State" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('state'); ?>
                                        </div>
                                    </div>

                                </div>


                            </div>


                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>ifsc" class="btn btn-danger">Cancel</a>
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
            $('#ifsc').focus();
        })
    </script>