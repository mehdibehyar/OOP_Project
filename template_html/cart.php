<?php
require_once '../Guide.php';
use App\Bascet;
session_start();
$bascet=new Bascet('localhost','oop','root','');
if (isset($_POST['id'])) {
    var_dump($bascet->create_data(['user_id' => $_SESSION['login']['id'], 'product_id' => $_POST['id']])) . "<br>";
}


//get data
$row=$bascet->get_data_I('bascet.id,bascet.product_id,bascet.user_id,
bascet.number,products.nameproduct,products.discount_price,products.image'
    ,"RIGHT JOIN products ON bascet.product_id=products.id WHERE user_id='{$_SESSION['login']['id']}'");

foreach ($row as $item){
    var_dump($item) . "<br>";
}
?>


