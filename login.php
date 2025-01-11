<?php


require_once "utils/helpers.php";

$title = "Login";

require_once "blocks/header.php";
?>

<h1>Login</h1>
<?php
echo '<p class="error">' . getMessage("error") . '</p>'
?>
<form action="users/login.php" method="post">
    <p>email:</p>
    <input type="text" value="<?=oldValue('email')?>" name="email" placeholder="email">
    <p>password:</p>
    <input type="password" name="password" placeholder="password">
    <input value="submit" type="submit">
</form>

<p>Dont have an account? <a href="/register.php">Register</a></p>

<?php
require_once "blocks/footer.php";
?>
