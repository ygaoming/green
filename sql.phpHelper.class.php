<?php   
    class SqlHelper{
        public $conn;
        public $dbname="greens";
        public $username="root";
        public $password="66669999";
        public $host="localhost";
        public function __construct(){
            $this->conn=mysql_connect($this->host,$this->username,$this->password);
            mysql_query("SET NAMES utf8");
            if(!$this->conn){
                die(mysql_error());
            }
            mysql_select_db($this->dbname,$this->conn);
        }
        //ִ��dql���
        public function execute_dql($sql){
            $res=mysql_query($sql) or die(mysql_error());
            
            return $res;
    }
    //ִ��dql��䣬���Ƿ��ص���һ������
    public function execute_dql2($sql){
        $arr=array();
        $res=mysql_query($sql,$this->conn) or die(mysql_error());
        mysql_query("set names utf8");    //设置传输使用gb2312字符集防止乱码。
        $i=0;
        //��$res=>$arr
        while($row=mysql_fetch_assoc($res)){
            $arr[$i++]=$row;
        }
        //����Ϳ������ϰ�$res�ر�
        mysql_free_result($res);
        return $arr;
    }
    //ִ��dml���
    public function execute_dml($sql){
        $b=mysql_query($sql,$this->conn) or die(mysql_error());
        if(!$b){
            return 0;
        }else{
            if(mysql_affected_rows($this->conn)>0){
                return 1; //��ʾOK
            }else{
                return 2;//��ʾû�����ܵ�Ӱ��
            }
        }
        
    }
    //�ر����ӵķ���
    public function close_connect(){
        if(!empty($this->conn)){
            mysql_close($this->conn);
        }
        
    }
    //将数组转为json兼容中文
    //public function JSON($array) {
        //arrayRecursive($array, 'urlencode', true);
        //$json = json_encode($array);
        //return urldecode($json);
   // }
   
    
    }
    
