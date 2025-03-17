<?php 
    require_once "layout/session.php"; // เรียกใช้งาน session.php
?>

<?php 
session_destroy(); // ทำการลบข้อมูล session ทั้งหมด
header("Location:loginForm.php"); // ทำการเปลี่ยนหน้าไปยัง loginForm.php
?>