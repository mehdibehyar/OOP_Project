<?php
//auotoload to app
require_once '../Guide.php';

//classes whit directory app
use App\Request;
use App\Validation;
use App\DB;
use App\User_DB;

//object is Validation whit app
$validation=new Validation();



//required whit filds
$ok=1;
if (isset($_POST['name'])) {
    if ($validation->is_required($_POST)) {
//        echo 'okokokokokoko';
    } else {
        $ok = 0;
        $key = $validation->getkey($_POST);
        $validation->create_error($key, 'fild is required');
    }

//max_count to password is 64
    if ($validation->max_count($_POST['password'], 64) == false) {
        $ok = 0;
        $validation->create_error('password', 'More than 64 characters');
    }


//max_count to username is 50
    if ($validation->max_count($_POST['username'], 50) == false) {
        $ok = 0;
        $validation->create_error('username', 'more than 50 characters');
    }


//max_count to name is 50
    if ($validation->max_count($_POST['name'], 50) == false) {
        $ok = 0;
        $validation->create_error('name', 'more than 50 characters');
    }


//max_count to email is 150
    if ($validation->max_count($_POST['email'], 150) == false) {
        $ok = 0;
        $validation->create_error('email', 'more than 150 characters');
    }
}

//insert data whit database
if ($ok==1) {
    $db = new User_DB('localhost', 'oop', 'root', '');
    if ($db->create_data($_POST)==true){

    }
    header('./index.php',true);
}



?>
<!doctype html>
<html lang="en">
<head>
    <title>login</title>
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
                    <form action="register.php" method="post">

                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1">full_name</label>
                                    <input type="text" id="form3Example1" class="form-control" name="name" maxlength="50" />

                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example2">username</label>
                                    <input type="text" id="form3Example2" class="form-control" name="username" maxlength="50" />

                                </div>
                            </div>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Email address</label>
                            <input type="email" id="form3Example3" class="form-control" name="email" maxlength="150" />

                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4">Password</label>
                            <input type="password" id="form3Example4" class="form-control" name="password" maxlength="64" />

                        </div>

                        <!-- Submit button -->
<!--                        <button type="submit" class="btn btn-primary btn-block mb-4" name="send" value="send">-->
<!--                            Sign up-->
<!--                        </button>-->
                        <input type="submit">

                         Register buttons
                        <div class="text-center">
                            <p>or sign up with:</p>
                            <a href="./login.php" style="text-align: center"><i>login</i></a>
                        </div>
                        <br>
                        <div class="card bg-primary border-56">
                            <?php $errors=$validation->get_errors() ?>
                            <?php foreach ($errors as $key=>$item){ ?>
                                <h4 style="text-align: left; color: red;"><?php echo $key . " " . $item . "<br>"?></h4>
                            <?php }?>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section: Design Block -->
</body>
</html>
