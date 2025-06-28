<?php
$conn = new mysqli("localhost", "root","", "car_rental");
if ($conn->connect_error){
    die("ошибкаподключения: ". 
    $conn->connect_error);
}
?>