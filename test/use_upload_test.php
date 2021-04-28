<?php 
    require_once('upload_test.php');
    header("content-type:text/html;charset=utf-8");

    // 对上传文件进行区分
    $files = getFile();


    // 将上传的文件内容赋值给$fileinfo
    foreach($files as $fileinfo){
        // 调用函数
        $echo = uploadFiles($fileinfo);
        echo $echo['mes'];
        echo "</br>";
    }
?>