    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>

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


    <section class="content">
        <div class="container-fluid">
            <form method="post" action="<?= base_url(); ?>user/save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-info"  style="overflow-x: scroll;"> 

                            <div class="card-body">
                                <a href="<?= base_url('squad/view_data_print/').$file['id'] ?>" target="_blank" class="btn btn-sm btn-secondary pull-right" style="color: #fff;">Print</a>
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
                                                <th class="text-center">Rc book no.</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Total KM</th>
                                                <th class="text-center">Session</th>
                                                <th class="text-center">Fule</th>
                                                <th class="text-center">Tra. Allowance</th>
                                                <th class="text-center">Tall Tax</th>
                                                <th class="text-center">KM Total Amount</th>
                                                <th class="text-center">Session Total</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Message</th>

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
                                                    <?= $ex_row['rcbook']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['date']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['km']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['session']; ?>
                                                </td>

                                                

                                                <td>
                                                    <?= $ex_row['fule']; ?>
                                                </td>


                                                <td>
                                                    <?= $ex_row['tra_allow']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['tall_tax']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['km_total']; ?>
                                                </td>


                                                <td>
                                                    <?= $ex_row['session_total']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['total']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['message']; ?>
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
                        extend: 'pdf',
                        title: '<?php echo $_title; ?> - <?= $file['title']; ?> ( <?= $this->session->userdata('year'); ?> )',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        customize: function (doc) { 
                            doc.defaultStyle.fontSize = 7;
                            doc.styles.tableHeader.fontSize = 8; 
                        }
                    },
                    { 
                        extend: 'excel',
                        title: '<?php echo $_title; ?> - <?= $file['title']; ?> ( <?= $this->session->userdata('year'); ?> )',
                        
                    }
                ]
                
            });
        })
    </script>