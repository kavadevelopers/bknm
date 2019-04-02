<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
                </div>
            </div>
        </div>
    </div>
<!-- /.content-header -->

    <link rel="stylesheet" href="<?= base_url(); ?>plugins/tree/css/hierarchy-view.css">
    <link rel="stylesheet" href="<?= base_url(); ?>plugins/tree/css/main.css">

<!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                            <section class="management-hierarchy" style="padding: 25px;">
                                <div class="hv-container">
                                    <div class="hv-wrapper">
                                        <div class="hv-item">
                                            <?php $main = binary_tree_row($agent_id); $right = binary_tree_row($agent_id); ?>
                                            <div class="hv-item-parent">
                                                <div class="person">
                                                    <img src="<?=base_url();?>uploads/<?= _fuser($main['agent_id'])['image']; ?>" alt="">
                                                    <p class="name">
                                                        <?= _fuserdt($main) ?>-<?= ucfirst($main['agent_id']) ?><?= _Bparent($main); ?><?= _Agstatus($main['active']); ?><br/><?= $this->auth->promotion_level_byid($agent_id); ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="hv-item-children">
                                                
                                                <!-- Left -->
                                                <?php if($this->binary_model->get_left($agent_id)){ ?>
                                                    <div class="hv-item-child">
                                                    <?php foreach($this->binary_model->get_left($agent_id) as $key => $main){ ?>
                                                        
                                                        
                                                            <div class="hv-item">
                                                                <div class="hv-item-parent" style="margin-bottom: 25px;">
                                                                    <div class="person">
                                                                        <img src="<?=base_url();?>uploads/<?= _fuser($main['agent_id'])['image']; ?>" alt="">
                                                                        <p class="name">
                                                                            <?= _fuserdt($main) ?>-<?= ucfirst($main['agent_id']) ?><?= _Bparent($main) ?>(L)<?= _Agstatus($main['active']); ?><br/><?= $this->auth->promotion_level_byid($main['agent_id']); ?><?= _more_tree($main) ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        

                                                    <?php } ?>
                                                    </div>
                                                <?php } ?>
                                                <!-- Left -->
                                                



                                                <!-- Right -->


                                                <?php if($this->binary_model->get_right($agent_id)){ ?>
                                                    <div class="hv-item-child">
                                                    <?php foreach($this->binary_model->get_right($agent_id) as $key => $main){ ?>
                                                        
                                                        
                                                            <div class="hv-item">
                                                                <div class="hv-item-parent" style="margin-bottom: 25px;">
                                                                    <div class="person">
                                                                        <img src="<?=base_url();?>uploads/<?= _fuser($main['agent_id'])['image']; ?>" alt="">
                                                                        <p class="name">
                                                                            <?= _fuserdt($main) ?>-<?= ucfirst($main['agent_id']) ?><?= _Bparent($main) ?>(R)<?= _Agstatus($main['active']); ?><br/><?= $this->auth->promotion_level_byid($main['agent_id']); ?><?= _more_tree($main) ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        

                                                    <?php } ?>
                                                    </div>
                                                <?php } ?>


                                                <!-- Right -->



                                            </div>






                                        </div>
                                    </div>
                                </div>
                            </section>

                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Main content -->


