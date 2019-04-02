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
	
	<?php  ?>

    <section class="content">
      	<div class="container-fluid">
      		<div class="card">
	      		<div class="card-body">
		      		<div class="row">
		      			<div class="col-md-4">     
		                    <div class="form-group">
		                      <select class="form-control-sm select2" name="location" id="location" style="width: 100%;" autocomplete="off" required>
		                       
		                        <?php if($location){ ?>
		                                <option value="">-- Select Location name --</option>
		                            	<?php foreach ($location as $key) { ?>
		                                    <option value="<?= $key['purchase_id'];?>"><?= $key['purchase_id'];?></option>

		                        		<?php } } else { ?>
		                            <option value="">Location Not Found</option>
		                        <?php } ?>
		                        

		                      </select>
		                    </div>
		                </div> 
		                <div class="col-md-4">
		                	<button type="button" class="btn btn-success btn-sm" onclick="get_product();"><i class="fa fa-eye"></i>&nbsp;show</button>
		                </div>
		            </div>
	            </div>
            </div>

            <div class="card" id="out" style="display: none;">
	      		<div class="card-body">
		      		<div class="row">
		      			<div id="_divpreloader"></div>
		      		</div>
		      	</div>
		    </div>

            <div class="row" id="data" style="display: none;">
            	
      		</div>
      	</div>
    </section>


    <script type="text/javascript">
    	function get_product(){

    		var location  = $('#location').val();
    		if(location != ''){
	    		$.ajax({
		          type : "post",
		          url : "<?php echo site_url('product_dashboard/ajax_get'); ?>",
		          data : "location="+location,
		          beforeSend: function() {
		          	$('#out').fadeIn('fast');
			      },
		          success:function( html ){	
		          		$('#out').fadeOut('fast');
		          		$('#data').fadeIn('slow');
		              	$('#data').html(html);
		          }
		        });
	    	}
	    	else
	    	{
	    		$.notify({
		          title: '<strong></strong>',
		          icon: 'fa fa-close',
		          message: 'Please Select Location'
		        },{
		          type: 'danger'
		        });
		        $('#data').html('');
	    	}
    	}



    </script>

    <style type="text/css">
	    #_divpreloader { z-index: 0;
	    height: 300px;
	    width: 100%;
	    overflow: visible;
	    background: #ffffff url(<?=base_url();?>image/loading.gif) no-repeat center center;
	}
  </style>

			