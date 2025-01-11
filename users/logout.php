<?php
require_once '../utils/helpers.php';

unset($_SESSION['id']);

redirect("login.php");