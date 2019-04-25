    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>


   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $_title; ?></h1>
          		</div>
                <?php if(check_right('12')){ ?>
                    <div class="col-sm-6">
                        <a href="<?= base_url('ifsc/add'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New</a>
                    </div>
                <?php } ?>
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
                                        
                                        <th>Ifsc Code</th>
                                        <th>Branch</th>
                                        <th>Bank</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th class="text-center" style="min-width: 100px;">Action</th>
                                        
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>


      	</div>
    </section>

    <style type="text/css">
        tr > td:last-of-type {
            text-align: center;
        }
    </style>

    <script type="text/javascript">
        $(function(){
            $('#users-all').DataTable({
                "processing":true,  
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                "serverSide":true,
                "ajax":{  
                    url:"<?php echo base_url() . 'ifsc/fetch_ifsc'; ?>",  
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
                        title: '<?=$this->config->config["projectTitle"]?> Ifsc Detail',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    },
                    { 
                        extend: 'pdf',
                        title: '<?=$this->config->config["projectTitle"]?> Ifsc Detail',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    },
                    { 
                        extend: 'excel',
                        title: '<?=$this->config->config["projectTitle"]?> Ifsc Detail',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    }
                ]
                
            });
        })
    </script>



