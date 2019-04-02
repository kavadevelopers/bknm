<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
          		</div>
        	</div><!-- /.row -->
      	</div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->

    <style type="text/css">
        .select2{
            width: 100% !important;
        }
    </style>

    <section class="content">
        <div class="container-fluid">
            <form method="post" action="<?= base_url(); ?>bill/save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Bill Details</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                            

                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; width:50px;">#</th>
                                                <th style="text-align: center; width:350px;">Acc Code / Account No.</th>
                                                <th style="text-align: center; width:190px;">Course</th>
                                                <th style="text-align: center; width:100px;">TPC</th>
                                                <th style="text-align: center;">Total</th>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center;">1</td>
                                                <td>
                                                    <select class="form-control form-control-sm select2" name="person[]" id="focus" required>
                                                        <option value="">-- Select Acc Code --</option>
                                                        <?php foreach ($persons as $key => $value) { ?>
                                                            <option value="<?= $value['id'] ?>">
                                                                <?= $value['code'] ?> - <?= $value['acno'] ?> - <?= $value['name'] ?>        
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <select class="form-control form-control-sm select2" onchange="course_onchange('1',this.value)" name="course[]" required>
                                                        <option value="">-- Select Course --</option>
                                                        <?php foreach ($course as $key => $value) { ?>
                                                            <option value="<?= $value['id'] ?>-<?= $value['price'] ?>">
                                                                <?= $value['cource'] ?>      
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <input type="hidden" name="" id="course_price1" value="0">
                                                </td>

                                                <td>
                                                    <input class="form-control form-control-sm" onkeypress="return isNumber(event)" onkeyup="total_price('1',this.value);" id="tpc1" type="text" name="tpc[]" placeholder="TPC" autocomplete="off" required readonly>
                                                </td>
                                                <td>
                                                    <input class="form-control form-control-sm" id="total1" type="text" name="total[]" placeholder="Total" autocomplete="off" readonly>
                                                </td>
                                            </tr>
                                        </thead>
                                        
                                        <tbody id="add_row">
                                            
                                    
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="5" style="text-align: right;">
                                                    <button type="button" class="btn btn-success btn-sm" onclick="add_row();" title="Add Row"><i class="fa fa-plus"></i> Add Row</button>
                                                    <button type="button" class="btn btn-sm btn-danger" id="remove_row'+i+'" onclick="remove()"><i class="fa fa-close"></i> Remove Last</button>
                                                </td>
                                            </tr>
                                        </tfoot>

                                    </table>


                                </div>
                            </div>
                        </div>



                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>bill" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success" id="submit"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <script type="text/javascript">


        $(function(){
            $('#focus').focus();
        })

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        
        function course_onchange(row,value)
        {
            if(value != "")
            {
                $('#course_price'+row).val(value.split('-')[1]);
                $('#tpc'+row).val('');
                $('#tpc'+row).removeAttr('readonly');
                $('#total'+row).val('');
            }
            else{
                $('#course_price'+row).val(0);
                $('#tpc'+row).val('');
                $('#tpc'+row).attr('readonly',true);
                $('#total'+row).val('');
            }
        }

        function total_price(row,tpc)
        {
            if(tpc != ""){
                var course_price = parseFloat($('#course_price'+row).val());
                var tpc = parseFloat(tpc);
                total = course_price * tpc;
                $('#total'+row).val(total.toFixed(2));
            }
            else{
                $('#total'+row).val('');
            }
        }

        var co_i = 1;
        function add_row() {
            co_i++;
            $('#add_row').append('<tr><td style="text-align: center;">'+co_i+'</td><td><select class="form-control form-control-sm select2a" name="person[]" required> <option value="">-- Select Acc Code --</option><?php foreach ($persons as $key => $value){ ?><option value="<?=$value['id'] ?>"> <?=$value['code'] ?> - <?=$value['acno'] ?> - <?=$value['name'] ?> </option> <?php } ?> </select> </td><td> <select class="form-control form-control-sm select2a" onchange="course_onchange('+co_i+',this.value)" name="course[]" required> <option value="">-- Select Course --</option> <?php foreach ($course as $key=> $value){?> <option value="<?=$value['id'] ?>-<?=$value['price'] ?>"> <?=$value['cource'] ?> </option> <?php } ?> </select> <input type="hidden" name="" id="course_price'+co_i+'" value="0"> </td><td> <input class="form-control form-control-sm" onkeyup="total_price('+co_i+',this.value);" id="tpc'+co_i+'" type="text" name="tpc[]" placeholder="TPC" autocomplete="off" required readonly> </td><td> <input class="form-control form-control-sm" id="total'+co_i+'" type="text" name="total[]" placeholder="Total" autocomplete="off" readonly> </td></tr>');
            $('.select2a').select2();
            return false;
        }

        function remove(){
            $('#add_row tr:last').remove();
            co_i--;
            return false;
        }

    </script>