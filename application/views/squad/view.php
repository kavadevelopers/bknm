    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>

   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
                <div class="col-md-12">
                    <h1 class="m-0 text-dark text-center">BHAKTA KAVI NARSINH MEHTA UNIVERSITY, JUNAGADH</h1>
                     
                </div>
          		<div class="col-md-12">
            		<h1 class="m-0 text-dark text-center"><?php echo $_title; ?>  - 
                    <?= $file['title']; ?> ( <?= $this->session->userdata('year'); ?> )</h1>
                     
          		</div>
        	</div>
      	</div>
    </div>

    <style type="text/css">
        table{
            font-size: 12px; 
        }
        tbody td{
            padding: 0 !important;
        }
        td{
            padding:0;
        }
    </style>

    <section class="content">
        <div class="container-fluid">
            <form method="post" action="<?= base_url(); ?>user/save" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-info"  style="overflow-x: scroll;"> 

                            <div class="card-body">
                                <a href="<?= base_url('squad/view_data_print/').$file['id'] ?>" target="_blank" class="btn btn-sm btn-secondary pull-right" style="color: #fff;">Print</a>
                                <div class="row">


                                    <table class="table table-bordered table-sm table-hover" id="table" >
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Account No.</th>
                                                <th class="text-center">Bank Name</th>
                                                <th class="text-center">IFSC</th>
                                                <th class="text-center">Branch</th>
                                                <th class="text-center">Acc Code</th>
                                                <th class="text-center">Vehical no.</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">KM</th>
                                                <th class="text-center">Remu.</th>
                                                <th class="text-center">Fule</th>
                                                <th class="text-center">T.A</th>
                                                <th class="text-center">Toll Tax</th>
                                                <th class="text-center">KM Total Amount</th>
                                                <th class="text-center">Remu. Total</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="add_row">
                                            
                                        <?php $cn = 0; $main_total = 0; foreach($old_data as $row => $ex_row){ $cn++; ?>    
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

                                                <td class="text-center">
                                                    <?= $ex_row['bank']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['ifsc']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['branch']; ?>
                                                </td>

                                                <td class="text-center">
                                                    <?= $ex_row['acc_code']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['rcbook']; ?>
                                                </td>

                                                <td>
                                                    <?= $ex_row['date']; ?>
                                                </td>

                                                <td class="text-center">
                                                    <?= $ex_row['km']; ?>
                                                </td>

                                                <td class="text-center">
                                                    <?= $ex_row['session']; ?>
                                                </td>

                                                

                                                <td class="text-center">
                                                    <?php if($ex_row['fule'] == 'Petrol'){ echo "P"; }else if($ex_row['fule'] == 'Diesel'){ echo "D"; }else if($ex_row['fule'] == 'Gas'){ echo "G"; }else if($ex_row['fule'] == 'Petro/LPG'){ echo "P/L"; }else if($ex_row['fule'] == 'Petrol/CNG'){ echo "P/C"; }; ?>
                                                </td>


                                                <td class="text-right">
                                                    <?= $ex_row['tra_allow']; ?>
                                                </td>

                                                <td class="text-right">
                                                    <?= $ex_row['tall_tax']; ?>
                                                </td>

                                                <td class="text-right">
                                                    <?= $ex_row['km_total']; ?>
                                                </td>


                                                <td class="text-right">
                                                    <?= $ex_row['session_total']; ?>
                                                </td>

                                                <td class="text-right">
                                                    <?= $ex_row['total']; ?>
                                                </td>

                                                <td>
                                                    <?php if(check_right('5')){ ?>
                                                        <?php if($file['final'] != '1'){ ?>
                                                            
                                                            <a class="btn btn-sm btn-primary" href="<?= base_url();?>squad/add_data/<?= $file['id'] ?>" title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </a>

                                                        <?php } else if($this->session->userdata('id') == '1'){ ?>

                                                            <a class="btn btn-sm btn-primary" href="<?= base_url();?>squad/add_data/<?= $file['id'] ?>" title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </a>                                                            

                                                        <?php }else{ ?>

                                                            <a class="btn btn-sm btn-primary" onclick="return admin_send();" title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                            </a>

                                                        <?php } ?>
                                                    <?php } ?>
                                                </td>
                                                
                                            </tr>

                                        <?php $main_total += $ex_row['total']; } ?>
                                            
                                            <tr>
                                                <th></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center"></th>
                                                <th class="text-center">Total : </th>
                                                <th class="text-right"><?= moneyFormatIndia($main_total); ?></th>
                                                <th class="text-center"></th> 
                                            </tr>
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