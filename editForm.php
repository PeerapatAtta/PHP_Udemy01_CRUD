<?php 
$title="แบบฟอร์มแก้ไขข้อมูลพนักงาน";
require_once "layout/header.php";
require_once "db/connect.php";
require_once "layout/check_admin.php";
if(!isset($_GET["id"])){
    header("Location:index.php");
}else{
    $id=$_GET["id"];
    $emp=$controller->getEmployeeDetail($id); // ดึงข้อมูลพนักงานจากฐานข้อมูล
}
$result=$controller->getDepartments();
?>
    <h1 class="text-center"><?php echo "แบบฟอร์มแก้ไขข้อมูล";?></h1>
    <form method="POST" action="updateEmployee.php"> <!-- // ส่งข้อมูลไปยังหน้า updateEmployee.php -->
        <input type="hidden" name="emp_id" value="<?php echo $emp["emp_id"]?>"/> <!-- // ส่งค่าไอดีพนักงานไปยังหน้า updateEmployee.php -->
        <div class="form-group">
            <label for="fname">ชื่อ</label>
            <input type="text" name="fname" class="form-control" value="<?php echo $emp["fname"]?>"> <!-- // แสดงข้อมูลชื่อพนักงาน -->
        </div>
        <div class="form-group">
            <label for="lname">นามสกุล</label>
            <input type="text" name="lname" class="form-control" value="<?php echo $emp["lname"]?>"> <!-- // แสดงข้อมูลนามสกุลพนักงาน -->
        </div>
        <div class="form-group">
            <label for="salary">เงินเดือน</label>
            <input type="text" name="salary" class="form-control" value="<?php echo $emp["salary"]?>"> <!-- // แสดงข้อมูลเงินเดือนพนักงาน -->
        </div>
        <div class="form-group">
            <label for="department">แผนก</label>
            <select name="department_id" class="form-control">
                <?php while($row=$result->fetch(PDO::FETCH_ASSOC)){?> <!--// วนลูปแสดงข้อมูลแผนก-->
                    <option 
                    <?php if($row["department_id"] == $emp["department_id"]) echo "selected"?> 
                    value="<?php echo $row["department_id"];?>"><?php echo $row["department_name"];?></option> <!--// แสดงข้อมูลแผนก-->
                <?php } ?>
            </select>
        </div>
        <input type="submit" name="submit" value="อัพเดต" class="btn btn-primary my-3">
    </form>
</div>
</body>
</html>