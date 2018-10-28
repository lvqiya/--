<?php 
//参数1: $_FILES并包含第一维下标
//参数2: 文件保存根目录
//参数3: 允许上传类型，文件后缀
function uploadFile ($file, $rootPath, $type) {
    define('ROOT_PATH', '/admin/upload/');
    if ($file['error'] == 0) {
        //获取文件后缀
        // 获取文件名的最后一个 . 的下标
        $pos = strrpos($file['name'], '.');
        // 截取 . 之后的字符串
        $ext = substr($file['name'], $pos);
        //echo $ext;

        //判断上传文件类型是否属于允许的类型
        if (in_array($ext, $type)) {
            //重命名文件
            $new_file = time() . rand(10000, 99999) . $ext;

            //将文件从临时路径移动到img目录下
            $path = ROOT_PATH . $new_file;
            
            if (@move_uploaded_file($file['tmp_name'], $rootPath . $new_file)) {
                return $path;
            } else {
                //文件移动失败
                return false;
            }

        } else {
            //上传类型不允许
            return false;
        }
    } else {
        //上传文件失败
        return false;
    }
}

?>