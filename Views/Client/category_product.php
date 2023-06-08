

        <div class="body ">
            <div class="breadcrumb" style="margin-top:150px;margin-left: 30px;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><a href="index.php" class="text-decoration-none text-secondary">Home</a></li>
                        <!-- <li class="breadcrumb-item ">
                            <a href="#" class="text-decoration-none text-secondary">Product</a>
                        </li> -->
                         <?php
                        foreach ($arr['products'] as $item ) {
                        ?> 
                        <li class="breadcrumb-item active text-dark" aria-current="page"><?php echo $item['name_cate'];break; ?></li>
                        <?php
                         }
                        ?>
                    </ol>
                </nav>
            </div>
            <div class=" filter">
                <div class="icon text-muted" style="size:40px"><i class="fa-solid fa-filter"></i> Filter</div>
                <div class="filter_box">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle bg-light " style="border-radius:0%;width: 200px;color: gray;border: 1px solid rgb(159, 159, 159); outline: none;" data-bs-toggle="dropdown" aria-expanded="false">
                          Filter by
                        </button>
                        <ul class="dropdown-menu bg-light " style="width: 200px;border-radius:0% ;">
                        <?php
                    foreach($arr['products'] as $item) {
                    ?> 
                            <li><a class="dropdown-item prd_item bg-light text-muted" href="?redirect=category&action=filter_max_to_min&id=<?= $item['prd_cate'] ?>">Price from high to low</a></li>
                            <li><a class="dropdown-item bg-light  text-muted" href="?redirect=category&action=filter_min_to_max&id=<?= $item['prd_cate'] ?>">Price from low to high</a></li>
                            <li><a class="dropdown-item  bg-light  text-muted" href="?redirect=category&action=filter_new&id=<?= $item['prd_cate'] ?>">New product</a></li>
                            <li><a class="dropdown-item  bg-light  text-muted" href="?redirect=category&action=filter_feature&id=<?= $item['prd_cate'] ?>">Feature product</a></li>
                            <?php
                            break;
                         }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="prd-list">
                <?php
                         if(isset($error)) {
                            echo $error;
                         }
                         ?>
                <div class="d-flex flex-wrap col-12">
                <?php
                    foreach($arr['products'] as $item) {
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
                <nav aria-label="Page navigation example">
                     <ul class="pagination" style = "text-align:center">
                        <?php
                        if($arr['current_page'] > 1 && $arr['total_page'] > 1){
                            $pev = $arr['current_page'] - 1;
                            echo' <li  class="page-item">
                        <a class="page-link" href="index.php?redirect=category&action='.$arr['action'].'&id='.$item['cate_id'].'&current_page='.$pev.'" aria-label="Previous">
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
                                echo '<li class="page-item"><a class="page-link" href="index.php?redirect=category&action='.$arr['action'].'&id='.$item['cate_id'].'&current_page='.$i.'">'.$i.'</a></li>';
                            }
                        }
                        ?>
                    <?php
                    if($arr['current_page'] < $arr['total_page'] && $arr['total_page'] > 1){
                        $next = $arr['current_page'] + 1;
                        echo ' <li class="page-item">
                        <a class="page-link" href="index.php?redirect=category&action='.$arr['action'].'&id='.$item['cate_id'].'&current_page='.$next.'" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                        </li>';
                    }
                    ?>
                    
                    </ul>
                </nav>
                <!-- <div class="see_more mt-3 text-center fs-5 ">
                    <button href="" class="btn btn-outline-secondary text-center text-decoration-none " style="    transition: 0.4s linear ;  box-shadow: 0px 2px 4px rgb(159, 159, 159); border-radius: 0%; width: 200px; ">
                     See more...
                  </button>

                </div> -->
                <?php foreach($arr['products'] as $item) {

                    ?>
                <div class="banner mt-5">
                    
                    <img src="public/images/<?= $item['image_cate']?>" width="1519" alt="">
                </div>
                <div class="category_information">
                    <button class="btn  open" id="toggle_button">More Information</button>
                    <div id="content_container">
                        <div class="row mt-3">
                            <div class="col col-lg-3"></div>
                            <div class="col col-lg-6">
                                <h5 class="text-center">Instructions on how to choose the right <?= $item['name_cate'] ?> Levents size</h5>
                                <p><?= $item['name_cate'] ?> Levents shirt sizes are denoted by sizes 1, 2, 3. Each size will specify a certain number of pounds and height. You can consider by the number of pounds to choose the right shirt size. When buying a men's shirt, the
                                    parameters you need to focus on are the collar, shoulders and form of the shirt to create masculinity and strength.</p>
                                <p>If the size of the shirt does not fit, is too small or too big, it will make the wearer uncomfortable. When measuring shirt size for women and men, there will be a difference. Men's shirts need to prioritize height and
                                    women's shirts often prioritize weight. If you are wondering between a large size or a smaller size, choose a large size to wear more comfortably and comfortably.</p>
                                <p>
                                    In case if your height is in this size but your weight is in another size, you should choose according to your height size to ensure a good fit and aesthetics. In addition, you should consider buying shirts on reputable e-commerce sites or websites to
                                    ensure you are buying genuine products, in the right size.
                                </p>
                                <img src="public/images/<?= $item['image_size'] ?>" width="700" alt="">
                            </div>
                            <div class="col col-lg-3"></div>
                        </div>
                        <div class="row">
                            <div class="col col-lg-3"></div>
                            <div class="col col-lg-6">
                                <h5>How to properly store <?= $item['name_cate'] ?> Levents shirts
                                </h5>
                                <p> <?= $item['name_cate'] ?> Levents shirts to ensure long-term quality need to be properly stored. Some notes in shirt storage you need to pay attention to are as follows:
                                </p>
                                <ul style="font-size:12px">
                                    <li style="margin-bottom:5px;">How to wash: <?= $item['name_cate'] ?> Levents shirts should be hand-washed the first time they are used and washed only with water without detergent. After washing, it can be dried in medium mode and pay attention to sorting coloring
                                        and white items before washing. Used products can be machine washed but avoid putting detergent directly on the fabric surface and limit soaking for too long.</li>
                                    <li>How to dry, dry and iron: <?= $item['name_cate'] ?> Levents shirts should not be exposed directly to the sun, but should choose a cool and sunny drying location. Pay attention to the left of the shirt before drying and do not iron the
                                        shirt at too high a temperature. When drying the hanger, you need to take care to hang it properly to avoid dilating the shirt, especially the neck.</li>
                                </ul>
                            </div>
                            <div class="col col-lg-3"></div>
                        </div>

                    </div>
                    <button class="collapse mt-1 text-muted" id="close_button">
                        Collapse
                    </button>
                </div>
                <?php
                    break;
                      }
                    ?>
            </div>





        </div>

