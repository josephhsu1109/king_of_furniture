<?php
header("Context-Type: text/html; charset=utf-8");
include("../connMySql.php");
$seldb = @mysqli_select_db($db_link, "myuser");
if (!$seldb) {
    die("選擇失敗");
}


if(isset($_POST['action'])&&($_POST['action'] == 'update')){
    $sql_query="UPDATE item_data SET item_name=?,item_price=?,item_describe=?,item_exist=? WHERE item_id=?";
    $stmt=$db_link->prepare($sql_query);
    $stmt->bind_param("sisss",$_POST['item_name'],$_POST['item_price'],$_POST['item_describe'],$_POST['item_exist'],$_POST['item_id']);
    if($stmt->execute()){
        $stmt->close();
        $db_link->close();
        echo "<script>alert('修改成功');location.href='item_data.php'</script>";
    }
    else{
        die('修改失敗');
    }
}
$sel_data="SELECT item_id,item_name,item_price,item_describe,item_exist FROM item_data WHERE item_id=?" ;
$stmt=$db_link->prepare($sel_data);
$stmt->bind_param("i",$_GET['item_id']);
$stmt->execute();
$stmt->bind_result($item_id,$item_name,$item_price,$item_describe,$item_exist);
$stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改資料系統</title>
    <style>
        body{
            margin: auto;
            width: 800px;
        }
        table,tr,td{
            margin: auto;
            border: 1px solid black;
        }
        th{
            margin: auto;
            background-color: pink;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h1><center>修改資料</center></h1>
    <center><input type="button" value="回主畫面" onclick="location.href='../../sell.php'"></center>
    <form action="" method="POST">
        <table>
            <tr>
                <th>欄位</th>
                <th>資料</th>
            </tr>
            <tr>
                <td>商品名稱</td>
                <td><input type="text" name="item_name" value="<?php echo "$item_name"?>"></td>
            </tr>
            <tr>
                <td>商品價格</td>
                <td><input type="text" name="item_price" value="<?php echo "$item_price"?>"></td>
            </tr>
            <tr>
                <td>商品描述</td>
                <td><input type="text" name="item_describe" value="<?php echo "$item_describe"?>"></td>
            </tr>
            <tr>
                <td>商品是否還在</td>
                <td>
                <input type="radio"  name="item_exist" value="尚有存貨" <?php if($item_exist=='尚有存貨'){echo "checked";}?>>尚有存貨
                <input type="radio"  name="item_exist" value="已出售"<?php if($item_exist=='已出售'){echo "checked";}?>>已出售
                </td>
            </tr>
            
            <tr>
                <td colspan="2" style="text-align:center">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="item_id" value="<?php echo $item_id ; ?>">
                <input type="submit" name="btnS" value="更新資料">
                <input type="reset" name="btnR" value="重新填寫">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>