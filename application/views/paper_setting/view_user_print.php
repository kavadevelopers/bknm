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
								<th colspan="16" class="th-border" style="text-align: center;line-height: 60px; font-size: 20px; font-weight: bold;">
									<?=$this->config->config["Full_name"]?>
								</th>
							</tr>
							<tr>
								<th class="th-border" style="text-align: center; font-size: 18px;">
									File-<?= $file['no'] ?>
								</th>
								<th colspan="16" class="th-border" style="text-align: center; font-size: 20px;">
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
                                <th class="text-center" style="width: 70px;">Date</th>
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
                            
                        <?php $cn = 0; $ta = 0; $tall_tax = 0; $pap_setting = 0; $day_allow = 0;$total = 0; foreach($old_data as $row => $ex_row){ $cn++; ?>    
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

                                <td class="text-center">
                                    <?= $ex_row['date']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['cource']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['nos']; ?>
                                </td>

                                

                                <td class="text-center">
                                    <?= $ex_row['day']; ?>
                                </td>


                                <td class="text-right">
                                    <?= $ex_row['ta']; ?>
                                </td>

                                <td class="text-right">
                                    <?= $ex_row['tall_tax']; ?>
                                </td>

                                <td class="text-right">
                                    <?= $ex_row['paper_total']; ?>
                                </td>


                                <td class="text-right">
                                    <?= $ex_row['day_all']; ?>
                                </td>

                                <td class="text-right">
                                    <?= $ex_row['total']; ?>
                                </td>
                                
                            </tr>
                            <?php 
                                if($ex_row['ta'] != ''){ $ta += $ex_row['ta']; }
                                if($ex_row['paper_total'] != ''){ $pap_setting += $ex_row['paper_total']; }
                                if($ex_row['tall_tax'] != ''){ $tall_tax += $ex_row['tall_tax']; }
                                if($ex_row['day_all'] != ''){ $day_allow += $ex_row['day_all']; }
                                if($ex_row['total'] != ''){ $total += $ex_row['total']; }
                            ?>
                        <?php  } ?>

                            <tr>
                                <td colspan="11" class="text-right"><strong>Total : </strong></td>
                                <th class="text-right"><?= $ta; ?></th>
                                <th class="text-right"><?= $tall_tax; ?></th>
                                <th class="text-right"><?= $pap_setting; ?></th>
                                <th class="text-right"><?= $day_allow; ?></th>
                                <th class="text-right"><?= $total; ?></th>
                            </tr>

                        </tbody>

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
