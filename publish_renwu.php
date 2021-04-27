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
    
    <title>我的发布</title>
</head>
<body>
    <div class="container">
      <!-- 顶部标题 -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-5">发布任务</h1>
        </div>
      </div>
      <!-- 中间文章标题和tag -->
      <form method="post" id="title_and_tag" class="was-validated">
        <br>
        <div class="input-group mb-3 col-md-6">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">任务名称</span>
          </div>
          <input id="title_publish" type="text" class="form-control" placeholder="请输入名称" aria-label="Username" aria-describedby="basic-addon1" required>
        </div>
        <div class="form-group col-md-6" >
          <select class="custom-select" id="tag" required >
            <option value="">选择任务对应的tag</option>
            <option value="1">安全研究</option>
            <option value="2">安全开发</option>
            <option value="3">安全服务</option>
          </select>
          <div class="invalid-feedback">必须选择任务对应的tag</div>
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
      <!-- 文章内容 -->
      <!-- 富文本输入框 -->
      <!-- 此处对上传的图片和文字并没有验证 -->
        <form method="POST" id="info">
          <textarea id="summernote"name="editordata"></textarea>
          <br>
          <input id="publish" class="btn btn-primary" type="button" value="发布">
        </form>

      </div>
    <script>
      var content = "";
      $('#summernote').summernote({
        placeholder:'Hello',
        tabsize:2,
        height:300,
        lang:'zh-cmn-Hans',
        focus:true,
        callbacks: {
          onChange: function(contents, $editable) {
            content = contents;
            // test = $editable;
            // console.log(contents);
          }
        }
      });
      $(function(){
        $("#file").change(function () {
          $("#path_mp4").val($("#file")[0].files[0].name);
          console.log($("#path_mp4").val($("#file")[0].files[0].name));
        });
        // 监听按钮
        $('#publish').click(function(){
          // 处理图片，我们把所有的代码都存入到txt文件中，然后再在数据库中存储索引！！！
          var code = $("#summernote").summernote("code");
          var tag = $('#tag')[0].value;
          var title = $('#title_publish').val();

          $.ajax({
            type: 'POST',
            url: 'check_publish.php',
            dataType: 'json',
            data: {
              publish_text: code,
              tag:          tag  ,
              title:        title
            },
            success: function(data){
              // alert(data["title"]);
              //  console.log(data);
            }
          });
        });
      });
    </script>
</body>
</html>