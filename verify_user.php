<?php
    /*该页面的主要功能：
    **1、验证账号密码
    */

    session_start();
    // 访问权限控制
    // defined('mail') or exit('Access Denied');
    //验证session和用户输入的表单，完成验证码的验证
    if($_POST['code'] != ""){
        if(strtolower($_POST['code'])==strtolower($_SESSION['session'])){
            //echo'<font color="#0000CC">输入正确</form>';
            //验证账号密码
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "bs";
            $mail_r = $_POST["username"];
            $password_r = $_POST["password"];
            
            $mail_sha1 = sha1($mail_r);
            $password_sha1 = sha1($password_r);

            $con = mysqli_connect($servername,$username,$password,$dbname);//连接Mysql----服务器地址，用户名，密码，指定的数据库名

            if (!$con)
            {
                // die('Could not connect: ' . mysql_error());
                echo "<script>alert(\"登录失败\")</script>";
                $json_arr = array("INFO"=>"code_error");
                $json_obj = json_encode($json_arr);
                echo $json_obj;
                exit();
            }
            else{
                //echo "succeess<br>";
                //执行sql查询语句
                $sql = sprintf("select password from member where mail=('%s') ", $mail_sha1);//更安全的写法，防止SQL注入
                $result = $con->query($sql);//获取所有查询结果
                $data = $result->fetch_assoc();//将结果放入关联数组中
                $select_pwd = $data["password"];
                // echo $data["pwd"];
                if ($password_sha1 === $select_pwd) {
                    // 设置session验证
                    // 如果密码正确，那么将表单的信息输入到session里去，并且在main.php中认证
                    $_SESSION["session_mail"] = $mail_sha1; // 这里需要传入的是sha1后的mail值
                    // $_SESSION["pwd"] = $password_r;
                    $json_arr = array("INFO"=>"Success", "URL"=>"main.php");
                    $json_obj = json_encode($json_arr);
                    echo $json_obj;
                    exit();
                }else{
                    $json_arr = array("INFO"=>"error");
                    $json_obj = json_encode($json_arr);
                    echo $json_obj;
                    // echo "<script>alert(\"登录失败\")</script>";
                    // echo "<script>"."window.location=\"http://127.0.0.1:80/index.html\""."</script>";
                }
            }
        }else{
            $json_arr = array("INFO"=>"code_error");
            $json_obj = json_encode($json_arr);
            echo $json_obj;
            // echo '<font color="#CC0000"><b>验证码输入错误</b></font>';
        }
        exit();
    }else{
        exit('Access Denied');
    }
    // else{
        // echo '<script>alert("请输入图片中的验证码");</script>';
        // echo "<script>"."window.location=\"http://127.0.0.1/test.php\""."</script>";
    // }
?>