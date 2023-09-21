<?php
header("Context-Type: text/html; charset=utf-8");
include("connMySql.php");
$seldb = @mysqli_select_db($db_link, "myuser");
if (!$seldb) {
    die("選擇失敗");
}
require_once("connMySql.php");
$pageRow_records = 4;
$num_pages = 1;
if (isset($_GET['page'])) {
    $num_pages = $_GET['page'];
}
$startRow_records = ($num_pages - 1) * $pageRow_records;
$query_RecBoard = "SELECT * FROM wish_data ORDER BY w_id DESC";
$query_limit_RecBoard = $query_RecBoard . "LIMIT {$startRow_records},{$pageRow_records}";
$RecBoard = $db_link->query($query_RecBoard);
$all_RecBoard = $db_link->query($query_RecBoard);
$total_records = $all_RecBoard->num_rows;
$total_pages =  ceil($total_records / $pageRow_records);
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
            <div id="div_login"><img src="img/member.png" id="login"></div><?php  } ?>
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

        <!--------    輸入   -------->
        <div class="title">想要的傢俱...</div>
        <form action="php/item/item_wish.php" method="POST">
            <div id="wish_list">
                <div class="wish_row">
                    <div class="wish_cell">家具名稱</div>
                    <div class="wish_cell"><input type="text" placeholder="輸入想要的傢俱..." id="enter_1" name="w_name"></div>
                </div>
                <div class="wish_row">
                    <div class="wish_cell">選擇種類</div>
                    <div class="wish_cell">
                        <select id="sell_category" name="w_category" required>
                            <option>桌椅</option>
                            <option>收納</option>
                            <option>電器</option>
                            <option>其他</option>
                        </select>
                    </div>
                </div>
                <div class="wish_row">
                    <div class="wish_cell">理想價格</div>
                    <div class="wish_cell"><input type="text" placeholder="輸入理想的價格..." id="enter_2" name="w_price"></div>
                </div>
                <div class="wish_row">
                    <div class="wish_cell">需求及特色</div>
                    <div class="wish_cell"><textarea placeholder="輸入商品需求、特色..." id="enter_3" name="w_describe"></textarea></div>
                </div>
                <div class="wish_row">
                    <div class="wish_cell"></div>
                    <div class="wish_cell">  
                       <div class="button_submit">
                        <input type="hidden" name="action" value="add">
                        <input type="submit" value="提交" id="submit">
                    </div>
                    </div>
                </div>
            </div>
        </form>
        <!--------    許願池   -------->
        <div class="title">許願池</div>
        
        <!-- 20210619 -->
        <div id="pond"><?php $i = 0 ?>
            <?php while ($row_RecBoard = $RecBoard->fetch_assoc()) { ?>
            <div id="pond_item">
                <!-- <div class="pond_img"><img src="img/storage.png"></div> -->
                <div>家具名稱:<?php echo $row_RecBoard['w_name'] ?></div>
                <div>種類:<?php echo $row_RecBoard['w_category'] ?></div>
                <div>理想價格:<?php echo $row_RecBoard['w_price'] ?></div>
                <div>需求及特色:<?php echo $row_RecBoard['w_describe'] ?></div>
            </div>           
            <?php } ?>
        </div>

    </div>
    <!-- -------------------------------------------------------------------------- -->
    <div class="footer">
        <P>© 2021 THE KING OF FURNITURE</P>
    </div>
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>

</html>