<!-- 测试题目页面 -->
<?php 
    // 创建伪随机数
    /*
    * array unique_rand( int $min, int $max, int $num )
    * 生成一定数量的不重复随机数，指定的范围内整数的数量必须
    * 比要生成的随机数数量大
    * $min 和 $max: 指定随机数的范围
    * $num: 指定生成数量
    */
    session_start();
    function unique_rand($min, $max, $num) {
        $count = 0;
        $return = array();
        while ($count < $num) {
            $return[] = mt_rand($min, $max);
            $return = array_flip(array_flip($return));
            $count = count($return);
        }
        //打乱数组，重新赋予数组新的下标
        shuffle($return);
        return $return;
    }
    //生成10个1到100范围内的不重复随机数
    // $arr = unique_rand(1, 100, 10);
    // foreach($arr as $key => $value){
    //     echo "{$key}=>{$value}";
    // }
    // echo implode($arr, ",");
    // 数据库参数
    $servername = "127.0.0.1";
    $username = "root";
    $password = "root";
    $dbname = "question";
    $con = mysqli_connect($servername, $username, $password, $dbname);
    if(!$con){
        echo "error!";
    }
    // 看收到的是那个类型的职业的测试请求
    $tag = $_SESSION['session'];
    $dbtable_problem = "problem_".$tag;
    $dbtable_answer  = "answer_".$tag;
    // 查看题库的数目
    $sql_row = sprintf("select * from %s",$dbtable_problem); 
    $result = mysqli_query($con, $sql_row);
    // 提取搜索到的总条数
    $num_rows = mysqli_num_rows($result);
    $arr_id = unique_rand(1, $num_rows, 5);
    $_SESSION['id'] = $arr_id;
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>安全服务工程师测试题</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">第一题</h4>
                <p class="card-text">
                    <?php 
                        $sql_1 = "select problem from $dbtable_problem where questionflag = 'new_test' and id=$arr_id[0]";
                        $res_1 = $con->query($sql_1);
                        $data_1 = $res_1->fetch_assoc();
                        echo $data_1["problem"];
                    ?>
                </p>
                <form name="first_1" id="first_1" method="POST">
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio1" id="A">
                            A、
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'A' and id=$arr_id[0]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio1" id="B">
                            B、                            
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'B' and id=$arr_id[0]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                            </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio1" id="C">
                            C、                          
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'C' and id=$arr_id[0]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                    </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio1" id="D">
                            D、                       
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'D' and id=$arr_id[0]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                        </label>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">第二题</h4>
                <p class="card-text">
                    <?php 
                        $sql_1 = "select problem from $dbtable_problem where questionflag = 'new_test' and id=$arr_id[1]";
                        $res_1 = $con->query($sql_1);
                        $data_1 = $res_1->fetch_assoc();
                        echo $data_1["problem"];
                    ?>
                </p>
                <form name="second_2" id="second_2" method="POST">
                <div class="radio">
                        <label>
                            <input type="radio" name="optradio2" id="A">
                            A、
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'A' and id=$arr_id[1]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio2" id="B">
                            B、                            
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'B' and id=$arr_id[1]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                            </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio2" id="C">
                            C、                          
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'C' and id=$arr_id[1]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                    </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio2" id="D">
                            D、                       
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'D' and id=$arr_id[1]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                        </label>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">第三题</h4>
                <p class="card-text">
                    <?php 
                        $sql_1 = "select problem from $dbtable_problem where questionflag = 'new_test' and id=$arr_id[2]";
                        $res_1 = $con->query($sql_1);
                        $data_1 = $res_1->fetch_assoc();
                        echo $data_1["problem"];
                    ?>
                </p>
                <form name="third_3" id="third_3" method="POST"> 
                <div class="radio">
                        <label>
                            <input type="radio" name="optradio3" id="A">
                            A、
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'A' and id=$arr_id[2]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio3" id="B">
                            B、                            
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'B' and id=$arr_id[2]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                            </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio3" id="C">
                            C、                          
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'C' and id=$arr_id[2]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                    </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio3" id="D">
                            D、                       
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'D' and id=$arr_id[2]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                        </label>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">第四题</h4>
                <p class="card-text">
                    <?php 
                        $sql_1 = "select problem from $dbtable_problem where questionflag = 'new_test' and id=$arr_id[3]";
                        $res_1 = $con->query($sql_1);
                        $data_1 = $res_1->fetch_assoc();
                        echo $data_1["problem"];
                    ?>
                </p>
                <form name="forth_4" id="forth_4" method="POST">
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio4" id="A">
                            A、
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'A' and id=$arr_id[3]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio4" id="B">
                            B、                            
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'B' and id=$arr_id[3]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                            </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio4" id="C">
                            C、                          
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'C' and id=$arr_id[3]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                    </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio4" id="D">
                            D、                       
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'D' and id=$arr_id[3]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                        </label>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">第五题</h4>
                <p class="card-text">
                    <?php 
                        $sql_1 = "select problem from $dbtable_problem where questionflag = 'new_test' and id=$arr_id[4]";
                        $res_1 = $con->query($sql_1);
                        $data_1 = $res_1->fetch_assoc();
                        echo $data_1["problem"];
                    ?>
                </p>
                <form name="fifth_5" id="fifth_5" method="POST">
                <div class="radio">
                        <label>
                            <input type="radio" name="optradio5" id="A">
                            A、
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'A' and id=$arr_id[4]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio5" id="B">
                            B、                            
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'B' and id=$arr_id[4]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                            </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio5" id="C">
                            C、                          
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'C' and id=$arr_id[4]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                    </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="optradio5" id="D">
                            D、                       
                            <?php 
                                $sql_2 = "select problem_answer from $dbtable_answer where questionflag = 'new_test' and id_n = 'D' and id=$arr_id[4]";
                                $res_2 = $con->query($sql_2);
                                $data_2 = $res_2->fetch_assoc();
                                echo $data_2["problem_answer"];
                            ?>
                        </label>
                    </div>
                </form>
            </div>
        </div>
        <button type="button" class="btn btn-primary" id="sub">提交答案</button>
    </div>
    <script>
        /*------判断radio是否有选中，获取选中的值--------*/
        $(function(){
            // 第一题
            $("#sub").click(function(){
                var arr_name =[];//存储各个单选框的按钮值
                var arr_val=[]; //存储各个单选框的checked值
                var arr_answer = []; // 存储各个选项的值
                
                var str_i = ""; //存储没有被做到的题目
                var flag = true; //判断是否完成所有题目的标志
                arr_name.push("optradio1");
                arr_name.push("optradio2");
                arr_name.push("optradio3");
                arr_name.push("optradio4");
                arr_name.push("optradio5");
                $.each(arr_name, function(val_i, name_n){
                    id_find = 'input:radio[name="' + name_n + '"]:checked';
                    arr_val.push($(id_find).val());
                });
                
                console.log(arr_val);
                // 遍历选项选择情况,val_ii为索引，val_n为当前项
                $.each(arr_val, function(val_i, val_n){
                    // console.log( i + ": " + n );
                    if(val_n == null){
                        var i = (val_i + 1).toString();
                        str_i = str_i + i + "、";
                        flag = false;
                        // alert("第"+i+"题没有做！");
                    }
                });
                if(flag == true){
                    // 如果所有的题目有做完了那么就post到后台去
                    $.each(arr_name, function(val_i, name_n){
                        id_find = 'input:radio[name="' + name_n + '"]:checked';
                        arr_answer.push($(id_find).attr("id"));
                    });
                    $.ajax({
                        type: 'POST',
                        url: 'check_timu.php',
                        dataType: 'json',
                        data:{
                            answer: arr_answer,
                            flag: "new_test",
                            <?php echo "tag: '$tag'"; ?>
                        },
                        success: function (data) {
                            console.log(data);
                            // console.log(data.status);
                            if(data.status == 'OK'){
                                alert("恭喜通过测试，您的邀请码是："+data.invite_code);
                                window.location.href = "/zuce.php";
                            }else{
                                alert("抱歉，您未通过测试。");
                            }
                        }
                    });
                }else{
                    // 如果有一题没有做完就提示
                    str_i = str_i.slice(0,-1);
                    alert("第"+ str_i + "题没有做完");
                }
                });
        });
    </script>
</body>
</html>