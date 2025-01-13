<?php
global $connect;
require_once '../utils/helpers.php';

loginRequired(true);


$id = $_GET['id'];
if ($id == "" || !is_numeric($id)) {
    redirect('../index.php');
}

require_once "../utils/connect.php";

$sql ="DELETE FROM goods WHERE `goods`.`id` = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

redirect('../index.php');