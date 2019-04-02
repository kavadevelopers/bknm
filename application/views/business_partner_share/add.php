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
            <form method="post" id="selling_form" action="<?= base_url();?>business_partner_share/save" enctype="product/form-data">
                <div class="row">
                    <div class="col-md-12">

                        <!-- start here -->
                        <div class="card card-info"> 
                                <div class="card-header">
                                    <h3 class="card-title">Business Partner Share Amount </h3>
                                </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                           
                                            <label>Business Partner Name <span class="astrick">*</span></label>
                                            <select class="form-control form-control-sm select2" name="business_name" autocomplete="off" required>
                                                
                                                
                                                <?php 
                                                    $row = count($business_name);
                                                    echo $row;
                                                    if($row >= 1){ ?>
                                                        <option value="">-- Select Business Partner Name --</option>
                                                    <?php   foreach ($business_name as $key) { 
                                                            $customer_details = $this->users->business_detail($key['id']);
                                                    ?>
                                                        <option value="<?= $key['id'];?>" >
                                                        <?= $customer_details[0]['fi_name'].' '.$customer_details[0]['la_name'];?>
                                                        </option>
                                                  
                                                <?php 
                                                            } 
                                                    }
                                                    else
                                                    {
                                                ?>
                                                    <option value="">Business Partner Name Not Found Please Add Business Partner</option> 
                                                <?php } ?>

                                          </select>
                                          
                                        </div>               
                                    </div>
                                    
                                    

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Credit Amount<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="number" name="credit_amount" placeholder="Credit Amount" step="0.01" min="1" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Date<span class="astrick">*</span></label>
                                            <input class="form-control form-control-sm" type="text" name="date" id="date" placeholder="Date" value="<?= date('d-m-Y');?>" required readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Payment Mode<span class="astrick">*</span></label>
                                            <select name="payment_mode" class="form-control form-control-sm" required>
                                                <option value="">-- Select Payment Mode  --</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="Bank Transfer">Bank Transfer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Payment Mode Detail<span class="astrick">*</span></label>
                                            <textarea class="form-control form-control-sm" type="text" name="payment_mode_detail" placeholder="Payment Mode Detail Ex. (Cheque No., Ref.No.)" required></textarea>
                                        </div>
                                    </div>


                                </div><!-- // Row -->
                            </div><!-- // Card Body -->
                        </div><!-- // Card Info -->

                       

                        <div class="card">
                            <div class="card-footer">
                                <div class="float-right">
                                  <a href="<?= base_url(); ?>business_partner_share" class="btn btn-danger">Cancel</a>
                                  <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                </div>
                            </div>
                        </div>
                        <!-- end here -->

                    </div>
                </div><!-- // Row -->
            </form>    
        </div><!-- // container-fluid -->
    </section>
<!-- /.container-fluid -->

<script type="text/javascript">
    
     
    $(function(){
        
        //Initialize Select2 Elements
        $('.select2').select2()

        //First Receipt Date
        $('#date').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight:'TRUE',
            autoclose: true
        });
    });    
</script>   