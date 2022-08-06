<?php
namespace App;
class Sprinkled{
    public function delete_file($file_address){
        unlink($file_address);
    }
}
//class To static
class Sprinkled_s {
    public static function __callStatic(string $name, array $arguments)
    {
        return (new Sprinkled())->$name(...$arguments);
    }
}