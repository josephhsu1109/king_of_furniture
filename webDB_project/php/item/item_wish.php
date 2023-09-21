<?php
header("Context-Type: text/html; charset=utf-8");
include("../connMySql.php");
$seldb = @mysqli_select_db($db_link, "myuser");
if (!$seldb) {
    die("選擇失敗");
}
?>


<?php


if (isset($_POST['action']) && ($_POST['action'] == 'add')) {

    $sql_query = "INSERT INTO wish_data(w_name,w_category,w_price,w_describe)
    VALUES(?,?,?,?)";
    $stmt = $db_link->prepare($sql_query);
    $stmt->bind_param(
        "ssis",
        $_POST['w_name'],
        $_POST['w_category'],
        $_POST['w_price'],
        $_POST['w_describe']
    );

    if ($stmt->execute()) {
        $stmt->close();
        $db_link->close();
        echo "<script>alert('送出成功!');location.href='../../index.php';</script>";
    } else {
        die('FAIL!');
    }
}
?>
