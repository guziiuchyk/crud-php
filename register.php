<?php

require_once "utils/helpers.php";

$title = "Register";

require_once "blocks/header.php";
?>

<h1>Register</h1>
<?php
    echo '<p class="error">' . getValidationError() . '</p>'
?>
<form action="users/create.php" method="post">
    <p>Name:</p>
    <input type="text" value="<?=oldValue('name')?>" name="name" placeholder="name">
    <p>email:</p>
    <input type="text" value="<?=oldValue('email')?>" name="email" placeholder="email">
    <p>password:</p>
    <input type="password" name="password" placeholder="password">
    <p>password confirm:</p>
    <input type="password" name="password_confirm" placeholder="password confirm">
    <input value="submit" type="submit">
</form>

<p>Have an account? <a href="/login.php">Login</a></p>

<?php
require_once "blocks/footer.php";
?>
