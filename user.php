<!-- 用户中心 demo-->
<!-- 功能：能够更改密码。查看发表过的帖子，删除发表过的帖子 -->
<?php 
    session_start();
    $user_mail = $_SESSION["session_mail"];
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
        exit();
    }
?>
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
    <!-- 头部：展示注册的年龄，粉丝，获赞数。编辑个人资料 -->
    <div class="card mb-3 border-light" style="max-width: 540px;">
    <div class="row">
        <div class="col-sm-4">
        <img src="/icon/030-owl.svg" class="card-img" alt="">
        </div>
        <div class="col-sm-8">
        <div class="card-body">
            <h5 class="card-title">
                <?php  
                    $sql_2 = sprintf("select name from member where mail='%s'",$user_mail);
                    $res_name = $con -> query($sql_2);
                    $data = $res_name->fetch_assoc();//将结果放入关联数组中
                    echo $data["name"];
                ?>
            </h5>
            <!-- 待定 -->
            <p class="card-text"><small class="text-muted">这个人很懒什么也没有留下</small></p>
        </div>
        </div>
    </div>
    </div>
    <!-- 内容部分：我的发布，我的评论 -->
    <div class="row">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-fabu" role="tab" aria-controls="pills-home" aria-selected="true">我的发布</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-pinglun" role="tab" aria-controls="pills-profile" aria-selected="false">我的评论</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-renwu-tab" data-toggle="pill" href="#pills-renwu" role="tab" aria-controls="pills-renwu" aria-selected="false">我的任务</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-renwu2-tab" data-toggle="pill" href="#pills-renwu2" role="tab" aria-controls="pills-renwu2" aria-selected="false">我发布的任务</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-ziliao-tab" data-toggle="pill" href="#pills-ziliao" role="tab" aria-controls="pills-ziliao" aria-selected="false">编辑资料</a>
        </li>
        </ul>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-fabu" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="col-12 col-sm-8">
        <table class="table table-hover">
        <thead class="thead-light">
            <tr>
            <th scope="col">#</th>
            <th scope="col">发布的时间</th>
            <th scope="col">发布的标题</th>
            <th scope="col">所属的分类</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql_3 = sprintf("select * from publish where mail='%s'",$user_mail);
                $res_all = $con -> query($sql_3);
                $data = $res_all->fetch_all();  //获取查询到的数据
                $i = 0;
                while($i < count($data,0)){
                    if($data[$i][3] == 1){
                        $tag = '安全研究';
                    }elseif ($data[$i][3] == 2) {
                        $tag = '安全开发';
                    }elseif ($data[$i][3] == 3) {
                        $tag = '安全服务';
                    }
                    $time = date('Y-m-s h:i:s',$data[$i][2]);
                    echo "<tr>";
                    echo "<th scope='row'>$i</th>";
                    echo "<td>".$time."</td>";
                    echo "<td>".$data[$i][4]."</td>";
                    echo "<td>".$tag."</td>";
                    echo "<td><a href='#' class='btn btn-light' id='num_".$data[$i][5]."' onclick='getid(this.id)'>查看</a></td>";
                    echo "</tr>";
                    $i = $i + 1;
                }
            ?>
        </tbody>
        </table>
        </div>
        </div>
        <div class="tab-pane fade" id="pills-pinglun" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="col-12 col-sm-8">
        <table class="table table-hover">
        <thead class="thead-light">
            <tr>
            <th scope="col">#</th>
            <th scope="col">评论的时间</th>
            <th scope="col">评论的标题</th>
            <th scope="col">所属的分类</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td>{2021-04-21}</td>
            <td>学习</td>
            <td>安服</td>
            <td><a href="#" class="btn btn-light">查看</a></td>
            </tr>
            <tr>
            <th scope="row">2</th>
            <td>{2021-04-21}</td>
            <td>学习2</td>
            <td>安服2</td>
            <td><a href="#" class="btn btn-light">查看</a></td>
            </tr>
            <tr>
            <th scope="row">3</th>
            <td>{2021-04-21}</td>
            <td>学习3</td>
            <td>安服2</td>
            <td><a href="#" class="btn btn-light">查看</a></td>
            </tr>
        </tbody>
        </table>
        </div>
        </div>
        <div class="tab-pane fade" id="pills-renwu" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="card text-white bg-info mb-3" style="max-width: 20rem;">
        <div class="card-header">任务截至时间：2021-04-30</div>
        <div class="card-body">
            <h5 class="card-title">任务的标题</h5>
            <p class="card-text">任务发布的人：XXX</p>
            <button type="button" class="btn btn-primary">详细信息</button>
        </div>
        </div>
        </div>
        <div class="tab-pane fade" id="pills-renwu2" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="card text-white bg-info mb-3" style="max-width: 20rem;">
        <div class="card-header">任务发布时间：{2021-04-21}</div>
        <div class="card-body">
            <h5 class="card-title">任务的标题</h5>
            <p class="card-text">任务接收的人：XXX</p>
            <button type="button" class="btn btn-primary">详细信息</button>
        </div>
        </div>
        </div>
        <div class="tab-pane fade" id="pills-ziliao" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="col-12 col-md-8">
        <form>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-4 col-form-label">昵称</label>
            <div class="col-sm-8">
            <input type="email" class="form-control" id="inputEmail3" placeholder="留空不做修改">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-4 col-form-label">旧密码</label>
            <div class="col-sm-8">
            <input type="password" class="form-control" id="inputPassword3" placeholder="留空不做修改" >
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-4 col-form-label">新密码</label>
            <div class="col-sm-8">
            <input type="password" class="form-control" id="inputPassword3" placeholder="留空不做修改">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-4 col-form-label">再次输入新密码</label>
            <div class="col-sm-8">
            <input type="password" class="form-control" id="inputPassword3" placeholder="留空不做修改">
            </div>
        </div>
        
        <div class="form-group row">
            <div class="col-sm-8">
            <button type="submit" class="btn btn-primary">确认</button>
            </div>
        </div>
        </form>
        </div>
        </div>
    </div>
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