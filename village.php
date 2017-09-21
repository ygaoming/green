<?php 
    require_once 'sql.phpHelper.class.php';
    header("Content-type: text/html; charset=utf-8");
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
    $village = $_POST['village'];
    $sql = "update account set village = '$village' where id = '$token'";
    $sqlHelper = new SqlHelper();
    $sqlHelper->execute_dql($sql);
    if(mysql_affected_rows() > 0){
        $arr = [
            'status'=>true,
            'msg'=>'修改成功'
        ];
        foreach($arr as $key => $value){
            $arr[$key] = urlencode($value);
        };
        echo urldecode(json_encode($arr));
    }else{
        $arr = [
            'status'=>false,
            'msg'=>'修改失败'
        ];
        foreach($arr as $key => $value){
            $arr[$key] = urlencode($value);
        };
        echo urldecode(json_encode($arr));
    }
    $sqlHelper->close_connect();
    
    

?>