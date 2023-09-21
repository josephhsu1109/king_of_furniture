<?php
header("Context-Type: text/html; charset=utf-8");
include("../connMySql.php");
$seldb = @mysqli_select_db($db_link, "myuser");
if (!$seldb) {
     die("選擇失敗");
}
session_start();
if (@$_SESSION['user'] == NULL) {
     if (!empty($_POST['u_acc']) && !empty($_POST['u_pw'])) {
          $u_acc = $_POST['u_acc'];
          $u_pw  = $_POST['u_pw'];
          $sql_query = "SELECT * FROM member_data Where u_acc = '$u_acc' && u_pw ='$u_pw' ";
          //搜尋賣家狀態
          $sql_status = "SELECT u_status FROM member_data Where u_acc = '$u_acc' && u_pw ='$u_pw'";
          $status_result = $db_link->query($sql_status)->fetch_assoc();
          //搜尋電話
          $sql_phone = "SELECT u_phone FROM member_data Where u_acc = '$u_acc' && u_pw ='$u_pw'";
          $phone_result = $db_link->query($sql_phone)->fetch_assoc();

          $result = mysqli_query($db_link, $sql_query);
          $row = mysqli_fetch_assoc($result);
          $total = mysqli_num_rows($result);
          if ($total == 1) {
               echo "登入成功!";
               $_SESSION['user'] = $_POST['u_acc'];
               $_SESSION['status'] = $status_result['u_status'];
               $_SESSION['phone'] = $phone_result['u_phone'];
               $db_link->close();
               header('location:../../index.php');
          } else {
               echo "<script>alert('帳密錯誤!')</script>";
          }
     }
} else {
     echo "<script>alert('你已經登入');location.href='../../index.php';</script>";
     
}
?>
<DOCTYPE html>
     <html>

     <head>
          <title>會員登入</title>
          <style>
               body {
                    background-color: rgb(17, 58, 75);
               }

               #LoginWrap {
                    border: 1px solid #000;
                    margin-left: auto;
                    margin-top: 15%;
                    margin-right: auto;
                    width: 500px;
                    height: 200px;
                    background-color: lightgray;
                    border-radius: 10px;
                    font-size: 30px;
               }

               .login_form {
                    margin: 50px 0 0 130px;
               }
          </style>
     </head>

     <body>

          <div id="LoginWrap">
               <form action="" method="post" class="login_form">
                    <table width="100%">
                         <tr>
                              <td>帳號</td>
                              <td><input name="u_acc" type="text" value="" required></td>
                         </tr>
                         <tr>
                              <td>密碼</td>
                              <td><input name="u_pw" type="text" value="" required></td>
                         </tr>
                         <tr>
                              <td colspan="2" style="text-align:center;">
                                   <input name="" type="submit" value="登入">
                                   <input name="" type="submit" value="註冊" onclick="location.href='sign.php'">
                                   <input type="button" name="" value="回到主畫面" onclick="location.href='../../index.php'">
                              </td>
                         </tr>
                    </table>
               </form>

          </div>
     </body>

     </html>