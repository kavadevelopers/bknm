<title><?=$this->config->config["projectTitle"]?> | <?php echo $page_title; ?></title>

<!-- Content Header (Page header) -->
   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark"><?php echo $page_title; ?></h1>
          		</div>
        	</div><!-- /.row -->
      	</div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->

<!-- Main content -->
    <section class="content">
      	<div class="container-fluid">
            <form method="post" action="<?= base_url();?>report/show_expense" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">

                    	<div class="card card-info"> 
                            <div class="card-header">
                                <h3 class="card-title">Expense Type</h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                
                                	<div class="col-md-4">
                                        <div class="form-group">

                                            <label>Select Expense Type<span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="purchase_id" autocomplete="off" required>
                                            	<option value="">-- Select Expense Type --</option>

                                            	<?php foreach ($purchase_id as $key => $value) { ?>
                                            		<option value="<?= $value['id']; ?>" <?php if($value['id'] == set_value('purchase_id')) { echo "selected"; } ?>><?= $value['purchase_id']; ?></option>
                                            	<?php } ?>
                                                
                                            </select>
                                            <?php echo form_error('purchase_id'); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date Range<span class="astrick">*</span></label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Date Range" id="daterange-btn" name="date_range" required>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success" name="binary"><i class="fa fa-eye"></i>&nbsp;Show</button>
                                
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
<!-- Main content -->

<script type="text/javascript">
    $(function(){
        $('#daterange-btn').daterangepicker(
      {
        format: 'DD-MM-YYYY',
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
    })
</script>