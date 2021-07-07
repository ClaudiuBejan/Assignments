<?php

if($_SERVER['REQUEST_METHOD']=="POST"){

    $firstname = $_COOKIE["firstname"];
    $lastname = $_COOKIE["lastname"];
    $balance=htmlentities($_POST['balance'], ENT_QUOTES, "UTF-8" );
    $amount=htmlentities($_POST['amount'], ENT_QUOTES, "UTF-8" );
    $history="";

    $mysqli = new mysqli("localhost", "root", "", "accounts");

    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
        Please try again later.</p>';
        exit;
    }

    $balance -= (int)$amount;
    $stmt= $mysqli->prepare("UPDATE accounts SET balance=? WHERE firstname=? AND lastname=?");
    $stmt->bind_param('sss', $balance, $firstname, $lastname);
    $stmt -> execute();
    $stmt->free_result();

    $h="Withdrew £$amount/";
    $stmt= $mysqli->prepare("UPDATE accounts SET history=CONCAT_WS(' ', ?, history ) WHERE firstname=? AND lastname=?");
    $stmt->bind_param('sss', $h, $firstname, $lastname);
    $stmt -> execute();
    $stmt->free_result();



    
        header("Location: customer.php");
        

      }