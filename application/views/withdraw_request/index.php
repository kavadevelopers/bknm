<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
                </div>
                <div class="col-sm-6">
                     <?php if($this->session->userdata('id') != '1'){ ?>
                    <a href="<?= base_url('withdraw_request/add'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New
                    </a>
                <?php } ?>
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
                                        <?php if($this->session->userdata('id') == '1'){ ?>
                                            <th>Balance</th>
                                        <?php } ?>
                                        <th>Withdraw Amount</th>
                                        
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th class="text-center">Status</th>
                                        <?php if($this->session->userdata('id') == '1'){ ?>
                                            <th class="text-center" id="action">Action</th>
                                        <?php } ?>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($request as $key) { ?>
                                        <tr>
                                        <?php if($this->session->userdata('id') == '1'){ ?>

                                            <td>
                                                <?php echo moneyFormatIndia($this->withdraw_req->get_balance_with_id($key['created_by'])); ?>     
                                            </td>

                                        <?php } ?>
                                            <td><?= moneyFormatIndia($key['withdraw_amount']); ?></td>
                                            <td><?= ucfirst($key['user_type']); ?></td>
                                            <td><?= $this->withdraw_req->get_userdata($key['user_type'],$key['created_by']).'-'.$this->withdraw_req->get_user($key['created_by'])[0]['user_type_id']; ?></td>
                                            <td><?= date('d-m-Y H:i A',strtotime($key['created_at'])); ?></td>

                                            <td class="text-center">
                                                <?php 
                                                    $status = $key['confirm'];
                                                    if($status == 0){
                                                    
                                                    echo '<span class="badge badge-warning">In Process</span>';

                                                    } else if($status == 1) { 
                                                        
                                                        echo '<span class="badge badge-success">Approved</span>';

                                                    } else if($status == 2) { 

                                                        echo '<span class="badge badge-danger">Rejected</span>';

                                                    } 
                                                ?>
                                            </td>
                                            
                                            
                                            
                                            <?php if($this->session->userdata('id') == '1'){ ?>
                                                
                                                    <td class="text-center">
                                                        <?php if($status == '0'){ ?>
                                                        <a class="badge badge-sm badge-success" href="<?= base_url();?>withdraw_request/confirm/<?= $key['id'];?>" onclick="return confirm('Are you Sure You Want to Approve this Request .?');" title="Approve">
                                                            <i class="fa fa-check-square-o"></i>
                                                        </a>

                                                        <a class="badge badge-sm badge-danger" href="<?= base_url();?>withdraw_request/reject/<?= $key['id'];?>" onclick="return confirm('Are you Sure You Want to Reject this Request .?');" title="Reject">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                        <?php } ?>
                                                    </td>
                                                
                                            <?php } ?>
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

                <?php if($this->session->userdata('id') == '1'){ ?>
                    { "orderable": false, "targets": [4] }
                <?php } ?>    
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> <?= $page_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> <?= $page_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> <?= $page_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                }
            ]
            
        });
    })
</script>
