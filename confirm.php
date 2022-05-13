<?php
session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Checkout</title>
</head>

<body>
    <form id="frmcart" name="frmcart" method="POST" action="saveorder.php">
        <table width="600" border="1" align="center" class="square">
            <tr>
                <td width="1558" colspan="4" bgcolor="#FFDDBB">
                    <strong>สั่งซื้อสินค้า</strong>
                </td>
            </tr>
            <tr>
                <td bgcolor="#F9D5E3">สินค้า</td>
                <td align="center" bgcolor="#F9D5E3">ราคา</td>
                <td align="center" bgcolor="#F9D5E3">จำนวน</td>
                <td align="center" bgcolor="#F9D5E3">รวม/รายการ</td>
            </tr>
            <?php
$total = 0;
foreach ($_SESSION['cart'] as $p_id => $qty) {
$sql = "SELECT * FROM product WHERE p_id=$p_id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);
$sum = $row['p_price'] * $qty;
$total += $sum;
echo "<tr>";
echo "<td>" . $row["p_name"] . "</td>";
echo "<td align='right'>" . number_format($row['p_price'], 2) . "</td>";
echo "<td align='right'>$qty</td>";
echo "<td align='right'>" . number_format($sum, 2) . "</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td align='right' colspan='3' bgcolor='#F9D5E3'><b>รวม</b></td>";
echo "<td align='right' bgcolor='#F9D5E3'>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
echo "</tr>";
?>
        </table>
        <p>
        <table border="1" cellspacing="0" align="center">
            <tr>
                <td colspan="2" bgcolor="#CCCCCC">รายละเอียดการจัดส่ง</td>
            </tr>
            <tr>
                <td bgcolor="#EEEEEE">ชื่อ</td>
                <td><input name="name" type="text" id="name" required /></td>
            </tr>
            <tr>
                <td width="22%" bgcolor="#EEEEEE">ที่อยู่</td>
                <td width="78%">
                    <textarea name="address" cols="35" rows="5" id="address" required></textarea>
                </td>
            </tr>
            <tr>
                <td bgcolor="#EEEEEE">อีเมล</td>
                <td><input name="email" type="email" id="email" required /></td>
            </tr>
            <tr>
                <td bgcolor="#EEEEEE">เบอร์ติดต่อ</td>
                <td><input name="phone" type="text" id="phone" required /></td>
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC">
                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                    <input type="submit" class="btn vtn-warning" name="Submit2" value="สั่งซื้อ" />
                    <a href="product.php" class="btn btn-primary"> กลับหน้ารายการสินค้า</a>
                </td>
            </tr>
        </table>
    </form>
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