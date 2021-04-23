<!-- 西瓜视频播放器使用 -->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/xgplayer@2.9.6/browser/index.js" type="text/javascript"></script>
    <!-- 使用Bootstrap4框架 -->
    <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <!-- bootstrap.bundle.min.js 用于弹窗、提示、下拉菜单，包含了 popper.min.js -->
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>西瓜播放器</title>
</head>
<body>
    <div class="container" id="main">
        <div id="mse" class="mb-3">

        </div>
    </div>
 
    <script>
        let player = new Player({ 
            el: document.querySelector('#mse'),
            url: '/mycode/test.mp4',
            videoInit: true,
            fluid: true,
            playbackRate: [0.5, 0.75, 1, 1.5, 2],
            defaultPlaybackRate: 1,
            playNext: {
                urlList: [
                '/mycode/test.mp4',
                '/mycode/test.mp4',
                '/mycode/test.mp4'
                ],
            }
        });
    </script>
</body>
</html>