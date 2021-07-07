<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order</title>
    <style>
    p{
        display: flex;
        justify-content: space-between;
    }
    .receipt{
        margin-top:3rem;display:flex;flex-direction:column;
        align-items:space-around; width: 50vw; height:50vw;padding: 1rem 3rem 1rem 1rem;
        position: absolute; margin: auto; z-index: 99;
        background-color: #eee;
    }
    </style>
</head>
<body style="display:flex;flex-direction:column;align-items:center; background-color:#eee;">

<header>
    <img src="eat.jpg" alt="picture ofburgers" style="height: 15vw;">
    </header>

    <div style="display:flex;flex-direction:column;align-items:center; background-color:#eee;position:relative">
<div style="display:flex;flex-direction:column;align-items:center">
<h1>New Order</h1>
<form action="order.php" method="post" style="display:flex;flex-direction:column;align-items:space-around;">
 <p>First name: <input type="text" name="firstname" /></p>
 <p>Last name: <input type="text" name="lastname" /></p>
 <p><img src="chips.jpg" alt="chips" width="60px"><input type="number" name="chips" /></p>
 <p><img src="fish.jpg" alt="fish" width="60px"> <input type="number" name="fish" /></p>
 <p><img src="burger.jpg" alt="burger" width="60px"> <input type="number" name="burger" /></p>
 <p><img src="cocacola.jpg" alt="coca-cola" width="60px"> <input type="number" name="cocacola" /></p>
 <p><img src="pepsi.jpg" alt="pepsi" width="60px"> <input type="number" name="pepsi" /></p>
 <p><input type="submit" /></p>
</form>
</div>

<?php
    $firstname = "";
    $lastname = "";
    $chips = 0;
    $fish = 0;
    $burger = 0;
    $cocacola = 0;
    $pepsi = 0;
    $zero = 0;
if($_SERVER['REQUEST_METHOD']=="POST"){
    $firstname = htmlentities($_POST['firstname'], ENT_QUOTES, "UTF-8" );
    $lastname = htmlentities($_POST['lastname'], ENT_QUOTES, "UTF-8" );
    $chips = htmlentities($_POST['chips'], ENT_QUOTES, "UTF-8" );
    $fish = htmlentities($_POST['fish'], ENT_QUOTES, "UTF-8" );
    $burger = htmlentities($_POST['burger'], ENT_QUOTES, "UTF-8" );
    $cocacola = htmlentities($_POST['cocacola'], ENT_QUOTES, "UTF-8" );
    $pepsi = htmlentities($_POST['pepsi'], ENT_QUOTES, "UTF-8" );

    $chips = (int)$chips > $zero ? (int)$chips : $zero;
    $fish = (int)$fish > $zero ? $fish : $zero;
    $burger = (int)$burger > $zero ? (int)$burger : $zero;
    $cocacola = (int)$cocacola > $zero ? (int)$cocacola : $zero;
    $pepsi = (int)$pepsi > $zero ? (int)$pepsi : $zero;

    $db = new mysqli("localhost", "root", "", "fastfoodapp");

    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
        Please try again later.</p>';
        exit;
    }

    $stmt = $db->prepare("INSERT INTO orders (firstname, lastname, chips, fish, burger, cocacola, pepsi)
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssisiii', $firstname, $lastname, $chips, $fish, $burger, $cocacola, $pepsi);
    $stmt->execute();
    if( $stmt->affected_rows > 0){
        $db->real_query("SELECT orderid FROM orders WHERE orderid = ( SELECT MAX(orderid) FROM orders )");
        $result = $db -> store_result();
        $row = $result -> fetch_row();
        $total = "Total: £".(int)$chips * 2.99 + (int)$fish * 4.59 + (int)$burger * 4.69 + (int)$cocacola * 2.59 + (int)$pepsi * 2.19;
        $chips = (int)$chips > $zero ? "Chips * ".(int)$chips.": £".(int)$chips * 2.99: "";
        $fish = (int)$fish > $zero ? "Fish * ".(int)$fish.": £".(int)$fish * 4.59: "";
        $burger = (int)$burger > $zero ?  "Burger * ".(int)$burger.": £".(int)$burger * 4.69: "";
        $cocacola = (int)$cocacola > $zero ? "Coca-Cola * ".(int)$cocacola.": £".(int)$cocacola * 2.59: "";
        $pepsi = (int)$pepsi > $zero ? "Pepsi * ".(int)$pepsi.": £".(int)$pepsi * 2.19: "";



    echo "

        <div class='receipt'> 
        <h2>Receipt</h2>
        <p> Order number: $row[0] </p>
         <div>$chips</div>
         <div>$fish</div>
         <div>$burger</div>
         <div>$cocacola</div>
         <div>$pepsi</div>
         <hr>
         <div>$total</div>

        </div>

        
    ";
    }
    $stmt->free_result();
    $db->close();


}
?>
</div>
</body>
</html>
