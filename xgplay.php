<!-- 西瓜视频播放器使用 -->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/xgplayer@2.9.6/browser/index.js" type="text/javascript"></script>
    <title>西瓜播放器</title>
</head>
<body>
    <div id="mse">

    </div>
    <script>
        let player = new Player({
            el: document.querySelector('#mse'),
            url: '/mycode/test.mp4',
            videoInit: true,
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