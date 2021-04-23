<?php
    header("Content-type:text/html;charset=utf-8");
    $publish_text = $_POST['publish_text']; //文本
    $publish_tag = $_POST['tag']; // 类型
    $publish_title = $_POST['title']; //标题
    $publish_time = time(); // 当前的时间戳
    // 数据库参数
    $servername = "127.0.0.1";
    $username = "root";
    $password = "root";
    $dbname = "bs";
    $con = mysqli_connect($servername, $username, $password, $dbname);

    $sql2 = sprintf("select count(no) from publish");
    $res_code = $con -> query($sql2);
    $count_array = $res_code -> fetch_all();//获取查询到的数据
    $count_no = $count_array[0][0];
    $count_no = $count_no + 1;

    if(!$con){
        echo "error";
    }
    else{
        // 此处缺少，需要对上传的数据进行验证
        $file_name = md5($publish_time);
        $file_path = sprintf("E:/phpstudy_pro/WWW/study/publish/%s.txt", $file_name);
        $file = fopen($file_path, "w") or exit("Unable to open file!");
        fwrite($file, $publish_text);

        $upload_text = sprintf("insert into publish(name, publish_path, publish_time, publish_tag, publish_title, no) values('%s', '%s','%d','%s', '%s', %u)", 'test', $file_path, $publish_time, $publish_tag, $publish_title, $count_no);
        $res_upload_text = $con->query($upload_text);
        // 错误日志记录
        if($res_upload_text === 0){
            $log_path = sprintf("E:/phpstudy_pro/WWW/study/publish/%s.log", $publish_time);
            $file2 = fopen($log_path, "w") or exit("Unable to open file!");
            fwrite($file2, "ERROR\n");
        }
        fclose($file);
        // $json_arr = array("publish_text"=>$publish_text,"publish_time"=>$publish_time, "tag"=>$tag, "title"=>$title);
        // $json_obj = json_encode($json_arr);
        // echo $json_obj;
    }
?>