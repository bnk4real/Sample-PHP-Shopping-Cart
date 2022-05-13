<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Product Detail</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <table width="600" border="0" align="center" class="square">
        <tr>
            <td colspan="3" bgcolor="#CCCCCC"><b>สินค้า</b></td>
        </tr>

        <?php
//connect db
include("connect.php");
$p_id = $_GET['p_id']; //สร้างตัวแปร p_id เพื่อรับค่า

$sql = "SELECT * FROM product WHERE p_id=$p_id"; //รับค่าตัวแปร p_id ที่ส่งมา
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
//แสดงรายละเอียด
echo "<tr>";
echo "<td width='120' valign='top'><b>ชื่อสินค้า</b></td>";
echo "<td width='279'>" . $row["p_name"] . "</td>";
echo "<td width='70' rowspan='4'><img src='img/" . $row["p_pic"] . " ' width='100'></td>";
echo "</tr>";


echo "<tr>";
echo "<td valign='top'><b>รายละเอียดสินค้า</b></td>";
echo "<td>" . $row["p_detail"] . "</td>";
echo "</tr>";


echo "<tr>";
echo "<td valign='top'><b>ราคาสินค้า</b></td>";
echo "<td>" . number_format($row["p_price"], 2) . "</td>";
echo "</tr>";


echo "<tr>";
echo "<td colspan='2' align='center'>";
echo "<a href='cart.php?p_id=$row[p_id]&act=add'> เพิ่มลงตะกร้าสินค้า </a></td>";
echo "</tr>";
?>
    </table>

    <p>
        <center><a href="product.php" class="btn btn-warning"> กลับไปหน้ารายการสินค้า</a></center>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
        </script>

</body>

</html>