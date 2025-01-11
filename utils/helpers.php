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

function loginRequired(): void
{
    if (!isset($_SESSION['id'])) {
        addMessage("error", "You need to login first");
        redirect('/testphp/login.php');
    }
}