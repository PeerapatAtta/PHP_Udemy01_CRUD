<?php
class User
{
    private $db; // เก็บค่าเชื่อมต่อฐานข้อมูล
    function __construct($con)
    { // ฟังก์ชันสร้าง object จาก class User
        $this->db = $con; // เชื่อมต่อกับฐานข้อมูล
    }

    // ฟังก์ชันสำหรับการเพิ่มข้อมูลผู้ใช้งาน
    function insertUser($username, $password)
    {
        try {
            $result = $this->getUserByUserName($username); // ทำการเรียกใช้งานฟังก์ชัน getUserByUserName   
            if ($result["num"] > 0) {
                return false;
            } else {
                $new_password = md5($password . $username); // ทำการเข้ารหัสรหัสผ่าน
                $sql = "INSERT INTO users(username,password) VALUES(:username,:password)"; // คำสั่ง SQL สำหรับการเพิ่มข้อมูล
                $stmt = $this->db->prepare($sql); // เตรียมคำสั่ง SQL
                $stmt->bindParam(":username", $username); // กำหนดค่าให้กับพารามิเตอร์ :username
                $stmt->bindParam(":password", $new_password); // กำหนดค่าให้กับพารามิเตอร์ :password
                $stmt->execute(); // ทำการเรียกใช้งานคำสั่ง SQL
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // ฟังก์ชันสำหรับการตรวจสอบข้อมูลผู้ใช้งาน
    function getUserByUserName($username)
    {
        try {
            $sql = "SELECT COUNT(*) as num FROM users WHERE username=:username"; // คำสั่ง SQL สำหรับการค้นหาข้อมูล
            $stmt = $this->db->prepare($sql); // เตรียมคำสั่ง SQL
            $stmt->bindParam(":username", $username); // กำหนดค่าให้กับพารามิเตอร์ :username
            $stmt->execute(); // ทำการเรียกใช้งานคำสั่ง SQL
            $result = $stmt->fetch(); // ดึงข้อมูลออกมา
            return $result; // ส่งค่ากลับ จำนวนข้อมูลที่พบ
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // ฟังก์ชันสำหรับการตรวจสอบข้อมูลผู้ใช้งาน
    function getUser($username,$password){
        try{
            $sql="SELECT * FROM users WHERE username=:username AND password=:password"; // คำสั่ง SQL สำหรับการค้นหาข้อมูล
            $stmt=$this->db->prepare($sql); // เตรียมคำสั่ง SQL
            $stmt->bindParam(":username",$username); // กำหนดค่าให้กับพารามิเตอร์ :username
            $stmt->bindParam(":password",$password); // กำหนดค่าให้กับพารามิเตอร์ :password
            $stmt->execute(); // ทำการเรียกใช้งานคำสั่ง SQL
            $result = $stmt->fetch(); // ดึงข้อมูลออกมา
            return $result; // ส่งค่ากลับ ข้อมูลที่พบ
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}
