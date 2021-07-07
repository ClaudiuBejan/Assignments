<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New account</title>
</head>
<body>
<form action="newaccount.php" method="POST">
    <p>First Name: <input type="text" name="firstname"></p>
    <p>Last Name: <input type="text" name="lastname"></p>
    <p>Date of birth: <input type="date" name="dob" /></p>
    <p>Date of birth: <input type="password" name="pwd" /></p>
    <p><input type="submit" /></p>
</form>
<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    $firstname = "";
    $lastname = "";
    $dob = "";
    $pdw="";
    $firstname = htmlentities($_POST['firstname'], ENT_QUOTES, "UTF-8" );
    $lastname = htmlentities($_POST['lastname'], ENT_QUOTES, "UTF-8" );
    $dob = htmlentities($_POST['dob'], ENT_QUOTES, "UTF-8" );
    $pwd = htmlentities($_POST['pwd'], ENT_QUOTES, "UTF-8" );

    $db = new mysqli("localhost", "root", "", "accounts");

    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
        Please try again later.</p>';
        exit;
    }

    $stmt = $db->prepare("INSERT INTO accounts (firstname, lastname, dob, pwd)
    VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $firstname, $lastname, $dob, $pwd);
    $stmt->execute();
    if( $stmt->affected_rows > 0)
    printf("Thanks for registering, you may wish to <a href='login.php'>Login</a> ");
    $stmt->free_result();
    $db->close();
}

?> 

</body>
</html>