<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
          		</div>
                <div class="col-sm-6">
                    <a href="<?= base_url('partner_investment/add'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New</a>
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
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Payment Detail</th>
                                        <th>Date</th>
                                        <th class="text-center" id="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php foreach ($invest as $key => $value) { $b_detail = $this->partner_invest->business_detail($value['name']); ?>

                                        <tr>
                                           
                                            <td><?= $b_detail['fi_name'].' '.$b_detail['mi_name'].' '.$b_detail['la_name']; ?></td>
                                            <td><?= $value['invest_amount']; ?></td>
                                            <td><?= $value['pay_mode']; ?></td>
                                            <td><?= nl2br($value['pay_mode_detail']); ?></td>
                                            <td style="min-width: 80px;"><?= _vdate($value['pay_date']); ?></td>
                                            
                                            <td class="my_center" style="min-width: 170px;">
                                                <a onclick="return master('<?= base_url('partner_investment/edit/').$value['id'];?>');" href="" class="btn btn-sm btn-success" title="Edit"><i class="fa fa-edit"></i>
                                                </a>                                                

                                                <a onclick="return master('<?= base_url('partner_investment/delete/').$value['id'];?>');" href="" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i>
                                                </a>
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
                { "orderable": false, "targets": [5] }
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> Investment',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> Investment',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> Investment',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                }
            ]
            
        });
    })
</script>
