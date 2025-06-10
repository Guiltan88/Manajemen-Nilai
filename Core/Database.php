<?php
class Database{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "manajemennilai";
    private $conn;
    function __construct(){
        $this->conn = new mysqli($this->servername, $this->username, 
        $this->password, $this->database);
    }
        public function execute($sql){
            $result = mysqli_query($this->conn, $sql);
            $data = [];
            while ($row = mysqli_fetch_array($result)){
                $data[]=$row;
            }
            return $data;
        }
        public function delete($table,$where){
            $status=false;
            $query="DELETE FROM $table WHERE $where";
            $result=mysqli_query($this->conn, $query);

            if ($result){
                $affectedRows=mysqli_affected_rows($this->conn);
                if ($affectedRows>0){
                    $status=true;
                }
            }else{
                $status=false;
            }
            return $status;
        }
        public function insert($table, $col, $values){
            $status=false;
            $f="";
            foreach($col as $val){
                $f.=$val.',';
            }
            $f = rtrim($f,",");
            $v="";
            foreach($values as $val){
                $v.="'".$val."',";
            }
            $v = rtrim($v,",");
            $query = "INSERT INTO $table ($f) VALUES ($v)";
            $result = mysqli_query($this->conn, $query);

            if ($result){
                $affectedRows=mysqli_affected_rows($this->conn);
                if ($affectedRows>0){
                    $status=true;
                }
            }else{
                $status=false;
            }
            return $status;
        }
        public function getConnection(){
            return $this->conn;
        }
    }
?>