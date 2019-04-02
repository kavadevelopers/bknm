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
            <form method="post" action="<?= base_url(); ?>expense/update" enctype="product/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Expense Detail</h3>
                            </div>


                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Description <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="desc" placeholder="Description" value="<?php echo set_value('desc',$expense[0]['desc']); ?>" autocompleate="off" required>
                                            <?php echo form_error('desc'); ?>
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Amount <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="amount" placeholder="Amount" value="<?php echo set_value('amount',$expense[0]['amount']); ?>" autocompleate="off" required>
                                            <?php echo form_error('amount'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm datepicker" type="text" name="date" placeholder="Date" value="<?= set_value('date',date('d-m-Y',strtotime($expense[0]['date'])));?>" autocompleate="off" required readonly>
                                            <?php echo form_error('date'); ?>

                                        </div>
                                    </div>

                                    <div>
                                        <input type="hidden" name="id" value="<?= $expense[0]['id']; ?>">
                                    </div> 

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                  
                                  <a href="<?= base_url(); ?>expense" class="btn btn-danger">Cancel</a>

                                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Save</button>
                                </div>
                            </div>
                        </div>
                    <!-- end here -->

                   
                </div>
            </form>    
        </div><!-- // container-fluid -->
    </section>
<!-- /.container-fluid -->