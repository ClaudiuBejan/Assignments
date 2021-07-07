<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel</title>
    <style>
    p{
        display: flex;
        justify-content: space-between;
    }
    </style>
</head>
<body>
<header>
    <img src="airplane.jpg" alt="airplane in the sky" style="width: 100%;">
    </header>
<div style="display:flex;flex-direction:column;align-items:center">
<h1>Cancel a ticket</h1>
<form action="cancel.php" method="post" style="display:flex;flex-direction:column;align-items:space-around;">
 <p>First name: <input type="text" name="firstname" /></p>
 <p>Last name: <input type="text" name="lastname" /></p>
 <p>Date of birth: <input type="date" name="dob" /></p>
 <p>Outbound: <input type="text" name="outbound" /></p>
 <p>Inbound: <input type="text" name="inbound" /></p>
 <p>Date: <input type="date" name="date" /></p>
 <p><input type="submit" /></p>
</form>
</div>

<?php
    $firstname = "";
    $lastname = "";
    $dob = "";
    $inbound = "";
    $outbound = "";
    $date = "";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $firstname = htmlentities($_POST['firstname'], ENT_QUOTES, "UTF-8" );
    $lastname = htmlentities($_POST['lastname'], ENT_QUOTES, "UTF-8" );
    $dob = htmlentities($_POST['dob'], ENT_QUOTES, "UTF-8" );
    $inbound = htmlentities($_POST['inbound'], ENT_QUOTES, "UTF-8" );
    $outbound = htmlentities($_POST['outbound'], ENT_QUOTES, "UTF-8" );
    $date = htmlentities($_POST['date'], ENT_QUOTES, "UTF-8" );

    $db = new mysqli("localhost", "root", "", "tickets");

    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
        Please try again later.</p>';
        exit;
    }

    $stmt = $db->prepare("DELETE FROM tickets WHERE (firstname = ? AND lastname = ? AND dob = ? AND outboundairport = ? AND inboundairport = ? AND flightdate = ?)");
    $stmt->bind_param('ssssss', $firstname, $lastname, $dob, $inbound, $outbound, $date);
    $stmt->execute();
    if( $stmt->affected_rows > 0){
    printf("%s, \n Your ticket from %s to %s has been cancelled.", $firstname, $inbound, $outbound);
    }else{
        echo "Ticket not found. ";
    }
    $stmt->free_result();
    $db->close();
}

?>

</body>
</html>