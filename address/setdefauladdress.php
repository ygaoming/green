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
    $token = $header['token'];
    $id = $_POST['id'];
    $defaul = $_POST['defaul'];
    //初始化默认地址
    $sql0 = "update address set defaul ='0' where user_id = '$token'";
    //修改默认地址
    $sql = "update address set defaul ='$defaul' where user_id = '$token' and id = '$id'";
    $sqlHelper = new SqlHelper();
    $res0 = $sqlHelper->execute_dql($sql0);
    $res = $sqlHelper->execute_dql($sql);
    if(mysql_affected_rows() > 0){
        $arr = [
            'status'=>true,
            'msg'=>'设置成功'
        ];
        echo json_encode($arr);
    }else{
        $arr = [
            'status'=>false,
            'msg'=>'设置失败'
        ];
        echo json_encode($arr);
    }
    $sqlHelper->close_connect();



?>