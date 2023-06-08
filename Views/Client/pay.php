
<div class="body">

<div class="breadcrumb" style="margin-top:150px;margin-left: 30px;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="index.php" class="text-decoration-none text-secondary">Home</a></li>

            <li class="breadcrumb-item active text-dark" aria-current="page">Pay</li>
        </ol>
    </nav>
</div>

<div class="row" style="margin-right:30px;margin-left: 30px;">

    <div class="col col-lg-6 col-md-12 col-sm-12" style="padding-right:30px; border-right: 1px solid rgb(159, 159, 159);">
      <form method = "post"  action="?redirect=pay&action=checkaccess">
    
        <h4>Customer information</h4>
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" style="  border: none; border-radius:0; border-bottom: 1px solid rgb(159, 159, 159);" required placeholder="Name">
        </div>
        <div class="input-group mb-3">
            <div class="row">
                <div class="col col-lg-6">
                    <input type="text" class="form-control " name ="email" style="width:340px; border: none; border-radius:0; border-bottom: 1px solid rgb(159, 159, 159);" required placeholder="Email">
                </div>
                <div class="col col-lg-6">
                    <input type="text" class="form-control " name = "phone" style="width: 333px;  border: none; border-radius:0; border-bottom: 1px solid rgb(159, 159, 159);" required placeholder="Phone number: (+84)">
                </div>
            </div>

        </div>
        <div class="input-group mb-3">
            <div class="row">
                <div class="col col-lg-4">  
                    
                    <input type="date" class="form-control "  name="dateOfBirth" style=" border: none; border-radius:0; border-bottom: 1px solid rgb(159, 159, 159);" required >
                </div>
                <div class="col col-lg-8">
                   
                    <input type="text" class="form-control " name="address" style="width: 465px;  border: none; border-radius:0; border-bottom: 1px solid rgb(159, 159, 159);" required placeholder="Address">
                </div>
            </div>

        </div>

        <div class="input-group ">
            <textarea placeholder="Note" name="note" rows="6" style=" border-radius: 0%; border: 1px solid rgb(159, 159, 159);" class="form-control "></textarea>
        </div>
        <button type="submit" class="btn btn-secondary mt-3" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3); border-radius: 0%; width: 200px;">
            Payment
        </button>
      </form>
        
    </div>
    <div class="col col-lg-6 col-md-12 col-sm-12" style="padding-left: 30px;">
        <h4>Cart</h4>
        <div class="cart-items">
            <?php
            if(isset($_SESSION['cart'])) {
            ?>
            <div class="prd-items-cart">
                <?php
                $total_price_all = 0;
                // $total_price = 1;
                foreach ($arr['product'] as $productID => $value) {
                    foreach($value as $id_size => $item){

                    $total_price = $item['amount'] * $item["price"];
                    $total_price_all += $total_price; 
                    // Tính tổng tiền sản phẩm trong giỏ hành
                ?>
                <div class="row mt-3 mb-3">
                    <div class="col col-lg-3">
                        <img src="public/images/<?= $item['image_product'] ?>" width="110" height="110" alt="">
                    </div>
                    <div class="col col-lg-6 mt-3 prd-detail-cart">
                        <div class="name text-secondary"><?= $item['name'] ?> / <?= $item['color'] ?></div>
                        <div class="size text-secondary mt-2">Size: SIZE <?php echo $item['size_name'] ?></div>
                        <div class=" text-secondary mt-2">
                            <div class="quantity">
                                <p>x<?= $item['amount'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-3 mt-3 ">
                        <div class="price-prd-cart mt-5 text-secondary"><span><?php 
                            echo number_format($total_price);
                        
                         ?> VND</span>
                        </div>
                    </div>
                </div>
                <?php 
                    }
            
            } ?>
            </div>
            

            <div class="cart-footer">
                <div class="total">
                    <h5>Total prices</h5>
                    <span class="text-danger fw-bold fs-5">
                    <?php 
                            echo number_format($total_price_all);
                        
                         ?> VND</span>
                </div>
            </div>
            <?php }else {
            echo '<div class="alert alert-danger mt-3">Giỏ hàng của bạn hiện không có sản phẩm nào !</div>';
            } ?>
        </div>
    </div>
</div>

<!-- </div> -->

