<?php
session_start();
include "db.php";
echo "<h2>Каталог машин</h2>";
$result =$conn->query("SELECT * FROM cars" );
while($row = $result->fetch_assoc()){
echo "Марка: ". $row['brand'],
"<br>";
echo "Модель: ". $row['model'],
"<br>";
echo "Цена за день:".
$row['price']. "руб/<br>";
if (isset($_SESSION["user_id"])){
    echo "<a href='add_zakaz.php? car_id=". $row['id'] . ">Арендовать</a>";
} else{
    echo "<a href ='login.php'>Войти<a/>";
}
echo "<hr>";
} 
?>