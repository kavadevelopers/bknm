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
            <form method="post" action="<?= base_url(); ?>setting/save_bank" enctype="product/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Account Details</h3>
                            </div>


                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bank Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="bank" placeholder="Bank Name" value="<?php echo $bank['bank']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Account Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="ac_name" placeholder="Account Name" value="<?php echo $bank['ac_name']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Account No. <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="ac_no" placeholder="Account No." value="<?php echo $bank['ac_no']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ifsc Code <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="ifsc" placeholder="Ifsc Code" value="<?php echo $bank['ifsc']; ?>" required>
                                        </div>
                                    </div>


                                  </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
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