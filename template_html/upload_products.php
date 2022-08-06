<?php
require_once '../Guide.php';
use App\Product_DB;
use App\Validation;
use App\File_mov;
//object is Validation whit app
$validation=new Validation();



//required whit filds
$ok=1;
if (isset($_POST['nameproduct'])) {
    if ($validation->is_required($_POST)) {
//        echo 'okokokokokoko';
    } else {
        $ok = 0;
        $key = $validation->getkey($_POST);
        $validation->create_error($key, 'fild is required');
    }


    //validation To file size
    if ($validation->file_size('image',1000000)==false){
        $ok=0;
        $validation->create_error('file_size','The file size exceeds the limit');
    }
    $target_file = 'image' . basename($_FILES["image"]["name"]);
    $type_data = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    //validation To file type
    if ($validation->file_type(['jpg','png','jpeg','gif'],$type_data)==false){
        $ok=0;
        $validation->create_error('file_type','Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
    }



    //validation To file unique
    if ($validation->file_unique($target_file)==false){
        $ok=0;
        $validation->create_error('file_unique','The file already exists');
    }


    //check validation ok
    if ($ok==1){

        $product_db=new Product_DB('localhost','oop','root','');

        //Import file data to post
        $product_db->key_add('image',$_FILES['image']['name'],$_POST);
        $data=$product_db->get_key_add();

        //create data and check create
        if ($product_db->create_data($data)==true){

            $fil_mov=new File_mov();
            $target_file = 'image/' . basename($_FILES["image"]["name"]);
            //file move and check file move
            if (!$fil_mov->upload_file('image',$target_file)){
                $validation->create_error('upload_error','do not upload file');
            }else{
                $successful='create product successfuly';
            }


        }

    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <title>Upload_Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- Section: Design Block -->
<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-primary" style="
        height: 300px;
        "></div>
    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
        <div class="card-body py-5 px-md-5">

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-5">Sign up now</h2>
                    <form action="./upload_products.php" method="post" enctype="multipart/form-data">

                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1">Name_Product</label>
                                    <input type="text" id="form3Example1" class="form-control" name="nameproduct" maxlength="50" />

                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example2">Price</label>
                                    <input type="text" id="form3Example2" class="form-control" name="price" maxlength="50" />

                                </div>
                            </div>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Discount_Price</label>
                            <input type="text" id="form3Example3" class="form-control" name="discount_price" maxlength="150" />

                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4">Image</label>
                            <input type="file" name="image" class="form-control bg-success" >
                        </div>

                        <!-- Submit button -->
                        <!--                        <button type="submit" class="btn btn-primary btn-block mb-4" name="send" value="send">-->
                        <!--                            Sign up-->
                        <!--                        </button>-->
                        <input type="submit" class="bg-primary border-secondary"><br>
                        <div class="card bg-primary border-56">
                            <?php $errors=$validation->get_errors() ?>
                            <?php foreach ($errors as $key=>$item){ ?>
                                <h4 style="text-align: left; color: red;"><?php echo $key . " " . $item . "<br>"?></h4>
                            <?php }?>
                        </div>
                        <?php if (isset($successful)){ ?>
                            <div class="card text-success">
                                <?php echo $successful ?>
                            </div>
                        <?php } ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section: Design Block -->
</body>
</html>
