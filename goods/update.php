<?php

global $connect;
require_once '../utils/connect.php';
require_once '../utils/helpers.php';

loginRequired();

$id = trim($_POST['id']);
$name = trim($_POST['name']);
$description = trim($_POST['description']);
$price = trim($_POST['price']);

if ($id == "" || !is_numeric($id)) {
    redirect("../index.php");
}

if($name == "" || $description == "" || $price == ""){
    redirect('../index.php');
}

mysqli_query($connect, "UPDATE `goods` SET `name` = '$name', `description` = '$description', `price` = '$price' WHERE `goods`.`id` = $id ");

redirect('../index.php');