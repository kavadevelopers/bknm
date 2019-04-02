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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Coustmer Name</th>
                                        <th>Product ID</th>
                                        <th>Plot Size</th>
                                        <th>selling Amount</th>
                                        <th>Sale By</th>
                                        <th>Date</th>
                                        <th class="text-center">Invoice</th>
                                        <th class="text-center" id="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sell as $key) {  ?>
                                        <tr>
                                            <td>
                                                <?= $this->users->customer_detail($key['coust_name'])[0]['fi_name'].' '.$this->users->customer_detail($key['coust_name'])[0]['la_name']; ?>
                                            </td>
                                            <td><?= $this->add_product->get_product_del($key['product_id'])[0]['product_id']; ?></td>
                                            <td><?= $key['ploat_size']; ?></td>
                                            <td><?= $key['selling_amount']; ?></td>
                                            <td><?= $this->users->get_user($key['created_by'])[0]['user_type_id']; ?></td>
                                            <td><?= date('d-m-Y',strtotime($key['date'])); ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-secondary btn-sm" 
                                                    href="<?= base_url('cancled/print_invoice/'); ?><?= $key['id']; ?>"  target="_blank"><i class="fa fa-print" title="Print"></i>
                                                </a>
                                            </td>
                                            
                                           
                                            <td class="text-center">
                                                <a class="btn btn-info btn-sm" 
                                                    href="<?= base_url('cancled/view/'); ?><?= $key['id']; ?>">
                                                    <i class="fa fa-eye" title="View"></i></a>
                                                
                                                <a class="btn btn-secondary btn-sm" 
                                                    href="<?= base_url('cancled/sale_print/'); ?><?= $key['id']; ?>"  target="_blank">
                                                    <i class="fa fa-print" title="Print"></i></a>

                                                <?php if($this->session->userdata('id') == '1'){ ?>

                                                    <a class="btn btn-warning btn-sm" 
                                                    href="<?= base_url('cancled/sale_report/'); ?><?= $key['id']; ?>" >
                                                    <i class="fa fa-line-chart" title="Print"></i></a>

                                                     <a class="btn btn-secondary btn-sm" 
                                                    href="<?= base_url('cancled/repayment_plan/'); ?><?= $key['id']; ?>" >
                                                    <i class="fa fa-plus" title="Add Repayment"></i></a>

                                                    <a class="btn btn-primary btn-sm" 
                                                    href="<?= base_url('cancled/repay_detail/'); ?><?= $key['id']; ?>" >
                                                    <i class="fa fa-list" title="Repayments"></i></a>

                                                   
                                                <?php } ?>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
            "columnDefs": [
                { "orderable": false, "targets": [7,6] }
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> Sales',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> Sales',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> Sales',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                }
            ]
            
        });
    })
</script>
