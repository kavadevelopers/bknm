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
            <form method="post" action="<?= base_url();?>report/show_sale" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                    	<div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Select Product</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                
                                	<div class="col-md-4">
                                        <div class="form-group">

                                            <label>Select Product<span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="product_id" autocomplete="off" required>
                                            	<option value="">-- Select Product --</option>

                                            	<?php foreach ($get_product_all as $key => $value) { ?>
                                            		<option value="<?= $value['id']; ?>"><?= $this->add_product->get_product_del($value['product_id'])[0]['product_id']; ?></option>
                                            	<?php } ?>
                                                
                                            </select>
                                            <?php echo form_error('product_id'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success" name="binary"><i class="fa fa-eye"></i>&nbsp;Show</button>
                                
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
