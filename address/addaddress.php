<?php 
    require_once "../sql.phpHelper.class.php";
    header("Content-type: text/html; charset=utf-8");
    //指定允许其他域名访问
    header('Access-Control-Allow-Origin:http://abc.cn');
    //相应类型
    header('Access-Control-Allow-Methods:POST,GET');
    //相应头设置，允许设置token一个http头
    header('Access-Control-Allow-Headers:token');
    //获取http请求头
    $header = apache_request_headers();
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
    $token = $header['token'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $defaul = $_POST['defaul'];
    $id = uuid();
    $sql = "insert into address (id,name,phone,address,defaul,user_id) values('$id','$name','$phone','$address','$defaul','$token')";
    $sqlHelper = new SqlHelper();
    $res = $sqlHelper->execute_dml($sql);
    if($res == 1 ){
        $arr = [
            'status'=>true,
            'msg'=>'添加成功'
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
    };
    $sqlHelper->close_connect();
    
    



?>