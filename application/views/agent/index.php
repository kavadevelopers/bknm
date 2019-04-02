<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
          		</div>
                <div class="col-sm-6">
                    <a href="<?= base_url('agent/add'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New</a>
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
                                        
                                        <th>Agent Id</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Promotion Level</th>
                                        <th>Active / Deactive</th>
                                        <?php if($this->session->userdata('id') == '1'){ ?>

                                            <th class="text-center" id="action">Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($agents as $key) { $details = get_agent_details($key['id']); ?>

                                        <tr>
                                            
                                            <td><?= $key['user_type_id']; ?></td>
                                            <td><?=$details['fi_name'].' '.$details['la_name'];?></td>
                                            <td><?= $key['mobile']; ?></td>
                                            <td><?= $this->auth->promotion_level_byid($key['user_type_id']); ?></td>
                                            <td class="text-center">
                                                <?php if($this->users->active_agent($key['user_type_id'])[0]['active'] == 0) { ?>
                                                    <span href="<?= base_url('agent/active/').$key['user_type_id']; ?>" class="badge badge-success">Active</span><?php } else { ?>

                                                    <span href="<?= base_url('agent/deactive/').$key['user_type_id']; ?>" class="badge badge-danger">Deactive</span>
                                                <?php } ?>
                                            </td>
                                            
                                            <?php if($this->session->userdata('id') == '1'){ ?>
                                                
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-secondary" href="<?= base_url();?>tree/get/<?= $key['user_type_id'];?>" target="_blank" title="Binary Tree">
                                                        <i class="fa fa-tree"></i>
                                                    </a>

                                                    <a class="btn btn-sm btn-info" href="<?= base_url();?>agent/view/<?= $key['id'];?>" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    
                                                    <a class="btn btn-sm btn-success" onclick="return master('<?= base_url();?>agent/edit/<?= $key['id'];?>');" href="" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a class="btn btn-sm btn-danger" onclick="return master('<?= base_url();?>agent/delete/<?= $key['id'];?>');" href="" onclick="return confirm('Are you Sure You Want to Delete this Agent .?');" title="Delete">
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
                
                    { "orderable": false, "targets": [5] }
                    
                <?php } ?>
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> Agent',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> Agent',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> Agent',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                }
            ]
            
        });
    })
</script>

