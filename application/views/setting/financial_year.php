    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>


   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $_title; ?></h1>
          		</div>
        	</div>
      	</div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
                <div class="row">

                    <?php if($this->uri->segment(2) == 'financial_year' || $this->uri->segment(2) == 'save_financial_year'): ?>

                        
                        <div class="col-md-4">
                            <form method="post" action="<?= base_url(); ?>setting/save_financial_year" enctype="multipart/form-data">
                                <div class="card card-info"> 

                                    <div class="card-header">
                                        <h3 class="card-title">Add Financial Year</h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Financial Year <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" value="<?php echo set_value('financial_year'); ?>" type="text" name="financial_year" placeholder="Financial Year ..ex(2020-2021)" autocomplete="off" spellcheck="false">
                                                    <?php echo form_error('financial_year'); ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <div class="float-right">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm" id="year-all">
                                        <thead>
                                            <tr>
                                                
                                                <th>Financial Year</th>
                                                <th>Created By</th>
                                                <th>Created At</th>
                                                <th class="text-center" style="width: 100px;">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($year as $index => $value) { ?>
                                                <tr>
                                                    <td><?= $value['name'] ?></td>
                                                    <td><?= $this->user_model->_user($value['created_by'])[0]['name'] ?></td>
                                                    <td><?= _vdatetime($value['created_at']) ?></td>
                                                    <td class="text-center">

                                                        <a class="btn btn-sm btn-primary" href="<?= base_url();?>setting/edit_financial_year/<?= $value['id'];?>" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-danger" href="<?= base_url();?>setting/delete_financial_year/<?= $value['id'];?>" onclick="return confirm('Are you Sure You Want to Delete this Financial Year ?');" title="Delete">
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
                        

                    <?php elseif($this->uri->segment(2) == 'edit_financial_year' || $this->uri->segment(2) == 'update_financial_year'): ?>

                        
                        <div class="col-md-4">
                            <form method="post" action="<?= base_url(); ?>setting/update_financial_year" enctype="multipart/form-data">
                                <div class="card card-info"> 
                                    <input type="hidden" name="id" value="<?php echo set_value('id',$fyear['id']); ?>">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit Financial Year</h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Financial Year <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" value="<?php echo set_value('financial_year',$fyear['name']); ?>" type="text" name="financial_year" placeholder="Financial Year ..ex(2020-2021)" autocomplete="off" spellcheck="false">
                                                    <?php echo form_error('financial_year'); ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <div class="float-right">
                                            <a href="<?= base_url(); ?>setting/financial_year" class="btn btn-danger">Cancel</a>
                                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Save</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        

                    <?php endif; ?>

                    

                </div>
            
        </div>
    </section>


    <script type="text/javascript">
        $(function(){
            $('#year-all').DataTable({
                "dom": "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
                "columnDefs": [
                    
                    
                        { "orderable": false, "targets": [3] }
                        
                    
                ],
                order : [],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            });
        })
    </script>