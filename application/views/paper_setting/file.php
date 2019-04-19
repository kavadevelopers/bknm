    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>


   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $_title; ?></h1>
          		</div>
                <div class="col-sm-6">

                    <a href="<?= base_url('paper_setting/view_all_bank'); ?>" style="margin-left: 5px;" class="float-sm-right btn btn-info btn-sm"> <i class="fa fa-eye"></i> View Files</a>

                    <a href="<?= base_url('paper_setting/export_all_bank'); ?>" style="margin-left: 5px;" class="float-sm-right btn btn-warning btn-sm"> <i class="fa fa-eye"></i> Export Bank</a>

                    <a href="<?= base_url('paper_setting/export_all_corp'); ?>" style="margin-left: 5px;" class="float-sm-right btn btn-warning btn-sm"> <i class="fa fa-eye"></i> Export Corporate</a>

                    <a style="margin-left: 5px;" href="<?= base_url('paper_setting/add_file'); ?>" class="float-sm-right btn btn-primary btn-sm" onclick="return confirm('Are you Sure You Want To Add New File?');"> <i class="fa fa-plus"></i> Add New File</a>

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
                                        <th class="text-center" style="width: 180px;">Action</th>
                                        <th class="text-center" style="width: 250px;">Print</th>
                                        <th class="text-center" style="width: 150px;">Export</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $where = "AND `total` != '0' AND `total` != '' AND `total` != '0.00'"; ?>
                                    <?php foreach ($files as $index => $value) { ?>
                                        <tr>
                                            <td>File-<?= $value['no'] ?></td>
                                            <td><?= $this->general_model->get_head($value['head'])[0]['name'] ?></td>
                                            <td><?= $value['year'] ?></td>
                                            
                                            <td class="text-center">

                                                <a class="badge badge-primary" href="<?= base_url();?>paper_setting/add_data/<?= urlencode($value['id']);?>" title="Add Data">
                                                    Add Bill
                                                </a>

                                                <a class="badge badge-info" href="<?= base_url();?>paper_setting/view_data/<?= $value['id'];?>" title="View File">
                                                    View File
                                                </a>
                                                <?php $bank_data = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$value['file_name']."` WHERE `acc_code` != '' $where ORDER BY `id` ASC")->num_rows(); ?>
                                                <?php if($bank_data == 0){ $bank_link = 'onclick="return corp_not_found();"'; }else{ $bank_link = ""; } ?>
                                                <a class="badge badge-warning" <?= $bank_link ?> href="<?= base_url();?>paper_setting/view_bills/<?= $value['id'];?>" title="View Bills">
                                                    View Bills
                                                </a>
                                            </td>
                                            <td class="text-center">

                                            <?php $bank_data = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$value['file_name']."` WHERE `ifsc` NOT Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->num_rows(); ?>

                                            <?php if($bank_data == 0){ $bank_link = 'onclick="return corp_not_found();"'; }else{ $bank_link = ""; } ?>

                                                <a class="badge badge-primary" <?= $bank_link ?> href="<?= base_url();?>paper_setting/print_bank/<?= urlencode($value['id']);?>" title="Print Bank Copy" target="_blank">
                                                    Print Bank Copy
                                                </a>

                                            <?php $dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$value['file_name']."` WHERE `ifsc` Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->num_rows(); ?>

                                            <?php if($dis_acc == 0){ $corp_link = 'onclick="return corp_not_found();"'; }else{ $corp_link = ""; } ?>

                                                <a class="badge badge-info" <?= $corp_link ?> href="<?= base_url();?>paper_setting/print_corp_bank/<?= $value['id'];?>" title="View File" target="_blank">
                                                    Print Corporate Copy
                                                </a>


                                            </td>
                                            <td class="text-center">
                                                <a class="badge badge-warning" href="<?= base_url();?>paper_setting/bank_download/<?= $value['id'];?>" title="Bank Copy Excel">
                                                    Bank Copy
                                                </a>

                                                <a class="badge badge-secondary" href="<?= base_url();?>paper_setting/corp_download/<?= $value['id'];?>" title="Corporate Copy Excel">
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
                    
                    
                        { "orderable": false, "targets": [3,4,5] }
                        
                    
                ],
                order : [],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
            });
        })


        function corp_not_found()
        {

            $.notify({
                title: '<strong></strong>',
                icon: 'fa fa-times-circle',
                message: 'No data Found'
            },{
                type: 'danger'
            });

            return false;
        }
    </script>



