<?php 
    // 上传视频和pdf学习文件的页面

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css"rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    
    <title>文件上传</title>
</head>
<body>
    <div class="container">
      <!-- 顶部标题 -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-5">上传学习文件</h1>
        </div>
      </div>
      <!-- 中间文章标题和tag -->
      <form method="post" id="title_and_tag" class="was-validated">
        <br>
        <div class="input-group mb-3 col-md-6">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">视频名称</span>
          </div>
          <input id="title_publish" type="text" class="form-control" placeholder="请输入名称" aria-label="Username" aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3 col-md-6">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">视频简介</span>
          </div>
          <input id="title_publish" type="text" class="form-control" placeholder="请输入简介" aria-label="Username" aria-describedby="basic-addon1" required>
        </div>
        <div class="form-group col-md-6" >
          <select class="custom-select" id="tag" required >
            <option value="">选择文件对应的标签</option>
            <option value="1">安全研究</option>
            <option value="2">安全开发</option>
            <option value="3">安全服务</option>
          </select>
          <div class="invalid-feedback">必须选择任务对应的标签</div>
        </div>
      </form>
      <!-- 上传文件 -->

      <div class="input-group mb-3 col-md-6">
        <input class="form-control" type="text" id="path_mp4" onclick="$('#file').click()" readonly>
        <span id="upload_vedio" class="btn btn-info input-group-addon" onclick="$('#file').click()">
          <i class="glyphicon glyphicon-cloud-upload"></i>
          视频文件上传
        </span>
        <!-- <div class="invalid-feedback">仅支持MP4格式的视频文件</div> -->
      </div>
      <div class="input-group mb-3 col-md-6">
        <input class="form-control" type="text" id="path_pdf" onclick="$('#file_pdf').click()" readonly>
        <span id="upload_pdf" class="btn btn-info input-group-addon" onclick="$('#file_pdf').click()">
          <i class="glyphicon glyphicon-cloud-upload"></i>
           PDF文件上传
        </span>
      </div>
      <div class="input-group mb-3 col-md-6">
        <input class="form-control" type="text" id="path_txt" onclick="$('#file_').click()" readonly>
        <span id="upload_text" class="btn btn-info input-group-addon" onclick="$('#file').click()">
          <i class="glyphicon glyphicon-cloud-upload"></i>
          文本文件上传
        </span>
      </div>
      <input type="file" class="form-control" id="file" style="display:none"/>
      
      </div>
    <script>
      var content = "";

      $(function(){
        $("#file").change(function () {
          $("#path_mp4").val($("#file")[0].files[0].name);
          console.log($("#path_mp4").val($("#file")[0].files[0].name));
        });
    </script>
</body>
</html>