<div class="body">
            <div class="banner" style="margin-top: 150px;">
                <img src="public/images/banner.png" width="100%" alt="">
            </div>
            <div class="feature-list mt-5">
                <div class="content text-center">
                    <a href="#" class="text-decoration-none text-dark text-uppercase font-monospace fw-semibold fs-4 "><i class="fa-solid fa-fire text-danger"></i>  Feature product</a>
                </div>
                <div class="row">
                    <!-- <div class="cart-sidebar">
                        <h2>Giỏ hàng</h2>
                        <ul class="cart-items">
                            sadasbkdjh
                        </ul>
                    </div> -->
                    <?php
                    
                    foreach ($arr['featured'] as $item){
                        $count = 0;
                    ?>
                    <div class="col col-lg-3 col-md-6 col-sm-12 mt-3">
                        <div class="card h-100 " style="border: none;">
                            <div class="img">
                                <a href="?redirect=product&id=<?=$item['id'] ?>">
                                    <div class="img_product ">

                                        <?php
                                       
                                        foreach ($arr['image'] as $image){
                                            if($image['id_prd'] == $item['id']){    
                                                if($count == 0) {
                                                    // echo $image['image_product'];
                                                   ?>
                                          <img src="Public/images/<?php echo $image['image_product'];?>" class="img-change" alt="">
                                            <?php
                                                }
                                                if ($count == 1){
                                                    // echo $image['image_product'];
                                                   
                                                    ?>  
                                             <img src="Public/images/<?php echo $image['image_product'];?>" alt="">

                                                     <?php
                                                         break;
                                                }
                                                $count ++;
                                              
                                               
                                            }
                                        }
                                        ?>
                                        
                                    </div>
                                </a>
                            </div>

                            <div class="card-body ">
                                <div class="row">
                                    <ul  style="padding-left: 0rem; text-align: right;">
                                        <?php
                                        foreach($arr['color'] as $color){
                                            if($color['id'] == $item['prd_color']){

                                        ?>
                                        <ol class="d-inline" style = "padding-left: 0rem; ">   
                                         <img src="Public/images/<?php echo $color['color_image'];?>" width = 15 height = 15 style ="margin:auto" alt="">
                                        </ol>
                                        <?php
                                        }
                                        }   
                                        ?>
                                    </ul>
                                </div>
                                <a href="?redirect=product&id=<?=$item['id'] ?>" class="text-decoration-none ">
                                        <?php
                                        foreach($arr['color'] as $color){
                                            if($color['id'] == $item['prd_color']){

                                        ?>
                                    <h5 class="card-title text-body-secondary " style="text-transform: uppercase;">
                                        <?= $item['name'];
                                        ?> / <?= $color['name']; ?>
                                    </h5>
                                    <?php
                                        }
                                        }   
                                        ?>
                                    <span class="price text-decoration-line-through text-secondary">
                                    
                                  <?= number_format($item['price']); ?> VND</span>

                                    <?php
                                    foreach($arr['detail'] as $detail){
                                        if($detail['id_prd'] == $item['id']){

                                    ?>
                                     <span class="price text-decoration-underline text-danger">
                                    
                                    <?= number_format($detail['price_detail']); ?> VND</span>
  
                                  </a>
                                  <?php 
                                  break;
                                  } 
                                    }
                                  ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    

                </div>
                <!-- <div class="see_more mt-3 text-center fs-5 ">
                    <a class="btn btn-outline-secondary text-center text-decoration-none " style="  transition: 0.4s linear ;  box-shadow: 0px 2px 4px rgb(159, 159, 159); border-radius: 0%; width: 200px; ">
                     See more...
                  </a>

                </div> -->
            </div>

            <div class=" advertisement mt-5 text-center ">
                <p class=" fs-4   fw-semibold  text-muted"> How we make a million t-shirts   </p>
                <video src="Public/images/advertisement_video.mp4" width="100%" loop autoplay="true"></video>
            </div>

            <div class="Nice outfit mt-5">
                <div class="content text-center fs-4   fw-semibold  text-muted">
                    Nice outfit with Levents
                </div>
                <div class="row">
                    <div class="col col-lg-6 col-md-6 col-sm-12 mt-3">
                        <div class="card h-100" style="border: none;">
                            <div class="img">
                                <a href="#">
                                    <div class="img_product "><img src="public/images/outfit1_front.png" class="img-change" alt="">
                                        <img src="public/images/outfit1_back.png" alt=""></div>
                                </a>
                            </div>



                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 mt-3">
                        <div class="card h-100" style="border: none;">
                            <div class="img">
                                <a href="#">
                                    <div class="img_product "><img src="Public/images/outfit2_front.png" class="img-change" alt="">
                                        <img src="Public/images/outfit2_back.png" alt=""></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 mt-3">
                        <div class="card h-100" style="border: none;">
                            <div class="img">
                                <a href="#">
                                    <div class="img_product "><img src="Public/images/outfit3_front.png" class="img-change" alt="">
                                        <img src="Public/images/outfit3_back.png" alt=""></div>
                                </a>
                            </div>



                        </div>
                    </div>

                    <div class="col col-lg-6 col-md-6 col-sm-12 mt-3">
                        <div class="card h-100" style="border: none;">
                            <div class="img">
                                <a href="#">
                                    <div class="img_product "><img src="Public/images/outfit4_front.png" class="img-change" alt="">
                                        <img src="Public/images/outfit4_back.png" alt=""></div>
                                </a>
                            </div>



                        </div>
                    </div>



                </div>

            </div>






        </div>


        <div class="contact mt-5">
            <div class="row " style="margin: auto;">
                <div class="col col-lg-6 col-md-12 col-sm-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.2129871969637!2d106.68325221474907!3d10.794992992308893!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752923119d1ed1%3A0x2bdfa7f7e688df24!2sLEVENTS!5e0!3m2!1svi!2s!4v1678379390397!5m2!1svi!2s"
                        width="700" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col col-lg-6 col-md-12 col-sm-12">
                    <div class="contact">
                        <div class="content mt-1">
                            SEND MESSAGE TO LEVENTS IMMEDIATELY WHEN YOU NEED SUPPORT OR HAVE QUESTIONS!
                        </div>
                        <div class="contact_form mt-5">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" style=" border: none; border-radius:0; border-bottom: 1px solid rgb(159, 159, 159);" placeholder="Name">
                            </div>
                            <div class="input-group mb-3">
                                <div class="row">
                                    <div class="col col-lg-6">
                                        <input type="text" class="form-control " style="width:345px; border: none; border-radius:0; border-bottom: 1px solid rgb(159, 159, 159);" placeholder="Email">
                                    </div>
                                    <div class="col col-lg-6">
                                        <input type="text" class="form-control " style="width: 360px;  border: none; border-radius:0; border-bottom: 1px solid rgb(159, 159, 159);" placeholder="Phone number">
                                    </div>
                                </div>
                            </div>


                            <div class="input-group ">
                                <textarea placeholder="Message" style="height: 210px ; border-radius: 0%; border: 1px solid rgb(159, 159, 159);" class="form-control "></textarea>
                            </div>
                            <a class="btn btn-secondary mt-3" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3); border-radius: 0%; width: 200px;">
                                Send
                            </a>

                        </div>
                    </div>

                </div>
            </div>
           

        </div>