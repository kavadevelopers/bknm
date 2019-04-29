    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>

    <?php

        $per_session = get_head_value_by_index('per_session','squad');
        $petrol_rate = get_head_value_by_index('petrol_per_km','squad');
        $lpg_petrol_rate = get_head_value_by_index('petrol_lpg_per_km','squad');
        $cng_petrol_rate = get_head_value_by_index('petrol_cng_per_km','squad');
        $diesel_rate = get_head_value_by_index('diesel_per_km','squad');
        $gas_rate = get_head_value_by_index('gas_per_km','squad');
        $min_km = get_head_value_by_index('min_km','squad');
        $min_km_rate = get_head_value_by_index('min_km_rate','squad');
        $file_limit = $this->db->get_where('head',['id' => '1'])->result_array()[0]['file_limit'];

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
        tbody td{
            text-align: center;
        }
    </style>




    <section class="content">
        <div class="container-fluid">
            <form method="post" action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info"  style=""> 

                            <div class="card-body" style="padding-bottom: 0px;">
                                <div class="row">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width: 35px;">Sr No.</th>
                                                <th class="text-center" style="width: 90px;">Acc Code</th>
                                                <th class="text-center" style="width: 95px;">Vehical no.</th>
                                                <th class="text-center" style="width: 80px;">Date</th>
                                                <th class="text-center" style="width: 90px;">KM</th>
                                                <th class="text-center" style="width: 62px;">Remu.</th>
                                                <th class="text-center" style="width: 90px;">Fule</th>
                                                <th class="text-center" style="width: 62px;">T.A</th>
                                                <th class="text-center" style="width: 62px;">Toll Tax</th>
                                                <th class="text-center" style="width: 80px;">KM Total</th>
                                                <th class="text-center" style="width: 80px;">Remu. Total</th>
                                                <th class="text-center" style="width: 150px;">Total</th>
                                                <th class="text-center">Message</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="card-body" style="overflow: scroll;  height: 300px; padding-top: 0px;">
                                <div class="row">
                                    <table  class="table table-bordered table-sm" id="table">
                                        <tbody id="add_row">
                                            
                                            <tr id="tr1">

                                                <td class="text-center" style="width: 35px;">
                                                    1
                                                    <input type="hidden" name="bill_id[]" value="1">
                                                    <input type="hidden" name="name[]" id="name1" onfocus="" autocomplete="off" placeholder="Person Name" required readonly>


                                                
                                                    <input type="hidden" name="acno[]" id="acno1" autocomplete="off" placeholder="Account No." required readonly>
                                                    

                                                    
                                                    <input style="width: 70px;" type="hidden" name="bank[]" id="bank1" autocomplete="off" placeholder="Bank Name" required readonly>
                                                    

                                                    
                                                    <input style="width: 75px;" type="hidden" name="ifsc[]" id="ifsc1" autocomplete="off" placeholder="IFSC Code" required readonly>
                                                    
                                                    <input style="width: 100px;" type="hidden" name="branch[]" id="branch1" autocomplete="off" placeholder="Branch" required readonly>
                                                </td>

                                                

                                                
                                                

                                                <td style="width: 90px;">
                                                    <input style="width: 80px;" onfocus="acc_auto('1');" type="text" name="acc_code[]" id="acc_code1" autocomplete="off" placeholder="Acc Code" required>
                                                </td>

                                                <td style="width: 95px;">
                                                    <input style="width: 80px;" type="text" name="rcbook[]" id="v_rcbook1" autocomplete="off" placeholder="Vehical no." onkeydown="chng_to_next_row('1',event);">
                                                </td>

                                                <td style="width: 80px;">
                                                    <input style="width: 65px;" type="text" value="<?= date('d-m-Y'); ?>" name="date[]" id="date1" autocomplete="off" placeholder="date" required onkeydown="chng_to_next_row('1',event);">
                                                </td>

                                                <td style="width: 90px;">
                                                    <input style="width: 75px;" onkeyup="total()" type="number" name="tot_km[]" id="tot_km1" autocomplete="off" placeholder="KM" required onkeydown="chng_to_next_row('1',event);">
                                                </td>

                                                <td style="width: 62px;">
                                                    <input style="width: 50px;" type="number" onkeyup="total()" name="session[]" id="session1" autocomplete="off" placeholder="Remuneration" required onkeydown="chng_to_next_row('1',event);">
                                                </td>

                                                

                                                <td style="width: 90px;">
                                                    <select name="fule[]" id="v_fule1" onchange="total()" style="width: 74px;">
                                                        <option value="">-- Fule --</option>
                                                            <option value="Petrol">Petrol</option>
                                                            <option value="Diesel">Diesel</option>
                                                            <option value="Gas">Gas</option>
                                                            <option value="Petro/LPG" >Petro/LPG</option>
                                                            <option value="Petrol/CNG">Petrol/CNG</option>
                                                    </select>
                                                </td>


                                                <td style="width: 62px;">
                                                    <input style="width: 50px;" type="text" onkeyup="total()" name="ta[]" id="ta1" autocomplete="off" placeholder="T.A" onkeydown="chng_to_next_row('1',event);">
                                                </td>

                                                <td style="width: 62px;">
                                                    <input style="width: 50px;" type="text" onkeyup="total()" onkeydown="chng_to_next_row('1',event);" name="talltax[]" id="talltax1" autocomplete="off" placeholder="Tall Tax">
                                                </td>

                                                <td style="width: 80px;">
                                                    <input type="text" name="km_total_amount[]" id="km_total_amount1" autocomplete="off" placeholder="KM Total Amount" readonly style="width: 60px;"  onkeydown="chng_to_next_row('1',event);">
                                                </td>


                                                <td style="width: 80px;">
                                                    <input type="text" name="session_total_amount[]" id="session_total_amount1" autocomplete="off" placeholder="Remuneration Total" readonly  style="width: 60px;" onkeydown="chng_to_next_row('1',event);">
                                                </td>

                                                <td style="width: 150px;">
                                                    <input type="text" name="row_total[]" id="row_total1" autocomplete="off" placeholder="Total" readonly onkeydown="chng_to_next_row('1',event);">
                                                    <input type="hidden" name="type[]" value="C">
                                                </td>
                                                <td>
                                                    <input type="text" name="message[]" id="message1" autocomplete="off" placeholder="Message" value="<?= $file['message']; ?>" onkeydown="chng_to_next_row('1',event);">
                                                    <input type="hidden" id="rcbook1" >
                                                    <input type="hidden" id="fule1">
                                                </td>
                                            </tr>

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
                                                <input type="hidden" name="message[]">
                                                

                                                
                                                <input type="hidden" name="acc_code[]">

                                                <input type="hidden" name="date[]">
                                                <input type="hidden" name="tot_km[]">
                                                <input type="hidden" name="session[]">
                                                <input type="hidden" name="fule[]">
                                                <input type="hidden" name="ta[]">
                                                <input type="hidden" name="talltax[]" >
                                                <input type="hidden" name="km_total_amount[]">
                                                <input type="hidden" name="session_total_amount[]">
                                                <input type="hidden" name="rcbook[]">
                                                

                                                <td colspan="12">
                                                    <input type="text" name="row_total[]" id="main_total" autocomplete="off" placeholder="Total" readonly>
                                                    <input type="hidden" name="type[]" value="D">
                                                </td>
                                            </tr>
                                        </tfoot>


                                    </table>



                                </div>
                            </div>

                            

                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <a href="<?= base_url(); ?>squad/view_data/<?= $_id; ?>" onclick="return confirm('Are You Sure You Want To Go Back Without Saving File?');" class="btn btn-primary">
                                    View
                                </a>
                                <a href="<?= base_url(); ?>squad" onclick="return confirm('Are You Sure You Want To Go Back Without Saving File?');" class="btn btn-danger">
                                    Cancel
                                </a>
                                <button type="button" class="btn btn-success" onclick="submit_Data();"><i class="fa fa-save"></i>&nbsp;Save</button>
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

        $(function(){
            $('#acc_code1').focus();
        })

        document.onkeydown = function(e) {
            if (e.ctrlKey && e.keyCode === 83) {
                
                submit_Data();

                return false;
            }
        };

        function total()
        {
            var rowCount = $('#table >tbody >tr').length;
            var final_total = parseFloat(0.00);
            for(var i = 1; i <= rowCount; i++)
            {
                if($('#tr'+i).length){

                    var fule = $('#fule'+i).val();
                    if($('#tot_km'+i).val() != ''){ var tot_km            = parseFloat($('#tot_km'+i).val()); } else{ var tot_km = 0; }
                    if($('#session'+i).val() != ''){ var session          = parseFloat($('#session'+i).val()); } else{ var session = 0; }
                    if($('#ta'+i).val() != ''){ var ta                    = parseFloat($('#ta'+i).val()); } else{ var ta = 0; }
                    if($('#talltax'+i).val() != ''){ var talltax          = parseFloat($('#talltax'+i).val()); } else{ var talltax = 0; }

                    if(tot_km != '0')
                    {
                        $('#v_rcbook'+i).val($('#rcbook'+i).val());
                        $('#v_fule'+i).val($('#fule'+i).val());
                    }
                    else{
                        $('#v_rcbook'+i).val('');
                        $('#v_fule'+i).val('');
                    }
                    
                    var session_total_amount = session * parseFloat('<?= $per_session; ?>');
                    $('#session_total_amount'+i).val(session_total_amount.toFixed(2));

                    if(tot_km <= parseFloat('<?= $min_km; ?>'))
                    {
                        if(tot_km != 0)
                        {
                            var km_total_amount = parseFloat('<?= $min_km_rate; ?>');
                        }
                        else{
                            km_total_amount = 0;
                        }
                    }
                    else{
                        if(fule == '')
                        {
                            var km_total_amount = tot_km * 0;  
                        }
                        else if(fule == 'Petrol'){
                            var km_total_amount = tot_km * parseFloat('<?= $petrol_rate ?>');  
                        }
                        else if(fule == 'Diesel')
                        {
                            var km_total_amount = tot_km * parseFloat('<?= $diesel_rate ?>');  
                        }
                        else if(fule == 'Gas')
                        {
                            var km_total_amount = tot_km * parseFloat('<?= $gas_rate ?>');  
                        }
                        else if(fule == 'Petro/LPG')
                        {
                            var km_total_amount = tot_km * parseFloat('<?= $lpg_petrol_rate ?>');  
                        }
                        else if(fule == 'Petrol/CNG')
                        {
                            var km_total_amount = tot_km * parseFloat('<?= $cng_petrol_rate ?>');  
                        }
                         
                    }

                    var row_total   =  km_total_amount + session_total_amount + ta + talltax;

                    $('#km_total_amount'+i).val(km_total_amount.toFixed(2));
                    $('#row_total'+i).val(row_total.toFixed(2));
                    final_total += row_total;

                }
            }

            $('#main_total').val(final_total.toFixed(2));

        }

        function submit_Data(){

            $.ajax({
                type: "POST",
                url: "<?= base_url('squad/ajax_submit') ?>",
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
                source: "<?php echo site_url('squad/acc_autocomplete/?');?>",
                select: function (event, ui) {
                    $("#acc_code"+id).val(ui.item.value);
                    $('#name'+id).val(ui.item.name);
                    $('#acno'+id).val(ui.item.acno);
                    $('#bank'+id).val(ui.item.bnk);
                    $('#ifsc'+id).val(ui.item.ifsc);
                    $('#branch'+id).val(ui.item.branch);
                    $('#fule'+id).val(ui.item.fule);
                    $('#rcbook'+id).val(ui.item.rcbook);
                    add_row(id);
                    total();
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
                        $('#fule'+id).val('');
                        $('#rcbook'+id).val('');
                        total();
                    }
                } 
            });
        }

    </script>


    <script type="text/javascript">
        
        

        function add_row( i )
        {
            i = parseInt(i);
            if(parseInt('<?= $file_limit; ?>') > i){
                if($('#tr'+(i + 1)).length == 0){
                    i++;
                    $('#add_row').append('<tr id="tr'+i+'"> <td class="text-center">'+i+'<input type="hidden" name="bill_id[]" value="'+i+'"><input type="hidden" name="name[]" id="name'+i+'" autocomplete="off" placeholder="Person Name" required readonly> <input type="hidden" name="acno[]" id="acno'+i+'" autocomplete="off" placeholder="Account No." readonly required><input style="width: 70px;" type="hidden" name="bank[]" id="bank'+i+'" autocomplete="off" placeholder="Bank Name" readonly required><input style="width: 75px;" type="hidden" name="ifsc[]" id="ifsc'+i+'" autocomplete="off" placeholder="IFSC Code" readonly required><input style="width: 100px;" type="hidden" name="branch[]" id="branch'+i+'" autocomplete="off" placeholder="Branch" required readonly> </td><td> <input style="width: 80px;" onfocus="acc_auto('+i+');" type="text" name="acc_code[]" id="acc_code'+i+'" autocomplete="off" placeholder="Acc Code" required onkeydown="chng_to_next_row('+i+',event);"> </td><td><input style="width: 80px;" type="text" name="rcbook[]" id="v_rcbook'+i+'" autocomplete="off" placeholder="Vehical no." onkeydown="chng_to_next_row('+i+',event);"></td><td> <input style="width: 65px;" type="text" class="" value="<?=date('d-m-Y'); ?>" name="date[]" id="date'+i+'" autocomplete="off" placeholder="date" required onkeydown="chng_to_next_row('+i+',event);"> </td><td> <input style="width: 75px; "onkeyup="total()" type="text" name="tot_km[]" id="tot_km'+i+'" autocomplete="off" placeholder="KM" required onkeydown="chng_to_next_row('+i+',event);"> </td><td> <input style="width: 50px;" type="number" onkeyup="total()" name="session[]" id="session'+i+'" autocomplete="off" placeholder="Remuneration" required onkeydown="chng_to_next_row('+i+',event);"> </td><td> <select name="fule[]" id="v_fule'+i+'" onchange="total()" style="width: 74px;"> <option value="">-- Fule --</option> <option value="Petrol">Petrol</option> <option value="Diesel">Diesel</option> <option value="Gas">Gas</option> <option value="Petro/LPG" >Petro/LPG</option> <option value="Petrol/CNG">Petrol/CNG</option> </select> </td><td> <input style="width: 50px;" type="text" onkeyup="total()" name="ta[]" id="ta'+i+'" autocomplete="off" placeholder="T.A" onkeydown="chng_to_next_row('+i+',event);"> </td><td> <input style="width: 50px;" type="text" onkeyup="total()" name="talltax[]" id="talltax'+i+'" onkeydown="chng_to_next_row('+i+',event);" autocomplete="off" placeholder="Tall Tax"> </td><td> <input type="text" name="km_total_amount[]" id="km_total_amount'+i+'" autocomplete="off" placeholder="KM Total Amount" readonly style="width: 60px;" onkeydown="chng_to_next_row('+i+',event);"> </td><td> <input type="text" name="session_total_amount[]" id="session_total_amount'+i+'" autocomplete="off" placeholder="Remuneration Total" readonly style="width: 60px;" onkeydown="chng_to_next_row('+i+',event);"> </td><td> <input type="text" name="row_total[]" id="row_total'+i+'" autocomplete="off" placeholder="Total" readonly onkeydown="chng_to_next_row('+i+',event);"><input type="hidden" name="type[]" value="C"> </td><td><input type="text" name="message[]" id="message1" autocomplete="off" placeholder="Message" value="<?=$file['message']; ?>" onkeydown="chng_to_next_row('+i+',event);"><input type="hidden" id="rcbook'+i+'" ><input type="hidden" id="fule'+i+'"></td></tr>');
                }
            }
        }


        function chng_to_next_row(id,e)
        {

            

            
            if (e.keyCode === 13) {
                nid = parseInt(id) + 1;
                $('#acc_code'+nid).focus();

                return false;
            }

            if (e.ctrlKey && e.keyCode === 38) {
                nid = parseInt(id) - 1;
                $('#acc_code'+nid).focus();

                return false;
            }        
            

            
        }

    </script>
