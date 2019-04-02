<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">

	  .icon-kava{
	        font-size: 70px !important;
	  }

	</style>
    <section class="content">
        <div class="container-fluid">

        	<div class="row">
				<div class="col-lg-3 col-6">
					<div class="small-box bg-success">
						<div class="inner">
							<h6><?= moneyFormatIndia($total_sale); ?></h6>
							<p>Total Sale Collection</p>
						</div>
						<div class="icon icon-kava">
							<i class="fa fa-plus-square"></i>
						</div>
					</div>
				</div>
            
				<div class="col-lg-3 col-6">
					<div class="small-box bg-info">
						<div class="inner">
							<h6><?= moneyFormatIndia($total_installment); ?></h6>
							<p>Total Installment Collection</p>
						</div>
						<div class="icon icon-kava">
							<i class="fa fa-plus-square"></i>
						</div>
					</div>
				</div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                    	<div class="card-header border-transparent">
                            <h3 class="card-title">Sales</h3>
                        </div>
                        <div class="card-body">
		                    <table class="table table-bordered table-striped table-sm">
		                        <thead>
		                            <tr>
		                                <th>Name</th>
		                                <th>Sale</th>
		                                <th>Product ID</th>
		                                <th>Plot Size Sq.ft</th>
		                                <th>selling Amount</th>
		                                <th>Date</th>
		                                
		                            </tr>
		                        </thead>
		                        <tbody>   
		                            <?php foreach ($sale_rows as $key => $row) { ?>
		                                <tr>
		                                    <td><?= $this->users->customer_detail($row['coust_name'])[0]['fi_name'].' '.$this->users->customer_detail($row['coust_name'])[0]['la_name']; ?></td>
		                                    <td><?=$row['id'];?></td>
		                                    <td><?= $this->add_product->get_product_del($row['product_id'])[0]['product_id']; ?></td>
		                                    <td><?= $row['ploat_size']; ?></td>
		                                    <td><?= $row['selling_amount']; ?></td>
		                                    <td><?= date('d-m-Y',strtotime($row['date'])); ?></td>
		                                    

		                                </tr>
		                            <?php } ?>
		                        </tbody>
		                    </table>
		                </div>
		            </div>
		        </div>
		    </div>


		    <div class="row">
                <div class="col-12">
                    <div class="card">
                    	<div class="card-header border-transparent">
                            <h3 class="card-title">Installment Collected</h3>
                        </div>
                        <div class="card-body">


                        	<table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Product</th>
                                        <th>No Of Installment</th>
                                        <th>Installment Amount</th>
                                        <th>Late Charges</th>
                                        <th>Payment Type</th>
                                        <th>Payment Details</th>
                                        <th>Pay Date</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php foreach ($ins_row as $key) { ?>

                                        <tr>
                                            <td>
                                                <?= $this->payment_model->get_customer($this->payment_model->get_sell($key['main_id'])['coust_name']); ?>   
                                            </td>
                                            <td>
                                                <?= $this->payment_model->get_product($this->payment_model->get_sell($key['main_id'])['product_id']); ?>        
                                            </td>
                                            <td>
                                                <?= $this->payment_model->get_sell_installment_by_id($key['installment_id'])['no_of_installment']; ?>        
                                            </td>
                                            <td><?= $key['amount_install']; ?></td>
                                            <td><?= $key['late_charge']; ?></td>
                                            <td><?= $key['pay_type']; ?></td>
                                            <td><?= nl2br($key['pay_detail']); ?></td>
                                            <td style="min-width: 80px;"><?= _vdate($key['date']); ?></td>
                                            
                                        </tr>

                                    <?php } ?>


                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


<script type="text/javascript">
    $(function(){
        $('.table').DataTable({
            "dom": "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
           
            
        });
    })
</script>