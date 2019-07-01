<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>image/favicon.png" type="image/png"/>
    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>dist/css/adminlte.min.css">

    <style type="text/css">
        @media print {

            body { display: inline; margin-right: 20px;  }
            table { width:100%;  }
            @page { margin: 60px 10px 15px 10px; size:	A4 landscape; }

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
				
				<div class="col-md-12" style="">


					<table class="table table-bordered table-sm" id="table" style="font-size: 12px;">
                        
                        <tbody id="add_row">
                            <tr>
                                <th class="th-border" style="width: 50px; text-align: center;">
                                    <img src="<?= base_url() ?>/image/logo.png" style="width: 60px;">
                                </th>
                                <th colspan="19" class="th-border" style="text-align: center;line-height: 60px; font-size: 20px; font-weight: bold;">
                                    <?=$this->config->config["Full_name"]?>
                                </th>
                            </tr>
                            <tr>
                                <th class="th-border" style="text-align: center; font-size: 18px;">
                                    File-<?= $file['no'] ?>
                                </th>
                                <th colspan="19" class="th-border" style="text-align: center; font-size: 20px;">
                                    <?= $file['title']; ?> ( <?= $this->session->userdata('year') ?> )
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Sr No.</th>
                                <th class="text-center" style="width: 130px;">Name Of Person</th>
                                <th class="text-center">Account No.</th>
                                <th class="text-center" style="width: 30px;">Bank Name</th>
                                <th class="text-center" style="width: 40px;">IFSC</th>
                                <th class="text-center" style="width: 120px;">Branch</th>
                                <th class="text-center" style="width: 45px;">Acc Code</th>
                                <th class="text-center" style="width: 70px;">Date</th>
                                <th class="text-center" style="width: 70px;">Course1</th>
                                <th class="text-center" style="width: 70px;">Nos1</th>

                                <th class="text-center" style="width: 70px;">Course2</th>
                                <th class="text-center" style="width: 70px;">Nos2</th>
                                <th class="text-center">Day</th>
                                <th class="text-center" style="width: 20px;">Tra. All.</th>
                                <th class="text-center" style="width: 20px;">Toll Tax</th>
                                <th class="text-center">Remu. Total</th>
                                <th class="text-center">Day All.</th>
                                <th class="text-center">Total</th>

                            </tr>
                            
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

                                <td class="text-center">
                                    <?= $ex_row['date']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['course1']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['nos1']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['course2']; ?>
                                </td>

                                <td class="text-center">
                                    <?= $ex_row['nos2']; ?>
                                </td>

                                

                                <td class="text-center">
                                    <?= $ex_row['day']; ?>
                                </td>

                                <td class="text-right">
                                    <?= $ex_row['ta']; ?>
                                </td>

                                <td class="text-right">
                                    <?= $ex_row['talltax']; ?>
                                </td>

                                <td class="text-right">
                                    <?= $ex_row['rem']; ?>
                                </td>


                                <td class="text-right">
                                    <?= $ex_row['dayall']; ?>
                                </td>

                                <td class="text-right">
                                    <?= $ex_row['total']; ?>
                                </td>
                                
                            </tr>
                            <?php 
                                if($ex_row['ta'] != ''){ $ta += $ex_row['ta']; }
                                if($ex_row['rem'] != ''){ $km_total += $ex_row['rem']; }
                                if($ex_row['talltax'] != ''){ $tall_tax += $ex_row['talltax']; }
                                if($ex_row['dayall'] != ''){ $session_total += $ex_row['dayall']; }
                                if($ex_row['total'] != ''){ $total += $ex_row['total']; }
                            ?>
                        <?php  } ?>

                            <tr>
                                <th colspan="13" class="text-right"><strong>Total : </strong></th>
                                <th class="text-right"><?= moneyFormatIndia($ta); ?></th>
                                <th class="text-right"><?= moneyFormatIndia($tall_tax); ?></th>
                                <th class="text-right"><?= moneyFormatIndia($km_total); ?></th>
                                <th class="text-right"><?= moneyFormatIndia($session_total); ?></th>
                                <th class="text-right"><?= moneyFormatIndia($total); ?></th>
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
