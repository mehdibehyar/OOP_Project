<?php
namespace App;
class Validation{
    //isset
    //create_error
    //is required
    //max count
    //min count
    //unique
    protected array $errors=[];
    //create error
    public function create_error($key,$mess){
        $this->errors[$key]=$mess;
    }



    //required
    public function is_required(array $data){
        if ($this->remethod()){
            $emp=array_map(function ($item){return $item!='';},$data);
            $key=$this->getkey($data);
            if (in_array(false,$emp)){
                return false;
            }else{
                return true;
            }
        }
    }


    //get method
    public function remethod(){
        return $_SERVER['REQUEST_METHOD']=='POST';
    }


    //get key array
    public function getkey($data){
        foreach ($data as $key=>$item){
            if ($item==''){
                return $key;
            }
        }
    }


    //max count fild
    public function max_count($input,$max){
        if (strlen($input)>$max){
            return false;
        }else{
            return true;
        }
    }

    //min count array
    public function min_count($input,$min){
        if (strlen($input)<$min){
            return false;
        }else{
            return true;
        }
    }


    //get errors
    public function get_errors(){
        return $this->errors;
    }

//    public function unique(){
//
//    }



    //Validation To files
    public function file_size($fild_name,$max_size){
        if ($_FILES[$fild_name]['size']>$max_size){
            return false;
        }else{
            return true;
        }
    }


//validation To file unique
    public function file_unique($target_file){
        if (file_exists($target_file)){
            return false;
        }else{
            return true;
        }
    }


//validation To file type
    public function file_type($types,$type_data){
        if (in_array($type_data,$types)){
            return true;
        }
        else{
            return false;
        }
    }

}
//class To static
class Validation_s{
    public static function __callStatic(string $name, array $arguments)
    {
        return (new Validation())->$name(...$arguments);
    }
}