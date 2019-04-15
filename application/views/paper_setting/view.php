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
                                                    <input type="text" name="name[]" id="name<?= $cn; ?>" autocomplete="off" placeholder="Person Name" required readonly value="<?= $ex_row['name']; ?>">
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
                                                    <input style="width: 50px;" type="text" onkeyup="total()" value="<?= $ex_row['tall_tax']; ?>" name="talltax[]" id="talltax<?= $cn; ?>" autocomplete="off" placeholder="Tall Tax">
                                                </td>

                                                <td>
                                                    <input type="text" name="papertotal[]" id="papertotal<?= $cn; ?>" value="<?= $ex_row['paper_total']; ?>" autocomplete="off" placeholder="Paper Setting Total" readonly>
                                                </td>


                                                <td>
                                                    <input type="text" name="day_tot[]" value="<?= $ex_row['day_all']; ?>" id="day_tot<?= $cn; ?>" autocomplete="off" placeholder="Day Allowance" readonly>
                                                </td>

                                                <td>
                                                    <input type="text" name="row_total[]" value="<?= $ex_row['total']; ?>" id="row_total<?= $cn; ?>" autocomplete="off" placeholder="Total" readonly>
                                                    <input type="hidden" name="type[]" value="D">
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

                                                <td class="text-center">
                                                    Debit
                                                    <input type="hidden" name="bill_id[]" value="Credit">
                                                </td>

                                                

                                                <td>
                                                    <input type="text" name="name[]" id="namelast" autocomplete="off" value="<?= $last_row[0]['name'] ?>" placeholder="Person Name" required readonly>
                                                </td>

                                                <td>
                                                    <input type="text" name="acno[]" id="acnolast" autocomplete="off" value="<?= $last_row[0]['ac_no'] ?>" placeholder="Account No." required readonly>
                                                </td>

                                                <td>
                                                    <input style="width: 70px;" type="text" name="bank[]" id="banklast" value="<?= $last_row[0]['bank'] ?>" autocomplete="off" placeholder="Bank Name" required readonly>
                                                </td>

                                                <td>
                                                    <input style="width: 75px;" type="text" name="ifsc[]" value="<?= $last_row[0]['ifsc'] ?>" id="ifsclast" autocomplete="off" placeholder="IFSC Code" required readonly>
                                                </td>

                                                <td>
                                                    <input style="width: 100px;" type="text" name="branch[]" value="<?= $last_row[0]['branch'] ?>" id="branchlast" autocomplete="off" placeholder="Branch" required readonly>
                                                </td>

                                                <td>
                                                    <input style="width: 80px;" onfocus="acc_auto_last('last');" type="text" name="acc_code[]" id="acc_codelast" autocomplete="off" placeholder="Acc Code" value="<?= $last_row[0]['acc_code'] ?>" required>
                                                </td>

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
                                                    <input type="hidden" name="type[]" value="C">
                                                </td>
                                            </tr>
                                        </tfoot>


                                    </table>



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


    

    <style type="text/css">
        input:hover{
            width:200px !important;
            font-size: 16px;
            padding: 5px;
        }
    </style>


    <script type="text/javascript">
        
        $(function(){
            $('input').attr('readonly',true);
        })

    </script>
