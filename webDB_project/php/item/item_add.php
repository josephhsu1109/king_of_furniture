<?php
header("Context-Type: text/html; charset=utf-8");
include("../connMySql.php");
$seldb = @mysqli_select_db($db_link, "myuser");
if (!$seldb) {
    die("選擇失敗");
}
session_start();
@$user = $_SESSION['user'];
$sql_phone = "SELECT u_phone FROM member_data Where u_acc = '$user'";
$phone_result = $db_link->query($sql_phone)->fetch_assoc();
$phone = $phone_result['u_phone'];
?> 

<?php

function dd($variable)
{
    printf("<pre>%s</pre>", var_export($variable, true));
    die();
}
// file指向
$file = $_FILES['myfile'];


### 檢查後端是否接收到檔案
if (!isset($file)) {
    // $_SESSION['error'] = " 錯誤：請選擇檔案";
    echo "<script>alert('請選擇檔案');location.href='../../sell.php';</script>";
    die();
}


### 檢查是否有錯誤訊息
if ($file['error'] != UPLOAD_ERR_OK) {
    // $_SESSION['error'] = sprintf("檔案上傳錯誤：error(%s)", $file['error']);
    echo "<script>alert('檔案上傳錯誤');location.href='../../sell.php';</script>";
    die();
    // header('location:../../index.php');
}

### 檢查檔案類型是否合法
$mimeType = mime_content_type($file['tmp_name']);
$ALLOW_MIME_TYPE = ['image/jpeg', 'image/png', 'image/gif'];
if (!in_array($mimeType, $ALLOW_MIME_TYPE)) { //in_array(字串,陣列)檢查字串是否在字串裡面
    echo "<script>alert('檔案格式錯誤：僅接受jpg,png,gif');location.href='../../sell.php';</script>";
    die();
    // $_SESSION['error'] = sprintf("檔案格式錯誤：僅接受(%s)", str_replace('image/', '.', implode(',', $ALLOW_MIME_TYPE))); //implode(',',陣列)把陣列中的東西全部接起來，再用,隔開
    // header('location:../../index.php');
}


### 檢查檔案大小(MB)
$ALLOW_FILE_SIZE = 5 * 1024 * 1024;
if ($file['size'] > $ALLOW_FILE_SIZE) {
    echo "<script>alert('檔案超過上限：僅接受5MB以內');location.href='../../sell.php';</script>";
    die();
    //die('檔案超過上限：僅接受10MB以內');
    // $_SESSION['error'] = sprintf("檔案超過上限：僅接受%sMB以內", $ALLOW_FILE_SIZE / 1024 / 1024);
    // header('location:../../index.php');
}

### 搬檔案
$uploadTime = date("Ymdhis");
$uploadDir = 'upload';
$exts = explode('.', $file['name']); //取副檔名
$filename = sprintf("%s.%s.%s", $uploadTime, md5($file['name']), $exts[1]);
$destination = $uploadDir . '/' . $filename;

if (!is_dir($uploadDir)) { //確認資料夾是否存在
    mkdir($uploadDir);
}
$result = move_uploaded_file($file['tmp_name'], $destination);
if (!$result) {
    echo "<script>alert('圖片上傳失敗');location.href='../../sell.php';</script>";
    die();
    // $_SESSION['error'] = sprintf("上傳失敗");
}
// $name = $_POST['item_name'];
// $price = $_POST['item_price'];
// $category = $_POST['item_category'];
// $status = $_POST['item_status'];
// $location = $_POST['item_location'];
// $describe = $_POST['item_describe'];
// $exist = $_POST['item_exist'];

if (isset($_POST['action']) && ($_POST['action'] == 'add')) {
    // $sql_query = "SELECT * FROM item_data";
    $sql_query = "INSERT INTO item_data(item_name,item_price,item_category,item_status,item_location,item_describe,item_exist,item_img,item_seller)
    VALUES(?,?,?,?,?,?,?,?,?)";
    $stmt = $db_link->prepare($sql_query);
    $stmt->bind_param(
        "sisssssss",
        $_POST['item_name'],
        $_POST['item_price'],
        $_POST['item_category'],
        $_POST['item_status'],
        $_POST['item_location'],
        $_POST['item_describe'],
        $_POST['item_exist'],
        $filename,
        $phone
    );

    if ($stmt->execute()) {
        $stmt->close();
        $db_link->close();
        echo "<script>alert('成功上架!');location.href='../../index.php';</script>";
    } else {
        die('FAIL!');
    }
}
?>

