<?php
global $connect;
require_once '../utils/connect.php';
require_once '../utils/helpers.php';

loginRequired(true);

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

$sql = "INSERT INTO `goods` (name, description, price, created_by) VALUES (?, ?, ?, ?)";
$stmt = $connect->prepare($sql);
$stmt->bind_param("ssii", $name, $description, $price, $_SESSION["id"]);
$stmt->execute();
$stmt->close();

redirect("../index.php");