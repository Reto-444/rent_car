<?php
session_start();
include "db.php";
$error ="";
if ($_SERVER["REQUEST_METHOD"]== "POST"){
    $username =$_POST["username"];
    $password =$_POST["password"];
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows == 1){
        $stmt->bind_result($user_id);
        $stmt->fetch();
            $_SESSION["user_id"] = $user_id;
            header("Location: mycab.php");
            exit();
        }
    }
    $error = "Неправильный логин или пароль:";
?>
<form method = "POST">
    <input type="text" name="username"
    placeholder="Логин" required><br>
        <input type="password" name="password" placeholder="пароль"
        required><br>
        <button type="submit">Войти</button>
</form>
