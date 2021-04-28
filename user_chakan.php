<?php 
    session_start();
    $_SESSION['no'] = $_POST['data']; // 将POST数据给到session的user_no中

    $url = 'http://127.0.0.1/tiezi.php';
    // 打开tiezi.php
    header('content-type:text/html;charset=utf-8');
    echo $url;
?>