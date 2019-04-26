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
                        <form method="post" action="<?= base_url(); ?>head_edit/update_squad" enctype="multipart/form-data">
                            <div class="card card-info"> 
                                <input type="hidden" name="id" value="2">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Squad</h3>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Head Name <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" value="<?php echo set_value('head',$squad['name']); ?>" type="text" name="head" placeholder="Head Name" autocomplete="off" spellcheck="false" readonly>
                                                <?php echo form_error('head'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>File Limit <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" value="<?php echo set_value('file_limit',$squad['file_limit']); ?>" type="text" name="file_limit" placeholder="File Limit" autocomplete="off" spellcheck="false">
                                                <?php echo form_error('file_limit'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Minimum Km <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" value="<?php echo set_value('min_km',get_head_value_by_index('min_km','squad')); ?>" type="text" name="min_km" placeholder="Minimum Km" autocomplete="off" spellcheck="false">
                                                <?php echo form_error('min_km'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Minimum Km Rate <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" value="<?php echo set_value('min_km_rate',get_head_value_by_index('min_km_rate','squad')); ?>" type="text" name="min_km_rate" placeholder="Minimum Km Rate" autocomplete="off" spellcheck="false">
                                                <?php echo form_error('min_km_rate'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Petrol per Km <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" value="<?php echo set_value('petrol_per_km',get_head_value_by_index('petrol_per_km','squad')); ?>" type="text" name="petrol_per_km" placeholder="Petrol per Km" autocomplete="off" spellcheck="false">
                                                <?php echo form_error('petrol_per_km'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Diesel per Km <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" value="<?php echo set_value('diesel_per_km',get_head_value_by_index('diesel_per_km','squad')); ?>" type="text" name="diesel_per_km" placeholder="Diesel per Km" autocomplete="off" spellcheck="false">
                                                <?php echo form_error('diesel_per_km'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gas per Km <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" value="<?php echo set_value('gas_per_km',get_head_value_by_index('gas_per_km','squad')); ?>" type="text" name="gas_per_km" placeholder="Gas per Km" autocomplete="off" spellcheck="false">
                                                <?php echo form_error('gas_per_km'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Petro/LPG per Km <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" value="<?php echo set_value('petrol_lpg_per_km',get_head_value_by_index('petrol_lpg_per_km','squad')); ?>" type="text" name="petrol_lpg_per_km" placeholder="Petro/LPG per Km" autocomplete="off" spellcheck="false">
                                                <?php echo form_error('petrol_lpg_per_km'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Petro/CNG per Km <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" value="<?php echo set_value('petrol_cng_per_km',get_head_value_by_index('petrol_cng_per_km','squad')); ?>" type="text" name="petrol_cng_per_km" placeholder="Petro/CNG per Km" autocomplete="off" spellcheck="false">
                                                <?php echo form_error('petrol_cng_per_km'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Per Session <span class="astrick">*</span></label>
                                                <input class="form-control form-control-sm" value="<?php echo set_value('per_session',get_head_value_by_index('per_session','squad')); ?>" type="text" name="per_session" placeholder="Per Session" autocomplete="off" spellcheck="false">
                                                <?php echo form_error('per_session'); ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="float-right">
                                        <a href="<?= base_url(); ?>setting/head" class="btn btn-danger">Cancel</a>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Save</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            
        </div>
    </section>