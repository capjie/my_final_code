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
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
    
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
        <!-- 上传文件 -->
        <div class="form-group">
            <div class="input-group mb-3 col-md-6">
                <input class="form-control"  type="text" id="path_file" onclick="$('#file_upload').click()" placeholder='点击我添加文件' readonly>
                <button type="button" class="btn btn-success" id="upload_files">文件上传</button>
            </div>
            <input name='upload_file[]' type="file" multiple="multiple" class="form-control" id="file_upload" style="display:none"/>
        </div>
        <!-- <div id="qwe"></div> -->
    </div>

    
    <script>
        var clear_path = document.getElementById('path_file');
        clear_path.outerHTML = clear_path.outerHTML; 
        $(function(){
            $("#file_upload").change(function () {
                // $("#path_file").val($("#file_upload")[0].files[0].name);

                var files_upload = document.getElementById("file_upload").files;
                var path_name_str = "";
                for (var i = 0; i < files_upload.length; i++) {
                    //打印所有的文件名
                    // console.log(files_upload[i].name);

                    var ext = files_upload[i].name.split('.')[1];
                    // console.log(ext_vedio);
                    if(ext != 'mp4' && ext !='pdf' && ext!='txt'){
                        alert('请勿上传非法文件');
                        window.location.reload();
                    }else{
                        path_name_str = path_name_str + files_upload[i].name+"；";
                    }
                }
                $("#path_file").val(path_name_str);
                // console.log(files_upload);
                // 上传的文件名的后缀
                // var ext = $("#file_upload")[0].files[0].name.split('.')[1];
                // // console.log(ext_vedio);
                // if(ext != 'mp4' && ext !='pdf' && ext!='txt'){
                //     alert('请勿上传非法文件');
                //     var clear_path = document.getElementById('path_file');
                //     clear_path.outerHTML = clear_path.outerHTML; 
                // }
                // console.log($("#file_upload")[0]);
            });

            $('#upload_files').click(function(){
                var files_upload = document.getElementById("file_upload").files;
                // 旧的上传文件代码
                var fd = new FormData();
                for (var i = 0; i < files_upload.length; i++) {
                    fd.append(i, files_upload[i]);
                    console.log(files_upload[i]);
                }
                console.log(fd.get(0));
                // console.log(typeof(files_upload));
                // 旧的上传文件方法只能上传一个文件
                // fd.append("upfile_name", $("#file_upload")[0].files[0].name);
                // fd.append("upfile", $("#file_upload")[0].files[0]);
                // console.log($("#file_upload")[0].files[0].name);
                // console.log($("#file_upload")[0].files[0]);
                // console.log(fd.get("upfile_name"));
                // console.log(fd.get("upfile"));
                // 生成其他按钮的方法
                // var new_btn = `<div class="form-group">
                //         <div class="input-group mb-3 col-md-6">
                //             <input class="form-control" type="text" id="path_file" onclick="$('#file_upload').click()" readonly>
                //             <span id="upload_vedio" class="btn btn-info input-group-addon" onclick="$('#file_upload').click()">
                //             <i class="glyphicon glyphicon-cloud-upload"></i>
                //             文件上传
                //             </span>
                //         </div>
                //         <input type="file" class="form-control" id="file_upload" style="display:none"/>
                //     </div>`;
                // document.getElementById("qwe").innerHTML = new_btn;

                $.ajax({
                    type: 'POST',
                    url: '/test/use_upload_test.php',
                    data: fd,
                    cache: false,//上传文件无需缓存
                    processData: false,//用于对data参数进行序列化处理 这里必须false
                    contentType: false, //必须
                    
                    success: function(res){
                        console.log(res);
                        if(res.indexOf('篡改') != -1){
                            alert('停止你的攻击行为!');
                            $(".form-group input").val("");
                            window.location.reload();
                            // var clear_path_3 = document.getElementById('file_upload');
                            // clear_path_3.outerHTML = clear_path_3.outerHTML; 
                        }else if(res.indexOf('成功') != -1){
                            alert('上传成功');
                            $(".form-group input").val("");
                            // var clear_path_3 = document.getElementById('file_upload');
                            // clear_path_3.outerHTML = clear_path_3.outerHTML; 
                            window.location.reload();
                        }else{
                            alert('上传失败')
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>