<?php
global $connect;
require_once 'utils/connect.php';
require_once 'utils/helpers.php';

loginRequired();


$goods = mysqli_query($connect, "SELECT * FROM `goods`");
$goods = mysqli_fetch_all($goods);

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
            echo "<td><a href='update.php?id=$good[0]'>update</a></td>";
            echo "<td><a href='goods/delete.php?id=$good[0]'>delete</a></td>";
            echo "</tr>";
        } ?>
    </table>
<?php
require_once 'blocks/footer.php';
?>