<?php
global $connect;
require_once '../utils/helpers.php';
require_once '../utils/connect.php';

unset($_SESSION['id']);

$sql = "DELETE FROM tokens WHERE tokens.token = ?";

$stmt = $connect->prepare($sql);
$stmt->bind_param('s', $_COOKIE['token']);
$stmt->execute();
$stmt->close();

$expires_in = 60 * 60 * 24;
setcookie("token", "", time() - ($expires_in), "/");

redirect("/login.php");