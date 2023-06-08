<!-- h -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>Levents - Popular Stresswear brand</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="icon" href="public/images/cropped-douopleeblue-270x270.png">
</head>

<body>
    <div class="container-fluid" style="padding: 0;">
        <div class="topbar">
            <div id="logo">
                <nav class="navbar navbar-expand-lg bg-body-tertiary" style="border-bottom:1px solid rgb(159, 159, 159) ;">
                    <div class="col-lg-4"></div>
                    <div class=" col-lg-4 text-center" style="padding:10px">
                        <a class="" href="index.php ">
                            <img width="98 " height="30 " src="https://levents.asia/wp-content/uploads/2021/10/logo.png " class="custom-logo " alt="Levents ">
                        </a>
                    </div>

                    <div class="col-lg-4 "></div>
                </nav>
            </div>

            <div id="option">

                <nav class="navbar navbar-expand-lg bg-body-tertiary " style="border-bottom:1px solid rgb(159, 159, 159) ;height: 45px;">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                        <div class="collapse navbar-collapse  d-flex justify-content-between" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-between " >
                                <li class="nav-item" style="margin-left:50px">
                                    <a class="nav-link " aria-current="page" href="index.php" ><i class="fa-solid fa-house"></i> Home</a>
                                </li>

                                <li class="nav-item dropdown" style="margin-left:150px">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Product
                                  </a>
                                    <ul class="dropdown-menu bg-light" style="border-radius: 0%; border: none;box-shadow:0px 2px 4px rgb(159, 159, 159); ">
                                    <?php
                                   

                                    foreach($arr['category'] as $item){

                                        ?>
                                 
                                        <li ><a class="dropdown-item bg-light text-muted" href="?redirect=category&id=<?= $item['id'] ?>"><?= $item['name']; ?> </a></li>
                                        <?php
                                        } 
                                        ?>
                                        
                                    </ul>
                                </li>

                                <li class="nav-item" style="margin-left:150px">
                                    <a class="nav-link " href="?redirect=about">About us</a>
                                </li>
                                <li class="nav-item" style="margin-left:150px">
                                    <a class="nav-link " href="?redirect=contact">Contact</a>
                                </li>
                               
                            </ul>
                            <ul class="navbar-nav  mb-2 mb-lg-0">


                                <li class="nav-item" >
                                    <a class="nav-link icon">
                                       
                                            <button type="button" class="btn btn-action" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <img src="public/images/ic-ser.svg">
                                     </button>
                                    </a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal" style="margin-top:20px ;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content" style="border-radius: 0%;">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Levents</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="d-flex" role="form" method="post" action="?redirect=search" >
                                                                <input class="form-control me-2" name="search_content" style="border-radius: 0%;" type="search" placeholder="Search" aria-label="Search">
                                                                 <button class="btn btn-outline-secondary" style="border-radius: 50%;" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                                                </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="search_history">

                                                            </div>
                                                        </div>
                                                    </div>
                                               
                                            </div>

                                    </div>

                                    
                                </li>

                                <li class="nav-item" style="margin: auto">
                                    <a   class="nav-link icon cart-icon  position-relative">
                                        <img src="public/images/ic-cart.svg" alt="">
                                        <span class="position-absolute top-10 start-95 translate-middle badge bg-secondary border border-light rounded-circle">
                                        <?php
                                            if(isset($_SESSION["cart"])){
                                                $totals = 0;
                                                foreach($arr['product'] as $prd_id=>$qtt_size){
                                                    foreach($qtt_size as $qtt){
                                                       $totals++; 
                                                    }
                                                }
                                                echo $totals;
                                            }
                                            else{
                                                echo 0;
                                            }
                                        ?>
                                        </span>
                                    </a>
                                   
                                </li> 
                            <?php 
                                if(isset($_SESSION['user'] )){
                                    echo '   <li class="nav-item dropdowns    " style="margin: auto; margin-left: 10px;">
                                    <a class="nav-link icon " href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="public/images/ic-user.svg" alt="" >
                                    </a>
                                    <ul class="dropdown-menu bg-light dropdown-menu-lg-end" style="border-radius: 0%; border: none;box-shadow:0px 2px 4px rgb(159, 159, 159); ">
                                     <li><a class="dropdown-item bg-light text-muted" href="#"><i class="fa-solid fa-address-card"></i> Profile</a></li> 
                                     <li><a class="dropdown-item bg-light text-muted" href="?controller=admin"><i class="fa-solid fa-user-lock"></i> Adminitrator</a></li>
                                    <li><a class="dropdown-item bg-light text-muted" href="?controller=login&action=logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li> 
                                     </ul>
                                </li>';
                                }
                              
                                else{
                                    echo '   <li class="nav-item   " style="margin: auto; margin-left: 10px;">
                                    <a class="nav-link icon " href="?controller=login&action=login" >
                                        <img src="public/images/ic-user.svg" alt="">
                                    </a>
                                  
                                </li>';
                                }
                            ?>
                             
                            </ul>

                        </div>



                    </div>

                </nav>

            </div>




            <div class="cart-sidebar shadow-lg rounded">
                <div class="row">  
                    
                    <div class="cart-sidebar-header">
                        <h2>Cart</h2>
                        <button class="close-cart-sidebar"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                   
                    <?php
                      if(isset($_SESSION['cart'])) {
                    ?>  
                <form  method="post" action="?redirect=pay&action=update"> 
                    <div class="cart-items">
                    <?php
                            $total_price_all = 0;
                            foreach ($arr['product'] as $productID => $size) {
                                foreach($size as $id_size => $item) {
                                $total_price = $item['amount'] * $item['price'];
                                $total_price_all += $total_price; 
                                // Tính tổng tiền sản phẩm trong giỏ hành
                            ?>
                           
                                <div class="prd-items-cart">
                                    <div class="row mt-3 mb-3">
                                        <div class="col col-lg-3">
                                            <img src="public/images/<?php 
                                            echo $item['image_product']
                                            ?>" width="110" height="110" alt="">
                                        </div>
                                        <div class="col col-lg-6 mt-3 prd-detail-cart">
                                            <div class="name text-secondary"><?php 
                                            echo $item['name'];
                                            ?> / <?= $item['color'] ?></div>
                                            <div class="size text-secondary mt-2">Size: <?= $item['size_name']; ?></div>
                                            <div class=" text-secondary mt-2">
                                                <div class="quantitys">
                                                    <!-- <button class="minus-btn" type="button" name="button">-</button> -->
                                                    <input type="number" id="quantity" name="qtt[<?php echo $productID ;?>][<?= $id_size ?>]" min ="1" max ="<?= $item['quantity'] ;?>"  value="<?php echo $item['amount']; ?>">
                                                    <!-- <button class="plus-btn" type="button" name="button">+</button> -->
                                                </div>
                                                <!-- <div class="quantity">
                                                    <button class="minus-btn" type="button" name="button">-</button>
                                                    <input type="text" id="quantity"   name="qtt[]" min ="1" max =""  value="">
                                                    <button class="plus-btn" type="button" name="button">+</button>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col col-lg-3 mt-3 ">
                                            <div class="del-prd-cart">
                                                <a class="text-danger text-decoration-none" href="?redirect=pay&action=del&id=<?php echo $productID ;?>&id_size=<?= $id_size ?>">
                                                <i class="fa-solid fa-xmark"></i>
                                                </a> 
                                            </div>
                                            <div class="price-prd-cart mt-5 text-secondary"><span><?php 
                                                echo number_format($total_price);
                                                ?> VND</span>
                                            </div>
                                        </div>
                                    </div>
                                 <!-- </div> -->
                                </div>
                            <!-- </div> -->
                            <?php
                                } 
                            }
                            ?>
                        </div>
                      <div class="cart-footer">
                            <div class="total">
                                <h5>Total prices</h5>
                                <span class="text-danger fw-bold"><?php 
                                        echo number_format($total_price_all);
                                     ?> VND</span>
                            </div>
                            <p style="text-align: center; color: rgb(159, 159, 159);font-style: italic;">Other fees will be included in the payment</p>
                                 <!-- <button type ="submit" class="mb-3 text-decoration-none text-light btn btn-secondary w-100">Update cart</button> -->

                                <button type ="submit"  class="text-decoration-none text-light btn btn-secondary w-100">Pay</button>
                        </div>
                  </form>
                 
                      

                    </div>
                    <?php
                     }else {
                        echo '<div class="text-center text-danger mt-3">There are currently no products in your shopping cart !</div>';
                    }
                    ?>
                     
                </div>

            </div>


        </div>

                                        <?php
                                        if(!isset($_GET['redirect'])){
                                            include_once('Views/Client/main.php');
                                        }else{
                                            $redirect = $_GET['redirect'];
                                            switch($redirect){
                                                case 'product':
                                                    include_once('Views/Client/product_detail.php');
                                                    break;
                                                 case 'contact':
                                                    include_once('Views/Client/contact.php');
                                                    break;
                                                case 'about':
                                                    include_once('Views/Client/about.php');
                                                    break;
                                                case 'pay':
                                                    include_once('Views/Client/pay.php');
                                                    // include_once('Views/Client/about.php');

                                                    break;
                                                case 'category':
                                                    include_once('Views/Client/category_product.php');
                                                    break;
                                                case 'search':
                                                    include_once('Views/Client/search_result.php');
                                                    break;
                                                }
                                               
                                        }
                                        ?>

       


                                      
             <div class="infor footer mt-5 mb-5" style="border-top:1px solid rgb(159, 159, 159);">
                <div class="row mt-5" style="margin: auto;">
                    <div class="col col-lg-6 col-md-12 ">
                        <h4 class="text-uppercase font-monospace fw-semibold  mb-3">About us</h4>
                        <p class=" mb-5">Levents® – Popular Streetwear Brand </p>
                        <p> BUSINESS HOUSEHOLD Red Label</p>
                        <p> Business license is issued by the Police Department of Administrative Management & Social Information
                        </p>
                        <p> Business household office: 842 Su Van Hanh, Ward 13, District 10, City. Ho Chi Minh
                        </p>
                        <p> Rental number: 41J8031547
                        </p>
                        <p> Issue date: 06/07/2021
                        </p>
                        <p> Representative: Nguyen Tran Duy Khiet
                        </p>
                        <p> Personal Tax Code: 8748861448-001
                        </p>
                        <a href="http://online.gov.vn/Home/WebDetails/102459?AspxAutoDetectCookieSupport=1">
                            <img src="public/images/logoSaleNoti-1.png" width="210" height="80" alt="">

                        </a>




                    </div>
                    <div class="col col-lg-6 col-md-12">
                        <div class="row">
                            <div class="col col-lg-6 ">
                                <h4 class="text-uppercase font-monospace fw-semibold mb-3">Contact</h4>
                                <p>Hotline</p>
                                <h6>190 633 028</h6>
                                <p>Email</p>
                                <h6>Customercare@levents.asia</h6>
                            </div>
                            <div class="col col-lg-6 ">
                                <h4 class="text-uppercase font-monospace fw-semibold mb-3">Store</h4>
                                <p>842 Su Van Hanh, Ward 12, District 10, Ho Chi Minh City</p>
                                <p>The New Playground, 04, District 1, Ho Chi Minh City</p>
                                <p>54, Mau Than, Xuan Khanh Ward, Ninh Kieu District, Can Tho</p>
                                <div class="row">
                                    <ul class="list-group list-group-horizontal">
                                        <a href="https://www.facebook.com/Leventsbrand" class="text-decoration-none">
                                            <li class="list-group-item" style="border: none;"><i class="fa-brands fa-facebook-f"></i></li>
                                        </a>
                                        <a href="https://instagram.com/levents.official?igshid=YmMyMTA2M2Y=" class="text-decoration-none">
                                            <li class="list-group-item" style="border: none;"><i class="fa-brands fa-instagram"></i></li>
                                        </a>
                                        <a href="https://vt.tiktok.com/ZSdBbf2fb/" class="text-decoration-none">
                                            <li class="list-group-item" style="border: none;"><i class="fa-brands fa-tiktok"></i></li>
                                        </a>
                                        <a href="https://youtube.com/channel/UChl4KY_EpOg4GAjrtKlu_vw" class="text-decoration-none">
                                            <li class="list-group-item" style="border: none;"><i class="fa-brands fa-youtube"></i></li>
                                        </a>

                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <button id="btnTop"  onclick="scrollToTop()">
          <i class="fa-solid fa-angles-up"></i>
        </button>
    

        <!-- nut len dau trang -->
        <script>
            function scrollToTop() {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            }

            window.addEventListener("scroll", function() {
                var btnTop = document.getElementById("btnTop");
                if (window.pageYOffset > 100) {
                    btnTop.classList.add("show");
                } 
                else {
                    btnTop.classList.remove("show");
                }
            });
        </script>

          
        <!-- thanh option -->
        <script>
            // Lấy đối tượng cần ẩn đi
            var option = document.getElementById("option");
            // Bắt sự kiện cuộn trang
            window.addEventListener("scroll", function() {
                // Nếu cuộn trang xuống đủ xa để ẩn đi đối tượng
                if (window.scrollY > 100) {
                    option.style.display = "none";
                    // Bắt sự kiện di chuột vào đối tượng logo
                    var logo = document.getElementById("logo");
                    logo.addEventListener("mouseover", function(event) {
                        option.style.display = ""; // Hiển thị đối tượng option
                        option.addEventListener("mouseover", function(event) {
                            option.style.display = ""; // Hiển thị đối tượng option
                        });
                        // Bắt sự kiện di chuột ra khỏi đối tượng option
                        option.addEventListener("mouseout", function(event) {
                            option.style.display = " none "; // Ẩn đi đối tượng option
                        });
                    });
                } else {

                    option.style.display = ""; // Thay đổi thuộc tính display để hiển thị lại đối tượng


                }
            });
        </script>

        <script>
            //cart
            const cartIcon = document.querySelector('.cart-icon');
            const cartSidebar = document.querySelector('.cart-sidebar');

            cartIcon.addEventListener('click', function() {
                cartSidebar.classList.toggle('open');
            });
            const closeCartSidebarBtn = document.querySelector('.close-cart-sidebar');

            closeCartSidebarBtn.addEventListener('click', () => {
                cartSidebar.classList.remove('open');
            });
        </script>
        <!-- quantity -->
        
        <script>
            // Lấy tất cả các đối tượng có class là "quantity"
            const quantityContainers = document.querySelectorAll(".quantity");

            // Lặp qua tất cả các đối tượng và thêm các sự kiện click vào từng đối tượng riêng lẻ
            quantityContainers.forEach((container) => {
                const plusBtn = container.querySelector(".plus-btn");
                const minusBtn = container.querySelector(".minus-btn");
                const quantityInput = container.querySelector("input[name='qtt']");
                plusBtn.addEventListener("click", () => {
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue < 1000) {
                        quantityInput.value = ++currentValue;
                    }
                });

                minusBtn.addEventListener("click", () => {
                    let currentValue = parseInt(quantityInput.value);
                    if (currentValue > 1) {
                        quantityInput.value = --currentValue;
                    }
                });
            });
        </script>

   <!-- content_container_information -->
   <script>
            const toggleButton = document.getElementById('toggle_button');
            const contentContainer = document.getElementById('content_container');
            const closeButton = document.getElementById('close_button');

            toggleButton.addEventListener('click', function() {
                contentContainer.style.display = 'block';
                closeButton.style.display = 'block';
                toggleButton.style.display = 'none';
                if (closeButton.addEventListener('click', function() {
                        contentContainer.style.display = 'none';
                        toggleButton.style.display = 'block';
                        closeButton.style.display = 'none';
                    }));

             
            });
        </script>
     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js "></script>
</body>

</html>