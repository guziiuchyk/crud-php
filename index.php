<?php
global $connect;
require_once 'utils/connect.php';
require_once 'utils/helpers.php';

if (!isset($_SESSION['id']))
{
    redirect("./login.php");
}


$goods = mysqli_query($connect, "SELECT * FROM `goods`");
$goods = mysqli_fetch_all($goods);
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


    <h1>Create good</h1>
<?php
if (isset($_GET['val_error'])) echo "<span class='error'>" . $_GET['val_error'] . "</span>";
?>
    <form action="goods/create.php" method="post">
        <p>Name:</p>
        <input type="text" name="name" placeholder="name">
        <p>Description:</p>
        <textarea name="description" placeholder="description"></textarea>
        <p>Price:</p>
        <input type="text" name="price" placeholder="price">
        <input value="submit" type="submit">
    </form>

<?php
require_once 'blocks/footer.php';
?>