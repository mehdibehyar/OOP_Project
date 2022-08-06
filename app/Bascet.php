<?php
namespace App;
require_once 'DB.php';
use App\DB;
use PDO;
class Bascet extends DB {
    protected $fetch=PDO::FETCH_ASSOC;
    protected $table='bascet';
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