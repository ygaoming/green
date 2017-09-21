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
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $detail = $_POST['detail'];
    $sql = "update address set name = '$name',phone = '$phone',address = '$detail' where user_id = '$token' and id='$id'";
    $sqlHelper = new SqlHelper();
    $res = $sqlHelper->execute_dql($sql);
    if(mysql_affected_rows() > 0){
        $arr = ['status'=>true,'msg'=>'修改成功'];
        echo json_encode($arr);
    }else{
        $arr = [
            'status'=>true,
            'msg'=>'修改失败'
        ];
        echo json_encode($arr);
    }
    $sqlHelper->close_connect();

?>