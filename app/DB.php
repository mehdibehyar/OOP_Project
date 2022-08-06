<?php
namespace App;
use App\DBInterface;
use MongoDB\Driver\Exception\ConnectionException;
use PDO;
use Exception;
class DB{
    protected $table='user';
    protected $fetch=PDO::FETCH_ASSOC;

    //values To connected ODP
    public function __construct(protected $host,protected $dbname,protected $username,protected $password){}


    //create data
    public function create_data($data){
        $fild_POST=$this->valu_fild_post($data);
        $fild_DB=$this->valu_fild_db($data);
        try {
            $conn =new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username,$this->password);
            $stmt=$conn->prepare("INSERT INTO {$this->table}({$fild_DB}) VALUES ({$fild_POST})");
            $stmt->execute($data);
            return true;
        }catch (Exception $e){
            return $e->getMessage() . "line:" . $e->getLine() . "file:" . $e->getFile();
        }

    }


    //update data
    public function update_data($data,$where=""){
        try {
            $key_post=$this->valu_fild_post($data);
            $conn =new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username,$this->password);
            $stmt=$conn->prepare("UPDATE {$this->table} SET '{$key_post}'{$where}");
            $stmt->execute($data);
            return true;
        }catch (Exception $e){
            return $e;
        }



    }


    //delete data
    public function delete_data($where){
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // sql to delete a record
            $sql = "DELETE FROM {$this->table} {$where}";
            $conn->exec($sql);
            return true;
        }catch (\PDOException $e){
            return $e->getMessage();
        }
        $conn=null;
    }


    //get data
    public function get_data($dataget,$where=''){

        try {
            $conn =new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username,$this->password);
            $stmt=$conn->prepare("SELECT {$dataget} FROM {$this->table} {$where}");
            $stmt->execute();
            return $stmt->fetch($this->fetch);
        }catch (Exception $e){
            return $e->getMessage() . "line:" . $e->getLine();
        }
    }


    //values fild post whit function create_data
    public function valu_fild_post($data){
        $key=array_keys($data);
        return join(',',array_map(function ($item){
            return ":" . $item;
        },$key));

    }


    //values fild db whit function create_data
    public function valu_fild_db($data){
        $key=array_keys($data);
        return join(',',$key);
    }

}


