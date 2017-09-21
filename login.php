<?php
//header ("Content-Type:text/html;charset=utf8");
require_once 'sql.phpHelper.class.php';

       $phone = $_POST['phone'];
       $loginpwd = $_POST['loginpwd'];
    $SqlHelper = new SqlHelper();
    $sql = "select * from account where phone = $phone";
    $res = $SqlHelper->execute_dql($sql);
    if($row = mysql_fetch_assoc($res)){
    if($row['loginpwd'] == $loginpwd){
        $arr = [
                'status'=>true,
                'token'=>$row['id'],
                'msg'=>'登录成功'
           ];
            foreach($arr as $key => $value) {
                   $arr[$key] = urlencode($value);
               };
          echo urldecode(json_encode($arr));
    }else{
         $arr1 = [
                'status'=>false,
                'msg'=>'密码错误'
            ];
            foreach($arr1 as $key => $value ) {
                               $arr1[$key] = urlencode ($value);
                           };
            echo urldecode(json_encode($arr1));
    }

}else{
    $arr2 = [
        'status'=>false,
        'msg'=>'此账户不存在'
    ];
    foreach ( $arr2 as $key => $value ) {
                       $arr2[$key] = urlencode($value);
                   };
    echo urldecode(json_encode($arr2));
}