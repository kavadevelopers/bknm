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
            <form method="post" action="<?= base_url(); ?>user/pass_save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">User Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Username </label>
                                            <input class="form-control form-control-sm" value="<?php echo $user['user_name']; ?>" type="text" name="" placeholder="Username" autocomplete="off" spellcheck="false" readonly>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name </label>
                                            <input class="form-control form-control-sm" value="<?php echo $user['name']; ?>" type="text" name="name" placeholder="Name" autocomplete="off" spellcheck="false" readonly>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Password <span class="astrick">*</span></label>
                                            <div class="input-group">
                                                <input class="form-control form-control-sm" value="<?php echo set_value('pass'); ?>" type="password" name="pass" id="pass" placeholder="Password" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text _cpnt" id="eyepass"><i class="fa fa-eye"></i></span>
                                                </div>
                                            </div>
                                            <?php echo form_error('pass'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Confirm Password <span class="astrick">*</span></label>
                                            <div class="input-group">
                                                <input class="form-control form-control-sm" value="<?php echo set_value('con_pass'); ?>" type="password" name="con_pass" placeholder="Confirm Password" id="conpass" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text _cpnt" id="eyecpass"><i class="fa fa-eye"></i></span>
                                                </div>
                                            </div>
                                            <?php echo form_error('con_pass'); ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" value="<?php echo set_value('user_id',$user['id']); ?>">
                                </div>


                            </div>


                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>user" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Save</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>