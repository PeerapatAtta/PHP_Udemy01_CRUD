<?php 
class Controller{
    private $db;

    function __construct($con){
        $this->db=$con;
    }

    function getDepartments(){
        try{
            $sql = "SELECT * FROM departments";
            $result=$this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function getEmployees(){
        try{
            $sql = "SELECT * FROM employees a INNER JOIN departments b ON a.department_id = b.department_id ORDER BY a.emp_id";
            $result=$this->db->query($sql);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    function insert($fname,$lname,$salary,$department_id){
        try{
            // สร้างคำสั่ง SQL สำหรับการเพิ่มข้อมูล
            $sql="INSERT INTO 
            employees(fname,lname,salary,department_id)
            VALUES (:fname,:lname,:salary,:department_id)
            ";
            // สร้าง object PDOStatement จากคำสั่ง SQL
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":fname",$fname);
            $stmt->bindParam(":lname",$lname);
            $stmt->bindParam(":salary",$salary);
            $stmt->bindParam(":department_id",$department_id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    // ฟังก์ชันสำหรับลบข้อมูลพนักงาน
    function delete($id){
        try{
            $sql="DELETE FROM employees WHERE emp_id=:id"; // สร้างคำสั่ง SQL สำหรับการลบข้อมูล
            $stmt=$this->db->prepare($sql); // สร้าง object PDOStatement จากคำสั่ง SQL
            $stmt->bindParam(":id",$id); // กำหนดค่าพารามิเตอร์ให้กับคำสั่ง SQL
            $stmt->execute(); // ประมวลผลคำสั่ง SQL
            return true;
        }catch(PDOException $e){ // กรณีเกิดข้อผิดพลาด
            echo $e->getMessage(); // แสดงข้อความข้อผิดพลาด
            return false; // คืนค่ากลับเป็น false
        }
    }

    // ฟังก์ชันสำหรับดึงข้อมูลพนักงานจากฐานข้อมูล
    function getEmployeeDetail($id){
        try{
            $sql="SELECT * FROM employees a 
            INNER JOIN departments b
            ON a.department_id = b.department_id
            WHERE emp_id = :id"; // สร้างคำสั่ง SQL สำหรับการดึงข้อมูลพนักงาน
            $stmt=$this->db->prepare($sql); // สร้าง object PDOStatement จากคำสั่ง SQL
            $stmt->bindParam(":id",$id); // กำหนดค่าพารามิเตอร์ให้กับคำสั่ง SQL
            $stmt->execute(); // ประมวลผลคำสั่ง SQL
            $result = $stmt->fetch(PDO::FETCH_ASSOC); // ดึงข้อมูลออกมาและเก็บไว้ในตัวแปร $result
            return $result; // คืนค่ากลับเป็น $result
        }catch(PDOException $e){ // กรณีเกิดข้อผิดพลาด
            echo $e->getMessage(); // แสดงข้อความข้อผิดพลาด
            return false; // คืนค่ากลับเป็น false
        }
    }

    // ฟังก์ชันสำหรับอัพเดตข้อมูลพนักงาน
    function update($fname,$lname,$salary,$department_id,$emp_id){
        try{
            $sql="UPDATE employees 
            SET fname=:fname ,lname=:lname ,
            salary=:salary,department_id = :department_id 
            WHERE emp_id = :emp_id";
            $stmt=$this->db->prepare($sql);
            $stmt->bindParam(":fname",$fname);
            $stmt->bindParam(":lname",$lname);
            $stmt->bindParam(":salary",$salary);
            $stmt->bindParam(":department_id",$department_id);
            $stmt->bindParam(":emp_id",$emp_id);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}


?>