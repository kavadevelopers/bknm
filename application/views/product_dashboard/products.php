				<?php if($products){ foreach($products as $key => $value){ ?>	
	      			<div class="col-md-3">
	                  <div class="info-box bg-<?php if($value['status'] == '0'){ echo 'success'; }else if($value['status'] == '2'){ echo 'warning'; }else{ echo 'danger'; } ?> mb-3">
	                    <div class="info-box-content">
	                      <span class="info-box-text" style="text-align: center;">Plot No - <?= $value['ploat_code']; ?></span>
	                      <span class="info-box-number" style="text-align: center;    font-size: 12px;"><?= $value['ploat_size_sqft']; ?> Sq. Ft.</span>
	                      <span class="info-box-number" style="text-align: center;    font-size: 12px;">Amount - <?= moneyFormatIndia($value['selling_amount']); ?></span>
	                    </div>
	                  </div>
	            	</div>
            	<?php } }else{ ?>
            		<div class="col-md-3">
	                  <div class="info-box mb-3">
	                    <div class="info-box-content">
	                      <span class="info-box-text" style="text-align: center;"><i>No Product Found</i></span>
	                      
	                    </div>
	                  </div>
	            	</div>
            	<?php } ?>