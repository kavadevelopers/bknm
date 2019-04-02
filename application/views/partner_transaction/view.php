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
<div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Investor Transaction - <?= $b_id; ?></h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table id="product" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Credit</th>
                                            <th>Debit</th>
                                            <th>Date</th>
                                            <th>Credit/Debit</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($business_trans as $key) {  ?>
                                            <tr>
                                                <td><?= ucfirst($key['type']); ?></td>

                                                <?php if($key['type'] == 'expense'){ ?>
                                                    <td><?= $this->partner_transact->get_expense_type($key['investment_id'])['desc']; ?></td>
                                                <?php }else if($key['type'] == 'purchase'){  ?>
                                                    <td><?= $this->partner_transact->get_purchase_id($key['investment_id'])['purchase_id']; ?></td>
                                                <?php }else{ ?>
                                                    <td>-</td>
                                                <?php } ?>

                                                <td><?= $key['credit']; ?></td>
                                                <td><?= $key['debit']; ?></td>
                                                <td><?= _vdate($key['date']); ?></td>
                                                <td class="text-center">
                                                    <?php if($key['credit'] == '0'){ echo '<span class="badge badge-danger">Debit</span>'; }else{ echo '<span class="badge badge-success">Credit</span>'; } ?>        
                                                </td>
                                                
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="col-md-4">
                    <div class="info-box mb-3 bg-warning">
                      <span class="info-box-icon"><i class="fa fa-handshake-o"></i></span>
                        
                      <div class="info-box-content">
                        <span class="info-box-text">Total Investment</span>
                        <span class="info-box-number"><?= moneyFormatIndia($this->transaction_model->get_parterner_total_investment($busi_id['id'])['balance']); ?></span>
                      </div>
                    </div>

                    <div class="info-box mb-3 bg-secondary">
                      <span class="info-box-icon"><i class="fa fa-minus"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Total Debit</span>
                        <span class="info-box-number"><?= moneyFormatIndia($this->transaction_model->get_parterner_debit($busi_id['id'])['balance']); ?></span>
                      </div>
                    </div>

                    <div class="info-box mb-3 bg-info">
                      <span class="info-box-icon"><i class="fa fa-plus"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Total Credit</span>
                        <span class="info-box-number"><?= moneyFormatIndia($this->transaction_model->get_parterner_credit($busi_id['id'])['balance']); ?></span>
                      </div>
                    </div>

                    <div class="info-box mb-3 bg-success">
                      <span class="info-box-icon"><i class="fa fa-bank"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Balance</span>
                        <span class="info-box-number"><?= moneyFormatIndia($this->transaction_model->get_parterner_balance($busi_id['id'])['balance']); ?></span>
                      </div>
                    </div>
                </div>


            </div>


        </div>
    </section>
<!-- /.container-fluid -->

<script type="text/javascript">
    $(function(){
        $('.table').DataTable({
            "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
           
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> Partner Transaction - <?= $b_id; ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> Partner Transaction - <?= $b_id; ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> Partner Transaction - <?= $b_id; ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                }
            ]
            
        });
    })
</script>