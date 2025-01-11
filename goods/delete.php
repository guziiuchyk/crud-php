<?php
global $connect;
require_once '../utils/helpers.php';

loginRequired();


$id = $_GET['id'];
if ($id == "" || !is_numeric($id)) {
    redirect('../index.php');
}

require_once "../utils/connect.php";

mysqli_query($connect, "DELETE FROM goods WHERE `goods`.`id` = $id");
redirect('../index.php');