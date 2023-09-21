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
    echo"1234";
   
    $sql_query = "INSERT INTO message(add_name,add_mail,add_input)
    VALUES(?,?,?)";
    $stmt = $db_link->prepare($sql_query);
    $stmt->bind_param(
        "sss",
        $_POST['add_name'],
        $_POST['add_mail'],
        $_POST['add_input']
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
