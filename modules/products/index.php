<?php
include("products.php");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaint Products Nananger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            
        </div> >
            <a href="../../index.php" class="navbar-brand">Return to Dashboard</a>
            <span class="navbar-text text-white " >Inventary Mananger</span>
        </div>

    </nav>

    <div class="container" >
        <div class="row">
            <div class="col-md-4" >
                <div class="card shadow-sm mb-4" >
                    <div class="card-header bg-success text-white ">
                        <h5 class="card-title mb-0" >Product information</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data" >
                            <input type="hidden" name="txtID" value="<?php echo $txtID; ?>" >
                            <div class="mb-3" >
                                <div class="mb-3">
                                    <label class="form-label" >Name: </label>
                                    <input type="text" name="txtName" class="form-control" value="<?php echo $txtName; ?>" placeholder="Mouse" required id="">

                                </div>

                                <div class="row" >
                                    <div class="col-6 mb-3" >
                                        <label for="" class="form-label" >Price:</label>
                                        <input type="number" step="0.01" name="txtPrice" class="form-control" value="<?php echo $txtPrice; ?>" placeholder="25.00" required> 
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="" class="form-label" >Stock:</label>
                                        <input type="number" name="txtStock" class="form-control" value="<?php echo $txtStock; ?>" placeholder="120<?php echo " und."; ?>" id="">
                                    </div>
                                    
                                </div>
                                <div class="row" >
                                    <div class="col-8 mb-3">
                                        <label for="" class="form-label" >Category:</label>
                                        <input type="text" name="txtCategory" class="form-control" value="<?php echo $txtCategory; ?>" placeholder="Periferics" required id="">
                                    </div>
                                    <div class="col-4 mb-3" >
                                        <label for="" class="form-label" >Stock Alert:</label>
                                        <input type="number" name="txtMinStock" class="form-control" value="<?php echo $txtMinStock; ?>" placeholder="0" id="">

                                    </div>

                                </div>
                                <div class="mb-3 " >
                                    <label for="" class="form-label" >Image:</label>
                                    <input type="file" name="txtImage" class="form-control" value="" id="">
                                    <?php if(isset($product['image'])&&$product['image']!="imagen.jpg"){ ?>
                                        <div class="mt-2 text-center">
                                            <small>Current Image:</small><br>
                                            <img src="../../assets/img/<?php echo $product['image']; ?>" class="img-thumbnail" width="100" alt="">

                                        </div>
                                        <?php } ?>
                                </div>
                                <div class="d-grid gap-2" >
                                    <button type="submit" name="action" value="btnAdd" class="btn btn-success" <?php echo $addAction; ?> >Add</button>
                                    <button type="submit" name="action" value="btnModify" class="btn btn-warning" <?php echo $modifyAction; ?> >Modify</button>
                                    <button type="submit" name="action" value="btnDelete" class="btn btn-secondary" <?php echo $deleteAction; ?> >Cancel</button>

                                </div>
                                
                                

                            </div>


                        </form>


                    </div>

                </div>

            </div>
            
                <div class="col-md-8" >
                    <div class="card-shadow-sm" >
                        <div class="card-body p-0" >
                            <table class="table table-bordered table-hover align-middle " >
                                <thead class="table-dark" >
                                    <tr>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($productList as $product){ ?>
                                        <tr>
                                            <td class="text-center" style="width: 100px;" > 
                                                <img src="../../assets/img/<?php echo $product['image']; ?>" class="img-thumbnail rounded" alt="Photo" style="max-height: 80px;"  >

                                            </td>
                                            <td>
                                                <strong><?php echo $product['name']; ?></strong><br>
                                                <span class="badge bg-secondary"> <?php echo $product['category']; ?> </span>
                                            </td>
                                            <td class="fw-bold text-success" >
                                                S/<?php echo $product['price']; ?>
                                            </td>
                                            <td class="<?php echo $product['stock'] == 0 ? 'fw-bold text-danger' : ($product['stock'] <= $product['min_stock'] ? 'fw-bold text-warning' : ''); ?>" >
                                                <?php echo $product['stock']; ?> und.
                                                <?php if($product['stock']<=$product['min_stock']) 
                                                    echo '⚠️';?>
                                            </td>
                                            <td class="text-center">
                                                <form action="" method="post">
                                                    <input type="hidden" value="<?php echo $product['id']; ?>" name="txtID" id="">
                                                    <button type="submit" value="btnSelect" name="action" class="btn btn-info btn-sm mb-1">
                                                        <i class="bi bi-pencil" title="Edit" ></i>
                                                    </button>
                                                    <button type="submit" value="btnDelete" name="action" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure that you want to delete this product?');" title="Delete" >
                                                        <i class="bi bi-trash" ></i>
                                                    </button>
                                                    
                                                </form>
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