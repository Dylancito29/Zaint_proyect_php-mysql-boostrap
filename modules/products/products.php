<?php

include("../../config/db.php");

$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtName = (isset($_POST['txtName']))?$_POST['txtName']:"";
$txtCategory = (isset($_POST['txtCategory']))?$_POST['txtCategory']:"";
$txtPrice = (isset($_POST['txtPrice']))?$_POST['txtPrice']:"";
$txtStock = (isset($_POST['txtStock']))?$_POST['txtStock']:"";
$txtMinStock = (isset($_POST['txtMinStock']))?$_POST['txtMinStock']:"";

$txtImage = (isset($_FILES['txtImage']['name']))?$_FILES['txtImage']['name']:"";

$action = (isset($_POST['action']))?$_POST['action']:"";






$addAction = "";
$modifyAction = $deleteAction = $cancelAction = "";
$displayModal = false;
$error = [];


switch($action){
    case "btnAdd":
        if($txtName==""){
            $error['Name']="Enter a name, please";
        }
        if($txtPrice==""){
            $error['Price']="Enter a value, please";
        }

        if(count($error)>0){
            $displayModal = true;
        }

        $SQLSentence = $pdo->prepare("INSERT INTO products(name,category,price,stock,min_stock,image)VALUES(:name,:category,:price,:stock,:min_stock,:image)");

        $SQLSentence->bindParam(':name',$txtName);
        $SQLSentence->bindParam(':category',$txtCategory);
        $SQLSentence->bindParam(':price',$txtPrice);
        $SQLSentence->bindParam(':stock',$txtStock);
        $SQLSentence->bindParam(':min_stock',$txtMinStock);

        $date = new DateTime();

        

        $fileName =($txtImage!="")?$date->getTimestamp()."_".$_FILES['txtImage']['name']:"imagen.jpg";

        $tmpImage = $_FILES['txtImage']['tmp_name'];

        if($tmpImage !=""){
            move_uploaded_file($tmpImage, "../../assets/img/".$fileName);
        }
        $SQLSentence->bindParam(':image',$fileName);

        $SQLSentence-> execute();

        header("Location: index.php");

    break;
    case 'btnModify':
        $SQLSentence= $pdo->prepare("UPDATE products SET 
        name=:name,
        category=:category,
        price=:price,
        stock=:stock,
        min_stock = :min_stock
         WHERE id=:id
        ");

        $SQLSentence->bindParam(':name',$txtName);
        $SQLSentence->bindParam(':category',$txtCategory);
        $SQLSentence->bindParam(':price',$txtPrice);
        $SQLSentence->bindParam(':stock',$txtStock);
        $SQLSentence->bindParam(':min_stock',$txtMinStock);
        $SQLSentence->bindParam(':id',$txtID);

        $SQLSentence->execute();

        $date = new DateTime();

        

        $fileName =($txtImage!="")?$date->getTimestamp()."_".$_FILES['txtImage']['name']:"imagen.jpg";

        $tmpImage = $_FILES['txtImage']['tmp_name'];

        if($tmpImage !=""){
            move_uploaded_file($tmpImage, "../../assets/img/".$fileName);

            $SQLSentence=$pdo->prepare("SELECT image FROM products WHERE id=:id");
            $SQLSentence->bindParam(':id',$txtID);
            $SQLSentence->execute();

            $product= $SQLSentence->fetch(PDO::FETCH_LAZY);

            if(isset($product['image'])&&($product!="image")){
                if(file_exists("../../assets/img/".$product['image'])){
                    unlink("../../assets/img/".$product['image']);
                }
            }

            $SQLSentence=$pdo->prepare("UPDATE products SET 
            image=:image WHERE id=:id ");
            $SQLSentence->bindParam(':image',$fileName);
            $SQLSentence->execute();

        }

        header("Location: index.php");
        break;

        case "btnDelete":
            $SQLSentence=$pdo->prepare("SELECT image FROM products WHERE id=:id");
            $SQLSentence->bindParam(':id',$txtID);
            $SQLSentence->execute();

            $product=$SQLSentence->fetch(PDO::FETCH_LAZY);

            if(isset($product['image'])&&($product!="image")){
                if(file_exists("../../assets/img/".$product['image'])){
                    unlink("../../assets/img/".$product['image']);
                }
            }
            $SQLSentence=$pdo->prepare("DELETE FROM products WHERE id=:id");
            $SQLSentence->bindParam(':id',$txtID);
            $SQLSentence->execute();

            header('Location: index.php');
            break;
        
        case "btnCanceled":
            header('Location: index.php');
            break;
        case "btnSelect":
            $addAction = "disabled";
            $modifyAction = $deleteAction = $cancelAction = "";
            $displayModal = true;

            $SQLSentence=$pdo->prepare("SELECT * FROM products WHERE id=:id");
            $SQLSentence->bindParam(':id',$txtID);
            $SQLSentence->execute();

            $product = $SQLSentence->fetch(PDO::FETCH_LAZY);

            $txtName=$product['name'];
            $txtCategory=$product['category'];
            $txtPrice=$product['price'];
            $txtStock=$product['stock'];
            $txtMinStock=$product['min_stock'];
            break;
            


}

$SQLSentence = $pdo->prepare("SELECT * FROM products");
$SQLSentence->execute();
$productList = $SQLSentence->fetchAll(PDO::FETCH_ASSOC);


?>