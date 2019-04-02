<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
          		</div>
                <div class="col-sm-6">
                    <a href="<?= base_url('customer/add'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New</a>
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
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Sales</th>
                                        <?php if($this->session->userdata('id') == '1'){ ?>

                                            <th class="text-center" id="action">Action</th>

                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($customer as $key) { 
                                        $details = $this->user_genaral->customer_detail($key['id']); ?>
                                        <tr>
                                            <td><?= $key['user_type_id']; ?></td>
                                            <td><?= $details['fi_name'].' '.$details['la_name'];?></td>
                                            <td><?= $key['mobile']; ?></td>
                                            <td>
                                                <select class="form-control form-control-sm" id="<?=$key['user_type_id'];?>" name="" onchange="redirect_to_sale_view(this.value,<?=$key['user_type_id'];?>);" >
                                                <?php if($this->sel_product->get_sale_by_customer($key['id'])){ ?>
                                                    <option value="">-- Select Sale --</option>
                                                    <?php foreach($this->sel_product->get_sale_by_customer($key['id']) as $keya){ ?>

                                                        <option value="<?= $keya['id'];?>"><?= $keya['id'];?></option>

                                                    <?php } ?>
                                                <?php }else{ ?>
                                                    <option value="">-- No Sale Found --</option>
                                                <?php } ?>
                                                </select>
                                            </td>
                                            
                                            <?php if($this->session->userdata('id') == '1'){ ?>
                                                
                                                <td class="text-center">
                                                     <a class="btn btn-sm btn-info" href="<?= base_url();?>customer/view/<?= $key['id'];?>" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <a class="btn btn-sm btn-success" onclick="return master('<?= base_url();?>customer/edit/<?= $key['id'];?>');" href="" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a class="btn btn-sm btn-danger" onclick="return master('<?= base_url();?>customer/delete/<?= $key['id'];?>');" href="" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

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
                    title: '<?=$this->config->config["projectTitle"]?> Customer',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> Customer',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> Customer',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                }
            ]
            
        });
    })

    function redirect_to_sale_view(id,d_id)
    {
        if(id != '')
        {
            window.open('<?=base_url("sell_product/view/");?>'+id, '_blank');
            $('#'+d_id+' :selected').text(d_id);
        }
    }
</script>
