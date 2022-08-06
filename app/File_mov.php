<?php
namespace App;
class File_mov{

    public function upload_file($fild_name,$target_file){
        return move_uploaded_file($_FILES[$fild_name]['tmp_name'],$target_file);
    }

    //Delete file
    public function delete_file($file_address){
        return unlink($file_address);
    }

}
class File_mov_s {
    public static function __callStatic(string $name, array $arguments)
    {
        return (new File_mov())->$name(...$arguments);
    }
}
