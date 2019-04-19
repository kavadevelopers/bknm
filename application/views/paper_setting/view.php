    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>

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
                                            <tr>

                                                <td>
                                                    <?= $cn; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['name']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['ac_no']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['bank']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['ifsc']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['branch']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['acc_code']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['date']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['cource']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['nos']; ?>
                                                </td>

                                                

                                                <td>
                                                    <?= $ex_row['day']; ?>
                                                </td>


                                                <td>
                                                    <?= $ex_row['ta']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['tall_tax']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['paper_total']; ?>
                                                </td>


                                                <td>
                                                    <?= $ex_row['day_all']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['total']; ?>
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
            </form>
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