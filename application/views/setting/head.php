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

                    <?php if($this->uri->segment(2) == 'head' || $this->uri->segment(2) == 'save_head'): ?>

                        
                        <!-- <div class="col-md-4">
                            <form method="post" action="<?= base_url(); ?>setting/save_head" enctype="multipart/form-data">
                                <div class="card card-info"> 

                                    <div class="card-header">
                                        <h3 class="card-title">Add Head</h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Head Name <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" value="<?php echo set_value('head'); ?>" type="text" name="head" placeholder="Head Name" autocomplete="off" spellcheck="false">
                                                    <?php echo form_error('head'); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>File Limit <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" value="<?php echo set_value('file_limit'); ?>" type="text" name="file_limit" placeholder="File Limit" autocomplete="off" spellcheck="false">
                                                    <?php echo form_error('file_limit'); ?>
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
                        </div> -->

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-sm" id="year-all">
                                        <thead>
                                            <tr>
                                                
                                                <th>Head Name</th>
                                                <th>File Limit</th>
                                                <th>Day Allowance</th>
                                                <th>Created By</th>
                                                <th>Created At</th>
                                                <th class="text-center" style="width: 100px;">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($head as $index => $value) { ?>
                                                <tr>
                                                    <td><?= $value['name'] ?></td>
                                                    <td><?= $value['file_limit'] ?></td>
                                                    <td><?= $value['day'] ?></td>
                                                    <td><?= $this->user_model->_user($value['created_by'])[0]['name'] ?></td>
                                                    <td><?= _vdatetime($value['created_at']) ?></td>
                                                    <td class="text-center">

                                                        <a class="btn btn-sm btn-primary" href="<?= base_url();?>setting/edit_head/<?= $value['id'];?>" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <!-- <a class="btn btn-sm btn-danger" href="<?= base_url();?>setting/delete_head/<?= $value['id'];?>" onclick="return confirm('Are you Sure You Want to Delete this Head Name ?');" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </a> -->

                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        

                    <?php elseif($this->uri->segment(2) == 'edit_head' || $this->uri->segment(2) == 'update_head'): ?>

                        
                        <div class="col-md-4">
                            <form method="post" action="<?= base_url(); ?>setting/update_head" enctype="multipart/form-data">
                                <div class="card card-info"> 
                                    <input type="hidden" name="id" value="<?php echo set_value('id',$fyear['id']); ?>">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit Head</h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Head Name <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" value="<?php echo set_value('head',$fyear['name']); ?>" type="text" name="head" placeholder="Head Name" autocomplete="off" spellcheck="false" readonly>
                                                    <?php echo form_error('head'); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>File Limit <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" value="<?php echo set_value('file_limit',$fyear['file_limit']); ?>" type="text" name="file_limit" placeholder="File Limit" autocomplete="off" spellcheck="false">
                                                    <?php echo form_error('file_limit'); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Day Allowance <span class="astrick">*</span></label>
                                                    <input class="form-control form-control-sm" value="<?php echo set_value('day',$fyear['day']); ?>" type="text" name="day" placeholder="Day Allowance" autocomplete="off" spellcheck="false">
                                                    <?php echo form_error('day'); ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <div class="float-right">
                                            <a href="<?= base_url(); ?>setting/head" class="btn btn-danger">Cancel</a>
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
                    
                    
                        { "orderable": false, "targets": [5] }
                        
                    
                ],
                order : [],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            });
        })
    </script>