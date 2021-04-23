<?php
    /*这个页面主要提供功能：
    **1、展现界面：欢迎来到虚拟职场！
    **2、提供两个按钮分别是：（1）我想要求职；（2）我是职工。
    **3、分别点击这两个按钮之后会进行跳转，本别跳转到求职页面或者职工登录界面
    */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 使用Bootstrap4框架 -->
    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <!-- bootstrap.bundle.min.js 用于弹窗、提示、下拉菜单，包含了 popper.min.js -->
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>虚拟职场</title>
</head>
<body>
    <div class="title_1">
        <h1 class="display-2" align="center" style="font-family:楷体">欢迎来到虚拟职场</h1>
    </div>
    <div class="button_1">
        <center>
            <button type="button" onclick="choose()" class="btn btn-outline-primary btn-lg" >我想要求职</button>
            <button type="button" onclick="login()" class="btn btn-outline-primary btn-lg" onclick="login">我是职工</button>
        </center>
    </div>

    <script>
        //设置函数进行跳转,onclick中引用函数的格式 "函数名()"
        function choose() {
            //window.open("register.php");//跳转到指定的页面，打开新页面
            window.location="choose.html";//跳转到指定的页面，不打开新页面
            //函数点击测试 
            //alert("111");
        }
        function login() {
            //window.open("register.php");//跳转到指定的页面，打开新页面
            window.location="denglu.php";//跳转到指定的页面，不打开新页面
            //函数点击测试 
            //alert("111");
        }
    </script>
</body>
</html>