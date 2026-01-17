<?php

include("../../config/db.php");

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtFirstName = (isset($_POST['txtFirstName']))?$_POST['txtFirstName']:"";
$txtLastName = (isset($_POST['txtLastName']))?$_POST['txtLastName']:"";
$txtPhone = (isset($_POST['txtPhone']))?$_POST['txtPhone']:"";
$txtEmail = (isset($_POST['txtEmail']))?$_POST['txtEmail']:"";
$txtDocNumber = (isset($_POST['txtDocNumber']))?$_POST['txtDocNumber']:"";

$action = (isset($_POST['action']))?$_POST['action']:"";

$addAction="";
$modifyAction=$cancelAction="disabled";
$error=[];
switch($action){
    case "btnAdd":
        if($txtFirstName==""){
            $error['firts_name']="Enter the first name, please";
        }
        if($txtLastName==""){
            $error['last_name']="Enter the last name, please";
        }
        if($txtPhone==""){
            $error['phone']="Enter the phone number";
        }
        if($txtDocNumber==""){
            $error['doc_number']="Enter the doc_number";

        }
        if(count($error)>0){
            $displayModal= true;
            break;
        }
        $SQLSentence=$pdo->prepare("INSERT INTO clients(first_name,last_name,phone,doc_number,email) VALUES(:first_name,:last_name,:phone,:doc_number,:email)");

        $SQLSentence->bindParam(":first_name",$txtFirstName);
        $SQLSentence->bindParam(":last_name",$txtLastName);
        $SQLSentence->bindParam(":phone",$txtPhone);
        $SQLSentence->bindParam(":doc_number",$txtDocNumber);
        $SQLSentence->bindParam(":email",$txtEmail);

        $SQLSentence->execute();

        header("Location: index.php");
        break;

    case "btnModify":
        $SQLSentence=$pdo->prepare("UPDATE clients SET
        first_name=:first_name,
        last_name=:last_name,
        phone=:phone,
        doc_number=:doc_number,
        email=:email WHERE id=:id ");
        
        $SQLSentence->bindParam(":id",$txtID);
        $SQLSentence->bindParam(":first_name",$txtFirstName);
        $SQLSentence->bindParam(":last_name",$txtLastName);
        $SQLSentence->bindParam(":phone",$txtPhone);
        $SQLSentence->bindParam(":doc_number",$txtDocNumber);
        $SQLSentence->bindParam(":email",$txtEmail);

        $SQLSentence->execute();

        break;
    case "btnCancel":
        header("Locate: index.php");
        break;

    case "btnSelect":
        $addAction="disabled";
        $modifyAction=$cancelAction="";
        $SQLSentence=$pdo->prepare("SELECT *FROM clients WHERE id=:id");
        $SQLSentence->bindParam(":id",$txtID);
        $SQLSentence->execute();

        $product = $SQLSentence->fetch(PDO::FETCH_LAZY);
        $txtID = $product['id'];
        $txtFirstName = $product['first_name'];
        $txtLastName = $product['last_name'];
        $txtPhone = $product['phone'];
        $txtEmail = $product['email'];
        $txtDocNumber = $product['doc_number'];

        break;


    case "btnDelete":
        $SQLSentence=$pdo->prepare("DELETE * FROM clients  WHERE id=:id ");
        
        $SQLSentence->bindParam(":id",$txtID);
        
        $SQLSentence->execute();
        break;  
    
        
}
$SQLSentence=$pdo->prepare("SELECT * FROM clients");
$SQLSentence->execute();
$clientsList= $SQLSentence->fetchAll(PDO::FETCH_ASSOC);




    






?>