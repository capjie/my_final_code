<?php
    
    // 登录后的页面
    /*
    **1、学习天地、知识广场、通关测试
    **2、分为初级、中级、高级。
    */
    // 开始认证
    session_start();
    $user_mail = '10cba579f4d06ec2616d3727ec5ced9cf22ddf7a';
    // $user_mail = $_SESSION["mail"];
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bs";
    $con = mysqli_connect($servername,$username,$password,$dbname);//连接Mysql----服务器地址，用户名，密码，指定的数据库名
    $sql_1 = sprintf("select count(mail) from member where mail='%s'",$user_mail);
    $res_code = $con -> query($sql_1);
    $count_array = $res_code -> fetch_all();//获取查询到的数据
    $count_no = $count_array[0][0];
    if($count_no == 0){
        include('alert.html');
    }elseif ($count_no >= 0){
        include('main.html');
    }
?>