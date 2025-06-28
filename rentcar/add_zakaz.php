<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $car_id = $_POST["car_id"];
    $days = $_POST["days"];

    $stmt = $conn->prepare("INSERT INTO orders (user_id, car_id, days) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $user_id, $car_id, $days);
    $stmt->execute();

    echo "<p>Заказ оформлен успешно!</p>";
    echo "<a href='mycab.php'>Вернуться в кабинет</a>";
    exit();
}

$car_id = $_GET["car_id"];
$stmt = $conn->prepare("SELECT * FROM cars WHERE id=?");
$stmt->bind_param("i", $car_id);
$stmt->execute();
$result = $stmt->get_result();
$car = $result->fetch_assoc();
?>

<h2>Заказ: <?= $car["brand"] . " " . $car["model"] ?></h2>
<form method="post">
    <input type="hidden" name="car_id" value="<?= $car_id ?>">
    Количество дней: <input type="number" name="days" min="1" required><br>
    <button type="submit">Оформить заказ</button>
</form>