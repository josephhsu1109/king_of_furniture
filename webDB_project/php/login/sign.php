<?php
header("Context-Type: text/html; charset=utf-8");
include("../connMySql.php");
$seldb = @mysqli_select_db($db_link, "myuser");
if (!$seldb) {
    die("選擇失敗");
}

if (isset($_POST['action']) && ($_POST['action'] == 'add')) {
    if ($_POST['u_acc']==NULL||$_POST['u_pw']==NULL) {
        die("未輸入帳號或密碼，請回上一頁繼續輸入");
    }

    pwConfirm();

    $u_acc = $_POST['u_acc'];
    $sql_query = "SELECT * FROM member_data Where u_acc = '$u_acc'";
    $result = mysqli_query($db_link, $sql_query);
    $row = mysqli_fetch_assoc($result);
    $total = mysqli_num_rows($result);

    if ($total >= 1) {
        die("已經有人註冊過!");
    } else {

        $sql_query = "INSERT INTO member_data(u_acc,u_pw,u_sex,u_birthday,u_mail,u_phone,u_status)
    VALUES(?,?,?,?,?,?,?)";
        $stmt = $db_link->prepare($sql_query);
        $stmt->bind_param(
            "sssssss",
            $_POST['u_acc'],
            $_POST['u_pw'],
            $_POST['u_sex'],
            $_POST['u_birthday'],
            $_POST['u_mail'],
            $_POST['u_phone'],
            $_POST['u_status']
        );

        if ($stmt->execute()) {
            $stmt->close();
            $db_link->close();
            echo "<script>alert('SUCESS!');location.href='login.php';</script>";
        } else {
            die('FAIL!');
        }
    }
}

function pwConfirm()
{
    $u_pw = $_POST['u_pw'];
    $Confirm = $_POST['u_pwConfirm'];
    if ($u_pw !== $Confirm) {
        echo "<script>alert('確認密碼與輸入密碼不符');location.href='sign.php';</script>";
        die();
    }
}
?>



<center>
    <html>
        <head>
        <style>
            body{
                background-color: rgb(17, 58, 75);
            }
            .sign_form{
                border:1px solid gray;
                background-color:lightgray;
                width:500px;
                height:450px;
                margin:50px 0 0 0 ;
                border-radius:10px;
            }
        </style>
        </head>
        <body>
            
            <div class="sign_form">
            <h1>註冊會員</h1>
            <form method="post" action="">
                <table>
                    <tr>
                        <th>欄位</th>
                        <th>資料</th>
                    </tr>
                    <tr>
                        <td>帳號</td>
                        <td><input type="text" name="u_acc" minlength="6" maxlength="12" required></td>
                    </tr>
                    <tr>
                        <td>密碼</td>
                        <td><input type="password" name="u_pw" minlength="6" maxlength="12" required></td>
                    </tr>
                    <tr>
                        <td>再次輸入密碼</td>
                        <td><input type="password" name="u_pwConfirm" minlength="6" maxlength="12" required></td>
                    </tr>
                    <tr>
                        <td>性別</td>
                        <td>
                            <input type="radio" name="u_sex" value="M" checked>男
                            <input type="radio" name="u_sex" value="F">女
                        </td>
                    </tr>
                    <tr>
                        <td>生日</td>
                        <td><input type="date" name="u_birthday"></td>
                    </tr>
                    <tr>
                        <td>電子郵件</td>
                        <td><input type="email" name="u_mail"></td>
                    </tr>
                    <tr>
                        <td>電話</td>
                        <td><input type="tel" name="u_phone" require></td>
                    </tr>
                    <tr>
                        <td>成為會員後比較想成為</td>
                        <td>
                            <input type="radio" name="u_status" value="BUY" checked>買家
                            <input type="radio" name="u_status" value="SELL">賣家
                        </td>
                    </tr>
                    
                </table>
                <tr colspan="2" style="text-align:center">
                        <input type="hidden" name="action" value="add">
                        <input type="submit" name="btnSMT" value="新增資料">
                        <input type="reset" name="btnRST" value="重新填寫">
                        <input type="button" name="" value="回到主畫面" onclick="location.href='../../index.php'">
                    </tr>
            </form>
            </div>
        </body>    
    </html>
</center>