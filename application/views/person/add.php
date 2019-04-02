<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-12 col-md-6">
            		<h1 class="m-0 text-dark">Add Person</h1>
          		</div>
          		<div class="col-sm-12 col-md-6">
          			<h6 style="text-align: right; margin-top: 5px;"><b>Note : </b> All fields marked with an asterisk ( <span class="astrick">*</span> ) are required</h6>
          		</div>
        	</div><!-- /.row -->
      	</div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->

	<section class="content">
      	<div class="container-fluid">
            <form method="post" action="<?= base_url(); ?>person/save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Person Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                	<div class="col-md-4">
                                        <div class="form-group">
                                            <label>Acc Code<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" spellcheck="false" value="<?php echo set_value('code'); ?>" type="text" name="code" placeholder="Acc Code" autocomplete="off">
                                            <?php echo form_error('code'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Name<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" spellcheck="false" value="<?php echo set_value('name'); ?>" type="text" name="name" placeholder="Full Name" autocomplete="off">
                                            <?php echo form_error('name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mobile No.<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" spellcheck="false" value="<?php echo set_value('mobile'); ?>" type="text" name="mobile" placeholder="Mobile No." autocomplete="off">
                                            <?php echo form_error('mobile'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address <span class="astrick">*</span></label>
                                            <textarea class="form-control form-control-sm" spellcheck="false" type="text" name="address" placeholder="Address"><?php echo set_value('address'); ?></textarea>
                                            <?php echo form_error('address'); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Bank Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                	<div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bank Account No.<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" spellcheck="false" value="<?php echo set_value('account'); ?>" type="text" name="account" placeholder="Bank Account No." autocomplete="off">
                                            <?php echo form_error('account'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ifsc Code<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" spellcheck="false" value="<?php echo set_value('ifsc'); ?>" type="text" name="ifsc" placeholder="Ifsc Code" autocomplete="off">
                                            <?php echo form_error('ifsc'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bank Name<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" spellcheck="false" value="<?php echo set_value('bank'); ?>" type="text" name="bank" placeholder="Bank Name" autocomplete="off">
                                            <?php echo form_error('bank'); ?>
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


<script type="text/javascript">
    
     
    $(function(){    
        <?php if(!empty(validation_errors())){ ?>
    
            $.notify({
                title: '<strong></strong>',
                icon: 'fa fa-times-circle',
                message: 'Your Form Was Not Submmited Check Your Form'
            },{
                type: 'danger'
            }); 
        <?php } ?>
    })



</script>