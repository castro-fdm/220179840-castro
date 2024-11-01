<?php
    $servername = "localhost";
    $username = "root";
    $password = "Hotwheels06";
    $dbnme = "phonebook";



    //Create a connection

    $conn = new mysqli($servername, $username, $password, $dbnme);

    if ($conn->connect_error){
        die ("Connection failed". $conn->connect_error);
    }

?>