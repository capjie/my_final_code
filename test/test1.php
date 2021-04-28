<!-- 用户中心 demo-->
<!-- 功能：能够更改密码。查看发表过的帖子，删除发表过的帖子 -->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 使用Bootstrap4框架 -->
    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <!-- bootstrap.bundle.min.js 用于弹窗、提示、下拉菜单，包含了 popper.min.js -->
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <title>我的主页</title>
</head>
<body>
    <div class="container-fluid">
        <a class="btn btn-light" id="num_0" onclick="getid(this.id)">查看</a>
        <a class="btn btn-light" id="2" onclick="getid(this.id)">查看</a>
    </div>
    <script>
        function getid(id){
            var no = id.split("_")[1];
            console.log(id);
                $.post("/user_chakan.php",{"data":no},function(data){
                // alert("数据: " + data + "\n");
                // console.log(data);
                window.open(data);
            });  
        }
    </script>
</body>
</html>