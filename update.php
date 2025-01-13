<?php

require_once 'utils/helpers.php';

loginRequired();

global $connect;
$id = $_GET['id'];
if ($id == "" || !is_numeric($id)) {
    redirect('./index.php');
}

require_once "utils/connect.php";

$sql = "SELECT * FROM `goods` WHERE `id`= ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$good = $result->fetch_assoc();
$stmt->close();

if (!$good) {
    echo "<h1>GOOD NOT FOUND</h1>";
    echo "<a href='./index.php'>GO BACK</a>";
    exit;
}

$title = "Edit good $id";

require_once 'blocks/header.php';
?>
<h1>Update good with id=<?=$_GET["id"]?></h1>
<?php
echo '<p class="error">' . getValidationError() . '</p>'
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