    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>


   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $_title; ?></h1>
          		</div>
                <div class="col-sm-6">
                    <a href="<?= base_url('paper_setting/add_file'); ?>" class="float-sm-right btn btn-primary btn-sm" onclick="return confirm('Are you Sure You Want To Add New File?');"> <i class="fa fa-plus"></i> Add New File</a>
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
                            <table class="table table-bordered table-striped table-sm" id="file-all">
                                <thead>
                                    <tr>
                                        
                                        <th>File No.</th>
                                        <th>Head</th>
                                        <th>Year</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th class="text-center" style="width: 100px;">Action</th>
                                        <th class="text-center" style="width: 150px;">Export</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($files as $index => $value) { ?>
                                        <tr>
                                            <td>File-<?= $value['no'] ?></td>
                                            <td><?= $this->general_model->get_head($value['head'])[0]['name'] ?></td>
                                            <td><?= $this->general_model->get_year($value['year'])[0]['name'] ?></td>
                                            <td><?= $this->user_model->_user($value['created_by'])[0]['name'] ?></td>
                                            <td><?= _vdatetime($value['created_at']) ?></td>
                                            <td class="text-center">

                                                <a class="badge badge-primary" href="<?= base_url();?>paper_setting/add_data/<?= urlencode($value['id']);?>" title="Add Data">
                                                    Add Bill
                                                </a>

                                                <a class="badge badge-info" href="<?= base_url();?>paper_setting/view_data/<?= $value['id'];?>" title="View File">
                                                    View File
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a class="badge badge-warning" href="<?= base_url();?>paper_setting/add_data/<?= $value['id'];?>" title="Bank Copy">
                                                    Bank Copy
                                                </a>

                                                <a class="badge badge-secondary" href="<?= base_url();?>paper_setting/add_data/<?= $value['id'];?>" title="Corporate Copy">
                                                    Corporate Copy
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
            $('#file-all').DataTable({
                "dom": "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
                "columnDefs": [
                    
                    
                        { "orderable": false, "targets": [5,6] }
                        
                    
                ],
                order : [],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            });
        })
    </script>



