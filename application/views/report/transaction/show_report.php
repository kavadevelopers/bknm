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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
		                    <table id="main_transaction" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>UserId</th>
                                        <th>Credit</th>
                                        <th>Debit</th>
                                        <th>Date</th>
                                        <th>Credit/Debit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($this->dash_model->get_transaction_recent() as $key) {  ?>
                                        <tr>
                                            <td><?= ucfirst($key['type']); ?></td>
                                            <td><?= $this->dash_model->get_user_id_trans($key['credit_by'],$key['debit_by']); ?></td>
                                            <td><?= $key['credit']; ?></td>
                                            <td><?= $key['debit']; ?></td>
                                            <td><?= _vdate($key['date']); ?></td>
                                            <td class="text-center">
                                                <?php if($key['credit'] == '0'){ echo '<span class="badge badge-danger">Debit</span>'; }else{ echo '<span class="badge badge-success">Credit</span>'; } ?>        
                                            </td>
                                            
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
            "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> <?php echo $page_title; ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> <?php echo $page_title; ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> <?php echo $page_title; ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                }
            ]
            
        });
    })
</script>