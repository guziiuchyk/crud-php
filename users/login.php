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

$_SESSION["id"] = $user["id"];

redirect("../index.php");