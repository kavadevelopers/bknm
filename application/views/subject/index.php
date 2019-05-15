    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>


   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $_title; ?></h1>
          		</div>
                <div class="col-sm-6">
                    <a href="<?= base_url('subject/add'); ?>" class="float-sm-right btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add New</a>
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
                            <table class="table table-bordered table-striped table-sm" id="subject-all">
                                <thead>
                                    <tr>
                                        
                                        <th>Course</th>
                                        <th>Semester</th>
                                        <th>Paper Setting Price</th>
                                        <th>Paper Assessment Price</th>
                                        <th>Examination Fees</th>
                                        <th>Total Papers</th>
                                        <th>Paper Moderation Price</th>
                                        <th class="text-center" style="width: 100px;">Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($subjects as $index => $subject){ ?>

                                        <tr>
                                            <td><?= $subject['name'] ?></td>
                                            <td><?= $subject['semester'] ?></td>
                                            <td><?= $subject['paper_setting_price'] ?></td>
                                            <td><?= $subject['assessment_price'] ?></td>
                                            <td><?= $subject['examination_fees'] ?></td>
                                            <td><?= $subject['total_paper'] ?></td>
                                            <td><?= $subject['moderation_price'] ?></td>

                                            <td class="text-center">

                                                <a class="btn btn-sm btn-primary" href="<?= base_url();?>subject/edit/<?= $subject['id'];?>" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a class="btn btn-sm btn-danger" href="<?= base_url();?>subject/delete/<?= $subject['id'];?>" onclick="return confirm('Are you Sure You Want to Delete this Subject ?');" title="Delete">
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
            $('#subject-all').DataTable({
                "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
                "columnDefs": [
                    
                    
                        { "orderable": false, "targets": [7] }
                        
                    
                ],
                order : [],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [ 
                    { 
                        extend: 'print',
                        title: '<?=$this->config->config["projectTitle"]?> Courses',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    },
                    { 
                        extend: 'pdf',
                        title: '<?=$this->config->config["projectTitle"]?> Courses',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    },
                    { 
                        extend: 'excel',
                        title: '<?=$this->config->config["projectTitle"]?> Courses',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    }
                ]
                
            });
        })
    </script>



