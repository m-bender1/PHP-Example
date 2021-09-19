<?php
// db connection file 
    $user = "appProjectUser";
    $pass = "Windows1";
    $host = "localhost";
    $db = "marketStore";
    
    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error . "<br>";
    }
?>