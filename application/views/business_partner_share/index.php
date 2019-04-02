<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; $this->load->model('purchase'); ?></title>

<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <a href="<?= base_url('business_partner_share/add'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New</a>
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
                                        <th>Business Partner Name</th>
                                        <th>Credit Amount</th>
                                        <th>Date</th>
                                        <th>Payment Mode</th>
                                        <th>Payment Mode Detail</th>
                                        <th class="my_center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($business_all as $key) { 
                                                $business_detail = $this->users->business_detail($key['business_name']);
                                                $business_id = $this->users->all_business_user_type($key['business_name']); ?>
                                    
                                        <tr>
                                           <td><?= $business_detail[0]['fi_name'].' '.$business_detail[0]['mi_name'].' '.$business_detail[0]['la_name'].' - '.$business_id[0]['user_type_id']; ?></td>
                                           <td><?= $key['credit_amount']; ?></td>
                                           <td><?= _vdate($key['date']); ?></td>
                                           <td><?= $key['payment_mode']; ?></td>
                                           <td><?= $key['payment_mode_detail']; ?></td>
                                           
                                           
                                           <td class="my_center" style="min-width: 170px;">
                                               
                                                <!-- <a href="<?= base_url('num_sellers/edit/'); ?><?= $key['id']; ?>" class="btn btn-sm btn-success" title="Edit"><i class="fa fa-edit"></i></a>
 -->
                                                <a href="<?= base_url('business_partner_share/delete/'); ?><?= $key['id']; ?>" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are You Sure You Want To Delete This Business Partner Share .?');"><i class="fa fa-trash"></i></a>

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
                { "orderable": false, "targets": [5] },
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> <?= $page_title; ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> <?= $page_title; ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> <?= $page_title; ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                }
            ]
            
        });
    });
</script>