<?php 

    require_once 'sql.phpHelper.class.php';
    
    header("Content-type: text/html; charset=utf-8");
    //指定允许其他域名访问
    header('Access-Control-Allow-Origin:http://abc.cn');
    //相应类型
    header('Access-Control-Allow-Methods:POST,GET');
    //相应头设置，允许设置token一个http头
    header('Access-Control-Allow-Headers:token');
    //获取http请求头
    $header = apache_request_headers();
    $token = $header['token'];
   //图片后缀名数组
   $allowedExts = array("gif","jpeg","jpg","png");
   //把文件名以逗号分割成一个数组
   $temp = explode(".",$_FILES['file']['name']);
   //等到数组最后一个，即是后缀名
   $extension = end($temp);
   if((($_FILES['file']['type'] == "image/gif") || ($_FILES['file']['type'] == "image/jpeg") || 
       ($_FILES['file']['type'] == "image/jpg") || ($_FILES['file']['type'] == "image/pjpeg") || 
       ($_FILES['file']['type'] == "image/x-png") || ($_FILES['file']['type'] == "image/png")) && 
       ($_FILES['file']['size'] < 2*1024*1024) && in_array($extension,$allowedExts)){
       if($_FILES['file']['error'] > 0){
           $arr['status'] = urlencode(false);
           $arr['msg'] = urlencode('文件错误');
           echo urldecode(josn_encode($arr));
       }else{
           if($_FILES['file']['type'] == 'image/gir'){
               $img = mktime().rand(1,10000).'.gif';
           }else if($_FILES["file"]["type"] == "image/jpeg" || $_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/pjpeg"){
               $img = mktime().rand(1,10000).'.jpg';
           }else{
               $img = mktime().rand(1,10000).'.png';
           }
           if(is_uploaded_file($_FILES['file']['tmp_name'])){
               $uploaded_file = $_FILES['file']['tmp_name'];
               $move_to_file = $_SERVER['DOCUMENT_ROOT'].'/greens/up/'.$img;
               if(move_uploaded_file($uploaded_file, $move_to_file)){
                   $headimg = 'http://192.168.0.143:8080/greens/up/'.$img;
                   //存数据库
                   $sql = "update account set headimg = '$headimg' where token = '$token'";
                   $sqlHelper = new SqlHelper();
                   $res = $sqlHelper->execute_dql($sql);
                   if(mysql_affected_rows() > 0){
                       $arr = [
                           'status'=>true,
                           'msg'=>'修改头像成功',
                           'path'=>'http://192.168.0.143:8080/greens/up/'.$img
                       ];
                       foreach($arr as $key => $value){
                           $arr[$key] = urlencode($value);
                       };
                       echo urldecode(json_encode($arr));
                   }else{
                       $arr = [
                           'status'=>false,
                           'msg'=>'存数据库失败',
                       ];
                       foreach($arr as $key => $value){
                           $arr[$key] = urlencode($value);
                       };
                       echo urldecode(json_encode($arr));
                   }
               }else{
                   $arr['status'] = urlencode(false);
                   $arr['msg'] = urlencode('不是post方式上传的');
                   echo json_encode($arr);
               };
           
           }else{
               $arr['status'] = urlencode(false);
               $arr['msg'] = urlencode('图片类型，大小不符合');
               echo urldecode(json_encode($arr));
           }
       }
   }
    
 
 
   
   // $sql = "update account set headimg = '$headimg' where token = '$token'";
    //$sqlHelper = new SqlHelper();
    //$res = $sqlHelper->execute_dql($sql);
   // echo mysql_affected_rows();
//     if(mysql_affected_rows() > 0){
//         $arr = [
//             'status'=>true,
//             'msg'=>'修改头像成功'
//         ];
//         foreach($arr as $key => $value){
//             $arr[$key] = urlencode($value);
//         };
//         echo urldecode(json_encode($arr));
//     }else{
//         $arr1 = [
//             'status'=>false,
//             'msg'=>'修改头像失败'
//         ];
//         foreach($arr1 as $key => $value){
//             $arr1[$key] = urlencode($value);
//         };
//         echo urldecode(json_encode($arr1));
//     }
?>