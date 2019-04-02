<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; $this->load->model('purchase'); ?></title>

<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <a href="<?= base_url('num_sellers/add'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New</a>
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
                            <table class="table table-responsive table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Land Location/Name</th>
                                        <th>Account Number(land)</th>
                                        <th>Total Land Area IN (hec.)</th>
                                        <th>Purchase Amount</th>
                                        <th>Total Expense</th>
                                        <th>Total Land Cost</th>
                                        <th>Purchase Date </th>
                                        <th class="my_center">Agreement</th>
                                        <th class="my_center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($purchase as $key) { $land_detail = $this->purchase->purchase_land_detail($key['id']); $T_expense = $this->expense_model->expence_purchase_wise($key['id']); ?>
                                
                                        <tr>
                                           <td><?= $key['purchase_id']; ?></td>
                                           <td><?= $land_detail[0]['ac_num_land']; ?></td>
                                           <td><?= $land_detail[0]['total_land']; ?></td>
                                           <td><?= $land_detail[0]['purchase_amount']; ?></td>
                                           <td><?= $T_expense; ?></td>
                                           <td><?= $land_detail[0]['purchase_amount'] + $T_expense; ?></td>
                                           <td><?= date('d-m-Y',strtotime($land_detail[0]['purchase_date'])); ?></td>

                                           <td class="my_center"><a class="btn btn-sm btn-secondary" href="<?= base_url('num_sellers/print_short/');?><?= $key['id']; ?>" title="Print Agreement" target="_blank"><i class="fa fa-print" title="Print"></i></a></td>
                                           
                                            <td class="my_center" style="min-width: 170px;">
                                                <a class="btn btn-info btn-sm" 
                                                    href="<?= base_url('num_sellers/view/'); ?><?= $key['id']; ?>">
                                                    <i class="fa fa-eye" title="View"></i>
                                                </a> 
                                                

                                                <a class="btn btn-secondary btn-sm" 
                                                    href="<?= base_url('num_sellers/purchase_print/'); ?><?= $key['id']; ?>"  target="_blank">
                                                    <i class="fa fa-print" title="Print"></i>
                                                </a>

                                                <?php if($this->session->userdata('id') == '1'){ ?>

                                                    <a href="" class="btn btn-sm btn-danger" title="Delete" onclick="return master('<?= base_url('num_sellers/delete/'); ?><?= $key['id']; ?>');" ><i class="fa fa-trash"></i>
                                                    </a>

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
                { "orderable": false, "targets": [8,7] },
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> Purchase',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> Purchase',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> Purchase',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                }
            ]
            
        });
    });
</script>