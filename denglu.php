<!-- 
    /*  该页面的主要功能：
    **  1、登录
    **/
 -->
<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- 使用Bootstrap4框架 -->
   <!-- 新 Bootstrap4 核心 CSS 文件 -->
   <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
   <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
   <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
   <title>员工登录页面</title>
   <style type="text/css">
      body {
         /* 设置背景颜色，背景图加载过程中会显示背景色 */
         background-color: #D0D0D0;
      }
   </style>
</head>

<body>
   <!-- 由name的时候会将参数显示在地址栏 -->
   <div class="container">
      <form class="form-signin">
         <div class="text-center mb-4">
            <img class="mb-4" src="/tp/登录.svg" alt="" width="120" height="80">
         </div>

         <div class="form-label-group">
            <div class="row">
               <div class="col-8 offset-2"  >
                  <input type="text" id="username" class="form-control" placeholder="邮箱账号" autofocus="" required>
               </div>
               <div class="col-2">
               </div>
            </div>
            <label></label>
         </div>

         <div class="form-label-group">
            <div class="row">
               <div class="col-8 offset-2">
                  <input type="password" id="password" class="form-control" placeholder="密码" required>
               </div>
               <div class="col-2">
               </div>
            </div>
            <label></label>
         </div>


         <div class="row">
               <div class="col-5 offset-2">
                <p>
                    <!-- 这里的Math.random()是JS的Math对象生成随机数的方法,
                        该方法会返回一个0到1(不含1)之间的小数,
                        每次调用该方法都会随机返回。
                        所以,使用一个新的参数重新请求当前资源,
                        这样浏览器会以为这是一个不同的资源,而不会从缓存中返回,这种情况最常见的就是验证码的刷新。 -->
                    <!-- 点击图片刷新验证码 -->
                    <img onclick="this.src='image.php?t='+Math.random()" id="img" border="1" src="image.php" width="200" height="80">
                </p>
               </div>
               <div class="col-2">
                <p>
                    <span class="badge badge-pill badge-info">请输入验证码</span>
                    <input type="text" id="code" class="form-control" placeholder="验证码" autofocus="" required>
                </p>
               </div>
            </div>
            <label></label>

         <div class="col-8 offset-2">
            <div class="row">
               <button class="btn btn-lg btn-primary btn-block" type="submit" id="denglu">登 录</button>
            </div>
         <!--  onclick="return checkall()" -->
         </div>
         <p class="mt-5 mb-3 text-muted text-center">© 2021~</p>
      </form>
   </div>
   <script>
      $(function(){
         // 点击注册按钮
         $('#denglu').click(function(){
           var username = $("#username").val();
           var password = $("#password").val();
           var code = $("#code").val();
           console.log(username,password,code);
           //console.log(name);
           // console.log(name,school,mail,password,code);
           $.ajax({
              type: 'POST',
              url: 'verify_user.php',
              dataType: 'json',
                data: {
                    username: username,
                    password: password,
                    code: code
                },
                success: function(data){
                    console.log(data.INFO);
                    if(data.INFO == "Success"){
                     window.location.href = "/main.php";
                    }else{
                    switch (data.INFO) {
                        case 'error':
                            alert("账号或密码错误！");
                            break;
                        case 'code_error':
                            alert("验证码错误");
                            break;
                        default:
                            break;
                    }
                    }
                }
            });
         });
      });
   </script>
</body>

</html>