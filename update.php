<?php

require_once 'utils/helpers.php';

loginRequired();

global $connect;
$id = $_GET['id'];
if ($id == "" || !is_numeric($id)) {
    redirect('./index.php');
}

require_once "utils/connect.php";

$good = mysqli_query($connect, "SELECT * FROM `goods` WHERE `id`='$id'");
$good = mysqli_fetch_assoc($good);

if (!$good) {
    header("Location: index.php");
}

$title = "Edit good";

require_once 'blocks/header.php';
?>
<form action="goods/update.php" method="post">
    <input type="hidden" name="id" value="<?=$good["id"]?>"/>
    <p>Name:</p>
    <input value="<?=$good["name"]?>" type="text" name="name" placeholder="name">
    <p>Description:</p>
    <textarea name="description" placeholder="description"><?=$good["description"]?></textarea>
    <p>Price:</p>
    <input value="<?=$good["price"]?>" type="text" name="price" placeholder="price">
    <input value="submit" type="submit">
</form>

<?php
    require_once 'blocks/footer.php';
?>