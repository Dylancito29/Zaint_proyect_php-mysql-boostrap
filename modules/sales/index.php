<?php 


include("../../config/db.php");

$SQLSentence = $pdo->prepare("SELECT i.*, c.first_name, c.last_name FROM invoices i JOIN clients c ON i.client_id =  c.id ORDER BY i.date DESC ");
$SQLSentence->execute();


$salesList = $SQLSentence->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales history</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



</head>
<body>
    <nav>

    </nav>
    <div class="container" >
        <div class="col-12" >
            <div class="card shadow-lg" >
                <div class="m-3" >
                    <h5 class="mb-4" >Lastes sales registered</h5>
                    <table class="table table-bordered " >
                        <thead class="" >
                            <tr class="bg-dark" >
                                <th>#ID</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
    
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($salesList as $sale){ ?>
                                <tr>
                                    <td><?php echo $sale['id']; ?></td>
                                    <td><?php echo date("d/m/Y h:i A",strtotime($sale['date'])); ?></td>
                                    <td><?php echo $sale['first_name']." ".$sale['last_name'];?></td>
                                    <td class="fw-bold text-success" >S/ <?php echo number_format($sale['total'],2) ?></td>
                                    <td>
                                        <?php if($sale['status']=='pending'){ ?>
                                            <span class="badge bg warning text-dark">Pending</span>
                                        <?php }else{ ?>
                                            <span class="badge bg-success" >Paid</span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="report.php?id=<?php echo $sale['id']; ?>" class="btn btn-primary btn-sm" target="_blak" >
                                            <i class="bi bi-file-earmark-pdf"></i> Ver Factura
                                        </a>


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
    
</body>
</html>