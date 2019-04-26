<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>image/favicon.png" type="image/png"/>
    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">

    <style type="text/css">
        @media print {
            @page { margin: 0 10px 0 10px; size:	A4 landscape; }

            ._bg{ 
            	background-color: #a90e10 !important;
            	color: white;
        		-webkit-print-color-adjust: exact; 
            }

            .th-border{
	        	border:1px solid #000 !important;	 
	        }

	        .table-bordered{
	        	border:1px solid #000 !important;
	        }
        }

        @media print {
			body {-webkit-print-color-adjust: exact;}
		}

        .pagebreak { page-break-after: always; }

        ._data
        {
            border-bottom: solid 1px;
            font-style: italic;
            
        }
        .right{
            text-align: right;
        }

        .col-md-3 p{ font-size: 18px; }

        .my_padding{
            padding-left: 30px !important;
        }

        .table td, .table th
        {
        	padding: 1px 2px;

        }

        

    </style>

</head>

<body>
	


        <div class="row">
			<div class="col-md-12">
				
				<div class="col-md-12" style="margin-top: 20px; ">


					<table class="table table-bordered table-sm" id="table" style="font-size: 12px;">
                        <thead>
                        	<tr>
								<th class="th-border" style="width: 50px; text-align: center;">
									<img src="<?= base_url() ?>/image/logo.png" style="width: 60px;">
								</th>
								<th colspan="17" class="th-border" style="text-align: center;line-height: 60px; font-size: 20px; font-weight: bold;">
									<?=$this->config->config["Full_name"]?>
								</th>
							</tr>
							<tr>
								<th class="th-border" style="text-align: center; font-size: 18px;">
									File-<?= $file['no'] ?>
								</th>
								<th colspan="17" class="th-border" style="text-align: center; font-size: 20px;">
									<?= $file['title']; ?> ( <?= $this->session->userdata('year') ?> )
								</th>
							</tr>
                            <tr>
                                <th style="text-align: center;">Sr No.</th>
                                <th class="text-center" style="width: 130px;">Name Of Person</th>
                                <th class="text-center">Account No.</th>
                                <th class="text-center" style="width: 36px;">Bank Name</th>
                                <th class="text-center">IFSC</th>
                                <th class="text-center" style="width: 120px;">Branch</th>
                                <th class="text-center" style="width: 45px;">Acc Code</th>
                                <th class="text-center" style="width: 70px;">Vehical no.</th>
                                <th class="text-center" style="width: 70px;">Date</th>
                                <th class="text-center">Total KM</th>
                                <th class="text-center">Remuneration</th>
                                <th class="text-center">Fule</th>
                                <th class="text-center">Tra. Allowance</th>
                                <th class="text-center">Toll Tax</th>
                                <th class="text-center">KM Total Amount</th>
                                <th class="text-center">Remuneration Total</th>
                                <th class="text-center">Total</th>
                                <th class="text-center" style="width: 100px;">Message</th>

                            </tr>
                        </thead>
                        <tbody id="add_row">
                            
                        <?php $cn = 0; $ta = 0; $tall_tax = 0; $km_total = 0; $session_total = 0;$total = 0; foreach($old_data as $row => $ex_row){ $cn++; ?>    
                            <tr>

                                <td class="text-center">
                                    <?= $cn; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['name']; ?>
                                </td>

                                <td class="text-left">
                                    <?= $ex_row['ac_no']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['bank']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['ifsc']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['branch']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['acc_code']; ?>
                                </td>

                                <td class="text-center" style="font-size: 8px;">
                                    <?= $ex_row['rcbook']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['date']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['km']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['session']; ?>
                                </td>

                                

                                <td style="text-align: center;">
                                    <?php if($ex_row['fule'] == 'Petrol'){ echo "P"; }else if($ex_row['fule'] == 'Diesel'){ echo "D"; }else{ echo "G"; }; ?>
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

                                <td class="text-center">
                                    <?= $ex_row['message']; ?>
                                </td>
                                
                            </tr>
                            <?php 
                                if($ex_row['tra_allow'] != ''){ $ta += $ex_row['tra_allow']; }
                                if($ex_row['km_total'] != ''){ $km_total += $ex_row['km_total']; }
                                if($ex_row['tall_tax'] != ''){ $tall_tax += $ex_row['tall_tax']; }
                                if($ex_row['session_total'] != ''){ $session_total += $ex_row['session_total']; }
                                if($ex_row['total'] != ''){ $total += $ex_row['total']; }
                            ?>
                        <?php  } ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="12" class="text-right"><strong>Total : </strong></td>
                                <td class="text-right"><?= $ta; ?></td>
                                <td class="text-right"><?= $tall_tax; ?></td>
                                <td class="text-right"><?= $km_total; ?></td>
                                <td class="text-right"><?= $session_total; ?></td>
                                <td class="text-right"><?= $total; ?></td>
                                <td></td>
                            </tr>
                        </tfoot>

                    </table>

					
				</div>

			</div>
		</div>



    </div>

    <script>
        window.onload = function () {
            window.print();
            setTimeout(window.close, 0);
        }
	</script>

</body>
</html>
