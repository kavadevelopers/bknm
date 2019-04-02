<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <a href="<?= base_url('setting/add_location'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New</a>
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
                                        <th>#</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                        foreach ($location as $key => $row) { ?>
                                        <tr>
                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['name'] ?></td>                                           
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
            
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> Locations',
                    exportOptions: {
                        columns: [0,1]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> Locations',
                    exportOptions: {
                        columns: [0,1]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> Locations',
                    exportOptions: {
                        columns: [0,1]
                    }
                }
            ]
            
        });
    })
</script>
