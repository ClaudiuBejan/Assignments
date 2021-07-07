<?php

$id="";
    $tofirstname = htmlentities($_POST['tofirstname'], ENT_QUOTES, "UTF-8" );
    $tolastname = htmlentities($_POST['tolastname'], ENT_QUOTES, "UTF-8" );
    $firstname = $_COOKIE["firstname"];
    $lastname = $_COOKIE["lastname"];
    $dob = "";
    $pdw="";
    $balance=htmlentities($_POST['balance'], ENT_QUOTES, "UTF-8" );
    $amount=htmlentities($_POST['amount'], ENT_QUOTES, "UTF-8" );
    $history="";
    $tobalance= 0;

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
    $h="Transered to $tofirstname £$amount/";
    $stmt= $mysqli->prepare("UPDATE accounts SET history=CONCAT_WS(' ', ?, history ) WHERE firstname=? AND lastname=?");
    $stmt->bind_param('sss', $h, $firstname, $lastname);
    $stmt -> execute();
    $stmt->free_result();

    $stmt= $mysqli->prepare("SELECT balance FROM accounts WHERE firstname=? AND lastname=?");
    $stmt->bind_param('ss', $tofirstname, $tolastname);
    $stmt -> execute();
    $stmt->bind_result($tobalance);
        $stmt->fetch();
        echo $tobalance;
        echo "The amount $amount";
        $stmt->free_result();


    $tobalance += (int)$amount; 
    echo "The balance to $tobalance";
    $stmt= $mysqli->prepare("UPDATE accounts SET balance=? WHERE firstname=? AND lastname=?");
    $stmt->bind_param('iss', $tobalance, $tofirstname, $tolastname);
    $stmt -> execute();
    $stmt->free_result();
    $h="Received £$amount from $firstname/";
    $stmt= $mysqli->prepare("UPDATE accounts SET history=CONCAT_WS(' ', ?, history ) WHERE firstname=? AND lastname=?");
    $stmt->bind_param('sss', $h, $tofirstname, $tolastname);
    $stmt -> execute();
    $stmt->free_result();


    if ($stmt -> field_count) {
        header("Location: customer.php");
        

      }