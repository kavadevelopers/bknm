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
            <form method="post" action="<?= base_url();?>partner_investment/update" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Payment Detail</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            
                                            <input class="form-control form-control-sm" type="text" placeholder="Name" value="<?= $business_detail['fi_name'].' '.$business_detail['mi_name'].' '.$business_detail['la_name']; ?>" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Investment Amount <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="invest_amount" placeholder="Investment Amount" value="<?= $investment[0]['invest_amount']; ?>" autocomplete="off" step="0.01" min="1" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Payment Date <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm datepicker" type="text" name="pay_date" placeholder="Payment Date" value="<?= _vdate($investment[0]['pay_date']); ?>" autocomplete="off" readonly required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Payment Mode <span class="astrick">*</span></label>
                                            <select name="pay_mode" class="form-control form-control-sm"  required>
                                                <option value="">-- Select Payment Mode  --</option>
                                                <option value="Cash" <?php if($investment[0]['pay_mode'] == 'Cash') { echo "selected"; }?>>Cash</option>
                                                <option value="Cheque" <?php if($investment[0]['pay_mode'] == 'Cheque') { echo "selected"; }?>>Cheque</option>
                                                <option value="Bank Transfer" <?php if($investment[0]['pay_mode'] == 'Bank Transfer') { echo "selected"; }?>>Bank Transfer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Payment Mode Detail <span class="astrick">*</span></label>
                                            <textarea class="form-control form-control-sm" type="text" name="pay_mode_detail" placeholder="Payment Mode Detail Ex. (Cheque No., Ref.No.)" autocomplete="off" required><?= $investment[0]['pay_mode_detail']; ?></textarea>
                                        </div>
                                    </div>

                                    <!-- <input type="hidden" name="bs_prt_id" value="<?= $main_id; ?>"> -->
                                    <input type="hidden" name="name" value="<?= $investment[0]['name']; ?>">
                                    <input type="hidden" name="id" value="<?= $investment[0]['id']; ?>">

                                </div>
                            </div>
                            
                        </div>

                    </div><!-- // col-md-12 -->
                </div><!-- // row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>partner_investment" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
<!-- Main content -->
