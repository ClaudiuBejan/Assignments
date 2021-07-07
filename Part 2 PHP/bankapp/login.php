<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
    $loggedin = false;
    if($loggedin == false){
        echo "
        <h1>Login</h1>
    <form action='login.php' method='POST'>
        <p>First Name: <input type='text' name='firstname'></p>
        <p>Last Name: <input type='text' name='lastname'></p>
        <p>Password: <input type='password' name='pwd'></p>
        <p><input type='submit' /></p>
    </form>";
    }
    

    if($_SERVER['REQUEST_METHOD']=="POST"){
    $id="";
    $firstname = "";
    $lastname = "";
    $dob = "";
    $pdw="";
    $balance="";
    $history="";
    $firstname = htmlentities($_POST['firstname'], ENT_QUOTES, "UTF-8" );
    $lastname = htmlentities($_POST['lastname'], ENT_QUOTES, "UTF-8" );
    $pwd = htmlentities($_POST['pwd'], ENT_QUOTES, "UTF-8" );

    $mysqli = new mysqli("localhost", "root", "", "accounts");

    if (mysqli_connect_errno()) {
        echo '<p>Error: Could not connect to database.<br/>
        Please try again later.</p>';
        exit;
    }

    $stmt= $mysqli->prepare("SELECT * FROM accounts WHERE firstname=? AND lastname=? AND pwd = ?");
    $stmt->bind_param('sss', $firstname, $lastname, $pwd);
    $stmt -> execute();


    if ($stmt -> field_count) {
        $exp = time()+3600;
        $loggedin = true;
        $stmt->bind_result($id, $firstname, $lastname, $dob, $pwd, $balance, $history);
        setcookie("firstname", $firstname, time() + (86400 * 30), "/");
        setcookie("lastname", $lastname, time() + (86400 * 30), "/");
        header("Location: customer.php");
      }else {
          echo "not pos";
      }


      
}




?>
</body>
</html>