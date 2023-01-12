<?php
require_once "loginDB.php";
?>
<form action="index.php" method="get">
    <input type="text" name="username" placeholder="Benutzername">
    <input type="password" name="password" placeholder="Passwort">
    <input type="submit" value="Login">
</form>