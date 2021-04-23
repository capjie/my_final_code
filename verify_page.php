<?php 
    // 识别用户点击的页面是那一页
    session_start();
    $_SESSION["page"] = $_POST["page"];
    $_SESSION["title"] = $_POST["title"];
    $_SESSION["no"] = $_POST["no"];
?>