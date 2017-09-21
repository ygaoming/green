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
    //echo $id;
    $sql = "delete from address where user_id = '$token' and id = '$id'";
    $sqlHelper = new SqlHelper();
    $res = $sqlHelper->execute_dql($sql);
    if(mysql_affected_rows() > 0){
        $arr = [
            'status'=>true,
            'msg'=>'删除成功'
        ];
        echo json_encode($arr);
    }else{
        $arr = [
            'status'=>true,
            'msg'=>'删除失败'
        ];
        echo json_encode($arr);
    }
    $sqlHelper->close_connect();


?>