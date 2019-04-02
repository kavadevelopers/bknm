function parseDate(dateStr) {
  var dateParts = dateStr.split("-");
  return new Date(dateParts[2], (dateParts[1] - 1), dateParts[0]);
}

//is valid date format
function calculateAge (dateOfBirth, dateToCalculate) {
    var calculateYear = dateToCalculate.getFullYear();
    var calculateMonth = dateToCalculate.getMonth();
    var calculateDay = dateToCalculate.getDate();

    var birthYear = dateOfBirth.getFullYear();
    var birthMonth = dateOfBirth.getMonth();
    var birthDay = dateOfBirth.getDate();

    var age = calculateYear - birthYear;
    var ageMonth = calculateMonth - birthMonth;
    var ageDay = calculateDay - birthDay;

    if (ageMonth < 0 || (ageMonth == 0 && ageDay < 0)) {
        age = parseInt(age) - 1;
    }
    return age;
}

function isDate(txtDate) {
  var currVal = txtDate;
  if (currVal == '')
    return true;

  //Declare Regex
  var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
  var dtArray = currVal.match(rxDatePattern); // is format OK?

  if (dtArray == null)
    return false;

  //Checks for dd/mm/yyyy format.
  var dtDay = dtArray[1];
  var dtMonth = dtArray[3];
  var dtYear = dtArray[5];

  if (dtMonth < 1 || dtMonth > 12)
    return false;
  else if (dtDay < 1 || dtDay > 31)
    return false;
  else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
    return false;
  else if (dtMonth == 2) {
    var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
    if (dtDay > 29 || (dtDay == 29 && !isleap))
      return false;
  }

  return true;
}



/********************************************************************
 ********************************************************************
                              Add Purchase
********************************************************************
********************************************************************/

$(function(){
        
        //Initialize Select2 Elements
        $('.select2').select2()

        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        });
        
        //  Date Created
        $('#date_created').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        });

        // Purchase Date 
        $('#purchase_date').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        });

        // Advance  Payment Date 
        $('#adva_pay_date').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        });
        
        
        
  });    


function hecter(type,val){
        var yard =  parseFloat($('#total_land_yrd').val());
        var hectere =  parseFloat($('#total_land_hec').val());
        var sqft = parseFloat($('#lan_size_sq').val());

        var sft = parseFloat(9); // yard to sq ft
        var hct = parseFloat(0.0000836127359999986); // yard to hecter
        
        var hct_to_yd = parseFloat(11959.9); // hecter to yard
        var hct_to_sft = parseFloat(107639.1); // hectecert to sqft

        var sft_to_yd = parseFloat(0.111111); // sqft to yard
        var sft_to_hect = parseFloat(107639.1); // sqft to hecter

        if(val != ''){

            if(type == 'y'){
                if(yard != ''){
                    $('#total_land_hec').val(yard * hct);
                    $('#lan_size_sq').val(yard * sft);
                }
                else{
                    $('#total_land_yrd').val('');
                    $('#lan_size_sq').val('');
                    $('#total_land_hec').val('');
                }
            }

            if(type == 'h'){
                if(hectere != ''){
                    $('#total_land_yrd').val(hectere * hct_to_yd);
                    $('#lan_size_sq').val(hectere * hct_to_sft);
                }
                else{
                    $('#total_land_yrd').val('');
                    $('#lan_size_sq').val('');
                    $('#total_land_hec').val('');
                }
            }

            if(type == 'sq'){
                if(sqft != ''){
                    $('#total_land_yrd').val(sqft * sft_to_yd);
                    $('#total_land_hec').val(sqft / hct_to_sft);
                }
                else
                {   
                    $('#total_land_yrd').val('');
                    $('#lan_size_sq').val('');
                    $('#total_land_hec').val('');
                }
            }
        }
        else
        { 
            $('#total_land_yrd').val('');
            $('#lan_size_sq').val('');
            $('#total_land_hec').val('');
        }

        
    }


    function ramining_amount(){
           
           if($('#purchase_amount').val() != '' && $('#adva_payment').val() != '')
           {
               var purchse = parseFloat($('#purchase_amount').val());
                var advnce = parseFloat($('#adva_payment').val());
                $('#bal_amount').val(purchse - advnce);
                add_ins_amounts();
           }
           else{
                $('#bal_amount').val('');
                add_ins_amounts();
           }
    } 



    function Install_Time(){
        
        var time = $('#time').val();
        var time_ward = parseFloat($('#time_ward_land').val());

        if(time == 'Monthly'){

            $('#no_of_installment').val(time_ward);
        }
        
        if(time == 'Quarterly'){

            round = time_ward / 3;
            $('#no_of_installment').val(parseInt(round));
        }

        if(time == 'Half Yearly'){

            round = time_ward / 6;
            $('#no_of_installment').val(parseInt(round));
        }

        if(time == 'Yearly'){

            round = time_ward / 12;
            $('#no_of_installment').val(parseInt(round));
        }
    }



    function Installment_Cal(){
        var time_ward = $('#time_ward_land').val();
        
        if(time_ward > 0 && time_ward != ''){

            $('#install_packges').html('');
            $('#install_packges').append('<option value="Yes">Yes</option>');

         
                if(time_ward <= 2){
                    op_time = '<option value="Monthly" >Monthly</option>';
                }

                if(time_ward <= 5 && time_ward > 2){
                    op_time = '<option value="Monthly">Monthly</option><option value="Quarterly">Quarterly</option>';
                }

                if(time_ward <= 11 && time_ward > 5){
                    op_time = '<option value="Monthly">Monthly</option><option value="Quarterly">Quarterly</option><option value="Half Yearly">Half Yearly</option>';
                }

                if(time_ward >= 12 && time_ward > 11){
                    op_time = '<option value="Monthly">Monthly</option><option value="Quarterly">Quarterly</option><option value="Half Yearly">Half Yearly</option><option value="Yearly">Yearly</option>';
                }

                    $('#installment').html('');
                    $('#installment').append('<div class="col-md-4"><div class="form-group"> <label>Time <span class="astrick">*</span> </label> <select name="time" class="form-control form-control-sm" id="time" onchange="Install_Time();" required><option value="">-- Select Time --</option>'+op_time+'</select></div></div><div class="col-md-4"><div class="form-group"> <label>No. of Installment <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="number" name="no_of_installment" id="no_of_installment" placeholder="No. of Installment" autocomplete="off" readonly></div></div><div class="col-md-4"><div class="form-group"> <label>Deal Amount / Total Amount <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="deal_amount" placeholder="Deal Amount / Total Amount" autocomplete="off" required readonly></div></div><div class="col-md-4"><div class="form-group"> <label>Advance Payment <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="adva_payment" placeholder="Advance Payment" autocomplete="off" required readonly></div></div><div class="col-md-4"><div class="form-group"> <label>Installment Amount / Reamaning Amount <span class="astrick">*</span> </label> <input class="form-control form-control-sm" type="text" name="instal_amount" id="rem_amount" placeholder="Installment Amount / Reamaning Amount" autocomplete="off" required readonly></div></div>');
                        add_ins_amounts();
                        

        }
        else
        {
            $('#install_packges').html('');
            $('#install_packges').append('<option value="No">No</option>');
            
            $('#installment').html('');
        }
    }



    function add_ins_amounts(){
      if($('#adva_paymenta').val() != '')
          {
              $("[name='deal_amount']").val($('#purchase_amount').val());
              $("[name='adva_payment']").val($('#adva_payment').val());
              $("[name='instal_amount']").val($('#bal_amount').val());

          }else{
              $("[name='deal_amount']").val('');
              $("[name='adva_payment']").val('');
              $("[name='instal_amount']").val('');

          }
    }

   



/*********************      End Add Purchase     ********************/   


///// master password /////

function master(url)
{
    $('#master_model').modal('show');
    $('#url').val(url);
    return false;
}


function submit_passs()
{
    pass = $('#m_pass').val();
    dpass = $('#hidden_auth').val();
    if(pass == '')
    {
        $('#ms_error').html('Please Enter Master Password');
        return false;
    }
    else if(pass === dpass)
    {
        $('#ms_error').html('');
        window.location.replace($('#url').val());
        return false;
    }
    else
    {
        $('#ms_error').html('Wrong Master Password');
        return false;
    }
}

///// master password /////
