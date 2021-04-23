<!-- 1、用于注册的页面 -->
<?php
    /*页面的主要功能：
    **1、进行账号的注册（需要电话、姓名、所在的学校（选填）、邮箱（用来获取验证码）和密码（密码需要满足：大小写字母、数字、特殊字符这四项中的三项，长度在8-16位））
    **2、必须要从get_chance.php页面进行跳转才能进入（有可能有漏洞）
    */

    
    session_start();//启用session
    $_SESSION['add_member'] = "add_member";
    /*
    if(isset($_SESSION['name']))
    {
        // echo "<script>alert(\"欢迎管理员\")</script>";
        // php.ini 设置了1200秒后销毁session
        // unset($_SESSION['name']);
    }
    else
    {
        echo "<script>alert(\"您没有权限访问此页面\")</script>";
        // header("location:test.php"."?name=$name");//成功后返回index.php页面并保存name值
        echo "<script>"."window.location=\"http://127.0.0.1:80\""."</script>";
    }*/
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
   <title>员工注册</title>
   <style type="text/css">
      body {
         /* 设置背景颜色，背景图加载过程中会显示背景色 */
         background-color: #D0D0D0;
      }
   </style>

   <script>
      // 在标签中添加onblur（失去焦点事件，用户离开输入框时执行函数）
      // 验证学校是否为空
      function the_school(school){
         if(school){
            document.getElementById("school-1").innerHTML = "<img src='/tp/正确.svg' width='30' height='30'>";
            // console.log(school);
            return 1;
         }else{
            document.getElementById("school-1").innerHTML = "<h4><span class='badge badge-pill badge-danger'>学校不能为空</span></h3>";
            return 0;
         }
      }
      // 验证邮箱是否为空，并且格式是否正确
      function the_email(email){
         var emailReg = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/g;
         if(email){
            if(email.search(emailReg) != -1){
               document.getElementById("email-1").innerHTML = "<img src='/tp/正确.svg' width='30' height='30'>";
               return 1;
            }else{
               document.getElementById("email-1").innerHTML = "<h4><span class='badge badge-pill badge-danger'>邮箱格式错误</span></h3>";
               return 0;
            }
         }else{
            document.getElementById("email-1").innerHTML = "<h4><span class='badge badge-pill badge-danger'>邮箱不能为空</span></h3>";
            return 0;   
         }
      }
      // 验证密码格式的函数
      function the_password(password_1) {
        var passwordReg=/^.*(?=.{6,16})(?=.*\d)(?=.*[A-Z][a-z]{2,})(?=.*[!@#$%^&*?\(\)]).*$/;
        if(password_1 != "" && password_1.search(passwordReg) != -1){
            document.getElementById("password-1").innerHTML = "<h4><span class='badge badge-pill badge-success'>正确</span></h4>";
            return 1;
         }else{
            document.getElementById("password-1").innerHTML = "<h4><span class='badge badge-pill badge-danger'>密码格式错误</span></h3>";
            return 0;
         }
      }
      // 验证两次输入的密码是否相同的函数
      function check_password(password_2) {
        var password_1 = $("#password_1").val();
        // console.log(password_1);
        if(password_2){
         if(password_1 == password_2){
            document.getElementById("password-2").innerHTML = "<h4><span class='badge badge-pill badge-success'>正确</span></h4>";
            return 1;
         }else{
            document.getElementById("password-2").innerHTML = "<h4><span class='badge badge-pill badge-danger'>两次密码不同</span></h4>";
            return 0;
         }
        }else{
            document.getElementById("password-2").innerHTML = "<h4><span class='badge badge-pill badge-danger'>两次密码不同</span></h4>";
            return 0;
         }
      }
      // 验证表单是否都通过了检测的函数
      function checkall(){
         //通过调用来实现检测
         var password_1 = $('#password_1').val();
         var password_2 = $('#password_2').val();
         var school = $('#school').val();
         var email = $('#email').val();
         var school_tag = the_school(school);
         var email_tag = the_email(email);
         var password_tag = the_password(password_1);
         var same_tag = check_password(password_2);
         if(school_tag == 1 && email_tag==1 && password_tag ==1 && same_tag ==1){
            return true;
         }else{
            alert("还有没填写的字段！无法注册");
            return false;
         }
      }
   </script>
</head>

<body>
   <!-- 由name的时候会将参数显示在地址栏 -->
   <div class="container">
      <form class="form-signin">
         <div class="text-center mb-4">
            <img class="mb-4" src="/tp/注册.svg" alt="" width="80" height="80">
            <h1 class="h3 mb-3 font-weight-normal">注册属于你的账号</h1>
         </div>
         <div class="form-label-group">
            <div class="row">
               <div class="col-8 offset-2">
                  <input type="text" id="name" class="form-control" placeholder="昵称" autofocus="">
               </div>
            </div>
            <label></label>
         </div>
         <div class="form-label-group">
            <div class="row">
               <div class="col-8 offset-2"  >
                  <input type="text" id="school" class="form-control" placeholder="请输入您的学校" autofocus=""
                  onblur="the_school(this.value)">
               </div>
               <div class="col-2" id="school-1">
               </div>
            </div>
            <label></label>
         </div>
         <div class="form-label-group">
            <div class="row">
               <div class="col-8 offset-2">
                  <input type="email" id="email" class="form-control" placeholder="请输入邮箱" autofocus=""
                  onblur="the_email(this.value)">
               </div>
               <div class="col-2" id="email-1">
               </div>
            </div>
            <label></label>
         </div>
         <div class="form-label-group">
            <div class="row">
               <div class="col-8 offset-2">
                  <input type="password" id="password_1" class="form-control" placeholder="密码由6~16位的数字，字母和特殊符号组成"
                     onblur="the_password(this.value)">
               </div>
               <div class="col-2" id="password-1">
               </div>
            </div>
            <label></label>
         </div>
         <div class="form-label-group">
            <div class="row">
               <div class="col-8 offset-2">
                  <input type="password" id="password_2" class="form-control" placeholder="请再次输入您的密码"
                     onblur="check_password(this.value)">
               </div>
               <div class="col-2" id="password-2">
               </div>
            </div>
            <label></label>
         </div>
         <div class="form-label-group">
            <div class="row">
               <div class="col-8 offset-2">
                  <input type="text" id="code" class="form-control" placeholder="请输入您的邀请码" autofocus="">
               </div>
               <div class="col-2" id="code-1">
               </div>
            </div>
            <label></label>
         </div>
         <div class="col-8 offset-2">
            <div class="row">
               <button class="btn btn-lg btn-primary btn-block" type="button" id="zhuce">注 册</button>
            </div>
         <!--  onclick="return checkall()" -->
         </div>
         <p class="mt-5 mb-3 text-muted text-center"> 毕业设计</p>
      </form>
   </div>
   <script>
      $(function(){
         // 点击注册按钮
         $('#zhuce').click(function(){
            if(checkall()){
               var name = $("#name").val();
               var school = $("#school").val();
               var mail = $("#email").val();
               var password = $("#password_1").val();
               var code = $("#code").val();
               if(name ==""){
                  name = mail;
               }
               console.log(name);
               // console.log(name,school,mail,password,code);
               $.ajax({
                  type: 'POST',
                  url: 'add_member.php',
                  dataType: 'json',
                  data: {
                     name: name,
                     school: school,
                     mail: mail,
                     password: password,
                     code: code
                  },
                  success: function(data){
                     console.log(data.INFO);
                     if(data.INFO == "Success"){
                        alert("注册成功！");
                        window.location.href = "/main.php";
                     }else{
                        console.log(data.INFO);
                     }
                  }
               });
            }
         });
      });
   </script>
</body>

</html>