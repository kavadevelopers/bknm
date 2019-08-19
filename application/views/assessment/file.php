    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>


   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $_title; ?></h1>
          		</div>
                <div class="col-sm-6">

                    <?php if(check_right('4')){ ?>
                        <a href="<?= base_url('assessment/view_all_bank'); ?>" style="margin-left: 5px;" class="float-sm-right btn btn-info btn-sm"> <i class="fa fa-eye"></i> View Files</a>
                    <?php } ?>

                    <?php if(check_right('3')){ ?>
                        <a id="export_al_corp"  href="<?= base_url('assessment/export_all_corp'); ?>" style="margin-left: 5px;" class="float-sm-right btn btn-warning btn-sm"> <i class="fa fa-eye"></i> Export Corporate</a>
                    <?php } ?>
                    
                    <?php if(check_right('2')){ ?>
                        <a id="export_bnk" href="<?= base_url('assessment/export_all_bank'); ?>" style="margin-left: 5px;" class="float-sm-right btn btn-warning btn-sm"> <i class="fa fa-eye"></i> Export Bank</a>
                    <?php } ?>

                    

                    <?php if(check_right('1')){ ?>
                        <a style="margin-left: 5px;" href="<?= base_url('assessment/add_file_view'); ?>" class="float-sm-right btn btn-primary btn-sm" > <i class="fa fa-plus"></i> Add New File</a>
                    <?php } ?>
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
                                        <?php if(check_right('2') || check_right('3')){ ?>
                                            <th class="text-center">#</th>
                                        <?php } ?>

                                        <th class="text-center" style="width: 40px;">File No.</th>
                                        <th class="text-center" style="width: 60px;">Year</th>
                                        <th class="text-center" style="width: 40px;">SEM</th>

                                        <?php if($this->session->userdata('id') == '1'){ ?>
                                            <th>Entry By</th>
                                        <?php } ?>
                                        <?php if(check_rights_column(['5','6','7'])){ ?>
                                            <th class="text-center" style="width: 180px;">Action</th>
                                        <?php } ?>

                                        <?php if(check_rights_column(['8','9'])){ ?>
                                            <th class="text-center" style="width: 250px;">Print</th>
                                        <?php } ?>

                                        <?php if(check_rights_column(['10','11'])){ ?>
                                            <th class="text-center" style="width: 150px;">Export</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $where = "AND `total` != '0' AND `total` != '' AND `total` != '0.00'"; ?>
                                    <?php foreach ($files as $index => $value) { ?>
                                        <tr>
                                            <?php if(check_right('2') || check_right('3')){ ?>
                                                <td>
                                                    <label class="container">
                                                        <input type="checkbox" class="chk_box" name="chk_box" value="<?= $value['id'] ?>">
                                                        <span class="checkmark" style="left: 13px !important;"></span>
                                                    </label>
                                                </td>
                                            <?php } ?>
                                            <td>File-<?= $value['no'] ?></td>
                                            <td class="text-center"><?= $value['year'] ?></td>
                                            <td class="text-center"><?= ($value['sem'] == 1)?'1 - 3 - 5':'2 - 4 - 6'; ?></td>

                                            <?php if($this->session->userdata('id') == '1'){ ?>
                                                <td><?= $value['entry_by'] ?></td>
                                            <?php } ?>

                                            <?php if(check_rights_column(['5','6','7'])){ ?>
                                                <td class="text-center">

                                                    <?php if(check_right('5')){ ?>
                                                        <?php if($value['final'] != '1'){ ?>
                                                            <a class="badge badge-primary" href="<?= base_url();?>assessment/add_data/<?= urlencode($value['id']);?>" title="Add Data">
                                                                Add Bill
                                                            </a>
                                                        <?php } else if($this->session->userdata('id') == '1'){ ?>

                                                            <a class="badge badge-primary" href="<?= base_url();?>assessment/add_data/<?= urlencode($value['id']);?>" title="Add Data">
                                                                Add Bill
                                                            </a>    

                                                        <?php }else{ ?>

                                                            <a class="badge badge-primary" href="#" onclick="return admin_send();" title="Add Data">
                                                                Add Bill
                                                            </a>

                                                    <?php } } ?>

                                                    <?php if(check_right('6')){ ?>
                                                        <a class="badge badge-info" href="<?= base_url();?>assessment/view_data/<?= $value['id'];?>" title="View File">
                                                            View File
                                                        </a>
                                                    <?php } ?>

                                                    <?php if(check_right('7')){ ?>
                                                        <?php $bank_data = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$value['file_name']."` WHERE `acc_code` != '' $where ORDER BY `id` ASC")->num_rows(); ?>
                                                        <?php if($bank_data == 0){ $bank_link = 'onclick="return corp_not_found();"'; }else{ $bank_link = ""; } ?>
                                                        <a class="badge badge-warning" <?= $bank_link ?> href="<?= base_url();?>assessment/view_bills/<?= $value['id'];?>" title="View Bills">
                                                            View Bills
                                                        </a>
                                                    <?php } ?>

                                                    <?php if(check_right('21')){ ?>
                                                        <a class="badge badge-info" href="<?= base_url();?>assessment/edit_file/<?= $value['id'];?>" title="Edit File">
                                                            Edit File
                                                        </a>
                                                    <?php } ?>

                                                    <?php if(check_right('20')){ ?>
                                                        <a class="badge badge-danger" onclick="return confirm('Are You Sure Want To Delete This File ?');" href="<?= base_url();?>assessment/delete/<?= $value['id'];?>" title="Delete File">
                                                            Delete File
                                                        </a>
                                                    <?php } ?>

                                                </td>
                                            <?php } ?>

                                            <?php if(check_rights_column(['8','9'])){ ?>
                                                <td class="text-center">
                                                    <?php if(check_right('8')){ ?>
                                                        <?php $bank_data = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$value['file_name']."` WHERE `ifsc` NOT Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->num_rows(); ?>

                                                        <?php if($bank_data == 0){ $bank_link = 'onclick="return corp_not_found();"'; }else{ $bank_link = ""; } ?>

                                                        <a class="badge badge-primary" <?= $bank_link ?> href="<?= base_url();?>assessment/print_bank/<?= urlencode($value['id']);?>" title="Print Bank Copy" target="_blank">
                                                            Print Bank Copy
                                                        </a>
                                                    <?php } ?>

                                                    <?php if(check_right('9')){ ?>
                                                        <?php $dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$value['file_name']."` WHERE `ifsc` Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->num_rows(); ?>

                                                        <?php if($dis_acc == 0){ $corp_link = 'onclick="return corp_not_found();"'; }else{ $corp_link = ""; } ?>

                                                        <a class="badge badge-info" <?= $corp_link ?> href="<?= base_url();?>assessment/print_corp_bank/<?= $value['id'];?>" title="View File" target="_blank">
                                                            Print Corporate Copy
                                                        </a>
                                                    <?php } ?>

                                                </td>
                                            <?php } ?>
                                            <?php if(check_rights_column(['10','11'])){ ?>
                                                <td class="text-center">
                                                    <?php if(check_right('10')){ ?>
                                                        <a class="badge badge-warning" href="<?= base_url();?>assessment/bank_download/<?= $value['id'];?>" title="Bank Copy Excel">
                                                            Bank Copy
                                                        </a>
                                                    <?php } ?>
                                                    <?php if(check_right('11')){ ?>
                                                        <a class="badge badge-secondary" href="<?= base_url();?>assessment/corp_download/<?= $value['id'];?>" title="Corporate Copy Excel">
                                                            Corporate Copy
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            <?php } ?>
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


        var chk = $('chk_box').val();

        $(function(){
            $('#export_bnk').click(function(){
                var checkedIds = $(".chk_box:checked").map(function() {
                    return this.value;
                  }).toArray();
                
                if(checkedIds == ''){
                    $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-times-circle',
                        message: 'Please Select Any One File.'
                      },{
                        type: 'danger'
                      });
                }
                else{
                    window.location = '<?= base_url() ?>assessment/export_all_bank?ids='+checkedIds;    
                }
                
                return false;
            });

            $('#export_al_corp').click(function(){
                var checkedIds = $(".chk_box:checked").map(function() {
                    return this.value;
                  }).toArray();
                
                if(checkedIds == ''){
                    $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-times-circle',
                        message: 'Please Select Any One File.'
                      },{
                        type: 'danger'
                      });
                }
                else{
                    window.location = '<?= base_url() ?>assessment/export_all_corp?ids='+checkedIds;    
                }
                
                return false;
            });

        })

        $(function(){
            $('#file-all').DataTable({
                "dom": "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
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

        function admin_send()
        {
            $.notify({
                title: '<strong></strong>',
                icon: 'fa fa-times-circle',
                message: 'Please Contact Admin For Changes in This File'
            },{
                type: 'danger'
            });

            return false;
        }
    </script>



