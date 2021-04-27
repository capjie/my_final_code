<!-- 集合了3个模块的发布页面的入口 -->
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="card-deck">
        <div class="card border-secondary mb-3" style="max-width: 20rem;">
            <div class="card-header">发布帖子</div>
            <div class="card-body text-secondary">
            <p class="card-text">通过发布帖子来认识其他的成员</p>
            <a href="publish.php" class="btn btn-primary">Go</a>
            </div>
        </div>
        <div class="card text-white bg-info mb-3" style="max-width: 20rem;">
            <div class="card-header">发布任务</div>
            <div class="card-body">
            <p class="card-text">发布任务，考考大家</p>
            <a href="publish_renwu.php" class="btn btn-primary">Go</a>
            </div>
        </div>
        <!-- disabled 的问题还没有解决 -->
        <div class="card text-white bg-success mb-3" style="max-width: 20rem;">
            <div class="card-header">发布项目</div>
            <div class="card-body">
            <p class="card-text">发布你的项目，招兵买马</p>
            <a href="pulish_renwu2.php" class="btn btn-primary">Go</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>