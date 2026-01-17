<?php 
include("clients.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Mananger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>
<body class="bg-dark" >
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="#">Features</a>
        <a class="nav-link" href="#">Pricing</a>
        <a class="nav-link disabled" aria-disabled="true">Disabled</a>
      </div>
    </div>
  </div>
</nav>

</nav>

    <div class="container " >
        <div class="row" >
            <div class="col-4">
                <div class="card shadow-sm m-4">
                    <div class="card-header bg-info text-center text-white " >
                        <h5>Client Data</h5>
                    </div>
                    <div class="card-body">
                        <div m-2>
                            <form action="" method="post" enctype="multipart/form-data" >
                                <input type="hidden" name="txtID"  value="<?php echo $txtID; ?>" >

                                <div class="row" >
                                    <div class="col-6" >
                                        <label class="form-label ">First Name:</label>
                                        <input type="text" class="form-control" name="txtFirstName" value="<?php echo $txtFirstName; ?>">
                                    </div>

                                    <div class="col-6">
                                        <label class="form-label">Last Name:</label>
                                        <input type="text" class="form-control" name="txtLastName" value="<?php echo $txtLastName; ?>">

                                    </div>

                                </div>

                                <div class="row" >
                                    <div class="col-6" >
                                        <label class="form-label" >Phone Number:</label>
                                        <input type="text" name="txtPhone" class="form-control" value="<?php echo $txtPhone; ?>" id="">
                                    </div>

                                    <div class="col-6" >
                                        <label class="form-label" >Document:</label>
                                        <input type="number" name="txtDocNumber" class="form-control" value="<?php echo $txtDocNumber; ?>" id="">
                                    </div>

                                </div>
                                


                                <label class="form-label" >Email:</label>
                                <input type="email" name="txtEmail" class="form-control" value="<?php echo $txtEmail; ?>" id="">

                                <div class=" d-grid gap-2 mt-4" >
                                    <button type="submit" name="action" class="btn btn-success btn-md " value="btnAdd" <?php echo $addAction; ?> >Add</button>
                                    <button type="submit" name="action" class="btn btn-warning btn-md " value="btnModify" <?php  echo $modifyAction; ?> >Modify</button>
                                    <button type="submit" name="action" class="btn btn-secondary btn-md " value="btnCancel" <?php echo $cancelAction; ?> >Cancel</button>

                                </div>

                            </form>
                            
                        </div>

                    </div>

                </div>
    
            </div>
            <div class="col-8 mt-4" >
                <table class="table table-striped table-bordered table-hover " >
                    <thead class=" table-info text-center" >
                        <tr>
                            <th>Full Name</th>
                            <th>Phone Number</th>
                            <th>Document</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php foreach($clientsList as $client){ ?>
                            <tr>
                                <td><?php echo $client['first_name']." ".$client['last_name']; ?></td>
                                <td><?php echo $client['phone']; ?></td>
                                <td><?php echo $client['doc_number']; ?></td>
                                <td><?php echo $client['email']; ?></td>
                                <td class="text-center" >
                                    <form method="post">
                                        <input type="hidden" name="txtID"  value="<?php echo $client['id']; ?>" >
                                        <button type="submit" class="btn btn-primary btn-md mb-1" name="action" value="btnSelect" >
                                            <i class="bi bi-pencil" title="Select" ></i>
                                        </button>
                                        <button type="submit" class="btn btn-danger btn-md mb-1 " name="action" value="btnDelete" ><i class="bi bi-trash"></i></button>

                                        
                                    </form>
                                    
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>

                </tabl>

                

            </div>

        </div>

    </div>
    
</body>
</html>