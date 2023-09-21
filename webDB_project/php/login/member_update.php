<?php
header("Context-Type: text/html; charset=utf-8");
include("../connMySql.php");
$seldb = @mysqli_select_db($db_link, "myuser");
if (!$seldb) {
    die("選擇失敗");
}
session_start();
// session_unset();
// session_destroy();
@$user = $_SESSION['user'];
@$status = $_SESSION['status'];


if (isset($_POST['action']) && ($_POST['action'] == 'update')) {
    $sql_query = "UPDATE member_data SET u_pw=?,u_mail=?,u_status=? WHERE u_acc='$user'";
    $stmt = $db_link->prepare($sql_query);
    $stmt->bind_param("sss", $_POST['u_pw'], $_POST['u_mail'], $_POST['u_status']);
    if ($stmt->execute()) {
        $stmt->close();
        $db_link->close();
        $_SESSION['status'] = $_POST['u_status'];
        echo "<script>alert('修改成功，請重新登入');location.href='logout.php'</script>";
    } else {
        die('修改失敗');
    }
}

$sel_data = "SELECT u_pw,u_mail,u_status FROM member_data WHERE u_acc='$user'";
$data_result = $db_link->query($sel_data)->fetch_assoc();

$u_pw = $data_result['u_pw'];
$u_mail = $data_result['u_mail'];
$u_status = $data_result['u_status'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改資料系統</title>
    <style>
        body {
            margin: auto;
            width: 800px;
        }

        table,
        tr,
        td {
            margin: auto;
            border: 1px solid black;
        }

        th {
            margin: auto;
            background-color: pink;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <center>
        <h1>
            修改會員資料
        </h1>
        <h2>您的帳號為 : <?php echo $user; ?></h2>
    </center>
    <center><input type="button" value="回主畫面" onclick="location.href='../../sell.php'"></center>
    <form action="" method="POST">
        <table>
            <tr>
                <th>欄位</th>
                <th>資料</th>
            </tr>
            <tr>
                <td>變更密碼</td>
                <td><input type="text" name="u_pw" value="<?php echo $u_pw ?>" minlength="6" maxlength="12" require></td>
            </tr>
            <tr>
                <td>變更信箱</td>
                <td><input type="text" name="u_mail" value="<?php echo $u_mail ?>"></td>
            </tr>
            <tr>
                <td>變更身分</td>
                <td>
                    <input type="radio" name="u_status" value="SELL" <?php if ($u_status == 'SELL') {
                                                                            echo "checked";
                                                                        } ?>>賣家
                    <input type="radio" name="u_status" value="BUY" <?php if ($u_status == 'BUY') {
                                                                        echo "checked";
                                                                    } ?>>買家
                </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align:center">
                    <input type="hidden" name="action" value="update">
                    <input type="submit" name="btnS" value="更新資料">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>