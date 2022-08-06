<?php
namespace App;
//require_once '../Guide.php';
class Request{

    protected $data;
    public function Data_operations($data){

        if ($_SERVER['REQUEST_METHOD']=='POST'){

            foreach ($data as $item){
                $this->data=$this->filterdata($item);

            }

        }
    }

    public function filterdata($data){
        trim($data);
        stripslashes($data);
        htmlspecialchars($data);
    }
    public function getdata(){
        return $this->data;
    }

}
//class To static
class Request_s{
    public static function __callStatic(string $name, array $arguments)
    {
        return (new Request())->$name(...$arguments);
    }
}

