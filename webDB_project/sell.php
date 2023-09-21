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
            <div id="div_login"><img src="img/member.png" id="login"></div>  <?php  } ?>
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
        <!--------    出售家具   -------->
        <div class="title">我要出售！</div>
        <div class="sell">
            <form action="php/item/item_add.php" method="POST" enctype="multipart/form-data">

                <div class="sell_photo">
                    <img id="blah" src="#" alt="未選擇圖片" height="300px" width="400px">
                    <input type="file" name="myfile" value="置入商品圖" id="sell_img" accept="imagesell_img">
                </div>

                <div class="sell_furniture">
                    <div class="sell_item">
                        <div class="sell_title">商品名稱</div>
                        <div class="sell_input"><input type="text" id="sell_name" name="item_name" required></div>
                    </div>

                    <div class="sell_item">
                        <div class="sell_title">商品價格</div>
                        <div class="sell_input"><input type="number" id="sell_price" name="item_price" required></div>
                    </div>

                    <div class="sell_item">
                        <div class="sell_title">商品類別</div>
                        <div class="sell_input">
                            <select id="sell_category" name="item_category" required>
                                <option>桌椅</option>
                                <option>收納</option>
                                <option>電器</option>
                                <option>其他</option>
                            </select>
                        </div>
                    </div>

                    <div class="sell_item">
                        <div class="sell_title">商品狀況</div>
                        <div class="sell_input">
                            <select id="sell_condition" name="item_status">
                                <option>二手-近全新</option>
                                <option>二手-良好</option>
                                <option>二手-普通</option>
                            </select>
                        </div>
                    </div>

                    <div class="sell_item">
                        <div class="sell_title">商品地點</div>
                        <div class="sell_input">
                            <input type="text" id="sell_map" name="item_location">
                        </div>
                    </div>

                    <div class="sell_item">
                        <div class="sell_title">商品說明</div>
                        <div class="sell_input">
                            <input type="text" id="sell_detial" name="item_describe">
                        </div>
                    </div>

                    <div class="sell_item">
                        <div class="sell_title">存貨狀況</div>
                        <div class="sell_input">
                            <select id="sell_stock" name="item_exist">
                                <option>尚有存貨</option>
                                <option>已出售</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="sell_btn">
                    <input type="hidden" name="action" value="add">
                    <input type="submit" value="上架" id="submit">
                </div>

        </div>
        </form>
    </div>


    <script>
        sell_img.onchange = evt => {
            const [file] = sell_img.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>

    <!-- -------------------------------------------------------------------------- -->
    <div class="footer">
        <P>© 2021 THE KING OF FURNITURE</P>
    </div>
</body>

</html>