<?php
global $connect;
require_once 'utils/connect.php';
require_once 'utils/helpers.php';

loginRequired();

$title = "Create good";

require_once 'blocks/header.php';
?>
    <h1>Create good</h1>
<?php
echo '<p class="error">' . getValidationError() . '</p>'
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