<?php
// include_once("../config/db.php");
// $sqlAllcategories = "SELECT * FROM category ORDER BY id_cate ASC";
// $queryAllCategories = mysqli_query($conn,$sqlAllcategories);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel='shortcut icon' href='../public/images/icon.ico' /> -->
    <link rel="shortcut icon" href="Public/images/cropped-douopleeblue-270x270.png">

    <title>Levents - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="ckeditor_4.20.2_standard/ckeditor/ckeditor.js" ></script>
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
                        <a href="?controller=admin" class="list-group-item list-group-item-action " aria-current="true">
                            <i class="fa-solid fa-gauge"></i> Dashboard
                        </a>
                        <a href="?controller=admin&redirect=user" class="list-group-item list-group-item-action "><i class="fa-solid fa-user"></i> User management</a>
                        <a href="?controller=admin&redirect=product" class="list-group-item list-group-item-action active bg-secondary"><i class="fa-solid fa-shirt"></i> Product management</a>
                        <a href="?controller=admin&redirect=category" class="list-group-item list-group-item-action "><i class="fa-solid fa-list-check"></i> Category management</a>
                        <a href="?controller=admin&redirect=order" class="list-group-item list-group-item-action "><i class="fa-solid fa-cart-shopping"></i> Order management</a>
                        <!-- <a href="?controller=admin&redirect=revenue" class="list-group-item list-group-item-action "><i class="fa-solid fa-dollar-sign"></i> Revenue management</a> -->

                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
            <div class="row">
                    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="index.php?controller=admin"><i class="fa-solid fa-house"></i> Home</a></li>
    <li class="breadcrumb-item"><a class="text-decoration-none text-dark"  href="?controller=admin&redirect=product"><i class="fa-solid fa-shirt"></i> Product management</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add product</li>
  </ol>
</nav>
                    </div>
                <div class="row mt-2">
                    <h3 class="text-danger">Add a new product</h3>
                   
                    <div class="row mt-3">
                        <div class="row">
                            <form action="?controller=admin&redirect=product&action=store" role="form" method="post" enctype="multipart/form-data">
                                <div class="row">
                                      <div class="col-lg-6 col-md-12">
                                    <div class="mb-3">
                                    <label>Name</label>
                                    <input required name="name"  class="form-control" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label>Price</label>
                                    <input required name="price"  class="form-control" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label>Promotion (%)</label>
                                    <input  name="promotion"  required class="form-control" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="prd_cate" required class="form-select" aria-label="Default select example">
                                        <option selected hidden></option>
                                    <?php 
                                    foreach($arr['cate'] as $item) {

                                    // }

                                    // ?>
                                        <option value= <?php 
                                    echo $item['id'];?>><?php 
                                    echo $item['name'];?></option>
                                    //     <?php
                                    //       }
                                    }
                                    ?>
                                        

                                      
                                      </select>
                                </div>

                                <!-- <div class="mb-3">
                                    <label>Status</label>
                                    <select class="form-select" required name="status" aria-label="Default select example">
                                        
                                        <option value="1">Availability</option>
                                        <option value="0">Out of stock</option>
                                        

                                      
                                      </select>
                                </div> -->
                                
                                <div class="mb-3">
                                    <label>Color</label>
                                    <select name="color" required class="form-select" aria-label="Default select example">
                                        <option selected hidden></option>
                                    <?php 
                                    foreach($arr['color'] as $item) {

                                           
                                     ?>
                                    <option value= <?php 
                                    echo $item['id'];?>>
                                    <?php 
                                    echo $item['name'];?></option>
                                       <?php
                                    //       }
                                    }
                                    ?>
                                        

                                      
                                      </select>
                                </div>
                                <div class="mb-3">
                                  <label>Quantity</label>
                                 <?php
                                    foreach($arr['size'] as $size){

                                    ?>
                                    <ul>
                                    <ol >
                                    <label for="">
                                        Size <?= $size['name'] ?>
                                    </label>
                                    
                                    <input type="number" name= "quantity_<?php echo $size['name'] ?>" > </ol>
                                    </ol>
                                    </ul>
                                  <?php
                                  }
                                 ?>
                                </div>
                               
                                <!-- <div class="mb-3">
                                    <label>Promotion</label>
                                    <input  name="promotion" required class="form-control" placeholder="">
                                </div> -->
                                <!-- <div class="mb-3">
                                <label>Warranty</label>
                                    <input  name="warranty" required class="form-control" placeholder="">
                                </div> -->
                                <div class="form-check mb-3">
                                    <input class="form-check-input" name="featured" type="checkbox"  id="flexCheckIndeterminate">
                                    <label class="form-check-label" for="flexCheckIndeterminate">
                                    Featured product
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                    <textarea name="description" required class="form-control" id="description" rows="3"></textarea>
                                </div>
                                <input type="submit" name ="sbm" value="Add" class="btn btn-danger"></input>
                                <!-- <button type="reset" class="btn btn-primary">Reset</button> -->
                                </div>
                                
                             <div class="col-lg-6 col-md-12">
                            
                                 <label  class="form-label mt-3">Product image</label>
                            <form>
                            <input class="form-control form-control-sm mb-3" required name="image[]" type="file" multiple onchange="preview()">
                            <div class="row">
                              <img id="frame"  src="Public/images/no_image.jpg" />
 
                            </div>
                            </form>
                            
                           
                          </div>
                                </div>
                              
                            </form>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>

    </div>

<script>
    function preview() {
    frame.src=URL.createObjectURL(event.target.files[0]);
    }
    </script>    
    <script>CKEDITOR.replace('description')</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js "></script>
</body>

</html>