<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel order</title>
</head>
<body style="display:flex;flex-direction:column;align-items:center; background-color:#eee;">

<header>
    <img src="eat.jpg" alt="picture ofburgers" style="height: 15vw;">
    </header>

    <div style="display:flex;flex-direction:column;align-items:center; background-color:#eee;position:relative">
<div style="display:flex;flex-direction:column;align-items:center">
<h1>Cancel order</h1>
<form action="cancel.php" method="post" style="display:flex;flex-direction:column;align-items:space-around;">
 <p>First name: <input type="text" name="firstname" /></p>
 <p>Last name: <input type="text" name="lastname" /></p>
 <p>Order number<input type="number" name="orderid" /></p>
 <p><input type="submit" /></p>
</form>
</div>

<?php
    $firstname = "";
    $lastname = "";
    $orderid = 0;
if($_SERVER['REQUEST_METHOD']=="POST"){
    $firstname = htmlentities($_POST['firstname'], ENT_QUOTES, "UTF-8" );
    $lastname = htmlentities($_POST['lastname'], ENT_QUOTES, "UTF-8" );
    $orderid = htmlentities($_POST['orderid'], ENT_QUOTES, "UTF-8" );

    $db = new mysqli("localhost", "root", "", "fastfoodapp");

    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
        Please try again later.</p>';
        exit;
    }

    $stmt = $db->prepare("DELETE FROM orders WHERE firstname = ? AND lastname = ? AND  orderid = ?");
    $stmt->bind_param('ssi', $firstname, $lastname, $orderid);
    $stmt->execute();
    if( $stmt->affected_rows > 0){
        echo  "Your order has been cancelled";
        }else{
            echo "Order not found.";
        }
    
    $stmt->free_result();
    $db->close();


}

?>
</div>
</body>
</html>
