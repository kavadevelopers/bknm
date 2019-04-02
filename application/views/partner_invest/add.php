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
            <form method="post" action="<?= base_url();?>partner_investment/business_part" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Investment Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                               
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Investor<span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="business_part" autocomplete="off">
                                                <option value="" required>-- Select Investor --</option>

                                                <?php foreach ($users as $key => $value) { $b_detail = $this->partner_invest->business_detail($value['id']); ?>
                                                    <option value="<?= $value['id']; ?>" >
                                                        <?= 
                                                            $b_detail['fi_name'].' '.$b_detail['mi_name'].' '.$b_detail['la_name'].' - '.$value['user_type_id']; 
                                                        ?>     
                                                    </option>
                                                <?php } ?>
                                                
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>partner_investment" class="btn btn-danger">Cancel</a>
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
