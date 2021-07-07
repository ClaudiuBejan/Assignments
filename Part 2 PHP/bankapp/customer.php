<?php 

$id="";
    $firstname = $_COOKIE["firstname"];
    $lastname = $_COOKIE["lastname"];
    $dob = "";
    $pdw="";
    $balance="";
    $history="";

    $mysqli = new mysqli("localhost", "root", "", "accounts");

    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
        Please try again later.</p>';
        exit;
    }

    $stmt= $mysqli->prepare("SELECT accountid, balance FROM accounts WHERE firstname=? AND lastname=?");
    $stmt->bind_param('ss', $firstname, $lastname);
    $stmt -> execute();


    if ($stmt -> field_count) {
        $stmt->bind_result($id, $balance);
        $stmt->fetch();

        echo "Welcome $firstname <br>";
        echo "Your balance today is:£ $balance <br>";


        echo "
        <h2>Transfer</h2>
        <form action='transfer.php' method='POST'>
        <P>Firstname: <input type='text' name='tofirstname'></P>
        <P>Lastname: <input type='text' name='tolastname'></P>
        <p>Amount: <input type='number' name='amount'></p>
        <input type='hidden' name='balance' value='$balance'>
        <p><input type='submit' /></p>
  </form>
        ";

        echo "
        <h2>Deposit</h2>
        <form action='deposit.php' method='POST'>
        <p>Amount: <input type='number' name='amount'></p>
        <input type='hidden' name='balance' value='$balance'>
        <p><input type='submit' /></p>
        </form>
        ";

        echo "
        <h2>Withdraw</h2>
        <form action='withdraw.php' method='POST'>
        <p>Amount: <input type='number' name='amount'></p>
        <input type='hidden' name='balance' value='$balance'>
        <p><input type='submit' /></p>
        </form>
        ";

        echo "
        <form action='history.php' method='POST'>
        <p><button type='submit' >View account history</button></p>
        </form>
        ";

        echo "
        <form action='logout.php' method='POST'>
        <p><button type='submit' >Log out</button></p>
        </form>
        ";
        

      }

      ?>
