<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('您已登出');location = '../../index.php';</script>";
?>
