    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>


   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $_title; ?></h1>
          		</div>
                <div class="col-sm-6">
                    <a href="<?= base_url('professor/add'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New</a>
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
                                        
                                        <th>Acc Code</th>
                                        <th>Name</th>
                                        <th>Bank Account No.</th>
                                        <th>Contact No.</th>
                                        <th>IFSC Code</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th class="text-center" style="width: 100px;">Action</th>
                                        
                                    </tr>
                                </thead>
                                
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
                "processing":true,  
                "language": {
                    'processing'        : 'Hang on. Waiting for response...'
                },
                "serverSide":true,
                "ajax":{  
                    url:"<?php echo base_url() . 'professor/fetch_professor'; ?>",  
                    type:"POST"  
                },
                "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
                "columnDefs": [
                    
                    
                        { "orderable": false, "targets": [7] }
                        
                    
                ],
                order : [],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [ 
                    { 
                        extend: 'print',
                        title: '<?=$this->config->config["projectTitle"]?> Professors',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    },
                    { 
                        extend: 'pdf',
                        title: '<?=$this->config->config["projectTitle"]?> Professors',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    },
                    { 
                        extend: 'excel',
                        title: '<?=$this->config->config["projectTitle"]?> Professors',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    }
                ]
                
            });
        })
    </script>



