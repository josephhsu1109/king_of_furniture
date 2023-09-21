<?php
header("Context-Type: text/html; charset=utf-8");
include("../connMySql.php");
$seldb = @mysqli_select_db($db_link, "myuser");
if (!$seldb) {
    die("選擇失敗");
}
session_start();
@$user = $_SESSION['user'];
@$phone = $_SESSION['phone'];
$pageRow_records = 10;
$num_pages = 1;

if (isset($_GET['page'])) {
    $num_pages = $_GET['page'];
}
$startRow_records = ($num_pages - 1) * $pageRow_records;
$sql_query = "SELECT * FROM item_data WHERE item_seller= '$phone' ORDER BY item_id DESC";
$sql_query_limit = $sql_query . " LIMIT {$startRow_records},{$pageRow_records}";
$all_result = $db_link->query($sql_query);
$result = $db_link->query($sql_query_limit);
$total_records = $all_result->num_rows;
$total_pages = ceil($total_records / $pageRow_records);
?>


<head>
    <title>傢俱王</title>
    <link href="css/style.css" rel="stylesheet">
    <style>
        tr,
        th,
        td {
            border: 1px solid black;
            background-color: #e0ffff;
        }

        a {
            border-radius: 5px 5px 5px 5px;
            float: left;
            background-color: pink;
            text-decoration: none;
        }
    </style>

</head>

<body>
    <center>
        <h1>上架商品-管理系統</h1>
        <p>目前資料筆數:<?php echo $total_records; ?>    <input type='button' value='新增商品' onclick="location.href='../../sell.php'">
        <input type='button' value='回首頁' onclick="location.href='../../index.php'"></p>
        <table style="border:1px solid black;">
            <tr>
                <th>商品名稱</th>
                <th>商品價格</th>
                <th>商品分類</th>
                <th>商品新舊</th>
                <th>商品所在地</th>
                <th>商品描述</th>
                <th>商品是否還在</th>
                <th>功能</th>
            </tr>
            <?php
            while ($all_result = $result->fetch_assoc()) {
                echo
                "</td><td>" . $all_result['item_name'] .
                    "</td><td>" . $all_result['item_price'] .
                    "</td><td>" . $all_result['item_category'] .
                    "</td><td>" . $all_result['item_status'] .
                    "</td><td>" . $all_result['item_location'] .
                    "</td><td>" . $all_result['item_describe'] .
                    "</td><td>" . $all_result['item_exist'] .
                    "</td>";

                echo "<td><a href='item_update.php?item_id=" . $all_result['item_id'] . "'>修改</a>";
                echo "<a href='item_delete.php?item_id=" . $all_result['item_id'] . "'>
                刪除</a></td></tr>";
            }
            ?>

            <table border="0">
                <tr>
                    <?php if ($num_pages > 1) { ?>
                        <td><a href="item_data.php?page=1">第一頁</a></td>
                        <td><a href="item_data.php?page=<?php echo $num_pages - 1 ?>">上一頁</a></td>
                    <?php } ?>

                    <?php if ($num_pages < $total_pages) { ?>
                        <td><a href="item_data.php?page=<?php echo $num_pages + 1 ?>">下一頁</a></td>
                        <td><a href="ditem_data.php?page=<?php echo $total_pages ?>">最末頁</a></td>
                    <?php } ?>
                </tr>
            </table>
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $num_pages) {
                    echo "<div>" . "<a href='item_data.php'" . $i . "</a></div>";
                } else {
                    echo "<div>" . "<a href='item_data.php?page={$i}'>{$i}" . "</a></div>";
                }
            }
            ?>
        </table>
    </center>
    <?php $db_link->close();?>