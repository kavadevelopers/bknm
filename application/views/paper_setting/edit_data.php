    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>

    <?php

        $day_price = $this->db->get_where('head',['id' => '1'])->result_array()[0]['day'];
        $file_limit = $this->db->get_where('head',['id' => '1'])->result_array()[0]['file_limit'];

    ?>

   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-md-12">
            		<h1 class="m-0 text-dark text-center"><?php echo $_title; ?>  - 
                    PRACTICAL EXAM REMUNARATION BILL PAYMENT ( <?= $this->session->userdata('year'); ?> )</h1>
          		</div>
        	</div>
      	</div>
    </div>

    <style type="text/css">
        input{
            font-size: 12px;
        }
    </style>


    <section class="content">
        <div class="container-fluid">
            <form method="post" action="<?= base_url(); ?>user/save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-info"  style="overflow-x: scroll;"> 

                            <div class="card-body">
                                <div class="row">


                                    <table class="table table-bordered table-sm" id="table">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th class="text-center">Name Of Person</th>
                                                <th class="text-center">Account No.</th>
                                                <th class="text-center">Bank Name</th>
                                                <th class="text-center">IFSC</th>
                                                <th class="text-center">Branch</th>
                                                <th class="text-center">Acc Code</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Course</th>
                                                <th class="text-center">Nos</th>
                                                <th class="text-center">Day</th>
                                                <th class="text-center">T.A</th>
                                                <th class="text-center">Tall Tax</th>
                                                <th class="text-center">Paper Setting Total</th>
                                                <th class="text-center">Day Allowance</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="add_row">
                                            
                                        <?php $cn = 0; foreach($old_data as $row => $ex_row){ $cn++; ?>    
                                            <tr id="tr<?= $cn; ?>">

                                                <td class="text-center">
                                                    <?= $cn; ?>
                                                    <input type="hidden" name="bill_id[]" value="<?= $ex_row['bill_no']; ?>">
                                                </td>

                                                

                                                <td>
                                                    <input type="text" name="name[]" id="name<?= $cn; ?>" onfocus="change_focus_to_acc('<?= $cn; ?>');" autocomplete="off" placeholder="Person Name" required readonly value="<?= $ex_row['name']; ?>">
                                                </td>

                                                <td>
                                                    <input type="text" name="acno[]" id="acno<?= $cn; ?>" value="<?= $ex_row['ac_no']; ?>" autocomplete="off" placeholder="Account No." required readonly>
                                                </td>

                                                <td>
                                                    <input style="width: 70px;" type="text" name="bank[]" value="<?= $ex_row['bank']; ?>" id="bank<?= $cn; ?>" autocomplete="off" placeholder="Bank Name" required readonly>
                                                </td>

                                                <td>
                                                    <input style="width: 75px;" type="text" value="<?= $ex_row['ifsc']; ?>" name="ifsc[]" id="ifsc<?= $cn; ?>" autocomplete="off" placeholder="IFSC Code" required readonly>
                                                </td>

                                                <td>
                                                    <input style="width: 100px;" type="text" name="branch[]" value="<?= $ex_row['branch']; ?>" id="branch<?= $cn; ?>" autocomplete="off" placeholder="Branch" required readonly>
                                                </td>

                                                <td>
                                                    <input style="width: 80px;" onfocus="acc_auto('<?= $cn; ?>');" type="text" name="acc_code[]" id="acc_code<?= $cn; ?>" autocomplete="off" placeholder="Acc Code" value="<?= $ex_row['acc_code']; ?>" required>
                                                </td>

                                                <td>
                                                    <input style="width: 75px;" type="text" value="<?= $ex_row['date']; ?>" name="date[]" id="date<?= $cn; ?>" autocomplete="off" placeholder="date" required>
                                                </td>

                                                <td>
                                                    <input style="width: 75px;" onfocus="cource_auto('<?= $cn; ?>');" type="text" name="course[]" id="course<?= $cn; ?>" autocomplete="off" placeholder="Course" value="<?= $ex_row['cource']; ?>" required>

                                                    <input type="hidden" name="pap_rate[]" id="pap_rate<?= $cn; ?>" value="<?= $ex_row['pap_rate']; ?>">
                                                </td>

                                                <td>
                                                    <input style="width: 50px;" type="number" onkeyup="total()" name="nos[]" id="nos<?= $cn; ?>" autocomplete="off" placeholder="Nos" required value="<?= $ex_row['nos']; ?>">
                                                </td>

                                                

                                                <td>
                                                    <input style="width: 50px;" type="text" onkeyup="total()" name="day[]" id="day<?= $cn; ?>" autocomplete="off" placeholder="Day" value="<?= $ex_row['day']; ?>">
                                                </td>


                                                <td>
                                                    <input style="width: 50px;" type="text" onkeyup="total()" value="<?= $ex_row['ta']; ?>" name="ta[]" id="ta<?= $cn; ?>" autocomplete="off" placeholder="T.A">
                                                </td>

                                                <td>
                                                    <input style="width: 50px;" type="text" onkeyup="total()" value="<?= $ex_row['tall_tax']; ?>" name="talltax[]" id="talltax<?= $cn; ?>" autocomplete="off"  onkeydown="chng_to_next_row('<?= $cn; ?>',event);" placeholder="Tall Tax">
                                                </td>

                                                <td>
                                                    <input type="text" name="papertotal[]" id="papertotal<?= $cn; ?>" value="<?= $ex_row['paper_total']; ?>" autocomplete="off" placeholder="Paper Setting Total" readonly>
                                                </td>


                                                <td>
                                                    <input type="text" name="day_tot[]" value="<?= $ex_row['day_all']; ?>" id="day_tot<?= $cn; ?>" autocomplete="off" placeholder="Day Allowance" readonly>
                                                </td>

                                                <td>
                                                    <input type="text" name="row_total[]" value="<?= $ex_row['total']; ?>" id="row_total<?= $cn; ?>" autocomplete="off" placeholder="Total" readonly>
                                                    <input type="hidden" name="type[]" value="C">
                                                </td>
                                                
                                            </tr>

                                        <?php } ?>

                                        </tbody>


                                        <tfoot>
                                            <tr>
                                                <td colspan="15" style="padding: 10px;">
                                                    
                                                </td>
                                                
                                            </tr>

                                            <tr id="">

                                                <td class="text-center" colspan="6">
                                                    Debit
                                                    <input type="hidden" name="bill_id[]" value="Credit">
                                                </td>

                                                

                                                
                                                <input type="hidden" name="name[]">

                                                
                                                <input type="hidden" name="acno[]">

                                                
                                                <input type="hidden" name="bank[]">
                                                

                                                
                                                <input type="hidden" name="ifsc[]">
                                                

                                                
                                                <input type="hidden" name="branch[]">
                                                

                                                
                                                <input type="hidden" name="acc_code[]">

                                                <input type="hidden" name="pap_rate[]" id="" value="">
                                                <input type="hidden" name="date[]">
                                                <input type="hidden" name="course[]">
                                                <input type="hidden" name="nos[]">
                                                <input type="hidden" name="day[]">
                                                <input type="hidden" name="ta[]">
                                                <input type="hidden" name="talltax[]" >
                                                <input type="hidden" name="papertotal[]">
                                                <input type="hidden" name="day_tot[]">
                                                

                                                <td colspan="10">
                                                    <input type="text" name="row_total[]" id="main_total" value="<?= $last_row[0]['total'] ?>" autocomplete="off" placeholder="Total" readonly>
                                                    <input type="hidden" name="type[]" value="D">
                                                </td>
                                            </tr>
                                        </tfoot>


                                    </table>



                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="float-right">
                                    <a href="<?= base_url(); ?>paper_setting" onclick="return confirm('Are You Sure You Want To Go Back Without Saving File?');" class="btn btn-danger">
                                        Cancel
                                    </a>
                                    <button type="button" class="btn btn-success" onclick="submit_Data();"><i class="fa fa-save"></i>&nbsp;Save</button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <input type="hidden" name="file_id" value="<?= $file['id']; ?>">
                <input type="hidden" name="file_name" value="<?= $file['file_name']; ?>">
            </form>
        </div>
    </section>


    <script type="text/javascript">

        document.onkeydown = function(e) {
            if (e.ctrlKey && e.keyCode === 83) {
                
                submit_Data();

                return false;
            }
        };

        function submit_Data(){

            $.ajax({
                type: "POST",
                url: "<?= base_url('paper_setting/ajax_submit') ?>",
                data: $('form').serialize(),
                beforeSend: function() {

                    $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-refresh',
                        message: 'Saving Data'
                    },{
                        type: 'info'
                    });

                },
                success: function (data) {
                   
                    $.notify({
                        title: '<strong></strong>',
                        icon: 'fa fa-check',
                        message: 'Data Successfully Saved'
                    },{
                        type: 'success'
                    });

                }
            });


        }
        
        function acc_auto(id)
        {
            $( "#acc_code"+id ).autocomplete({
                source: "<?php echo site_url('paper_setting/acc_autocomplete/?');?>",
                select: function (event, ui) {
                    $("#acc_code"+id).val(ui.item.value);
                    $('#name'+id).val(ui.item.name);
                    $('#acno'+id).val(ui.item.acno);
                    $('#bank'+id).val(ui.item.bnk);
                    $('#ifsc'+id).val(ui.item.ifsc);
                    $('#branch'+id).val(ui.item.branch);
                    add_row(id);
                },
                change: function( event, ui ) {
                    if(ui.item==null)
                    {
                        $("#acc_code"+id).val('');
                        $('#name'+id).val('');
                        $('#acno'+id).val('');
                        $('#bank'+id).val('');
                        $('#ifsc'+id).val('');
                        $('#branch'+id).val('');
                    }
                } 
            });
        }

        function acc_auto_last(id)
        {
            $( "#acc_code"+id ).autocomplete({
                source: "<?php echo site_url('paper_setting/acc_autocomplete/?');?>",
                select: function (event, ui) {
                    $("#acc_code"+id).val(ui.item.value);
                    $('#name'+id).val(ui.item.name);
                    $('#acno'+id).val(ui.item.acno);
                    $('#bank'+id).val(ui.item.bnk);
                    $('#ifsc'+id).val(ui.item.ifsc);
                    $('#branch'+id).val(ui.item.branch);
                    add_row(id);
                },
                change: function( event, ui ) {
                    if(ui.item==null)
                    {
                        $("#acc_code"+id).val('');
                        $('#name'+id).val('');
                        $('#acno'+id).val('');
                        $('#bank'+id).val('');
                        $('#ifsc'+id).val('');
                        $('#branch'+id).val('');
                    }
                } 
            });
        }


        function cource_auto(id)
        {
            $( "#course"+id ).autocomplete({
                source: "<?php echo site_url('paper_setting/course_autocomplete/?');?>",
                select: function (event, ui) {
                    $("#course"+id).val(ui.item.label);
                    $('#pap_rate'+id).val(ui.item.paprate);
                    total();
                },
                change: function( event, ui ) {
                    if(ui.item==null)
                    {
                        $("#course"+id).val('');
                        $('#pap_rate'+id).val(0);
                        total();
                    }
                } 
            });

            total();
        }
        

    </script>

    <style type="text/css">
        input:hover{
            width:200px !important;
            font-size: 16px;
            padding: 5px;
        }
    </style>


    <script type="text/javascript">
        
        function total()
        {
            var rowCount = $('#table >tbody >tr').length;
            var final_total = parseFloat(0.00);
            for(var i = 1; i <= rowCount; i++)
            {
                if($('#tr'+i).length){

                    if($('#nos'+i).val() != ''){ var nos            = parseFloat($('#nos'+i).val()); } else{ var nos = 0; }
                    if($('#day'+i).val() != ''){ var day            = parseFloat($('#day'+i).val()); } else{ var day = 0; }
                    if($('#ta'+i).val() != ''){ var ta              = parseFloat($('#ta'+i).val()); } else{ var ta = 0; }
                    if($('#talltax'+i).val() != ''){ var talltax    = parseFloat($('#talltax'+i).val()); } else{ var talltax = 0; }

                    var course      = parseFloat($('#pap_rate'+i).val());
                    var papertotal  = nos * course;

                    var day_all     = parseFloat('<?= $day_price; ?>');
                    var day_allow   = day_all * day;
                    var row_total   = papertotal + day_allow + ta + talltax;

                    $('#papertotal'+i).val(papertotal.toFixed(2));
                    $('#day_tot'+i).val(day_allow.toFixed(2));
                    $('#row_total'+i).val(row_total.toFixed(2));

                    final_total += row_total;

                }
            }

            $('#main_total').val(final_total.toFixed(2));

        }

        function add_row( i )
        {
            i = parseInt(i);
            if(parseInt('<?= $file_limit; ?>') > i){
                if($('#tr'+(i + 1)).length == 0){
                    i++;
                    $('#add_row').append('<tr id="tr'+i+'"> <td class="text-center">'+i+'<input type="hidden" name="bill_id[]" value="'+i+'"></td><td> <input type="text" onfocus="change_focus_to_acc('+i+');" name="name[]" id="name'+i+'" autocomplete="off" placeholder="Person Name" required readonly> </td><td> <input type="text"  name="acno[]" id="acno'+i+'" autocomplete="off" placeholder="Account No." readonly required> </td><td> <input style="width: 70px;" type="text" name="bank[]" id="bank'+i+'" autocomplete="off" placeholder="Bank Name" readonly required> </td><td> <input style="width: 75px;" type="text" name="ifsc[]" id="ifsc'+i+'" autocomplete="off" placeholder="IFSC Code" readonly required> </td><td> <input style="width: 100px;" type="text" name="branch[]" id="branch'+i+'" autocomplete="off" placeholder="Branch" required readonly> </td><td> <input style="width: 80px;" onfocus="acc_auto('+i+');" type="text" name="acc_code[]" id="acc_code'+i+'" autocomplete="off" placeholder="Acc Code" required> </td><td> <input style="width: 75px;" type="text" class="" value="<?=date('d-m-Y'); ?>" name="date[]" id="date'+i+'" autocomplete="off" placeholder="date" required > </td><td> <input style="width: 75px;" onfocus="cource_auto('+i+');" type="text" name="course[]" id="course'+i+'" autocomplete="off" placeholder="Course" required> <input type="hidden" name="pap_rate[]" id="pap_rate'+i+'" value="0"> </td><td> <input style="width: 50px;" type="number" onkeyup="total()" name="nos[]" id="nos'+i+'" autocomplete="off" placeholder="Nos" required> </td><td> <input style="width: 50px;" type="text" onkeyup="total()" name="day[]" id="day'+i+'" autocomplete="off" placeholder="Day"> </td><td> <input style="width: 50px;" type="text" onkeyup="total()" name="ta[]" id="ta'+i+'" autocomplete="off" placeholder="T.A"> </td><td> <input style="width: 50px;" type="text" onkeyup="total()" name="talltax[]" id="talltax'+i+'" onkeydown="chng_to_next_row('+i+',event);" autocomplete="off" placeholder="Tall Tax"> </td><td> <input type="text" name="papertotal[]" id="papertotal'+i+'" autocomplete="off" placeholder="Paper Setting Total" readonly> </td><td> <input type="text" name="day_tot[]" id="day_tot'+i+'" autocomplete="off" placeholder="Day Allowance" readonly> </td><td> <input type="text" name="row_total[]" id="row_total'+i+'" autocomplete="off" placeholder="Total" readonly><input type="hidden" name="type[]" value="C"> </td></tr>');
                }
            }
        }


        function change_focus_to_acc(id)
        {

            $('#name'+id).keydown(function(e){


                if (e.keyCode === 9) {
            
                    $('#acc_code'+id).focus();

                    return false;
                }
            

            });

            
        }

        function chng_to_next_row(id,e)
        {

            

            id = parseInt(id) + 1;
            if (e.keyCode === 13) {
                
                $('#acc_code'+id).focus();

                return false;
            }
            

            
        }

    </script>
