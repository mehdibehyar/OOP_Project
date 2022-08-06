<?php
require_once '../Guide.php';
use App\Product_DB;
use App\File_mov;
$products=new Product_DB('localhost','oop','root','');
$row=$products->get_data_I('*');
if (isset($_POST['product_id'])) {
    $unl = new File_mov();

        if ($products->delete_data("WHERE id={$_POST['product_id']}")) {
            if(is_file("./image/{$_POST['name_img']}")) {
                $unl->delete_file("./image/{$_POST['name_img']}");
            }
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Products</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="">

<div class="container mt-3">
    <h2>Product List</h2><br>
    <table class="table border-primary">
        <thead class="table-primary border-5">
        <tr>
            <th>Name Product</th>
            <th>Price</th>
            <th>Discount Price</th>
            <th>Image</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($row as $item){ ?>
            <tr>
                <td><?= $item['nameproduct'] ?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $item['discount_price'] ?></td>
                <td><img src="./image/<?= $item['image'] ?>" width="60px" height="60px"></td>
                <td>
                    <form action="./edit_product.php" method="post">
                        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                        <input type="submit" value="Edit" class="bg-success border-white">
                    </form>
                </td>
                <td>
                    <form action="./products.php" method="post">
                        <input type="hidden" value="<?= $item['id'] ?>" name="product_id">
                        <input type="hidden" name="name_img" value="<?= $item['image'] ?>">
                        <input type="submit" class="bg-danger border-white" value="Delete">
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
