
 <?php   
foreach($arr['products'] as $item) {


?>          
           <div class="breadcrumb" style="margin-top:150px;margin-left: 30px;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><a href="index.php" class="text-decoration-none text-secondary">Home</a></li>
                        <!-- <li class="breadcrumb-item ">
                            <a href="#" class="text-decoration-none text-secondary">Product</a>
                        </li> -->
                        <li class="breadcrumb-item ">
                            <a href="?redirect=category&id=<?= $item['prd_cate'] ?>" class="text-decoration-none text-secondary"><?= $item['name_cate'] ?></a>
                        </li>
                        <li class="breadcrumb-item active text-dark" aria-current="page"><?php echo $item['name'];?></li>
                    </ol>
                </nav>
            </div>



            <div class="row" style="margin: 0px 80px 0px 80px">
                <div class="col col-lg-0"></div>
                <div class="col col-lg-12" >
                    <div class="card mb-3 " style="border: none;">
                        <div class="row ">
                               
                            <div class="col col-lg-7">
                                <div class="row">
                                   <div class="col col-lg-2">
                                   <ul>
                                    <?php
                                                foreach ($arr['image'] as $image) {
                                                    if($image['id_prd'] == $item['id']) {
                                                ?>
                                        <ol class="mb-2">
                                            <img src="Public/images/<?= $image['image_product']; ?>" width="65" height="65" alt="">
                                        </ol>
                                    <?php
                                                        }
                                                    }
                                    ?>
                                    </ul>  
                                   </div>
                                <div class="col col-lg-10">
                                        <div id="carouselExampleIndicators" class="carousel slide">
                                        <!-- <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        </div> -->
                                        <div class="carousel-inner">
                                           <?php
                                             $count = 0;
                                                foreach ($arr['image'] as $image) {
                                                    if($image['id_prd'] == $item['id']) {
                                                        if($count == 0){
                                                ?>
                                            <div class="carousel-item active"> 
                                            <img src="Public/images/<?= $image['image_product']; ?>" class="d-block w-100" alt="...">
                                             
                                             </div>
                                           <?php 
                                                    
                                                }
                                                    if ($count == 1 || $count > 1){
                                                    ?>
                                                     <div class="carousel-item"> 
                                                       <img src="Public/images/<?= $image['image_product']; ?>" class="d-block w-100" alt="...">
                                                    </div>
                                                    <?php
                                                    }
                                                 $count++;
                                                }

                                                }
                                            ?>
                                          
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                </div>
                                </div> 
                                </div>
                                
                            
                                
                            </div>
                            <div class="col col-lg-5">
                                <form method = "post" action="index.php?redirect=pay&action=add" >
                                        <!-- <button type="submit" class="btn add-cart btn-secondary">Add to cart</button> -->
                                                <input name="id_prd" type="text" hidden value="<?= $item['id'] ?>" >
                                    <div class="card-body">
                                    <h5  class="card-title mt-5 mb-5"><?= $item['name'] ?></h5>
                                    <span class="price  fs-6 text-decoration-line-through text-secondary">
                                    
                                  <?= number_format($item['price']); ?> VND</span>

                                    <?php  
                                    foreach($arr['detail'] as $detail){

                                    ?>
                                     <span class="price fs-5 text-decoration-underline text-danger">
                                    
                                    <?= number_format($detail['price_detail']); ?> VND</span>
                                    <?php
                                    break;
                                    }
                                    ?>
                                  <!-- </a> -->
                                
                                    <div class="color mt-5 mb-5"> 
                                         <?php
                                        foreach($arr['color'] as $color){
                                            if($color['id'] == $item['prd_color']){

                                        ?>
                                        <span>Color: <?= $color['name'] ?></span>
                                        <div class="color_img mt-2">
                                        <?php
                                        $count = 0;
                                        foreach($arr['image'] as $image){
                                            if($item['id'] == $image['id_prd']){
                                                if($count == 0){
                                        ?>
                                        <ol class="d-inline" style = "padding-left: 0rem; ">   
                                         <img src="Public/images/<?php echo $image['image_product'];?>" width = 80 height = 80 alt="">
                                        </ol>
                                        
                                        <?php 
                                                        }
                                                        $count ++;
                                                    }
                                               }
                                           }
                                        }   
                                        ?>
                                    
                                        </div>

                                    </div>
                                    <div class="size">
                                        <span>
                                            Size
                                        </span>
                                        <div class="size_number ">
                                            <div class="wrap-size mt-2"> 
                                                <?php
                                                foreach ($arr['detail'] as $size){
                                                    if($size['quantity'] > 0){
                                                ?>
                                               <span class="item-radio d-inline " style="margin-right:20px">
                                                    <input  name="size_id" type="radio" id="input-size-1" value="<?= $size['id_size'] ?>" required>
                                                    <label for="input-size" style="padding:3px 5px 3px 5px; border: 1px solid rgb(159, 159, 159); border-radius:none;" class="m-radio-label">SIZE <?= $size['name_size'] ?></label>
                                                </span>
                                                <?php
                                                }
                                                }
                                                ?>
                                           </div>
                                           
                                        </div>

                                    </div>

                                    
                                  
                                        <div class="action mt-5" style="border-bottom: 1px soild rgb(159, 159, 159);">
                                            <button  style="border-radius:0; width: 250px"  class="btn add-cart btn-secondary text-center">Add to cart</button>
                                                
                                            <!-- <button class="btn add-love btn-secondary"><i class="fa-regular fa-heart"></i></button> -->
                                        </div>`
                                 </form>
                                    <div class="info mt-3" style="border-top: 1px solid rgb(228, 227, 227)">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                  Information
                                                </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                
                                                <div class="accordion-body">
                                                        <!-- <p style="font-size:15px">
                                                            Levents T-shirt products are used special fabric material Li Ven Original 2.0 to bring comfort to the wearer. Not only about shirts, but all products at Levents are always invested and cared for
                                                        </p>
                                                        <b>
                                                        Size: 1/2/3/4
                                                      </b> -->
                                                      <?php
                                                      echo $item['description'];
                                                      ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                  Size table
                                                </button>
                                                </h2>
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        <span class="mb-2"> Products are sewn according to the relative standard parameters of Vietnamese people. If you are considering between two sizes, choose the larger size.
                                                        </span>
                                                        <ul>
                                                            <?php
                                                            foreach($arr['size'] as $size){

                                                            ?>
                                                            <li class="text" style="font-size: 15px">
                                                                <?= $size['size_information'] ?>
                                                            </li>
                                                            <?php
                                                            }
                                                            ?>
                                                            <!-- <li>Size 2: Height from 1m65 - 1m72, weight under 65kg
                                                            </li>
                                                            <li>Size 3: Height from 1m70 - 1m77, weight less than 80kg
                                                            </li>
                                                            <li>Size 4: Height over 1m72, weight under 95kg.
                                                            </li> -->
                                                        </ul>
                                                      
                                                        <img src="public/images/<?=$item['image_size'] ?>" width="500" height="250"alt="">
                                                       

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                        Refund Policy
                                                </button>
                                                </h2>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        In order to bring you convenience and a great shopping experience, we have developed a door-to-door exchange service and a warranty policy.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>




                                  </div>
                                
                                
                            </div>
                        </div>



                    </div>

                </div>

                <div class="col col-lg-0"></div>





            </div>

<?php
}
?>
      