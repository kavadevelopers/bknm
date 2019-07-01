    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>

   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark">Welcome To BKNMU</h1>
          		</div>
        	</div>
      	</div>
    </div>


    <section class="content">
      	<div class="container-fluid">
      	     <div class="row">
              	<div class="col-md-3 col-sm-6 col-12">
                	<div class="info-box bg-success-gradient">
                  		<span class="info-box-icon"><i class="fa fa-users"></i></span>
                  		<div class="info-box-content">
                    		<span class="info-box-text">Total Professor</span>
                    		<span class="info-box-number"><?= $count_professor; ?></span>
                  		</div>
                	</div>
              	</div>

                <?php if(check_right('18')){ ?>
                    <div class="col-md-9 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-sm" id="head_summary">
                                    <thead>
                                        <tr>
                                            
                                            <th>Head Name</th>
                                            <th>Total Files</th>
                                            <th>Total Bill Amount</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Paper Setting</td>
                                            <td><?= count($this->general_model->get_all_files('1',$this->session->userdata('year'))); ?></td>
                                            <td><?= moneyFormatIndia($this->dashboard_model->total_by_head('1')); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Squad</td>
                                            <td><?= count($this->general_model->get_all_files('2',$this->session->userdata('year'))); ?></td>
                                            <td><?= moneyFormatIndia($this->dashboard_model->total_by_head('2')); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Assessment</td>
                                            <td><?= count($this->general_model->get_all_files('3',$this->session->userdata('year'))); ?></td>
                                            <td><?= moneyFormatIndia($this->dashboard_model->total_by_head('3')); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Modaration</td>
                                            <td><?= count($this->general_model->get_all_files('4',$this->session->userdata('year'))); ?></td>
                                            <td><?= moneyFormatIndia($this->dashboard_model->total_by_head('4')); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
      	</div>
    </section>



    <script type="text/javascript">
        $(function(){
            $('#head_summary').DataTable({
                "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
                "columnDefs": [
                    
                    
                        // { "orderable": false, "targets": [7] }
                        
                    
                ],
                order : [],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [ 
                    { 
                        extend: 'print',
                        title: '<?=$this->config->config["projectTitle"]?> Head Summary',
                        exportOptions: {
                            columns: [0,1,2]
                        }
                    },
                    { 
                        extend: 'pdf',
                        title: '<?=$this->config->config["projectTitle"]?> Head Summary',
                        exportOptions: {
                            columns: [0,1,2]
                        }
                    },
                    { 
                        extend: 'excel',
                        title: '<?=$this->config->config["projectTitle"]?> Head Summary',
                        exportOptions: {
                            columns: [0,1,2]
                        }
                    }
                ]
                
            });
        })
    </script>

