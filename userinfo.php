<?php 
    require_once 'sql.phpHelper.class.php';
    header("Content-type: text/html; charset=utf-8");
    //ָ������������������
    header('Access-Control-Allow-Origin:http://abc.cn');
    //��Ӧ����
    header('Access-Control-Allow-Methods:POST,GET');
    //��Ӧͷ���ã���������tokenһ��httpͷ
    header('Access-Control-Allow-Headers:token');
    //��ȡhttp����ͷ
    $header = apache_request_headers();
    $token = $header['token'];
    $sql = "select * from account where id = '$token'";
    $sqlHelper = new SqlHelper();
    $res = $sqlHelper->execute_dql($sql);
    mysql_query("set names utf8");    //���ô���ʹ��gb2312�ַ�����ֹ���롣
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