<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>image/favicon.png" type="image/png"/>
    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">

    <style type="text/css">
        @media print {
            @page { margin: 40px 10px 15px 10px; size:	A4 landscape; }

            ._bg{ 
            	background-color: #a90e10 !important;
            	color: white;
        		-webkit-print-color-adjust: exact; 
            }

            .th-border{
	        	border:2px solid #000 !important;	 
	        }

	        .table-bordered{
	        	border:2px solid #000 !important;
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
				
				<div class="col-md-12" style="">


					<table class="table table-bordered" style="font-size: 12px;">
						
						<tbody>
							<tr>
								<th class="th-border" style="width: 100px; text-align: center;">
									<img src="<?= base_url() ?>/image/logo.png">
								</th>
								<th colspan="8" class="th-border" style="text-align: center;line-height: 106px; font-size: 30px; font-weight: bold;">
									<?=$this->config->config["Full_name"]?>
								</th>
							</tr>
							<tr>
								<th class="th-border" style="text-align: center; font-size: 18px;">
									File-<?= $file['no'] ?>
								</th>
								<th colspan="8" class="th-border" style="text-align: center; font-size: 20px;">
									<?= $file['title']; ?> ( <?= $this->session->userdata('year') ?> )
								</th>
							</tr>
							<tr>
								<th style="text-align: center; width: 100px;" >
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
								<th style="text-align: center; width: 250px;">
									Name Of Person
								</th>
								<th style="text-align: center;">
									Address
								</th>
								<th style="text-align: center;">
									Message
								</th>
							</tr>
							<?php $where = "AND `total` != '0' AND `total` != '' AND `total` != '0.00'"; ?>
							<?php $dis_acc = $this->year->query("SELECT DISTINCT `acc_code` FROM `".$file['file_name']."` WHERE `ifsc` NOT Like '%CORP%' AND `acc_code` != '' $where ORDER BY `id` ASC")->result_array();

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
								<tr>
									<th>
										
									</th>
									<th style="text-align: center;">
										D
									</th>

									<th style="text-align: right;">
										<?= $main_total; ?>
									</th>

									<th style="text-align: center;">
										<?= $debit_bank['ifsc']; ?>
									</th>

									<th>
										<?= $debit_bank['acno']; ?>
									</th>

									<th style="text-align: center;">
										11
									</th>

									<th>
										<?= $debit_bank['name']; ?>
									</th>

									<th>
										<?= $debit_bank['branch']; ?>
									</th>

									<th>
										
									</th>

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
