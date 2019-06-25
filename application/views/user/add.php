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
            <form method="post" action="<?= base_url(); ?>user/save" enctype="multipart/form-data" >
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
                                            <label>Username <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" id="username" value="<?php echo set_value('user_name'); ?>" type="text" name="user_name" placeholder="Username" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('user_name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('name'); ?>" type="text" name="name" placeholder="Name" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('name'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mobile </label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('mobile'); ?>" type="text" name="mobile" placeholder="Mobile" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('mobile'); ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email </label>
                                            <input class="form-control form-control-sm" value="<?php echo set_value('email'); ?>" type="text" name="email" placeholder="Email" autocomplete="off" spellcheck="false">
                                            <?php echo form_error('email'); ?>
                                        </div>
                                    </div>

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

                                </div>


                            </div>


                            
                        </div>


                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Select Financial Year</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <?php foreach($finicial_years as $key => $year){ ?>

                                        <div class="col-md-3">
                                            <label class="container"><?= $year['name']; ?>
                                              <input type="checkbox" name="f_year[]" value="<?= $year['name']; ?>" 
                                              <?php if(set_value('f_year')){ foreach (set_value('f_year') as $c_key => $set_val) {
                                                    if($set_val == $year['name']){
                                                        echo "checked";
                                                    }
                                              } }?>>
                                              <span class="checkmark"></span>
                                            </label>
                                        </div>

                                    <?php } ?>
                                    <div class="col-md-12">
                                        <?php echo form_error('f_year[]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Select Rights</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    <?php foreach($user_rights as $key => $row){ ?>

                                        <div class="col-md-3">
                                            <label class="container"><?= $row['name']; ?>
                                              <input type="checkbox" name="rights[]" value="<?= $row['id']; ?>" 
                                              <?php if(set_value('rights')){ foreach (set_value('rights') as $c_key => $set_val) {
                                                    if($set_val == $row['id']){
                                                        echo "checked";
                                                    }
                                              } }?>>
                                              <span class="checkmark"></span>
                                            </label>
                                        </div>

                                    <?php } ?>
                                    <div class="col-md-12">
                                        <?php echo form_error('rights[]'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <div class="card card-info">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>user" class="btn btn-danger">Cancel</a>
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
            $('#username').focus();




        })
    </script>