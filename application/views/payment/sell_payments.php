<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
          		</div>
                <div class="col-sm-6">
                    <a href="<?= base_url('payment/sell'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add Payment</a>
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
                                        <th>Customer Name</th>
                                        <th>Product</th>
                                        <th>No Of Installment</th>
                                        <th>Installment Amount</th>
                                        <th>Late Charges</th>
                                        <th>Payment Type</th>
                                        <th>Payment Details</th>
                                        <th>Received By</th>
                                        <th>Pay Date</th>
                                        <th class="text-center" id="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php foreach ($data as $key) { ?>

                                        <tr>
                                            <td>
                                                <?= $this->payment_model->get_customer($this->payment_model->get_sell($key['main_id'])['coust_name']); ?>   
                                            </td>
                                            <td>
                                                <?= $this->payment_model->get_product($this->payment_model->get_sell($key['main_id'])['product_id']); ?>        
                                            </td>
                                            <td>
                                                <?= $this->payment_model->get_sell_installment_by_id($key['installment_id'])['no_of_installment']; ?>        
                                            </td>
                                            <td><?= $key['amount_install']; ?></td>
                                            <td><?= $key['late_charge']; ?></td>
                                            <td><?= $key['pay_type']; ?></td>
                                            <td><?= nl2br($key['pay_detail']); ?></td>
                                            <td><?= $this->users->get_user($key['created_by'])[0]['user_type_id']; ?></td>
                                            <td style="min-width: 80px;"><?= _vdate($key['date']); ?></td>
                                            <td class="my_center" style="min-width: 170px;">
                                                <a class="btn btn-info btn-sm" 
                                                    href="<?= base_url('payment/sell_view/'); ?><?= $key['id']; ?>">
                                                    <i class="fa fa-eye" title="View"></i>
                                                </a>
                                                <a class="btn btn-secondary btn-sm" 
                                                    href="<?= base_url('payment/sell_print/'); ?><?= $key['id']; ?>"  target="_blank">
                                                    <i class="fa fa-print" title="Print"></i></a> 
                                                
                                                <?php if($this->session->userdata('id') == '1'){ ?>

                                                    <?php if($this->payment_model->sale_delete_off($key['id'],'sales')){ ?>
                                                    <a onclick="return master('<?= base_url('payment/delete_sale/'); ?><?= $key['id']; ?>');" href="" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                                    <?php } ?>
                                                    
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
                { "orderable": false, "targets": [6,9] }
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> Sales Payments',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> Sales Payments',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> Sales Payments',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                }
            ]
            
        });
    })
</script>
