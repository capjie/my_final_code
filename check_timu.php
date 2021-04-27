<?php
    session_start();
    header("Content-type:text/html;charset=utf-8");
    $answer = $_POST['answer'];
    $flag = $_POST['flag'];
    $tag = $_POST['tag'];
    $arr_id = $_SESSION['id'];
    $err_flag_str = ""; // 记录错误的题目
    $err_count = 0; // 记录错误的总数
    // $answer_str = "";
    // foreach ($answer as $key => $value) {
    //     $answer_str = $answer_str . $value;
    // }
    
    // 创建随机码(邀请码)
    function create_randcode($pw_length = 8) 
    { 
        $randpwd = ''; 
        for ($i = 0; $i < $pw_length; $i++)  
        { 
            $randpwd .= chr(mt_rand(33, 126)); 
        } 
        return $randpwd; 
    } 
    // 数据库参数
    $servername = "127.0.0.1";
    $username = "root";
    $password = "root";
    $dbname = "question";
    $con = mysqli_connect($servername, $username, $password, $dbname);
    if(!$con){
        echo "error";
    }
    else{
        // 遍历答案数组，并于数据库中的答案进行比较
        // 到时候可以使用之前存取随机数的数组来获取题目ID，然后一个个对比
        $i = 0;
        foreach ($answer as $key => $value) {
            // 查询数据库
            $sql = sprintf("select useranswer from answer_all where questionflag = '%s' and tag = '%s' and id=%u", $flag, $tag, $arr_id[$i]);
            $res = $con->query($sql);
            $data = $res->fetch_assoc();
            $i = $i + 1;

            // $value_right = substr($data["useranswer"], $key, 1);
            $value_right = $data["useranswer"];
            if($value === $value_right){
                continue;
            }else{
                // 数字转化成字符串
                $key_str = strval($key + 1);  
                $err_flag_str = $err_flag_str . $key_str ."、";
                $err_count = $err_count + 1;
            }
        }
        // 如果错题数目小于二
        if($err_count <= 2){
            $check_code = create_randcode(6);
            $sql_save_code = sprintf("insert into check_code(code) values('%s')", $check_code);
            // 创建进入注册页面的条件
            $_SESSION['check_code'] = $check_code;
            $res_save_code = $con->query($sql_save_code);
            $json_arr = array("invite_code"=>$check_code,"err_total"=>$err_count, "err_flag_str"=>$err_flag_str, "status"=>"OK", "Addr"=>"www.baidu.com");
            $json_obj = json_encode($json_arr);
            echo $json_obj;
        }else{
            $json_arr = array("err_total"=>$err_count, "err_flag_str"=>$err_flag_str, "status"=>"False");
            $json_obj = json_encode($json_arr);
            echo $json_obj;
        }
    }
?>