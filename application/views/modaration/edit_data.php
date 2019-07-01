    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>

    <?php

        $day_price = $this->db->get_where('head',['id' => '4'])->result_array()[0]['day'];
        $file_limit = $this->db->get_where('head',['id' => '4'])->result_array()[0]['file_limit'];

    ?>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <h1 class="m-0 text-dark text-center"><?php echo $_title; ?>  - 
                    <?= $file['title']; ?> ( <?= $this->session->userdata('year'); ?> )</h1>
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

                        <div class="card card-info"> 

                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="row">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width: 35px;">Sr No.</th>
                                                <th class="text-center" style="width: 90px;">Acc Code</th>
                                                <th class="text-center" style="width: 80px;">Date</th>
                                                <th class="text-center" style="width: 75px;">course1</th>
                                                <th class="text-center">nos1</th>
                                                <th class="text-center">course2</th>
                                                <th class="text-center">nos2</th>
                                                <th class="text-center">course3</th>
                                                <th class="text-center">nos3</th>
                                                <th class="text-center">Day</th>
                                                <th class="text-center">T.A</th>
                                                <th class="text-center">Tall Tax</th>
                                                <th class="text-center">Remu.Total</th>
                                                <th class="text-center">Day All.</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Message</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            <div class="card-body" style="overflow: scroll;  height: 300px; padding-top: 0px;">
                                <div class="row">


                                    <table class="table table-bordered table-sm" id="table">
                                        
                                        <tbody id="add_row">
                                            <?php $cn = 0; foreach($old_data as $row => $ex_row){ $cn++; ?>    
                                            <tr id="tr<?= $cn; ?>">

                                                <td class="text-center" style="width: 35px;">
                                                    <?= $cn; ?>
                                                    <input type="hidden" name="bill_id[]" value="<?= $ex_row['bill_no']; ?>">

                                                    <input type="hidden" name="name[]" id="name<?= $cn; ?>" onfocus="" value="<?= $ex_row['name']; ?>" autocomplete="off" placeholder="Person Name" required readonly>


                                                
                                                    <input type="hidden" name="acno[]" value="<?= $ex_row['ac_no']; ?>" id="acno<?= $cn; ?>" autocomplete="off" placeholder="Account No." required readonly>
                                                    

                                                    
                                                    <input style="width: 70px;" type="hidden" value="<?= $ex_row['bank']; ?>" name="bank[]" id="bank<?= $cn; ?>" autocomplete="off" placeholder="Bank Name" required readonly>
                                                    

                                                    
                                                    <input style="width: 75px;" type="hidden" value="<?= $ex_row['ifsc']; ?>" name="ifsc[]" id="ifsc<?= $cn; ?>" autocomplete="off" placeholder="IFSC Code" required readonly>
                                                    
                                                    <input style="width: 100px;" type="hidden" value="<?= $ex_row['branch']; ?>" name="branch[]" id="branch<?= $cn; ?>" autocomplete="off" placeholder="Branch" required readonly>
                                                </td>

                                                <td style="width: 90px;">
                                                    <input style="width: 80px;" value="<?= $ex_row['acc_code']; ?>" onfocus="acc_auto('<?= $cn; ?>');" type="text" name="acc_code[]" id="acc_code<?= $cn; ?>" autocomplete="off" placeholder="Acc Code" required>
                                                </td>

                                                <td style="width: 80px;">
                                                    <input style="width: 60px;" type="text" value="<?= $ex_row['date']; ?>" name="date[]" id="date<?= $cn; ?>" autocomplete="off" placeholder="date" required>
                                                </td>

                                                <td style="width: 75px;">
                                                    <input style="width: 60px;" onfocus="cource_auto2('<?= $cn; ?>','1');" value="<?= $ex_row['course1']; ?>" type="text" name="course[]" id="course1<?= $cn; ?>" autocomplete="off" placeholder="Course" required>
                                                    <input type="hidden" name="pap_rate[]" id="pap_rate1<?= $cn; ?>" value="<?= $ex_row['pap1']; ?>">
                                                </td>

                                                <td>
                                                    <input style="width: 30px;" type="text" onkeyup="total()" value="<?= $ex_row['nos1']; ?>" onkeydown="chng_to_next_row('<?= $cn; ?>',event);" name="nos[]" id="nos1<?= $cn; ?>" autocomplete="off" placeholder="Nos" required>
                                                </td>

                                                <td>
                                                    <input style="width: 60px;" value="<?= $ex_row['course2']; ?>" onfocus="cource_auto2('<?= $cn; ?>','2');" type="text" name="course2[]" id="course2<?= $cn; ?>" autocomplete="off" placeholder="Course2" required> 
                                                    <input type="hidden" name="pap_rate2[]" value="<?= $ex_row['pap2']; ?>" id="pap_rate2<?= $cn; ?>">
                                                </td>

                                                <td>
                                                    <input style="width: 30px;" type="text" value="<?= $ex_row['nos2']; ?>" onkeyup="total()" onkeydown="chng_to_next_row('<?= $cn; ?>',event);" name="nos2[]" id="nos2<?= $cn; ?>" autocomplete="off" placeholder="Nos2" required>
                                                </td>

                                                <td>
                                                    <input style="width: 60px;" value="<?= $ex_row['course3']; ?>" onfocus="cource_auto2('<?= $cn; ?>','3');" type="text" name="course3[]" id="course3<?= $cn; ?>" autocomplete="off" placeholder="Course3" required>
                                                    <input type="hidden" name="pap_rate3[]" value="<?= $ex_row['pap3']; ?>" id="pap_rate3<?= $cn; ?>">
                                                </td>

                                                <td>
                                                    <input style="width: 30px;" type="text" value="<?= $ex_row['nos3']; ?>" onkeyup="total()" onkeydown="chng_to_next_row('<?= $cn; ?>',event);" name="nos3[]" id="nos3<?= $cn; ?>" autocomplete="off" placeholder="Nos3" required>
                                                </td>

                                                

                                                <td>
                                                    <input style="width: 40px;" type="text" value="<?= $ex_row['day']; ?>" onkeyup="total()" onkeydown="chng_to_next_row('<?= $cn; ?>',event);" name="day[]" id="day<?= $cn; ?>" autocomplete="off" placeholder="Day">
                                                </td>


                                                <td>
                                                    <input style="width: 40px;" value="<?= $ex_row['ta']; ?>" type="text" onkeyup="total()" onkeydown="chng_to_next_row('<?= $cn; ?>',event);" name="ta[]" id="ta<?= $cn; ?>" autocomplete="off" placeholder="T.A">
                                                </td>

                                                <td>
                                                    <input style="width: 40px;" value="<?= $ex_row['talltax']; ?>" type="text" onkeyup="total()" onkeydown="chng_to_next_row('<?= $cn; ?>',event);" name="talltax[]" id="talltax<?= $cn; ?>" autocomplete="off" placeholder="Tall Tax">
                                                </td>

                                                <td>
                                                    <input type="text" style="width: 60px;" value="<?= $ex_row['rem']; ?>" name="papertotal[]" id="papertotal<?= $cn; ?>" autocomplete="off" placeholder="Remu.Total" readonly>
                                                </td>


                                                <td>
                                                    <input type="text" style="width: 40px;" value="<?= $ex_row['dayall']; ?>" name="day_tot[]" id="day_tot<?= $cn; ?>" autocomplete="off" placeholder="Day Allowance" readonly>
                                                </td>

                                                <td>
                                                    <input type="text" style="width: 50px;" value="<?= $ex_row['total']; ?>" name="row_total[]" id="row_total<?= $cn; ?>" autocomplete="off" placeholder="Total" readonly>
                                                    <input type="hidden" name="type[]" value="C">
                                                </td>
                                                <td>
                                                    <input type="text" style="width: 50px;" value="<?= $ex_row['message']; ?>" name="message[]" onkeydown="chng_to_next_row('<?= $cn; ?>',event);" id="message<?= $cn; ?>" autocomplete="off" placeholder="Message" >
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>


                                        <tfoot>
                                            <tr>
                                                <td colspan="20" style="padding: 10px;">
                                                    
                                                </td>
                                                
                                            </tr>

                                            <tr id="">

                                                <td class="text-center" colspan="12">
                                                    Debit
                                                    <input type="hidden" name="bill_id[]" value="Credit">
                                                </td>

                                                

                                                
                                                <input type="hidden" name="name[]">

                                                
                                                <input type="hidden" name="acno[]">

                                                
                                                <input type="hidden" name="bank[]">
                                                

                                                
                                                <input type="hidden" name="ifsc[]">
                                                

                                                
                                                <input type="hidden" name="branch[]">
                                               
                                                

                                                
                                                <input type="hidden" name="acc_code[]">
                                                <input type="hidden" name="date[]">

                                                <input type="hidden" name="course[]">
                                                <input type="hidden" name="nos[]">
                                                <input type="hidden" name="pap_rate[]">
                                                
                                                <input type="hidden" name="course2[]">
                                                <input type="hidden" name="nos2[]">
                                                <input type="hidden" name="pap_rate2[]">

                                                <input type="hidden" name="course3[]">
                                                <input type="hidden" name="nos3[]">
                                                <input type="hidden" name="pap_rate3[]">
                                                
                                                <input type="hidden" name="day[]">
                                                <input type="hidden" name="ta[]">
                                                <input type="hidden" name="talltax[]" >
                                                <input type="hidden" name="papertotal[]" >
                                                <input type="hidden" name="day_tot[]">
                                                <input type="hidden" name="message[]">

                                                <td colspan="11">
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
                                    <label class="container">Final Submit
                                        <input type="checkbox" name="final" value="1" >
                                        <span class="checkmark"></span>
                                    </label>
                                    <a href="<?= base_url(); ?>modaration/view_data/<?= $_id; ?>" onclick="return confirm('Are You Sure You Want To Go Back Without Saving File?');" class="btn btn-primary">
                                        View
                                    </a>
                                    <a href="<?= base_url(); ?>modaration" onclick="return confirm('Are You Sure You Want To Go Back Without Saving File?');" class="btn btn-danger">
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
                url: "<?= base_url('modaration/ajax_submit') ?>",
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
                   
                   //console.log(data)
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
                source: "<?php echo site_url('modaration/acc_autocomplete/?');?>",
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
                source: "<?php echo site_url('modaration/course_autocomplete/?');?>",
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

        function cource_auto2(id,num)
        {
            $( "#course"+num+id ).autocomplete({
                source: "<?php echo site_url('modaration/course_autocomplete/?');?>",
                select: function (event, ui) {
                    $("#course"+num+id).val(ui.item.label);
                    $('#pap_rate'+num+id).val(ui.item.paprate);
                    total();
                },
                change: function( event, ui ) {
                    if(ui.item==null)
                    {
                        $("#course"+num+id).val('');
                        $('#pap_rate'+num+id).val(0);
                        total();
                    }
                } 
            });

            total();
        }
        

    </script>


    <script type="text/javascript">
        
        function total()
        {
            var rowCount = $('#table >tbody >tr').length;
            
            var final_total = parseFloat(0.00);
            for(var i = 1; i <= rowCount; i++)
            {
                if($('#tr'+i).length){

                    if($('#nos1'+i).val() != '') { var nos              = parseFloat($('#nos1'+i).val()); } else{ var nos = 0; }
                    if($('#nos2'+i).val() != ''){ var nos2            = parseFloat($('#nos2'+i).val()); } else{ var nos2 = 0; }
                    if($('#nos3'+i).val() != ''){ var nos3            = parseFloat($('#nos3'+i).val()); } else{ var nos3 = 0; }

                    if($('#day'+i).val() != ''){ var day            = parseFloat($('#day'+i).val()); } else{ var day = 0; }
                    if($('#ta'+i).val() != ''){ var ta              = parseFloat($('#ta'+i).val()); } else{ var ta = 0; }
                    if($('#talltax'+i).val() != ''){ var talltax    = parseFloat($('#talltax'+i).val()); } else{ var talltax = 0; }

                    var course      = parseFloat($('#pap_rate1'+i).val());
                    var course2      = parseFloat($('#pap_rate2'+i).val());
                    var course3      = parseFloat($('#pap_rate3'+i).val());
                    
                    var papertotal  = nos * course;
                    var papertotal2  = nos2 * course2;
                    var papertotal3  = nos3 * course3;

                    var new_all = papertotal + papertotal2 + papertotal3;

                    var day_all     = parseFloat('<?= $day_price; ?>');
                    var day_allow   = day_all * day;
                    var row_total   = new_all + day_allow + ta + talltax;
                    $('#papertotal'+i).val(new_all.toFixed(2));
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
                    $('#add_row').append('<tr id="tr'+i+'"> <td class="text-center" style="width: 35px;"> '+i+' <input type="hidden" name="bill_id[]" value="'+i+'"><input type="hidden" name="name[]" id="name'+i+'" autocomplete="off" placeholder="Person Name" required readonly> <input type="hidden" name="acno[]" id="acno'+i+'" autocomplete="off" placeholder="Account No." readonly required><input style="width: 70px;" type="hidden" name="bank[]" id="bank'+i+'" autocomplete="off" placeholder="Bank Name" readonly required><input style="width: 75px;" type="hidden" name="ifsc[]" id="ifsc'+i+'" autocomplete="off" placeholder="IFSC Code" readonly required><input style="width: 100px;" type="hidden" name="branch[]" id="branch'+i+'" autocomplete="off" placeholder="Branch" required readonly> </td><td style="width: 90px;"> <input style="width: 80px;" onfocus="acc_auto('+i+');" type="text" name="acc_code[]" id="acc_code'+i+'" autocomplete="off" placeholder="Acc Code" required> </td><td style="width: 80px;"> <input style="width: 60px;" type="text" value="<?=date('d-m-Y'); ?>" name="date[]" id="date'+i+'" autocomplete="off" placeholder="date" required> </td><td> <input style="width: 60px;" onfocus="cource_auto2('+i+','+"1"+');" type="text" name="course[]" id="course1'+i+'" autocomplete="off" placeholder="Course" required> <input type="hidden" name="pap_rate[]" id="pap_rate1'+i+'" value="0"> </td><td> <input style="width: 30px;" type="text" onkeyup="total()" onkeydown="chng_to_next_row('+i+',event);" name="nos[]" id="nos1'+i+'" autocomplete="off" placeholder="Nos" required> </td><td> <input style="width: 60px;" onfocus="cource_auto2('+i+','+"2"+');" type="text" name="course2[]" id="course2'+i+'" autocomplete="off" placeholder="Course2" required> <input type="hidden" name="pap_rate2[]" id="pap_rate2'+i+'" value="0"> </td><td> <input style="width: 30px;" type="text" onkeyup="total()" onkeydown="chng_to_next_row('+i+',event);" name="nos2[]" id="nos2'+i+'" autocomplete="off" placeholder="Nos2" required> </td><td> <input style="width: 60px;" onfocus="cource_auto2('+i+','+"3"+');"  type="text" name="course3[]" id="course3'+i+'" autocomplete="off" placeholder="Course3" required> <input type="hidden" name="pap_rate3[]" id="pap_rate3'+i+'" value="0"> </td><td> <input style="width: 30px;" type="text" onkeyup="total()" onkeydown="chng_to_next_row('+i+',event);" name="nos3[]" id="nos3'+i+'" autocomplete="off" placeholder="Nos3" required> </td><td> <input style="width: 40px;" type="text" onkeyup="total()" onkeydown="chng_to_next_row('+i+',event);" name="day[]" id="day'+i+'" autocomplete="off" placeholder="Day"> </td><td> <input style="width: 40px;" type="text" onkeyup="total()" onkeydown="chng_to_next_row('+i+',event);" name="ta[]" id="ta'+i+'" autocomplete="off" placeholder="T.A"> </td><td> <input style="width: 40px;" type="text" onkeyup="total()" onkeydown="chng_to_next_row('+i+',event);" name="talltax[]" id="talltax'+i+'" autocomplete="off" placeholder="Tall Tax"> </td><td> <input type="text" style="width: 60px;" name="papertotal[]" id="papertotal'+i+'" autocomplete="off" placeholder="Remu.Total" readonly> </td><td> <input type="text" style="width: 40px;" name="day_tot[]" id="day_tot'+i+'" autocomplete="off" placeholder="Day Allowance" readonly> </td><td> <input type="text" style="width: 50px;" name="row_total[]" id="row_total'+i+'" autocomplete="off" placeholder="Total" readonly> <input type="hidden" name="type[]" value="C"> </td><td> <input type="text" style="width: 50px;" name="message[]" id="message'+i+'" onkeydown="chng_to_next_row('+i+',event);" autocomplete="off" placeholder="Message" value="<?=$file['message']; ?>"> </td></tr>');
                }
            }
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
