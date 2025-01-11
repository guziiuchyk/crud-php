<?php
require_once '../utils/helpers.php';

unset($_SESSION['id']);

$expires_in = 60 * 60 * 24;
setcookie("token", "", time() - ($expires_in), "/");

redirect("/login.php");