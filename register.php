<?php 
    require_once 'sql.phpHelper.class.php';
   
    header("Content-type: text/html; charset=utf-8");
    function uuid() {
        if (function_exists ( 'com_create_guid' )) {
            return com_create_guid ();
        } else {
            mt_srand ( ( double ) microtime () * 10000 ); //optional for php 4.2.0 and up.随便数播种，4.2.0以后不需要了。
            $charid = strtoupper ( md5 ( uniqid ( rand (), true ) ) ); //根据当前时间（微秒计）生成唯一id.
            $hyphen = chr ( 45 ); // "-"
            $uuid = '' . //chr(123)// "{"
                substr ( $charid, 0, 8 ) . $hyphen . substr ( $charid, 8, 4 ) . $hyphen . substr ( $charid, 12, 4 ) . $hyphen . substr ( $charid, 16, 4 ) . $hyphen . substr ( $charid, 20, 12 );
            //.chr(125);// "}"
            return $uuid;
        }
    }
    
     $phone = $_POST['phone'];
     $paypwd = $_POST['paypwd'];
     $loginpwd = $_POST['loginpwd'];
     $id = uuid();
     $name = '未设昵称';
     $headimg = 'http://192.168.0.143:8080/greens/headimg.jpg';
     
   
   
     //echo $result;
     //$token = Md5($phone + $paypwd + $loginpwd + $id + $name + $headimg);
     //echo $phone.''.$paypwd.''.$loginpwd.''.$id.''.$name.''.$headimg.''.$token;
    $sql = "insert into account (id,name,phone,paypwd,headimg,loginpwd) values('$id','$name','$phone','$paypwd','$headimg','$loginpwd')" ;
    $sqlHelper = new SqlHelper();
    $res = $sqlHelper->execute_dml($sql);
    mysql_query("set names gb2312");    //设置传输使用gb2312字符集防止乱码。
    //echo $res;
    if($res == 1){
        $arr = [
            'status'=>true,
            'msg'=>'注册成功'
        ];
        foreach($arr as $key => $value) {
                   $arr[$key] = urlencode($value);
               };
          echo urldecode(json_encode($arr));
    }else{
        $arr1 = [
            'status'=>false,
            'msg'=>'注册失败'
        ];
         foreach($arr1 as $key => $value) {
                   $arr[$key] = urlencode($value);
               };
          echo urldecode(json_encode($arr1));
    }
    //关闭资源
    $sqlHelper->close_connect();
    
     
       
        




   
?>