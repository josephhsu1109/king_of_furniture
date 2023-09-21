<?php
    //資料庫主機設定
    $db_host="localhost";
    $db_username = 'root';
    $db_password = '';
    $db_name = 'myuser';
 // $db_link = @mysqli_connect($db_host, $db_username);
    $db_link= @new mysqli($db_host, $db_username,$db_password,$db_name); 
    if($db_link -> connect_error !=""){
        echo "FAIL!";
    }else{
        mysqli_query($db_link,"SET NAMES utf8");
    }
    ?>
    
