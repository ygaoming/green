<?php 
    //验证码登录
    require_once 'sql.phpHelper.class.php';
    header("Content-type: text/html; charset=utf-8");
    $phone = '13599925721';
    $sql = "select * from account where phone = $phone";
    
    $sqlHelper = new SqlHelper(); 
    $res = $sqlHelper->execute_dql($sql);
    mysql_query("set names utf8");    //设置传输使用gb2312字符集防止乱码。
    if($row = mysql_fetch_assoc($res)){
        $arr = [
            'status'=>true,
            'token'=>$row['id'],
            'msg'=>'有此用户'
        ];
        foreach($arr as $key => $value) {
            $arr[$key] = urlencode($value);
        };
        echo urldecode(json_encode($arr));
    }else{
        $arr1 = [
            'status'=>false,
            'msg'=>'此用户还未注册'
        ];
        foreach($arr1 as $key => $value) {
            $arr1[$key] = urlencode($value);
        };
        echo urldecode(json_encode($arr1));
    }
    $sqlHelper->close_connect();

?>