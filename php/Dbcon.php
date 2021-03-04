<?php               //数据库连接类
class Dbcon{
    private $con;
    private $sql = "";
    private $res = "";

    public function __construct()
    {
        $servername = "localhost";
        $password = "ruanjian";

//            用于开发环境
//            $username = "web";
//            $dbname = "web";

//              用于生产环境
        $dbname = "web";
        $username = "web";

        $this->con = new mysqli($servername, $username, $password, $dbname);
        if ($this->con->connect_error){
            return 1;
        }
        else return 0;
    }
    public function __destruct(){
        $this->con->close();
    }

    public function setSql($str){
        $this->sql = $str;
        $this->res = $this->con->query($this->sql);
    }
    public function getRes(){
        return $this->res;
    }

    public function prepare($sql){
        return $this->con->prepare($sql);
    }

    public function affected_rows(){
        return mysqli_affected_rows($this->con);
    }
}
