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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        
                                        <th>Bill No</th>
                                        <th>C/D</th>
                                        <th>Amount</th>
                                        <th>Ifsc Code</th>
                                        <th>Account No.</th>
                                        <th>Saving or Current</th>
                                        <th>Name Of Person</th>
                                        <th>Address</th>
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $tot_all = 0; foreach ($person as $key => $value) {  ?>
                                        <?php $Bills = $this->db->query("SELECT `id` FROM `bill` WHERE `person` = '".$value["person"]."' ORDER BY `id` ASC")->result_array(); 
                                            $bill_all = "";
                                            foreach ($Bills as $keya => $valuea) {
                                                $bill_all .= $valuea['id'].',';
                                            } $bill_all = rtrim($bill_all,',');


                                            $amount = $this->db->query("SELECT SUM(total) AS `bills_tot` FROM `bill` WHERE `person` = '".$value["person"]."'")->result_array();

                                             ?>
                                        <tr>
                                            
                                            <td><?= $bill_all; ?></td>
                                            <td>C</td>
                                            <td><?= $amount[0]['bills_tot']; ?><?php $tot_all += $amount[0]['bills_tot']; ?></td>
                                            <td><?= $this->bknmu->person_by_id($value['person'])['ifsc']; ?></td>
                                            <td><?= $this->bknmu->person_by_id($value['person'])['acno']; ?></td>
                                            <td>10</td>
                                            <td><?= $this->bknmu->person_by_id($value['person'])['name']; ?></td>
                                            <td><?= $this->bknmu->person_by_id($value['person'])['address']; ?></td>


                                            
                                            
                                            
                                            

                                        </tr>
                                    <?php } ?>

                                        <tr>
                                                
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                
                                        </tr>

                                        <tr>
                                                
                                                <td></td>
                                                <td>D</td>
                                                <td><?= $tot_all; ?></td>
                                                <td><?= $this->bknmu->person_by_id("1")['ifsc']; ?></td>
                                                <td><?= $this->bknmu->person_by_id("1")['acno']; ?></td>
                                                <td>10</td>
                                                <td><?= $this->bknmu->person_by_id("1")['name']; ?></td>
                                                <td><?= $this->bknmu->person_by_id("1")['address']; ?></td>
                                                
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


      	</div>
    </section>
<!-- /.container-fluid -->

<script type="text/javascript">
    $(function(){
        $('.table').DataTable({
            "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
            "columnDefs": [
                { "orderable": false, "targets": [2,6] }
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                }
            ]
            
        });
    })
</script>

