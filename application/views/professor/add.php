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
            <form method="post" action="<?= base_url(); ?>professor/save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Professor Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Full Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="name" value="<?php echo set_value('name'); ?>" type="text" name="name" placeholder="Full Name" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bank Account No.<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('accountno'); ?>" type="text" name="accountno" placeholder="Bank Account No" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('accountno'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contact No. <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('contact'); ?>" type="text" name="contact" placeholder="Contact No." autocomplete="off" spellcheck="false">
                                            <?php echo form_error('contact'); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>IFSC Code <span class="astrick">*</span></label>
                                            
                                            <input class="form-control form-control-sm" value="<?php echo set_value('ifsc'); ?>" type="text" name="ifsc" placeholder="IFSC Code" id="sel_ifsc" autocomplete="off" spellcheck="false" >

                                            <?php echo form_error('ifsc'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('branch'); ?>" type="text" name="branch" placeholder="Branch Name" id="branch" autocomplete="off" spellcheck="false" readonly>
                                            <?php echo form_error('branch'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bank Short Name</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('bank_short'); ?>" type="text" name="bank_short" placeholder="Bank Short Name" id="bank_short" autocomplete="off" spellcheck="false" readonly>
                                            <?php echo form_error('bank_short'); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>RC Book No.</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('rcbook'); ?>" type="text" name="rcbook" placeholder="RC Book No." id="rc_book_no" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('rcbook'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Fule Type</label>
                                            <select class="form-control form-control-sm" name="fule" id="fule" onchange="" autocomplete="off" >
                                                <option value="">-- Select Fule Type --</option>
                                                <option value="Petrol" <?php if('Petrol' == set_value('fule')){ echo "selected"; } ?>>Petrol</option>
                                                <option value="Diesel" <?php if('Diesel' == set_value('fule')){ echo "selected"; } ?>>Diesel</option>
                                                <option value="Gas" <?php if('Gas' == set_value('fule')){ echo "selected"; } ?>>Gas</option>
                                                <option value="Petro/LPG" <?php if('Petro/LPG' == set_value('fule')){ echo "selected"; } ?>>Petro/LPG</option>
                                                <option value="Petrol/CNG" <?php if('Petrol/CNG' == set_value('fule')){ echo "selected"; } ?>>Petrol/CNG</option>
                                            </select>
                                            <?php echo form_error('fule'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Faculty</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('faculty'); ?>" type="text" name="faculty" placeholder="Faculty" id="" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('faculty'); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reference</label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('reference'); ?>" type="text" name="reference" placeholder="Reference" id="" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('reference'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control form-control-sm" value="" type="text" name="remarks" placeholder="Remarks" id="" autocomplete="off" spellcheck="false"><?php echo set_value('remarks'); ?></textarea>
                                            <?php echo form_error('remarks'); ?>
                                        </div>
                                    </div>

                                </div>


                            </div>


                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>professor" class="btn btn-danger">Cancel</a>
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
            $('#name').focus();

            $( "#sel_ifsc" ).autocomplete({
                source: "<?php echo site_url('professor/ifsc_autocomplete/?');?>",
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    $('#branch').val(ui.item.branch); 
                    $('#bank_short').val(ui.item.s_name); 
                },
                change: function( event, ui ) {
                    if(ui.item==null)
                    {
                        this.value='';
                        $('#bank_short').val(''); 
                        $('#branch').val(''); 
                    }
                } 
            });

        })

    </script>