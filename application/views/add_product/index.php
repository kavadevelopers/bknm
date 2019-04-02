<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
                </div>
                <?php if($this->session->userdata('id') == '1'){ ?>
                    
                    <div class="col-sm-6">
                        <a href="<?= base_url('create_product/add'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New</a>
                    </div>

                <?php } ?>
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
                                        <th>Land Location/Name</th>
                                        <th>Plot Number</th>
                                        <th>Plot Size (in Sq. Yd)</th>
                                        <th>Plot Size (in Sq. Ft)</th>
                                        <th>Sold/Un Sold </th>
                                        <th>Date</th>

                                        <?php if($this->session->userdata('id') == '1'){ ?>
                                            <th class="text-center" id="action">Action</th>
                                        <?php } ?>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($get_product_all as $key) {  ?>
                                        <tr>
                                            <td><?= $key['purchase_id']; ?></td>
                                            <td><?= $key['ploat_code']; ?></td>
                                            <td><?= $key['ploat_land_yard']; ?></td>
                                            <td><?= $key['ploat_size_sqft']; ?></td>

                                            <td>
                                                <?php if($key['status'] == '0'){ echo "Un Sold"; }else{ echo "Sold"; } ?>        
                                            </td>
                                            <td><?= date('d-m-Y',strtotime($key['date'])); ?></td>
                                            
                                            
                                            <?php if($this->session->userdata('id') == '1'){ ?>
                                                <td class="text-center">
                                                    <!-- <a class="btn btn-sm btn-success" href="<?= base_url();?>create_product/edit/<?= $key['id'];?>" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a> -->

                                                    <?php if($key['status'] == '0'){ ?>
                                                        <a class="btn btn-sm btn-danger" onclick="return master('<?= base_url();?>create_product/delete/<?= $key['id'];?>');" href="" title="Delete">
                                                            <i class="fa fa-trash"></i>
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
                    { "orderable": false, "targets": [6] }
                <?php } ?>    
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> Product',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> Product',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> Product',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                }
            ]
            
        });
    })
</script>
