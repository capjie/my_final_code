<?php 
    // 用来判断用户选择的是哪一个职业
    session_start();
    $tag = $_POST["tag"];
    $_SESSION['session'] = $tag; //这个变量的值与用户输入的值相等
    $json_arr = array("INFO"=>"success");
    $json_obj = json_encode($json_arr);
    echo $json_obj;
?>