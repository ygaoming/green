<?php 
    require_once "../sql.phpHelper.class.php";
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
    $id = $_POST['id'];
    $defaul = $_POST['defaul'];
    //��ʼ��Ĭ�ϵ�ַ
    $sql0 = "update address set defaul ='0' where user_id = '$token'";
    //�޸�Ĭ�ϵ�ַ
    $sql = "update address set defaul ='$defaul' where user_id = '$token' and id = '$id'";
    $sqlHelper = new SqlHelper();
    $res0 = $sqlHelper->execute_dql($sql0);
    $res = $sqlHelper->execute_dql($sql);
    if($res){
        $arr[
            'status'=>true,
            'msg'=>'���óɹ�'
        ];
        echo json_encode($arr);
    }else{
        $arr = [
            'status'=>false,
            'msg'=>'����ʧ��'
        ];
        echo json_encode($arr);
    }
    $sqlHelper->close_content();



?>