<?php 

$host="localhost";
$username="root";
$password="";
$db="employeesdb";
$dsn="mysql:host=$host;dbname=$db;cahrset=utf8"; // กำหนดค่า DSN สำหรับการเชื่อมต่อกับฐานข้อมูล

try{
    $pdo = new PDO($dsn,$username,$password); // สร้าง object PDO เพื่อเชื่อมต่อกับฐานข้อมูล
}catch(PDOException $e){
    echo $e->getMessage();
}

require_once "db/controller.php"; // เรียกใช้งานไฟล์ controller.php
require_once "db/user.php"; // เรียกใช้งานไฟล์ user.php

$controller = new Controller($pdo); // สร้าง object จาก class Controller
$user = new User($pdo); // สร้าง object จาก class User

$user->insertUser('admin','12345'); // เรียกใช้งานฟังก์ชัน insertUser จาก object $user

?>