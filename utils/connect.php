<?php

$connect = mysqli_connect("localhost", "root", "root", "crud");
if (!$connect) {
    die("Database Connection Failed" . mysqli_connect_error());
}