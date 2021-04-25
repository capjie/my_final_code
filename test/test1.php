<?php 
    $user_mail = '10cba579f4d06ec2616d3727ec5ced9cf22ddf7a';
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bs";
    $con = mysqli_connect($servername,$username,$password,$dbname);//连接Mysql----服务器地址，用户名，密码，指定的数据库名
    $sql_3 = sprintf("select * from publish where mail='%s'",$user_mail);
    $res_all = $con -> query($sql_3);
    $data = $res_all->fetch_all();  //获取查询到的数据
    echo count($data,0);
?>