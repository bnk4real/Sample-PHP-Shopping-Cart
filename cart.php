<?php
session_start();

include 'connect.php';

@$p_id = mysqli_real_escape_string($conn, $_GET['p_id']);
$act = mysqli_real_escape_string($conn, $_GET['act']);

//add to cart
if ($act == 'add' && !empty($p_id)) {
if (isset($_SESSION['cart'][$p_id])) {
$_SESSION['cart'][$p_id]++;
} else {
$_SESSION['cart'][$p_id] = 1;
}
}

//remove cart
if ($act == 'remove' && !empty($p_id)) //ยกเลิกการสั่งซื้อ
{
unset($_SESSION['cart'][$p_id]);
}

//update cart
if ($act == 'update') {
$amount_array = $_POST['amount'];
foreach ($amount_array as $p_id => $amount) {
$_SESSION['cart'][$p_id] = $amount;
}
}

//cancel cart
if ($act == 'cancel')
{
unset($_SESSION['cart'] );
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Shopping Cart</title>
</head>

<body>
    <form id="frmcart" name="frmcart" method="post" action="?act=update&p_id=0">
        <table width="600" border="0" align="center" class="square">
            <tr>
                <td colspan="5" bgcolor="#CCCCCC">
                    <b>ตะกร้าสินค้า</span>
                </td>
            </tr>
            <tr>
                <td bgcolor="#EAEAEA">สินค้า</td>
                <td align="center" bgcolor="#EAEAEA">ราคา</td>
                <td align="center" bgcolor="#EAEAEA">จำนวน</td>
                <td align="center" bgcolor="#EAEAEA">รวม(บาท)</td>
                <td align="center" bgcolor="#EAEAEA">ลบ</td>
            </tr>
            <?php
$total = 0;

if (!empty($_SESSION['cart'])) {
    include("connect.php");
    foreach ($_SESSION['cart'] as $p_id => $qty) {
        $sql = "SELECT * FROM product WHERE p_id=$p_id";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $sum = $row['p_price'] * $qty;
        $total += $sum;
        echo "<tr>";
        echo "<td width='334'>" . $row["p_name"] . "</td>";
        echo "<td width='46' align='right'>" . number_format($row["p_price"], 2) . "</td>";
        echo "<td width='57' align='right'>";
        echo "<input type='text' name='amount[$p_id]' value='$qty' size='2'/></td>";
        echo "<td width='93' align='right'>" . number_format($sum, 2) . "</td>";
        //remove product
        echo "<td width='46' align='center'><a href='cart.php?p_id=$p_id&act=remove'>ลบ</a></td>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<td colspan='3' bgcolor='#CEE7FF' align='center'><b>ราคารวม</b></td>";
    echo "<td align='right' bgcolor='#CEE7FF'>" . "<b>" . number_format($total, 2) . "</b>" . "</td>";
    echo "<td align='left' bgcolor='#CEE7FF'></td>";
    echo "</tr>";
}
?>
            <tr>
                <td><a href="product.php" class="btn btn-primary"> กลับหน้ารายการสินค้า</a></td>
                <td colspan="4" align="right">
                    <input type="button" class="btn btn-danger" name="btncancel" value="ยกเลิกการสั่งซื้อ"onclick="window.location='cart.php?act=cancel';" />
                    <input type="submit" class="btn btn-warning" name="button" id="button" value="ปรับปรุง" />
                    <input type="button" class="btn btn-success" name="Submit2" value="สั่งซื้อ" onclick="window.location='confirm.php';" />
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>


</html>