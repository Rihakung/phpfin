<?php session_start();
include('condb.php');

$ID = $_SESSION['useid'];
$name = $_SESSION['user'];
$level = $_SESSION['usestatus'];
if ($level != 'admin') {
    Header("Location: ../logout.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <form action="logout.php">
        <h1>Admin Page</h1>
        <h3> สวัสดี คุณ <?php echo $name; ?> สถานะ <?php echo $level; ?> </h3>
        <input type="submit" value="ออกจากระบบ">
    </form>

    <br>

    <h1>ตารางสมาชิก</h1>
    <a href="admin.php?act=add" class="btf-info">เพิ่มสมาชิก</a>

    <?php
    $act = $_GET['act'];
    if ($act == 'add') {
        include('admin_form.add.php');
    } elseif ($act == 'edit') {
        include('admin_form.edit.php');
    } else {
        include('product_list.php');
    }
    ?>

    <br>
    <br>
    <?php
    //ตารางแสดงข้อมูลจากฐานข้อมูล
    //1. เชื่อมต่อ database:
    include('condb.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
    //2. query ข้อมูลจากตาราง tb_admin:
    $query = "SELECT * FROM useshop ORDER BY useid ASC" or die("Error:" . mysqli_error());
    //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
    $result = mysqli_query($con, $query);
    //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:
    echo ' <table class="table table-hover" border="2">';
    //หัวข้อตาราง 
    echo "
                      <tr>
                      <td>useid</td>
                      <td>user</td>
                      <td>usepass</td>
                      <td>usename</td>
                      <td>uselastname</td>
                      <td>usestatus</td>
                      <td>edit</td>
                      <td>delete</td>
                    </tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["useid"] .  "</td> ";
        echo "<td>" . $row["user"] .  "</td> ";
        echo "<td>" . $row["usepass"] .  "</td> ";
        echo "<td>" . $row["usename"] .  "</td> ";
        echo "<td>" . $row["uselastname"] .  "</td> ";
        echo "<td>" . $row["usestatus"] .  "</td> ";
        //แก้ไขข้อมูล
        echo "<td><a href='admin.php?act=edit&ID=$row[0]' class='btn btn-warning btn-xs'>แก้ไข</a></td> ";

        //ลบข้อมูล
        echo "<td><a href='admin_form_del_db.php?ID=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\" class='btn btn-danger btn-xs'>ลบ</a></td> ";
        echo "</tr>";
    }
    echo "</table>";
    //5. close connection
    mysqli_close($con);
    ?>




    <h1>ตารางสินค้า</h1>
    <a href="#" class="btf-info">เพิ่ม</a>
    <br>
    <br>
    </div>
    <?php
    //ตารางแสดงข้อมูลจากฐานข้อมูล
    //1. เชื่อมต่อ database:
    include('condb.php');  //ไฟล์เชื่อมต่อกับ database ที่เราได้สร้างไว้ก่อนหน้าน้ี
    //2. query ข้อมูลจากตาราง tb_admin:
    $query = "SELECT * FROM tbl_product ORDER BY p_id ASC" or die("Error:" . mysqli_error());
    //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
    $result = mysqli_query($con, $query);
    //4 . แสดงข้อมูลที่ query ออกมา โดยใช้ตารางในการจัดข้อมูล:
    echo ' <table class="table table-hover" border="2">';
    //หัวข้อตาราง 
    echo "
                      <tr>
                      <td>p_id</td>
                      <td>name</td>
                      <td>unit</td>
                      <td>price</td>
                      <td>img</td>
                      <td>edit</td>
                      <td>delete</td>
                    </tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row["p_id"] .  "</td> ";
        echo "<td>" . $row["p_name"] .  "</td> ";
        echo "<td>" . $row["p_price"] .  "</td> ";
        echo "<td>" . $row["p_img"] .  "</td> ";
        //แก้ไขข้อมูล
        echo "<td><a href='admin.php?act=edit&ID=$row[0]' class='btn btn-warning btn-xs'>แก้ไข</a></td> ";

        //ลบข้อมูล
        echo "<td><a href='admin_form_del_db.php?ID=$row[0]' onclick=\"return confirm('Do you want to delete this record? !!!')\" class='btn btn-danger btn-xs'>ลบ</a></td> ";
        echo "</tr>";
    }
    echo "</table>";
    //5. close connection
    mysqli_close($con);
    ?>
</body>

</html>