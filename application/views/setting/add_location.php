<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="<?= base_url(); ?>setting/save_location" enctype="product/form-data">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card card-info"> 
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Location Name <span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="location" placeholder="Location Name" value="<?php echo set_value('location'); ?>">
                                            <?php echo form_error('location'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    

                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>setting/location" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                </div>
            </form>    
        </div>
    </section>

<script type="text/javascript">
    <?php if(!empty(validation_errors())){ ?>
    $(function(){
        $.notify({
            title: '<strong></strong>',
            icon: 'fa fa-times-circle',
            message: 'Your Form Was Not Submmited Check Your Form'
        },{
            type: 'danger'
        }); 
    })
    <?php } ?>
</script>