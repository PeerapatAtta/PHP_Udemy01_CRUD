<?php 
require_once "db/connect.php"; // เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล
if(!isset($_GET["id"])){
    header("Location:index.php");
}else{
    $id=$_GET["id"];
    $result=$controller->delete($id);
    if($result){
        header("Location:index.php");
    }
}

?>