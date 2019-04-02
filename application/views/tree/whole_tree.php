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
                                                        <?= _fuserdt($main) ?>-<?= ucfirst($main['agent_id']) ?><?= _Bparent($main); ?><?= _Agstatus($main['active']); ?><br/><?= $this->auth->promotion_level_byid($main['agent_id']); ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="hv-item-children">

                                            <?php if(!empty($main['left'])){ $main = binary_tree_row($main['left']); ?>

                                                <div class="hv-item-child">
                            
                                                    <div class="hv-item">

                                                        <div class="hv-item-parent">
                                                            <div class="person">
                                                                <img src="<?=base_url();?>uploads/<?= _fuser($main['agent_id'])['image']; ?>" alt="">
                                                                <p class="name">
                                                                    <?= _fuserdt($main) ?>-<?= ucfirst($main['agent_id']) ?><?= _Bparent($main) ?>(L)<?= _Agstatus($main['active']); ?><br/><?= $this->auth->promotion_level_byid($main['agent_id']); ?><?= _whole_tree($main) ?>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <?php if(!empty($main['left']) || !empty($main['right'])){  ?>

                                                        <div class="hv-item-children">

                                                        
                                                            <?php if(!empty($main['left'])){ $lmain = binary_tree_row($main['left']); ?>
                                                            <div class="hv-item-child">
                                                                
                                                                <div class="person">
                                                                    <img src="<?=base_url();?>uploads/<?= _fuser($lmain['agent_id'])['image']; ?>" alt="">
                                                                    <p class="name">
                                                                        <?= _fuserdt($lmain) ?>-<?= ucfirst($lmain['agent_id']) ?><?= _Bparent($lmain) ?>(L)<?= _Agstatus($lmain['active']); ?><br/><?= $this->auth->promotion_level_byid($lmain['agent_id']); ?><?= _whole_tree($lmain) ?>
                                                                    </p>
                                                                </div>
                                                                
                                                            </div>
                                                            <?php } ?>
                                                        

                                                        
                                                            <?php if(!empty($main['right'])){ $rmain = binary_tree_row($main['right']); ?>
                                                            <div class="hv-item-child">
                                                                
                                                                <div class="person">
                                                                    <img src="<?=base_url();?>uploads/<?= _fuser($rmain['agent_id'])['image']; ?>" alt="">
                                                                    <p class="name">
                                                                        <?= _fuserdt($rmain) ?>-<?= ucfirst($rmain['agent_id']) ?><?= _Bparent($rmain) ?>(R)<?= _Agstatus($rmain['active']); ?><br/><?= $this->auth->promotion_level_byid($rmain['agent_id']); ?><?= _whole_tree($rmain) ?>
                                                                    </p>
                                                                </div>
                                                                
                                                            </div>
                                                            <?php } ?>
                                                        

                                                        </div>

                                                        <?php } ?>

                                                    </div>
                                                </div>

                                            <?php } ?>

                                            <?php if(!empty($right['right'])){ $right = binary_tree_row($right['right']); ?>

                                                <div class="hv-item-child">
                            
                                                    <div class="hv-item">

                                                        <div class="hv-item-parent">
                                                            <div class="person">
                                                                <img src="<?=base_url();?>uploads/<?= _fuser($right['agent_id'])['image']; ?>" alt="">
                                                                <p class="name">
                                                                    <?= _fuserdt($right) ?>-<?= ucfirst($right['agent_id']) ?><?= _Bparent($right) ?>(R)<?= _Agstatus($right['active']); ?><br/><?= $this->auth->promotion_level_byid($right['agent_id']); ?><?= _whole_tree($right) ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    <?php if(!empty($right['left']) || !empty($right['right'])){  ?>
                                                        <div class="hv-item-children">

                                                        
                                                            <?php if(!empty($right['left'])){ $lmain = binary_tree_row($right['left']); ?>
                                                            <div class="hv-item-child">
                                                                
                                                                <div class="person">
                                                                    <img src="<?=base_url();?>uploads/<?= _fuser($lmain['agent_id'])['image']; ?>" alt="">
                                                                    <p class="name">
                                                                        <?= _fuserdt($lmain) ?>-<?= ucfirst($lmain['agent_id']) ?><?= _Bparent($lmain) ?>(L)<?= _Agstatus($lmain['active']); ?><br/><?= $this->auth->promotion_level_byid($lmain['agent_id']); ?><?= _whole_tree($lmain) ?>
                                                                    </p>
                                                                </div>
                                                                
                                                            </div>
                                                            <?php } ?>
                                                        

                                                        
                                                            <?php if(!empty($right['right'])){ $rmain = binary_tree_row($right['right']); ?>
                                                            <div class="hv-item-child">
                                                                
                                                                <div class="person">
                                                                    <img src="<?=base_url();?>uploads/<?= _fuser($rmain['agent_id'])['image']; ?>" alt="">
                                                                    <p class="name">
                                                                        <?= _fuserdt($rmain) ?>-<?= ucfirst($rmain['agent_id']) ?><?= _Bparent($rmain) ?>(R)<?= _Agstatus($rmain['active']); ?><br/><?= $this->auth->promotion_level_byid($rmain['agent_id']); ?><?= _whole_tree($rmain) ?>
                                                                    </p>
                                                                </div>
                                                                
                                                            </div>
                                                            <?php } ?>
                                                        

                                                        </div>
                                                    <?php } ?>
                                                    </div>
                                                </div>

                                            <?php } ?>

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


