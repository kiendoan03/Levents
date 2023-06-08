

<div class="body ">
            <div class="breadcrumb" style="margin-top:150px;margin-left: 30px;">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><a href="index.php" class="text-decoration-none text-secondary">Home</a></li>
                        <!-- <li class="breadcrumb-item ">
                            <a href="#" class="text-decoration-none text-secondary">Product</a>
                        </li> -->
                         <?php
                        // foreach ($arr['search'] as $item ) {
                        ?> 
                        <li class="breadcrumb-item active text-dark fst-italic" aria-current="page"># <?php
                        if(isset($arr['search'])){
                            if($arr['search'] == ''){
                                echo 'All prodcuts';
                            }else{
                             echo $arr['search'];
                        } 
                           
                        }
                        // echo 'All prodcuts';
                        ?></li>
                        <?php
                        //  }
                        ?>
                    </ol>
                </nav>
            </div>
           
            <div class="prd-list">
                <?php
                if(isset($error)){
                   echo $error;
                }else{
                    echo $result;
                }
            
                ?>

                <div class="d-flex flex-wrap col-12">
                <?php
                    foreach($arr['products'] as $item) {
                        $count =0;
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

                <div class="see_more mt-3 text-center fs-5 ">
                    <!-- <a href="" class="btn btn-outline-secondary text-center text-decoration-none " style="    transition: 0.4s linear ;  box-shadow: 0px 2px 4px rgb(159, 159, 159); border-radius: 0%; width: 200px; ">
                     See more...
                  </a> -->
                  <nav aria-label="Page navigation example">
                     <ul class="pagination" style = "text-align:center">
                        <?php
                        if($arr['current_page'] > 1 && $arr['total_page'] > 1){
                            $pev = $arr['current_page'] - 1;
                            echo' <li  class="page-item">
                        <a class="page-link" href="index.php?redirect=search&search='.$arr['search'].'&current_page='.$pev.'" aria-label="Previous">
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
                                echo '<li class="page-item"><a class="page-link" href="index.php?redirect=search&search='.$arr['search'].'&current_page='.$i.'">'.$i.'</a></li>';
                            }
                        }
                        ?>
                    <?php
                    if($arr['current_page'] < $arr['total_page'] && $arr['total_page'] > 1){
                        $next = $arr['current_page'] + 1;
                        echo ' <li class="page-item">
                        <a class="page-link" href="index.php?redirect=search&search='.$arr['search'].'&current_page='.$next.'" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                        </li>';
                    }
                    ?>
                    
                    </ul>
                </nav>
                </div>
              
            </div>





        </div>

