<?php
namespace App;
require_once 'DB.php';
use App\DB;
use PDO;

class Product_DB extends DB {
    protected $datarr=[];
    protected $fetch=PDO::FETCH_ASSOC;
    protected $table='products';
    public function key_add($key,$value,$data){
        $this->datarr=[
            "$key"=>$value
        ];
        foreach ($data as $key=>$item){
            $this->datarr[$key]=$item;

        }
    }
    public function get_key_add(){
        return $this->datarr;
    }



    //get data unique To product_DB
    public function get_data_I($dataget,$where='')
    {
        try {
            $conn =new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username,$this->password);
            $stmt=$conn->prepare("SELECT {$dataget} FROM {$this->table} {$where}");
            $stmt->execute();
            return $stmt->fetchAll($this->fetch);
        }catch (Exception $e){
            return $e->getMessage() . "line:" . $e->getLine();
        }
    }

}
////class To static
//class Product_DB_s{
//    public static function __callStatic(string $name, array $arguments)
//    {
//        return (new Product_DB())->$name(...$arguments);
//    }
//}

