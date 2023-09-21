<?php
header("Context-Type: text/html; charset=utf-8");
include("connMySql.php");
$seldb = @mysqli_select_db($db_link, "myuser");
if (!$seldb) {
    die("選擇失敗");
}
require_once("connMySql.php");
if (isset($_GET['page'])) {
    $num_pages = $_GET['page'];
}
$query_RecBoard = "SELECT * FROM item_data ORDER BY item_id DESC";
$RecBoard = $db_link->query($query_RecBoard);
$all_RecBoard = $db_link->query($query_RecBoard);
$total_records = $all_RecBoard->num_rows;
$i = 0;
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
    <link href="css/style.css" rel="stylesheet" charset="utf-8">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            // 2021.06 17 user slidebox
            $("#login").click(function() {
                $('#slidebox').slideToggle();
            });

            $('.category img').hover(function() {
                $(this).css("height", "170px");
                $(this).css("width", "170px");
            }, function() {
                $(this).css("height", "150px");
                $(this).css("width", "150px");
            });
            $('.nav_page').hover(function() {
                $(this).css('font-size', '22px');
            }, function() {
                $(this).css('font-size', '20px');
            });
            // new goods
            $('.goods').click(function() {
                $("#win_goods").append('<div class="win_goods_add">' + $(this).html() + '</div>');
                $("#new_goods_win").fadeIn(500);
            });

            $('#new_goods_win_close').click(function() {
                $("#new_goods_win").hide();
                $("#win_goods").html("");
            });

        });
        $(document).ready(function() {
            $('#login').click(function() {
                $('#LoginWrap').show();
            })
            $('#back').click(function() {
                $('#LoginWrap').hide();
            })
        });
        $(document).ready(function() {});
    </script>


</head>

<body>
    <!----------------------------------------------------->
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
        <!--------    分類   -------->
        <div class="title">分類</div>
        <div class="category">
            <div class="category_row">
                <div class="category_item" id="table">
                    <a href="category.php"><img src="img/table.png" alt="table&chair" id="table_img"></a>
                </div>
                <div class="category_item" id="storage">
                    <a href="category.php"><img src="img/storage.png" alt="table&chair" id="storage_img"></a>
                </div>
                <div class="category_item" id="electrical">
                    <a href="category.php"><img src="img/electrical.png" alt="table&chair" id="electrical_img"></a>
                </div>
                <div class="category_item" id="other">
                    <a href="category.php"><img src="img/other.png" alt="table&chair" id="other_img"></a>
                </div>
            </div>
            <div class="category_row">
                <div class="category_item" id="tablechair"><a href="category.php">桌椅</a></div>
                <div class="category_item" id="storage"><a href="category.php">收納</a></div>
                <div class="category_item" id="electrical"><a href="category.php">電器</a></div>
                <div class="category_item" id="other"><a href="category.php">其他</a></div>
            </div>
        </div>
        <!--------    最新上架   -------->

        <div class="title">最新上架</div>
        <div class="new_goods"><?php $i = 0 ?>
            <?php while ($row_RecBoard = $RecBoard->fetch_assoc()) { ?>
                <div class="goods">
                    <div class="goods_img"><img src="php/item/upload/<?php echo $row_RecBoard['item_img']; ?>" alt="最新上架1"></div>
                    <div class="goods_name">
                        <div id="win_goods_name"><?php echo $row_RecBoard['item_name'] ?></div>
                    </div>
                    <div class="goods_detial">
                        <div class="win_goods_item goods_hide">商品描述:</div>
                        <div class="win_goods_text"><?php echo $row_RecBoard['item_describe'] ?></div>
                    </div>
                    <div class="goods_price goods_hide">
                        <div class="win_goods_item">商品價錢:</div>
                        <div class="win_goods_text"><?php echo $row_RecBoard['item_price'] ?></div>
                    </div>
                    <div class="goods_price goods_hide">
                        <div class="win_goods_item">商品類別:</div>
                        <div class="win_goods_text"><?php echo $row_RecBoard['item_category'] ?></div>
                    </div>
                    <div class="goods_price goods_hide">
                        <div class="win_goods_item">商品狀態:</div>
                        <div class="win_goods_text"><?php echo $row_RecBoard['item_status'] ?></div>
                    </div>
                    <div class="goods_price goods_hide">
                        <div class="win_goods_item">賣家地點:</div>
                        <div class="win_goods_text"><iframe width="300" height="300" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDnrrkqq6KjrnOZY0LFpASGlkoo1fFpb3o&q=<?php echo $row_RecBoard['item_location'] ?>" allowfullscreen>
                            </iframe></div>
                    </div>
                    <div class="goods_price goods_hide">
                        <div class="win_goods_item">存貨狀況:</div>
                        <div class="win_goods_text"><?php echo $row_RecBoard['item_exist'] ?></div>
                    </div>
                    <div class="goods_price goods_hide">
                        <div class="win_goods_item">賣家聯絡資訊為:</div>
                        <div class="win_goods_text"><?php echo $row_RecBoard['item_seller'] ?></div>
                    </div>
                </div>

            <?php } ?>
        </div>

        <div id="new_goods_win">
            <div id="new_goods_win_title">商品詳細內容</div>
            <div id="new_goods_win_close">x</div>
            <div id="win_goods">

            </div>
        </div>

    </div>
    <!-- -------------------------------------------------------------------------- -->
    <div class="footer">
        <P>© 2021 THE KING OF FURNITURE</P>
    </div>
</body>

</html>