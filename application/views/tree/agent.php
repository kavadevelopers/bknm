<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
          		</div>
        	</div><!-- /.row -->
      	</div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->

<!-- Main content -->
    <section class="content">
      	<div class="container-fluid">
            <form method="post" action="<?= base_url();?>tree/subadmin_get" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                    	<div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Agent Tree</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                
                                	<div class="col-md-4">
                                        <div class="form-group">

                                            <label>Select Agent Id<span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="agent_id" autocomplete="off" required>
                                            	<option value="">-- Select Agent Id --</option>

                                            	<?php foreach ($agent as $key => $value) { ?>
                                            		<option value="<?= $agent[$key]['user_type_id']; ?>" ><?= $agent[$key]['user_type_id']; ?></option>
                                            	<?php } ?>
                                                
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                  
                                    <button type="submit" class="btn btn-secondary" name="whole"><i class="fa fa-eye"></i>&nbsp;Whole Binary Tree</button>
                                    <button type="submit" class="btn btn-success" name="binary"><i class="fa fa-eye"></i>&nbsp;Binary Tree</button>
                                
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
<!-- Main content -->
