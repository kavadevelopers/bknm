   <title><?=$this->config->config["projectTitle"]?> | <?= $_title; ?></title>


   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?= $_title; ?></h1>
          		</div>
                <div class="col-sm-6">
                    <a href="<?= base_url('ifsc'); ?>" class="float-sm-right btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
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
                                            <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Ifsc Information</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content ml-1" id="myTabContent">
                                        <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                            
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Ifsc Code</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $ifsc['ifsc']; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Branch</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $ifsc['branch']; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Address</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= nl2br($ifsc['address']); ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">City</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $ifsc['city']; ?>
                                                </div>
                                            </div>
                                            <hr /> 

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">District</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $ifsc['district']; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Bank</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $ifsc['bank']; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Bank Short Name</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $ifsc['short_name_bank']; ?>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Micr</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $ifsc['micr']; ?>
                                                </div>
                                            </div>
                                            <hr /> 

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Contact</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $ifsc['contact']; ?>
                                                </div>
                                            </div>
                                            <hr />  

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">State</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $ifsc['state']; ?>
                                                </div>
                                            </div>
                                            <hr />  


                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Created By</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $this->user_model->_user($ifsc['created_by'])[0]['name'] ?> - <?= _vdatetime($ifsc['created_at']) ?>
                                                </div>
                                            </div>
                                            <hr />   

                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 col-5">
                                                    <label style="font-weight:bold;">Updated By</label>
                                                </div>
                                                <div class="col-md-8 col-6">
                                                    <?= $this->user_model->_user($ifsc['updated_by'])[0]['name'] ?> - <?= _vdatetime($ifsc['updated_at']) ?>
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