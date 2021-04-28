<?php 
    // 用来展现帖子的具体内容
    // 标题模块div
    // 内容模块div
    // 点赞模块
    // 评论模块div
    session_start();
    $no = $_SESSION["no"];

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bs";
    $con = mysqli_connect($servername,$username,$password,$dbname);//连接Mysql----服务器地址，用户名，密码，指定的数据库名
    $sql2 = sprintf("select publish_path from publish where no=%u",$no);
    $sql3 = sprintf("select publish_title from publish where no=%u",$no);
    $res_code = $con -> query($sql2);
    $res_code2 = $con -> query($sql3);
    $path_array = $res_code -> fetch_all();//获取查询到的数据
    $title_array = $res_code2 -> fetch_all();//获取查询到的数据
    $path = $path_array[0][0];
    $title = $title_array[0][0];

    $myfile = fopen($path , "r");
    $text = fread($myfile,filesize($path));
    fclose($myfile);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css"rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    
    <title>帖子</title>
</head>
<body>
    <div class="container">
        <div class="card" my-sm-4>
            <div class="card-body">
                <h1 class="display-3"><?php echo $title ?></h1>
            </div>
        </div>
        <div class="card" my-sm-4>
            <div class="card-body">
                <h1 class="display-3"><?php echo $text ?></h1>
            </div>
        </div>
    </div>

</body>
</html>