<?php
session_start();
// session_unset();
// session_destroy();
@$user = $_SESSION['user'];
@$status = $_SESSION['status'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>傢俱王</title>
    <link href="css/site.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#login").click(function() {
                $('#slidebox').slideToggle();
            });
            $('#login').click(function() {
                $('#LoginWrap').show();
            })
            $('#back').click(function() {
                $('#LoginWrap').hide();
            })
        });
    </script>
    
</head>

<body>
    <div class="header">
        <?php if ($user == NULL) { ?>
            <div id="div_login"><input type="button" value="登入" onclick="location.href='php/login/login.php'" id="login"></div>
        <?php } else { ?>
            <div id="div_login"><img src="img/member.png" id="login"></div> <?php  } ?>
            <div id="slidebox">
            <center style="display: inline-flex;flex-wrap: wrap;justify-content: space-around;">
                <p id="u_acc">您好! <?php echo $user ?> </p>
                <p id="u_name">您的身分為 : <?php echo $status ?>ER</p>
                <a href="php/item/item_data.php" style="text-decoration:none;color:gray">管理上架商品</a>
                <a href="php/login/member_update.php" style="text-decoration:none;color:gray">修改會員資料</a>
                <a href="php/login/logout.php" style="text-decoration:none;color:gray">登出</a>
            </center>
            </div>

       
        <div>
            <a href="index.php"><img src="img/傢俱王LOGO.png" alt="LOGO" id="logo"></a>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------- -->
    <div class="container">
        <!--------    置頂menu   -------->
        <div class="row">
            <div class="nav_all">
                <div class="nav_page"><a href="index.php">首頁</a></div>
                <div class="nav_page" style="<?php if ($user == NULL) echo "display: none;";
                                                else {
                                                } ?>"><a href="sell.php">出售傢俱</a></div>
                <div class="nav_page" style="<?php if ($user == NULL) echo "display: none;";
                                                else {
                                                } ?>"><a href="wish.php">許願池</a></div>
                <div class="nav_page" style="<?php if ($user == NULL) echo "display: none;";
                                                else {
                                                } ?>"><a href="message.php">留言</a></div>
            </div>
        </div>
        <!--------    留言區   -------->
        <form action="php/message/message_add.php" method="POST">
            <div id="message_list">
                <div class="description">
                    <p>歡迎蒞臨傢俱王！<br>如您對我們提供的服務內容，<br>有任何的疑問或建議，<br>請留下您的寶貴意見。</p>
                </div>
                <div class="message_row">
                    <div class="message_cell">姓名</div>
                    <div class="message_cell"><input type="text" id="message_name" name="add_name"></div>
                    <div class="message_cell">E-mail</div>
                    <div class="message_cell"><input type="text" id="message_mail" name="add_mail"></div>
                    <div class="message_cell">留言</div>
                    <div class="message_cell">
                        <textarea placeholder="輸入想對我們說的話..." id="message_userinput" name="add_input"></textarea>
                    </div>
                </div>

                <!--------    留言區按鈕   -------->
                <div class="button">

                    <div class="button_submit">
                        <input type="hidden" name="action" value="add">
                        <input type="submit" value="確認送出" id="submit">
                    </div>
                    <div class="button_clear"><input type="reset" value="清除資料" id="clear"></div>
                </div>
            </div>






    </div>
    </form>
    <!-- -------------------------------------------------------------------------- -->
    <div class="footer">
        <P>© 2021 THE KING OF FURNITURE</P>
    </div>
</body>

</html>