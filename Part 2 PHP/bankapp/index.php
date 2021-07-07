<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

require_once("account.php");

$test = new Account("First", "Last");

echo $test->displaybalance();
echo $test->deposit(5);
echo $test->displaybalance();


?>
<nav>
    <ul>
        <li>
            <a href="newaccount.php">New Account</a>
        </li>
        <li>
            <a href="login.php">Login</a>
        </li>
    </ul>
</nav>
</body>
</html>




