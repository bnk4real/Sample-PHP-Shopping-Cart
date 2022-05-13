<?php
session_start();
include("connect.php");
?>
<meta charset=utf-8>

<body>
    <!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
    <?php
$name = $_POST["name"];
$address = $_POST["address"];
$email = $_POST["email"];
$phone = $_POST["phone"];
//$total_qty = $_POST["total_qty"];
$total = $_POST["total"];
$dttm = Date("Y-m-d G:i:s");
//บันทึกการสั่งซื้อลงใน order_detail
mysqli_query($conn, "BEGIN");
$sql1 = "INSERT INTO order_head 
values(null,
 '$dttm', 
 '$name', 
 '$address', 
 '$email', 
 '$phone', 
 '$total')";
$query1 = mysqli_query($conn, $sql1);

//ฟังก์ชั่น MAX() จะคืนค่าที่มากที่สุดในคอลัมน์ที่ระบุ ออกมา หรือจะพูดง่ายๆก็ว่า ใช้สำหรับหาค่าที่มากที่สุด นั่นเอง.
$sql2 = "SELECT MAX(o_id) AS o_id
FROM order_head
WHERE o_name='$name'
AND o_email='$email'
AND o_dttm='$dttm' ";
$query2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_array($query2);
$o_id = $row["o_id"];
//PHP foreach() เป็นคำสั่งเพื่อนำข้อมูลออกมาจากตัวแปลที่เป็นประเภท array โดยสามารถเรียกค่าได้ทั้ง $key และ $value ของ array
foreach ($_SESSION['cart'] as $p_id => $qty) 
{
    $sql3 = "SELECT * FROM product WHERE p_id=$p_id";
    $query3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($query3);
    $pricetotal = $row3['p_price'] * $qty;
    $sql4 = "INSERT INTO order_detail 
    values
    (null, 
    $o_id, 
    $p_id, 
    $qty, 
    $pricetotal)";
    $query4 = mysqli_query($conn, $sql4);
}

if ($query1 && $query4) {
mysqli_query($conn, "COMMIT");
$msg = "บันทึกข้อมูลการซื้อเรียบร้อยแล้ว ";
foreach ($_SESSION['cart'] as $p_id) {
//unset($_SESSION['cart'][$p_id]);
unset($_SESSION['cart']);
}
} else {
mysqli_query($conn, "ROLLBACK");
$msg = "บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ครับ ";
} 
?>
    <script type="text/javascript">
    alert("<?php echo $msg; ?>");
    window.location = 'product.php';
    </script>