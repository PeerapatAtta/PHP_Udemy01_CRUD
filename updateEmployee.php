<?php 
require_once "db/connect.php"; // เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล
if(isset($_POST["submit"])){ // ตรวจสอบว่ามีการกดปุ่ม submit หรือไม่
    $emp_id = $_POST["emp_id"]; // รับค่าไอดีพนักงาน
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $salary=$_POST["salary"];
    $department_id=$_POST["department_id"];

    $result = $controller->update($fname,$lname,$salary,$department_id,$emp_id);
    if($result){
        header("Location:index.php");
    }
}

?>