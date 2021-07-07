<?php

if($_SERVER['REQUEST_METHOD']=="POST"){

    setcookie('firstname', "k", time()-100, '/');
    setcookie('lastname', "k", time()-100, '/');

    header("Location: index.php");
}