<?php
namespace App;
require_once 'DB.php';
use App\DB;
use PDO;
class User_DB extends DB {
    protected $table='user';
    protected $fetch=PDO::FETCH_ASSOC;

}
//class To static
class User_DB_s{
    public static function __callStatic(string $name, array $arguments)
    {
        return (new User_DB())->$name(...$arguments);
    }
}