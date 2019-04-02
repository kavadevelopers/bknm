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
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Date</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0; foreach ($data as $key => $row) { $total += $row['amount']; ?>
                                        <tr>
                                            
                                            <td><?= $row['desc']; ?></td>
                                            <td><?= $row['amount']; ?></td>
                                            <td><?= date('d-m-Y',strtotime($row['date'])); ?></td>
                                           
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <th style="text-align: right;">Total</th>
                                    <th><?=  $total;  ?></th>
                                    <th></th>
                                </tfoot>
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
            "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-12't>>",
            
            buttons: [ 
                { 
                    extend: 'print',
                    title: '<?=$this->config->config["projectTitle"]?> Expense',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?=$this->config->config["projectTitle"]?> Expense',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?=$this->config->config["projectTitle"]?> Expense',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                }
            ]
            
        });
    })
</script>
