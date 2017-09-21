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
    $sql = "select * from address where user_id = '$token'";
    $sqlHelper = new SqlHelper();
    $res = $sqlHelper->execute_dql($sql);
    while ($row = mysql_fetch_array($res,MYSQL_ASSOC)) {
        $data[] = $row;
	}
	
	if(mysql_num_rows($res)>0){
		$arr=[
			'status'=>true,
			'data'=>$data,
			'msg'=>'获取成功'
		];
		echo json_encode($arr);
	}else{
		$arr=[
			'status'=>true,
			'data'=>[],
			'msg'=>'没有数据'
		];
		echo json_encode($arr);
	}
	$sqlHelper->close_connect();
	
    
        
   
    


?> 