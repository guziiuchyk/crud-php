<?php
global $connect;
require_once '../utils/connect.php';
require_once '../utils/helpers.php';

loginRequired();

$name = trim($_POST['name']);
$description = trim($_POST['description']);
$price = trim($_POST['price']);

if($name == "" || $description == "" || $price == ""){
    addValidationError("all", "Please fill in all fields");
    redirect("../index.php");
}

if(!is_numeric($price)){
    addValidationError("price", "price must be a valid number");
    redirect("../index.php");
}

mysqli_query($connect, "INSERT INTO `goods` (name, description, price, created_by) VALUES ('$name', '$description', '$price', ".$_SESSION["id"].")");

redirect("../index.php");