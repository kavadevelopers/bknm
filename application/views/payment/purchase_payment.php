<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <a href="<?= base_url('payment/purchase'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add Payment</a>
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
                                        <th>Saller Name</th>
                                        <th>No Of Installment</th>
                                        <th>Installment Amount</th>
                                        <th>Late Charges</th>
                                        <th>Payment Type</th>
                                        <th>Payment Details</th>
                                        <th>Pay Date</th>

                                        <?php if($this->session->userdata('id') == '1'){ ?>
                                            <th class="text-center" id="action">Action</th>

                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php foreach ($data as $key) { ?>

                                        <tr>
                                            <td>
                                                <?= $this->payment_model->find_saleer($key['main_id'])[0]['name'].'-'.$this->payment_model->find_saleer($key['main_id'])[0]['p_id']; ?>   
                                            </td>
                                            <td>
                                                <?= $this->payment_model->get_purchase_installment_by_id($key['installment_id'])['no_of_installment']; ?>        
                                            </td>
                                            <td><?= $key['amount_install']; ?></td>
                                            <td><?= $key['late_charge']; ?></td>
                                            <td><?= $key['pay_type']; ?></td>
                                            <td><?= nl2br($key['pay_detail']); ?></td>
                                            <td style="min-width: 80px;"><?= _vdate($key['date']); ?></td>
                                                
                                            <?php if($this->session->userdata('id') == '1'){ ?>

                                                <td class="my_center" style="min-width: 170px;">
                                                    <!-- <a class="btn btn-sm btn-success" onclick="return master('<?= base_url('payment/purchase_edit/'); ?><?= $key['id']; ?>');" href="" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a> -->
                                                    <?php if($this->payment_model->sale_delete_off($key['id'],'purchase')){ ?>
                                                    <a onclick="return master('<?= base_url('payment/delete_purchase/'); ?><?= $key['id']; ?>');" href="" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
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
                    { "orderable": false, "targets": [7,5] }
                <?php } ?>
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> Purchase Payments',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> Purchase Payments',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> Purchase Payments',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                }
            ]
            
        });
    })
</script>
