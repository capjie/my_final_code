<!-- 用于处理上传的视频、pdf和txt文件信息 -->
<?php 
    // 启用session，用来知道文件是谁传来的
    session_start();
    $allowExts = array("pdf", "mp4", "txt");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extenion = end($temp);  // 获取文件后缀名字
    if (($_FILES["file"]["type"] == "application/pdf")
    || ($_FILES["file"]["type"] == "application/txt")
    || ($_FILES["file"]["type"] == "application/mp4")
    && in_array($extenion, $allowExts)
    ){
        if ($_FILES["file"]["error"] > 0)
        {
            echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        }
        else
        {
            // echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
            // echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
            // echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            // echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"];
            // ???
            if (file_exists("upload/" . $_FILES["file"]["name"]))
            {
                echo $_FILES["file"]["name"] . " 文件已经存在。 ";
            }
            else
            {
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
                echo "文件存储在: " . "upload/" . $_FILES["file"]["name"];
            }
        }
    }else{
        echo "Error!Attack?";
    }
?>