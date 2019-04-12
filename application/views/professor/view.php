   <title><?=$this->config->config["projectTitle"]?> | <?= $_title; ?></title>


   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?= $_title; ?></h1>
          		</div>
                <div class="col-sm-6">
                    <a href="<?= base_url('professor'); ?>" class="float-sm-right btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
                </div>  
        	</div>
      	</div>
    </div>

    <style type="text/css">
        hr{
            margin : 1px 0;
        }
    </style>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Professor Information</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content ml-1" id="myTabContent">
                                        <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                            
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Acc Code</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $professor['acc_code']; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Name</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $professor['name']; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Contact No.</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $professor['contact']; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Bank Account No.</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $professor['acno']; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Ifsc Code</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $professor['ifsc']; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Branch</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $professor['branch']; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">RC Book No.</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= nl2br($professor['rcbook']); ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Fule Type</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $professor['fule']; ?>
                                                </div>
                                            </div>
                                            <hr /> 

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Faculty</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $professor['faculty']; ?>
                                                </div>
                                            </div>
                                            <hr /> 

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Reference</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $professor['ref']; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Remark</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= nl2br($professor['remark']); ?>
                                                </div>
                                            </div>
                                            <hr /> 


                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Created By</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $this->user_model->_user($professor['created_by'])[0]['name'] ?> - <?= _vdatetime($professor['created_at']) ?>
                                                </div>
                                            </div>
                                            <hr />   

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Updated By</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $this->user_model->_user($professor['updated_by'])[0]['name'] ?> - <?= _vdatetime($professor['updated_at']) ?>
                                                </div>
                                            </div>
                                            <hr />                                             


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>