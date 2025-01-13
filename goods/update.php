<?php

global $connect;
require_once '../utils/connect.php';
require_once '../utils/helpers.php';

loginRequired(true);

$id = trim($_POST['id']);
$name = trim($_POST['name']);
$description = trim($_POST['description']);
$price = trim($_POST['price']);

if ($id == "" || !is_numeric($id)) {
    redirect("../index.php");
}

if($name == "" || $description == "" || $price == ""){
    addValidationError("updateError","All fields are required");
    redirect('../update.php?id='.$id);
}

if(!is_numeric($price)){
    addValidationError("updateError","Price must be a number");
    redirect('../update.php?id='.$id);
}

$sql = "UPDATE `goods` SET `name` = ?, `description` = ?, `price` = ? WHERE `goods`.`id` = ?";

$stmt = $connect->prepare($sql);

$stmt->bind_param("ssii", $name, $description, $price, $id);
$stmt->execute();
$stmt->close();

redirect('../index.php');