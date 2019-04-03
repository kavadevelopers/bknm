    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>


   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $_title; ?></h1>
          		</div>
                <div class="col-sm-6">
                    <a href="<?= base_url('user/add'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New</a>
                </div>
        	</div>
      	</div>
    </div>


    <section class="content">
      	<div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-sm" id="users-all">
                                <thead>
                                    <tr>
                                        
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th class="text-center" style="width: 100px;">Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $index => $user){ ?>

                                        <tr>
                                            <td><?= $user['name'] ?></td>
                                            <td><?= $user['user_name'] ?></td>
                                            <td><?= $user['mobile'] ?></td>
                                            <td><?= $user['email'] ?></td>

                                            <td class="text-center">

                                                <a class="btn btn-sm btn-primary" href="<?= base_url();?>user/edit/<?= $user['id'];?>" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a class="btn btn-sm btn-warning" href="<?= base_url();?>user/reset_pass/<?= $user['id'];?>" title="Reset Password">
                                                    <i class="fa fa-refresh"></i>
                                                </a>

                                                <a class="btn btn-sm btn-danger" href="<?= base_url();?>user/delete/<?= $user['id'];?>" onclick="return confirm('Are you Sure You Want to Delete this User ?');" title="Delete">
                                                    <i class="fa fa-trash"></i>
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



    <script type="text/javascript">
        $(function(){
            $('#users-all').DataTable({
                "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
                "columnDefs": [
                    
                    
                        { "orderable": false, "targets": [4] }
                        
                    
                ],
                order : [],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [ 
                    { 
                        extend: 'print',
                        title: '<?=$this->config->config["projectTitle"]?> Users',
                        exportOptions: {
                            columns: [0,1,2,3]
                        }
                    },
                    { 
                        extend: 'pdf',
                        title: '<?=$this->config->config["projectTitle"]?> Users',
                        exportOptions: {
                            columns: [0,1,2,3]
                        }
                    },
                    { 
                        extend: 'excel',
                        title: '<?=$this->config->config["projectTitle"]?> Users',
                        exportOptions: {
                            columns: [0,1,2,3]
                        }
                    }
                ]
                
            });
        })
    </script>



