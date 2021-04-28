<?php 
    // 首先对上传的文件类型进行区分
    function getFile(){
        $i = 0;
        foreach($_FILES as $file) {
            // 如果上传的是单个文件的话
            if(is_string($file['name'])){
                $files[$i] = $file;
                $i++;
            }
            // 如果上传多个文件的话
            elseif(is_array($file['name'])){
                foreach($file['name'] as $key => $value){
                    /*
                        1、$file中的第0个元素即name的值，放在files数组中的第0个的name位置
                    */
                    $files[$i]['name'] =    $file['name'][$key];
                    $files[$i]['type'] =    $file['type'][$key];
                    $files[$i]['tmp_name'] =    $file['tmp_name'][$key];
                    $files[$i]['error'] =    $file['error'][$key];
                    $files[$i]['size'] =    $file['size'][$key];
                    $i++;
                }
            }
        }
        return $files;
    }
    // 封装函数（对多种文件上传都有效）
    function uploadFiles($fileinfo, $arrExt=array('txt', 'mp4', 'pdf'), $flag = true, $path = './video'){
        $arrmime = array('mp4'=>'video/mpeg4', 'pdf'=>'application/pdf', 'txt'=>'text/plain');
        if($fileinfo['error'] == UPLOAD_ERR_OK){
            // 检测文件类型
            $ext = pathinfo($fileinfo['name'], PATHINFO_EXTENSION);
            if(!@in_array($ext, $arrExt)){
                $echo['mes'] = $fileinfo['name'].'文件类型不被允许';
            }

            // 检测文件是否是HTTP POST上传
            if(!is_uploaded_file($fileinfo['tmp_name'])){
                $echo['mes'] = $fileinfo['name'].'上传文件不是通过HTTP POST上传的';
            }
            if($flag){
                // 判断上传的文件是否是对应的真实的文件
                $finfo = finfo_open(FILEINFO_MIME_TYPE);//返回 mime 类型。
                $mimetype = finfo_file($finfo, $fileinfo['tmp_name']);
                finfo_close($finfo);
                if($mimetype != $arrmime[$ext]){
                    $echo['mes'] = $fileinfo['name'].'上传文件修篡改！';
                }
            }
            if(!empty($echo)){
                return $echo;
            }
            if(!file_exists($path)){
                // 创建
                mkdir($path, 0777, true);
                chmod($path, 0777);
            }
            // 创建唯一的文件名防止产生覆盖
            $uniname = md5(uniqid(microtime(true), true));
            // 确定文件的具体位置和名字类型
            $destination = sprintf("%s/%s.%s", $path, $uniname, $ext);
            if(@move_uploaded_file($fileinfo['tmp_name'], $destination)){
                $echo['mes'] = '文件：'.$fileinfo['name'].'上传文件成功';
                return $echo;
            }else{
                $echo['mes'] = '文件：'.$fileinfo['name'].'上传文件失败';
            }
        }else{
            switch ($fileinfo['error']){
                case 1:
                    $echo['mes'] = '上传的文件超过了在PHP.INI中的最大上传文件值';
                    break;
                case 2:
                    $echo['mes'] = '上传的文件超过了max_file_size的选定值';
                    break;
                case 3:
                    $echo['mes'] = '只有部分文件上传';
                    break;
                case 4:
                    $echo['mes'] = '没有选定的文件被上传';
                    break;
                case 6:
                    $echo['mes'] = '找不到临时文件';
                    break;
                case 7:
                    $echo['mes'] = '文件写入失败';
                    break;
                case 8:
                    $echo['mes'] = '上传文件被PHP扩展程序中断';
                    break;
            }
            return $echo;
        }
    }
?>