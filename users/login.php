<?php
global $connect;
require_once '../utils/helpers.php';
require_once "../utils/connect.php";

$email = $_POST["email"];
$password = $_POST["password"];

if($email == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)){
    addMessage("error","Email is not valid");
    redirect("../login.php");
}

$user = mysqli_query($connect,"SELECT * FROM `users` WHERE email='$email'");

$user = mysqli_fetch_assoc($user);

if(!password_verify($password, $user["password"])){
    addMessage("error","Wrong password");
    redirect("../login.php");
}

$token = bin2hex(random_bytes(60));
$expires_in = 60 * 60 * 24;
$expires_at = date('Y-m-d H:i:s', time() + $expires_in);

$sql = "INSERT INTO tokens (user_id, token, expires_in) VALUES (?, ?, ?)";
$stmt = $connect->prepare($sql);
$stmt->bind_param("iss", $user["id"], $token, $expires_at);
$stmt->execute();
$stmt->close();

setcookie("token", $token, time() + ($expires_in), "/", "", false, true);

$_SESSION["id"] = $user["id"];

redirect("../index.php");