<?php

session_start();

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

function addValidationError(string $fieldName, string $message): void
{
    $_SESSION['validation'][$fieldName] = $message;
}

function getValidationError(): string
{
    if (empty($_SESSION['validation'])) {
        return '';
    }
    $message =  $_SESSION['validation'][array_key_first($_SESSION['validation'])];
    $_SESSION['validation'] = [];
    return $message;
}

function addOldValue(string $key, mixed $value): void
{
    $_SESSION["old"][$key] = $value;
}

function oldValue(string $key): mixed
{
    $value = $_SESSION["old"][$key] ?? "";
    unset($_SESSION["old"][$key]);
    return $value;
}

function addMessage(string $key,string $message): void
{
    $_SESSION['messages'][$key] = $message;
}

function getMessage(string $key): string
{
    $message = $_SESSION["messages"][$key] ?? "";
    unset($_SESSION["messages"][$key]);
    return $message;
}

function loginRequired(bool $isValid = false): void
{
    global $connect;
    if(!isset($_COOKIE["token"])){
        redirect("/login.php");
    }

    if(!$isValid){
        return;
    }

    $sql = "SELECT * FROM tokens WHERE token = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $_COOKIE["token"]);
    $stmt->execute();
    $stmt->bind_result($id, $userId, $token, $expireIn);
    if (!$stmt->fetch()) {
        redirect("/login.php");
    }
    $stmt->close();


}

function adminRequired(): void
{
    global $connect;
    loginRequired();
    $user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`='" . $_SESSION['id'] . "'");
    $user = mysqli_fetch_assoc($user);
    if (!$user['role'] == "ADMIN") {
        redirect('/login.php');
    }
}