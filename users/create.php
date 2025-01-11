<?php
global $connect;
require_once '../utils/connect.php';
require_once '../utils/helpers.php';

loginRequired();

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

addOldValue("name", $name);
addOldValue("email", $email);

if(empty($name))
    addValidationError("name", "Name is required");
if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    addValidationError("email", "Email is not valid");
if(empty($password))
    addValidationError("password", "Password is required");
if(empty($password_confirm))
    addValidationError("password_confirm", "Password Confirmation is required");
if($password != $password_confirm)
    addValidationError("password_confirm", "Password Confirmation does not match");

if(!empty($_SESSION["validation"])){
    redirect("../register.php");
}

$password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO `users` (name, email, password) VALUES (?, ?, ?)";
$stmt = $connect->prepare($sql);
$stmt->bind_param("sss", $name, $email, $password);
$stmt->execute();
$stmt->close();

redirect("../login.php");