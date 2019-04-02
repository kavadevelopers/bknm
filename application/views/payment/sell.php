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
            <form method="post" action="<?= base_url();?>payment/save_sell" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                    	<div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Customer Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                
                                	<div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Customer Name<span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="customer_id" autocomplete="off">
                                            	<option value="">-- Select Customer Name --</option>

                                            	<?php foreach ($all_sales as $key => $value) { ?>
                                            		<option value="<?= $all_sales[$key][0]; ?>" ><?= $all_sales[$key][1]; ?></option>
                                            	<?php } ?>
                                                
                                            </select>
                                            <?php echo form_error('customer_id'); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>payment/sell_payments" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
<!-- Main content -->
