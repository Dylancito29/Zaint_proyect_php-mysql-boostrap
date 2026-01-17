<?php 

include("../../config/db.php");


$SQLSentence=$pdo->prepare("SELECT * FROM clients");
$SQLSentence->execute();

$clientsList = $SQLSentence->fetchAll(PDO::FETCH_ASSOC);


$SQLSentence=$pdo->prepare("SELECT * FROM products");
$SQLSentence->execute();

$productList=$SQLSentence->fetchAll(PDO::FETCH_ASSOC);

$currentDate = date('Y-m-d H:i');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Creator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <div class="container" >
        <div class="row" >
            <div class="col-4" >
                <div class="card shadow-lg mb-4 " >
                    <div class="card-header bg-primary">
                        <h5 class="text-white text-center" >Client Information</h5>
                    </div>
                    <div class="card-body" >
                        <div m-2 >
                            <div class="mb-4" >
                                <label class="label-form" >Date:</label>
                                <input type="text" class="form-control" id="" value="<?php echo $currentDate; ?>" readonly>

                            </div>
                            <div class="mb-3" >
                                <label class="form-label"> Select Client:</label>
                                <div class="input-group" >
                                    <select name="selectClient" class="form-select" required>
                                        <option value="">--Select a Client</option>
                                        <?php foreach($clientsList as $client){ ?>
                                            <option value="<?php echo $client['id']; ?>">
                                                <?php echo $client['first_name']." ".$client['last_name']."(Doc: ".$client['doc_number'].")"; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <button class="btn btn-primary" type="button" >
                                        <i class="bi bi-person-fill-add"></i>
                                    </button>
                                </div>

                            </div>
                            <div class="mb-3" >
                                <hr>
                            </div>
                            <div class="col-12" >
                                <button class=" col-12 btn btn-success btn-lg" type="submit" >
                                    <i class="bi bi-save2-fill" ></i> Save Sale
                                </button>
                                
                            </div>


                        </div>

                    </div>

                </div>

            </div>

            <div class="col-8 " >
                <div class="card card-shadow-lg" >
                    <div class="card-header bg-primary text-white text-center" >
                        <h2><i class="bi bi-cart4"></i> Shopping cart</h2>
                    </div>
                    <div class="card-body" >
                        <div class="m-2" >
                            <div class="row mb-3">
                                <div class="col-8">
                                    <div class="" >
                                        <label class="label-form" >Products:</label>
                                        <div class="input-group" >
                                            <select name="" class="form-select" id="selectProduct">
                                                <option value="">--Select a Product--</option>
                                                <?php foreach($productList as $product){ ?>
                                                    <option value="<?php echo $product['id']; ?>" 
                                                    data-price="<?php echo $product['price']; ?>"  
                                                    data-name="<?php echo $product['name']; ?>"> <?php echo $product['name']." S/".$product['price'] ; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-2">
                                    <div>
                                        <label class="label-form" >Quantity:</label>
                                        <input type="number" id="txtQuantity" class="form-control" value="1" min="1" >
                                    </div>

                                </div>
                                <div class="col-2 align-items-end d-flex  ">
                                    <div>
                                        <button type="button" class="btn btn-success" onclick="addToCart()" >
                                            <i class="bi bi-plus-lg" ></i>
                                        </button>
                                    </div>

                                </div>


                                
                            </div>
                            
                            <div>
                                <table class="table table-bordered table-striped" >
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cartTable" >
                                        <!-- Items will be added here dynamically -->
                                         <tr>
                                            <td colspan="5" class="text-center text-muted" >This cart is empty</td>
                                         </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                            <td  colspan="2" >S/ <span id="totalAmount">0.00</span></td>
                                           
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>

    </div>
    <script>
        let saleTotal = 0.00;

        function  addToCart(){
            // 1. 
            const select = document.getElementById('selectProduct');
            const quantityInput = document.getElementById('txtQuantity');
            const table = document.getElementById('cartTable');
            const totalDisplay = document.getElementById('totalAmount');


            // 2. Basic Validations
            if(select.value===""){
                alert("Please, Select a product⚠️")
                return;
            }
            if(quantityInput.value<1){
                alert("Please, Select at least 1");
                return;
            }
            
            // Get products data --
            const selectedOption = select.options[select.selectedIndex];
            const id = select.value;
            const name = selectedOption.getAttribute('data-name');
            const price = parseFloat(selectedOption.getAttribute('data-price'));
            const quantity = parseInt(quantityInput.value);


            // 4. Calculates

            const subtotal = price * quantity;
            saleTotal += subtotal ;


            // 5. Clean row 
            if(table.rows.length>0 && table.rows[0].cells.length===1){
                table.innerHTML="" ;               
            }

            const row = table.insertRow();

            row.innerHTML = `
                    <td>
                        ${name}
                        <input type="hidden" name="products_id[]" value="${id}">

                    </td>
                    <td>
                        ${quantity}
                        <input type="hidden" name="quantity[]" value="${quantity}">
                        <input type="hidden" name="unit_price[]" value="${price}">

                    </td>
                    <td>S/ ${price.toFixed(2)}</td>
                    <td>S/ ${subtotal.toFixed(2)}</td>
                    <td class="text-center" >
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this,${subtotal})" >
                            <i class="bi bi-trash" ></i>X
                        </button>

                    </td>            
            `;
            // 7. Update the total in the display
            totalDisplay.innerText =saleTotal.toFixed(2);

            // 8. Reset form
            select.value = "";
            quantityInput.value = 1;
            select.focus(); // Return 
        }
        function deleteRow(btn,subtotalSubs){
            //Delete row viewly 
            const row = btn.parentNode.parentNode;
            row.remove();

            // Substract totalDisplay
            saleTotal -= subtotalSubs;
            document.getElementById('totalAmount').innerText=saleTotal.toFixed(2);
        }


    </script>
    
</body>
</html>