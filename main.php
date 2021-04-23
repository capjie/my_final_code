<?php 
    // 登录后的页面
    /*
    **1、学习天地、知识广场、通关测试
    **2、分为初级、中级、高级。
    */
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>虚拟职场</title>
</head>
<body>
    <!-- 导航条 -->
    <!-- As a heading -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand mb-0 h1" href="/index.php">
                <img src="/icon/nav.svg" width="50" height="50" class="d-inline-block align-top" alt="">
            </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link active" href="study.php" target="Y">学习资料 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="knowledge.php" target="Y">知识广场 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="work.php" target="Y">任务广场 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="exam.php" target="Y">通关测试 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="#">个人中心</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- 导航栏 -->
    <div class="container">
        <!-- 100vh指的占满整个屏幕（移动设备） -->
        <div class="container-sm" style="height:90vh" id="test">
            <iframe src="study.php" frameborder="0" name="Y" style="width:100%;height:100%" scrolling="yes"></iframe>
        </div> 
    </div>
    <script>
        //window).scroll(
        $(function(){
            if ($(window).width() < 768) {
                //点击导航链接之后，把导航选项折叠起来
                $("#navbarNav a").click(function () {
                    $("#navbarNav").collapse('hide');
                });
                //滚动屏幕时，把导航选项折叠起来
                $(window).scroll(function () {
                    $("#navbarNav").collapse('hide');
                });
            }
        });
    </script>
</body>
</html>
