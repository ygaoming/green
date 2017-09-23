<?php
    require_once "sql.phpHelper.class.php";
    header("Content-type: text/html; charset=utf-8");
    //生成id
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
    //指定允许其他域名访问
    header('Access-Control-Allow-Origin:http://abc.cn');
    //相应类型
    header('Access-Control-Allow-Methods:POST,GET');
    //相应头设置，允许设置token一个http头
    header('Access-Control-Allow-Headers:token');
    //获取http请求头
    $header = apache_request_headers();
    $token = $header['token'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $email = $_POST['email'];
    $id = uuid();
    $sql = "insert into feedback (id,title,content,email,user_id) values('$id','$title','$content','$email','$token')";
    $sqlHelper = new SqlHelper();
    $res = $sqlHelper -> execute_dml($sql);
    mysql_query("set names utf8");    //设置传输使用gb2312字符集防止乱码。
    if($res == 1){
        $arr = [
            'status'=>true,
            'msg'=>'反馈成功'
        ];
        echo json_encode($arr);
    }else{
        $arr = [
            'status'=>true,
            'msg'=>'反馈成功'
        ];
        echo json_encode($arr);
    }
    $sqlHelper ->close_connect();
