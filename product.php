<?php

    include 'navbar.php';
    include 'carousel.php';
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <title>หน้าหลักการสั่งซื้อ</title>
</head>

<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body>
    <div class="container mt-5">
        <h4 class="text-center"> รายการสินค้า: </h4>
    </div>
    
    <table width="600" border="1" align="center" bordercolor="#666666">

        <tr>
            <td width="91" align="center" bgcolor="#CCCCCC"><strong>ภาพ</strong></td>
            <td width="200" align="center" bgcolor="#CCCCCC"><strong>ชื่อน้ำพริก</strong></td>
            <td width="44" align="center" bgcolor="#CCCCCC"><strong>ราคา</strong></td>
            <td width="100" align="center" bgcolor="#CCCCCC"><strong>รายละเอียดสินค้า</strong></td>
        </tr>

        <?php
            //connect database mysqli_query
            include("connect.php");
            $sql = "SELECT * FROM product ORDER BY p_id ASC"; //คิวรี่เรียกข้อมูลมาแสดงทั้งหมด
            $result = mysqli_query($conn, $sql);
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td align='center'><img src='img/" . $row["p_pic"] . " ' width='80'></td>";
                echo "<td align='left'>" . $row["p_name"] . "</td>";
                echo "<td align='center'>" . number_format($row["p_price"], 2) . "</td>";
                echo "<td align='center'><a href='product_detail.php?p_id=$row[p_id]'>คลิก</a></td>";
                echo "</tr>";
            }
        ?>

    </table>

</body>

</html>
<?php
    include 'footer.php';
?>