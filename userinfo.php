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
    $sql = "select * from account where id = '$token'";
    $sqlHelper = new SqlHelper();
    $res = $sqlHelper->execute_dql($sql);
    mysql_query("set names utf8");    //设置传输使用gb2312字符集防止乱码。
    if($row = mysql_fetch_assoc($res)){
            $arr=[
                'status'=>true,
                'name'=>$row['name'],
                'phone'=>$row['phone'],
                'headimg'=>$row['headimg'],
                'id'=>$row['id'],
                'city'=>$row['city'],
                'village'=>$row['village']
            ];
           foreach ($arr as $key => $value){
               $arr[$key] = urlencode($value);
           };
            echo urldecode(json_encode($arr));
    }else{
        $arr0=[
            'status'=>false,
            'd'=>[],
        ];
        echo json_encode($arr0);
    }
    
    
    
    
    
  
    


?>