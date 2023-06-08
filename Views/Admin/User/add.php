<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel='shortcut icon' href='../public/images/icon.ico' /> -->
    <link rel="shortcut icon" href="Public/images/cropped-douopleeblue-270x270.png">

    <title>DWG Shop - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-5 ">
                <div id="head" class="row">
                    <nav class="navbar navbar-expand-lg bg-secondary navbar-dark">
                        <div class="container-fluid">
                        <!-- <img src="../public/images/icon.ico" width="25" height="25" style=" margin-bottom: 2px;" alt=""> -->
                        <img src="Public/images/cropped-douopleeblue-270x270.png" width="25" height="25" style=" margin-bottom: 2px;" alt="">

                            <a class="navbar-brand" href="index.php?controller=admin">Levents</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
                            <div class="collapse navbar-collapse " id="navbarNavDropdown">
                                <ul class="navbar-nav ms-auto">

                                    <li class="nav-item dropdown">

                                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-user"></i> <?php if(isset($_SESSION['user']) & $_SESSION['role'] == '1'){ echo $_SESSION['user'];}?>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-dark bg-secondary ">
                                            <li><a class="dropdown-item bg-secondary" href="#"><i class="fa-solid fa-user"></i>Profile</a></li>
                            <li><a class="dropdown-item bg-secondary" href="?controller=login&action=logout"> <i class="fa-solid fa-right-from-bracket"></i>Log out</a></li>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div id="search" class="row ms-auto">
                    <nav class="navbar bg-light ">
                        <div class="container-fluid">
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-secondary " type="submit">Search</button>
                            </form>
                        </div>
                    </nav>
                </div>
                <div id="menu" class="row">
                <div class="list-group">
                        <a href="index.php?controller=admin" class="list-group-item list-group-item-action " aria-current="true">
                            <i class="fa-solid fa-gauge"></i> Dashboard
                        </a>
                        <a href="?controller=admin&redirect=user" class="list-group-item list-group-item-action active bg-secondary "><i class="fa-solid fa-user"></i> User management</a>
                        <a href="?controller=admin&redirect=product" class="list-group-item list-group-item-action "><i class="fa-solid fa-shirt"></i> Product management</a>
                        <a href="?controller=admin&redirect=category" class="list-group-item list-group-item-action "><i class="fa-solid fa-list-check"></i> Category management</a>
                        <a href="?controller=admin&redirect=order" class="list-group-item list-group-item-action "><i class="fa-solid fa-cart-shopping"></i> Order management</a>
                        <!-- <a href="?controller=admin&redirect=revenue" class="list-group-item list-group-item-action "><i class="fa-solid fa-dollar-sign"></i> Revenue management</a> -->

                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="row">
                <div class="row">
                    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="index.php?controller=admin"><i class="fa-solid fa-house"></i> Home</a></li>
    <li class="breadcrumb-item"><a class="text-decoration-none text-dark"  href="?controller=admin&redirect=user"><i class="fa-solid fa-user"></i> User management</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add user</li>
  </ol>
</nav>
                    </div>
                   
                    <div class="row">
                        <h3 class="text-danger">Add new member</h3>
                        <div class="row mt-2">
                       
                            <form method="post" action="?controller=<?= $controller ?>&redirect=<?= $redirect ?>&action=store">
                                <!-- <div class="alert alert-danger">Email already exists!</div> -->
                                <?php
                                if(isset($error)){
                                    echo $error;
                                }
                                ?>
                                <div class="mb-3">
                                    <label>Name</label>
                                    <!-- <input name="user_name" required class="form-control" placeholder="username"> -->
                                    <input type="text" name="username" value="" required class="form-control" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                    <input type="email" name="email" required  class="form-control" id="exampleFormControlInput1" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="inputPassword5" class="form-label">Password</label>
                                    <input type="password" required  id="inputPassword5" name="password" class="form-control" aria-describedby="passwordHelpBlock">
                                    <div id="passwordHelpBlock" class="form-text">
                                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Re_Password</label>
                                    <input name="re_password" required type="password" class="form-control">
                                </div>
                               
                                <div class="mb-5">
                                    <label>Choose role</label>
                                    <select class="form-select" name="role" aria-label="Default select example">
                                       
                                        <option value="1">Admin</option>
                                        <option value="0">User</option>
                                      
                                      </select>
                                      <!-- <div class="form-check">
                                    <input class="form-check-input" type="radio"  name="flexRadioDefault " id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                      User
                                     </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio"  name="flexRadioDefault" id="flexRadioDefault2" checked >
                                      <label class="form-check-label" for="flexRadioDefault2">
                                       Admin
                                      </label>
                                    </div>-->
                                </div>


                                <button type="submit" class="btn btn-danger">Add</button>
                                <!-- <button type="reset" class="btn btn-primary">Reset</button> -->

                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js "></script>
</body>

</html>