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

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <table id="main" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        
                                        <td>Gross Amount</td>
                                        <td><?= moneyFormatIndia($product['gross']); ?></td>
                                       
                                    </tr>

                                    <tr>
                                        
                                        <td>Sale Amount</td>
                                        <td><?= moneyFormatIndia($sale['selling_amount']); ?></td>
                                       
                                    </tr>

                                    <tr>
                                        
                                        <td> - </td>
                                        <td> - </td>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <table id="transaction" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0; foreach ($transaction as $key => $row) {  $total += $row['amount']; ?>
                                        
                                        <tr>
                                        
                                            <td><?= $row['type']; ?></td>
                                            <td><?= moneyFormatIndia($row['amount']); ?></td>
                                           
                                        </tr>    

                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th><?= moneyFormatIndia($total); ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
