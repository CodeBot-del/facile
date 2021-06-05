<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "facile";

    $conn = mysqli_connect($servername,$username,$password, $dbname);

    if(!$conn){
        echo "connection Failed";
    }
    
?>