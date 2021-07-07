<?php

    $firstname = $_COOKIE["firstname"];
    $lastname = $_COOKIE["lastname"];
    $history="";

    $mysqli = new mysqli("localhost", "root", "", "accounts");

    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
        Please try again later.</p>';
        exit;
    }

    $stmt= $mysqli->prepare("SELECT history FROM accounts WHERE firstname=? AND lastname=?");
    $stmt->bind_param('ss', $firstname, $lastname);
    $stmt -> execute();


    if ($stmt -> field_count) {
        $stmt->bind_result($history);
        $stmt->fetch();

        $history = explode('/', $history);
        echo "<h1> Welcome $firstname </h1> <br>";
        echo "Your previous transactions: <br> <hr>";

        foreach($history as $his){
            echo "$his <br>";
        }

        echo "
        <form action='logout.php' method='POST'>
        <p><button type='submit' >Log out</button></p>
        </form>
        ";


    }

