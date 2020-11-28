<?php

    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {                
        
        if($conn-> select_db('temvagaai') == false){
            echo "Não foi possivel conectar ao banco de dados";
        }
        
    }

?>
