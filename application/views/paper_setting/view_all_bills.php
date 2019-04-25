    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>

   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-md-12">
            		<h1 class="m-0 text-dark text-center"><?php echo $_title; ?> ( <?= $this->session->userdata('year'); ?> )</h1>
                     
          		</div>
        	</div>
      	</div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card card-info"  style="overflow-x: scroll;"> 

                        <div class="card-body">
                            <div class="row">

                                <table class="table table-bordered" style="font-size: 12px;">

                                    <thead>
                                        
                                        <tr>

                                            <th style="text-align: center;">
                                                File
                                            </th>

                                            <th style="text-align: center;">
                                                Bill No.
                                            </th>
                                            <th style="text-align: center;">
                                                C/D
                                            </th>
                                            <th style="text-align: center;">
                                                Amt
                                            </th>
                                            <th style="text-align: center;">
                                                IFSC Code
                                            </th>
                                            <th style="text-align: center;">
                                                Account No.
                                            </th>
                                            <th style="text-align: center; width: 15px;" >
                                                Saving Or Current
                                            </th>
                                            <th style="text-align: center;">
                                                Name Of Person
                                            </th>
                                            <th style="text-align: center;">
                                                Address
                                            </th>
                                            <th style="text-align: center;">
                                                Message
                                            </th>
                                            
                                        </tr>

                                    </thead>

                                    <tbody>
                                        
                                        <?php foreach ($files as $index => $value) { $file = $value;  ?>

                                        <?php $where = "AND `total` != '0' AND `total` != '' AND `total` != '0.00'"; ?>
                                        <?php $dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$file['file_name']."` WHERE `acc_code` != '' $where ORDER BY `id` ASC")->result_array();

                                            $main_total = 0;
                                            foreach ($dis_acc as $single => $acc) { 

                                                $Bills = $this->year->query("SELECT `bill_no` FROM `".$file['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where ORDER BY `id` ASC")->result_array(); 

                                                    $bill_all = "";
                                                    foreach ($Bills as $keya => $valuea) {
                                                        $bill_all .= $valuea['bill_no'].',';
                                                    } $bill_all = rtrim($bill_all,',');

                                                    $res_rows = $this->year->query("SELECT * FROM `".$file['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where ")->result_array()[0]; 

                                                    $amount = $this->year->query("SELECT SUM(total) AS `bills_tot` FROM `".$file['file_name']."` WHERE `acc_code` = '".$acc['acc_code']."' $where")->result_array()[0];

                                                    $main_total +=  $amount['bills_tot'];

                                                ?>

                                            
                                                <tr>

                                                    <td style="text-align: center;">
                                                        File-<?= $file['no'] ?>
                                                    </td>

                                                    <td style="text-align: center;">
                                                        <?= $bill_all ?>
                                                    </td>
                                                
                                                    <td style="text-align: center;">
                                                        <?= $res_rows['type'] ?>
                                                    </td>
                                                
                                                    <td style="text-align: right;">
                                                        <?= $amount['bills_tot'] ?>
                                                    </td>
                                                
                                                    <td style="text-align: center;">
                                                        <?= $res_rows['ifsc'] ?>
                                                    </td>
                                                
                                                    <td>
                                                        <?= $res_rows['ac_no'] ?>
                                                    </td>
                                                
                                                    <td style="text-align: center;">
                                                        10
                                                    </td>

                                                    <td>
                                                        <?= $res_rows['name'] ?>
                                                    </td>
                                                
                                                    <td>
                                                        <?= $res_rows['branch'] ?>
                                                    </td>

                                                    <td style="font-size: 10px; ">
                                                        <?= $res_rows['message'] ?>
                                                    </td>
                                                    
                                                    

                                                </tr>


                                            <?php } $debit_bank = $this->config->config["debit_bank"]; ?>


                                            <?php } ?>


                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <script type="text/javascript">
        $(function(){
            $('table').DataTable({
                "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
                "columnDefs": [
                    
                    
                        { "orderable": false, "targets": [7] }
                        
                    
                ],
                autoWidth: true,
                order : [],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [ 
                    { 
                        extend: 'print',
                        orientation: 'landscape',
                        title: '<?php echo $_title; ?> - PRACTICAL EXAM REMUNARATION BILL PAYMENT ( <?= $this->session->userdata('year'); ?> )',
                        customize: function(win)
                        {
             
                            

                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( {
                                    fontSize: '10px'
                                } );


                                var last = null;
                var current = null;
                var bod = [];
 
                var css = '@page { size: landscape; }',
                    head = win.document.head || win.document.getElementsByTagName('head')[0],
                    style = win.document.createElement('style');
 
                style.type = 'text/css';
                style.media = 'print';
 
                if (style.styleSheet)
                {
                  style.styleSheet.cssText = css;
                }
                else
                {
                  style.appendChild(win.document.createTextNode(css));
                }
 
                head.appendChild(style);
                        }
                    },
                    { 
                        extend: 'pdf',
                        title: '<?php echo $_title; ?> - PRACTICAL EXAM REMUNARATION BILL PAYMENT ( <?= $this->session->userdata('year'); ?> )',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        customize: function (doc) { 
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 8; 
                        }
                    },
                    { 
                        extend: 'excel',
                        title: '<?php echo $_title; ?> - PRACTICAL EXAM REMUNARATION BILL PAYMENT ( <?= $this->session->userdata('year'); ?> )',
                        
                    }
                ]
                
            });
        })
    </script>