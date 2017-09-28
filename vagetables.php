<?php
require_once "sql.phpHelper.class.php";
header("Content-type: text/html; charset=utf-8");
$sql = "select * from vagetables";
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