<?php
// include_once("../config/db.php");
// $limit = 3;
// $totalRecords =  "SELECT count(product_id) as total FROM product";
// $queryTotalRecords = mysqli_query($conn, $totalRecords);
// $result = mysqli_fetch_array($queryTotalRecords);
// $total_records = $result['total'];
// $total_page = ceil( $total_records/ $limit );
// if(isset($_GET['current_page'])){
//     $current_page = $_GET['current_page'];
// }else{
//     $current_page = 1;
// }

// if($current_page < 1){
//     $current_page = 1 ;
// }

// if($current_page > $total_page){
//     $current_page = $total_page;
// }

// $start = ($current_page - 1) * $limit;



// $sqlAllProducts = "SELECT * FROM product P 
//                     INNER JOIN category C 
//                     ON P.product_cate = C.id_cate
//                     ORDER BY P.product_id ASC LIMIT $start,$limit";
// $queryAllProducts = mysqli_query($conn, $sqlAllProducts);

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
                            <li class="breadcrumb-item "><a class="text-decoration-none text-secondary" href="?controller=admin">
                            <i class="fa-solid fa-house text-dark"></i>
                            Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product management</li>
                        </ol>
                    </nav>
                </div>
          
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Color</th>
                                <th scope="col">Category</th>
                                <th class="text-center" scope="col">Image</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            // if(mysqli_num_rows($queryAllProducts) > 0) {
                            // while($pro = mysqli_fetch_assoc($queryAllProducts)){
                            // 
                            $detail_price = 0;
                            foreach($arr['recod'] as $item){
                                $detail_price = $item['price'] - ($item['price']*($item['promotion']/100));
                            ?>

                            <tr>
                                <th scope="row">
                                <?php
                                // echo $pro['product_id'];
                                echo $item['id'];
                                ?>

                                </th>
                                <td>
                                <?= $item['name'];
                                // echo $pro['product_name'];
                                ?>

                                </td>
                                <td>
                                <?= number_format($detail_price);
                                // echo $pro['product_price'].' VND';
                                ?> VND
                                </td>
                                <td ><img width="50" height="50" src="Public/images/<?php echo $item['color_image'];?>" ></td>
                                <td>
                                <?= $item['name_cate'];
                                // echo $pro['product_price'].' VND';
                                ?> 
                                </td>
                                <td class="text-center"><img width="120" height="120" src="Public/images/<?php echo $item['image_product'];?>" ></td>
                               
                              
                                <?php
                                    if($item['featured'] == 1){
                                    echo '<td class=" text-success">Featured </td>';
                                    }else{
                                    echo '<td class=" text-danger">No featured</td>';
                                }
                                    // echo $pro['name_cate'];
                                ?>
                             
                                <td><a href="?controller=<?= $controller ?>&redirect=<?= $redirect ?>&action=edit&id=<?= $item['id']; ?>" class="btn btn-warning mb-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a  href="?controller=<?= $controller ?>&redirect=<?= $redirect ?>&action=destroy&id=<?= $item['id']; ?>" class="btn btn-danger text-decoration-none mb-2"><i class="fa-solid fa-xmark"></i></a>
                                </td>
                            </tr>
                            <?php
                            }
                            // }
                            // }
                            ?>
                            
                         
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation example">
                     <ul class="pagination">
                        <?php
                        if($arr['current_page'] > 1 && $arr['total_page'] > 1){
                            $pev = $arr['current_page'] - 1;
                            echo' <li class="page-item">
                        <a class="page-link" href="index.php?controller=admin&redirect=product&current_page='.$pev.'" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                        </li>';
                        }
                        ?>
                    
                        
                        <?php
                        for($i = 1;$i < $arr['total_page'] ; $i ++){
                            if($i == $arr['current_page']){
                                echo '<li class="page-item active"><a class="page-link disabled ">'.$i.'</a></li>';
                            }else{
                                echo '<li class="page-item"><a class="page-link" href="index.php?controller=admin&redirect=product&current_page='.$i.'">'.$i.'</a></li>';
                            }
                        }
                        ?>
                    <?php
                    if($arr['current_page'] < $arr['total_page'] && $arr['total_page'] > 1){
                        $next = $arr['current_page'] + 1;
                        echo ' <li class="page-item">
                        <a class="page-link" href="index.php?controller=admin&redirect=product&current_page='.$next.'" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                        </li>';
                    }
                    ?>
                    
                    </ul>
                </nav>
                <div class="row">
                    <div id="add_member" class="row mt-3">
                        <a href="?controller=<?= $controller ?>&redirect=<?= $redirect ?>&action=create" class="btn btn-info " style="display: inline-block;">
                            <i class="fa-solid fa-plus"></i> Add product
                        </a>
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