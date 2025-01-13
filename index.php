<?php
global $connect;
require_once 'utils/connect.php';
require_once 'utils/helpers.php';

loginRequired();


$sql = "SELECT * FROM goods";

$stmt = $connect->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$goods = [];
while ($row = $result->fetch_assoc()) {
    $goods[] = $row;
}

$title = "Goods";

require_once 'blocks/header.php';
?>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>description</th>
            <th>price</th>
            <th>created by</th>
            <th>&#9998;</th>
            <th>&#10006;</th>
        </tr>
        <?php foreach ($goods as $good) {
            echo "<tr>";
            foreach ($good as $param) {
                echo "<td>" . $param . "</td>";
            }
            echo "<td><a href='update.php?id=".$good["id"]."'>update</a></td>";
            echo "<td><a href='goods/delete.php?id=".$good["id"]."'>delete</a></td>";
            echo "</tr>";
        } ?>
    </table>
<?php
require_once 'blocks/footer.php';
?>