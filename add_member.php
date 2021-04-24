<?php
    /*该页面的主要功能：
    **1、将员工数据写入数据库
    */

    /*
    session_start();//启用session

    if($_SESSION['add_member'] === "add_member")
    {
        // echo "<script>alert(\"111\")</script>";
        // php.ini 设置了1200秒后销毁session
        // unset($_SESSION['name']);

    }
    else
    {
        echo "<script>alert(\"您没有权限访问此页面\")</script>";
        // header("location:test.php"."?name=$name");//成功后返回index.php页面并保存name值
        echo "<script>"."window.location=\"http://127.0.0.1:80\""."</script>";
    }
    */
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "bs";
    $dbname2 = "question";
    //获取表单内容，分别是注册的姓名，电话，邮箱，密码。
    $username_i = $_POST["name"];
    $tel_i = $_POST["school"];
    $mail_i = $_POST["mail"];
    $password_i = $_POST["password"];
    $code = $_POST["code"];
    //权限设置
    $level = 1;
    // $permission_1 = $_SESSION['permission_1'];
    // $permission_2 = $_SESSION['permission_2'];
    // $permission_3 = $_SESSION['permission_3'];

    //SHA1摘要
    // $username_i = sha1($username_i);
    $tel_sha1 = sha1($tel_i);
    $mail_sha1 = sha1($mail_i);
    $password_sha1 = sha1($password_i);//讲password摘要处理
    $con = mysqli_connect($servername, $username, $password, $dbname);//连接Mysql----服务器地址，用户名，密码，指定的数据库名
    $con2 = mysqli_connect($servername, $username, $password, $dbname2);//连接Mysql----服务器地址，用户名，密码，指定的数据库名

    if (!$con && !$con2) {
        // die('Could not connect: ' . mysql_error());
        echo "<script>alert(\"失败\")</script>";
        $json_arr = array("INFO"=>"code_error");
        $json_obj = json_encode($json_arr);
        echo $json_obj;
    } else {
        //echo "succeess<br>";
        $sql = sprintf("insert into member(name, school, mail, password, level) value('%s', '%s', '%s', '%s', %u)", $username_i, $tel_sha1, $mail_sha1, $password_sha1, $level);//更安全的写法，防止SQL注入
        //执行sql查询语句
        //先判断是否是正确的验证码
        $sql2 = sprintf("select code from check_code where code = '%s'", $code);
        $res_code = $con2 -> query($sql2);//返回的$res_code是一个对象而不是一个数组，需要使用->符号来提取数据
        //判断受影响的条数
        if ($res_code->num_rows != 0) {
            // 判断是否有相同的邮箱注册过
            $sql4 = sprintf("select name from member where mail='%s'", $mail_sha1);
            $res_se = $con -> query($sql4);
            if ($res_se -> num_rows != 0) {
                // 转化成json格式将结果返回
                $json_arr = array("INFO"=>"账户已存在");
                $json_obj = json_encode($json_arr);
                echo $json_obj;
            } else {
                // 删除验证码
                $sql3 = sprintf("delete from check_code where code='%s'", $code);
                $res_de = $con2 -> query($sql3);
                if (!$res_de) {
                    $json_arr = array("INFO"=>"删除失败");
                    $json_obj = json_encode($json_arr);
                    echo $json_obj;
                } else {
                    $res = $con -> query($sql);//执行添加语句
                    // 转化成json格式将结果返回
                    if ($res) {
                        $json_arr = array("INFO"=>"Success", "URL"=>"main.php");
                        $json_obj = json_encode($json_arr);
                        echo $json_obj;
                    } else {
                        // $info = "err: sql:".$sql."res: ".$res;
                        // $json_arr = array("INFO"=>$info);
                        $json_arr = array("INFO"=>"error");
                        $json_obj = json_encode($json_arr);
                        echo $json_obj;
                    }
                }
            }
        } else {
            // 返回界面显示错误的验证码
            $json_arr = array("INFO"=>"错误的邀请码");
            $json_obj = json_encode($json_arr);
            echo $json_obj;
        }
    }
