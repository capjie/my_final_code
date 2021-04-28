<?php 
    // 进行分页的php网页的测试
    // 到时候根据数据库的条数来，然后一页按照15条来分，少于15条就一页。，点击第几页对查询接下去的几条，数据表中应当记录对应帖子的录入顺序，
    // 根据这个录入顺序来展示应当展示的帖子的一些基本信息，比如点赞数，标题，标签分类，简单的内容
    session_start();
    
    if(isset($_SESSION["page"])){
        // 通过session来获取当前属于哪一个页面，page值默认为1，通过从main.php这个页面跳转得到这个session的值
        $page = $_SESSION["page"];
        echo "<script>console.log('page_num = $page');</script>";
    }else{
        $page = 0;
    }
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bs";
    $con = mysqli_connect($servername,$username,$password,$dbname);//连接Mysql----服务器地址，用户名，密码，指定的数据库名
    $sql2 = sprintf("select count(no) from publish");
    $res_code = $con -> query($sql2);
    $count_array = $res_code -> fetch_all();//获取查询到的数据
    $count_no = $count_array[0][0];

    $last_num = $count_no % 15; // 最后一页的帖子数量，也用了判断页数
    if($last_num == 0){
        $page_num = $count_no / 15; // 页数
    }elseif($count_no != 0){
        $page_num = ceil(($count_no / 15)); // 页数,进一取整
    }
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
    a.card-title span{
        font-size: 25px;
        font-weight : bold;
	    color : #222222;
    }
    a{
        text-decoration:none
    };
  </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="#">全部</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">安全服务</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">安全研究</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">安全开发</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="/publish.php">我要发布</a>
        </li> -->
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
        </form>
    </div>
    </nav>
    <!-- 帖子:后期相关内容通过PHP代码向数据库中提取，通过点赞数来判断是否是精品，是否置顶 -->
    <!-- 通过tag来判断是属于哪个领域的 -->
    <?php
        $page = floatval($page);
        // echo var_dump($page);
        // echo var_dump($page_num);
        // 关于帖子的各个属性的获取
        if($page_num != 0 && $page != ($page_num-1)){
            // page_num如果不等于0那么就说明有帖子
            $total = 0;
            while($total < 15){
                $no = ($page*15) + $total;
                $get_title = sprintf("select publish_title from publish where no=%u",$no);  //获取标题
                $get_name  = sprintf("select name from publish where no=%u",$no);  //获取发布者的名字
                $res_title = $con ->query($get_title);
                $title = $res_title ->fetch_all();
                $res_name = $con ->query($get_name);
                $name = $res_name ->fetch_all();
                $flag = $title[0][0].'-'.$no;

                // echo $title[0][0];
                // echo $text[0][0];
                echo '<div class="card">';
                echo '<div class="card-header">';
                echo '<img src="/icon/best.svg" width="40" height="40" class="d-inline-block align-top" alt="">';
                echo '<img src="/icon/top.svg" width="40" height="40" class="d-inline-block align-top" alt="">';
                echo '<img src="/icon/new.svg" width="35" height="35" class="d-inline-block align-top" alt="">';
                echo '<div class="like" style="float:right">';      
                echo ' <img src="/icon/like.svg" style="float:right" width="40" height="40" class="d-inline-block align-top" alt="">';       
                echo '</div>';        
                echo '</div>';    
                echo '<div class="card-body">';
                echo '<a class="card-title" href="#"><span id="'.$flag.'">'.$title[0][0].'</span></a>';
                echo '<p class="card-text">发布人：'.$name[0][0].'</p>';
                echo '</div>';
                echo '</div>';
                $total = $total + 1;
            }
        }elseif($page == ($page_num-1)){
            // 用户点击的页数是最后一页的话
            while($last_num){
                $no = ($page*15) + $last_num -1;
                $get_title = sprintf("select publish_title from publish where no=%u",$no);  //获取标题
                $get_name  = sprintf("select name from publish where no=%u",$no);  //获取发布者的名字
                $res_title = $con ->query($get_title);
                $title = $res_title ->fetch_all();
                $res_name = $con ->query($get_name);
                $name = $res_name ->fetch_all();
                $flag = $title[0][0].'-'.$no;
                echo '<div class="card">';
                echo '<div class="card-header">';
                echo '<img src="/icon/best.svg" width="40" height="40" class="d-inline-block align-top" alt="">';
                echo '<img src="/icon/top.svg" width="40" height="40" class="d-inline-block align-top" alt="">';
                echo '<img src="/icon/new.svg" width="35" height="35" class="d-inline-block align-top" alt="">';
                echo '<div class="like" style="float:right">';      
                echo ' <img src="/icon/like.svg" style="float:right" width="40" height="40" class="d-inline-block align-top" alt="">';       
                echo '</div>';        
                echo '</div>';    
                echo '<div class="card-body">';
                echo '<a class="card-title" href="#"><span  id="'.$flag.'">'.$title[0][0].'</span></a>';
                echo '<p class="card-text">发布人：'.$name[0][0].'</p>';
                echo '</div>';
                echo '</div>';
                $last_num = $last_num - 1;
            }
        }
        
    ?>
    <!-- 分页按钮;float-right:向右靠齐 -->
    <div class="my-sm-4 float-right">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                <!-- 上一页 -->
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <!-- 第一页到最后一页 -->
                <?php 
                    $a = 1;
                    while ($a <= $page_num) {
                        echo '<li class="page-item" id="pageid"><a class="page-link" href="#" id="'.$a.'">'.$a.'</a></li>';
                        $a = $a + 1;
                    }
                ?>

                <li class="page-item">
                <!-- 下一页 -->
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>
<script>
    $(document).ready(function(){
        // if ($(window).width() < 768) {
        // //点击导航链接之后，把导航选项折叠起来
        //     $("#navbarTogglerDemo03 a").click(function () {
        //         $("#navbarTogglerDemo03").collapse('hide');
        //     });
        // //滚动屏幕时，把导航选项折叠起来
        //     $(window).scroll(function () {
        //         $("#navbarTogglerDemo03").collapse('hide');
        //     });
        // }
        $(document).click(function(e){
            var v_id = $(e.target).attr('id');
            console.log(typeof(v_id));
            var istitle = v_id.indexOf("-");
            if(istitle != -1){
                var words = v_id.split("-");
                var title = words[0];
                var no = words[1];
                $.ajax({
                    type: 'POST',
                    url: 'verify_page.php',
                    datatype: 'json',
                    data:{
                        no :no
                    }
                });
                window.open("tiezi.php");
            }
            // var arrayOfIds = $.map($(".page-link"), function(n, i){
            // return n.id;
            // console.log(v_id);
            // console.log(v_class);
            // 获取到点击的页面是那一页
            if(istitle == -1 && v_id>=0){
                var v_id = v_id - 1;
                var v_class = $(e.target).attr('class');
                // console.log(v_id);
                // console.log(v_class);
                $.ajax({
                    type: 'POST',
                    url: 'verify_page.php',
                    datatype: 'json',
                    data:{
                        page: v_id
                    }
                });
                // console.log("555");/
                window.location.href = "knowledge.php";
            }
        });
    });
</script>
</body>

</html>