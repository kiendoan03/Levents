<?php
function indexx(){
    $id = $_GET['id'];
    include_once('Config/connect.php');
    $cate = mysqli_query($connect,"SELECT * FROM category ORDER BY id ASC");
    // $sql = "SELECT * FROM product WHERE id = '.$id.'";
    $query = mysqli_query($connect, "SELECT product.*, category.name as name_cate,category.image_size FROM category INNER JOIN product ON category.id = product.prd_cate   WHERE product.id = $id");
    $image = mysqli_query($connect, "SELECT * FROM image");    
    $color = mysqli_query($connect,"SELECT * FROM color");
    $size = mysqli_query($connect,"SELECT * FROM size ORDER BY id ASC");
    $detail = mysqli_query($connect,"SELECT product.* , size.name as name_size, size.id as id_size, size.size_information, product_detail.* FROM product INNER JOIN product_detail ON product.id = product_detail.id_prd INNER JOIN size ON product_detail.id_size = size.id WHERE product.id = ".$id."");
    // $arr = array();
    $temp = array();
        // Gọi tổng sản phẩm cho thông báo
        if(isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $prd_id => $value) {
                foreach($_SESSION['cart'][$prd_id] as $id_size => $quantity){

                // Tìm bản ghi cần thêm vào giỏ hàng
                
                // $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC  ) as image ON product.id = image.id_prd INNER JOIN (SELECT id_prd,quantity FROM product_detail ) as product_detail ON product.id = product_detail.id_prd WHERE product.id = '$prd_id'";
                $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC) as image ON product.id = image.id_prd 
                INNER JOIN (SELECT id as detail_id,id_prd,quantity,id_size,price_detail FROM product_detail ) as product_detail ON product.id = product_detail.id_prd
                INNER JOIN (SELECT id as id_size, name as size_name FROM size) as size ON product_detail.id_size = size.id_size
                INNER JOIN (SELECT name as color_name , id as id_color FROM color) as color ON product.prd_color = color.id_color
                WHERE product.id = '$prd_id' AND product_detail.id_size = '$id_size'";
                $resultTemp = mysqli_query($connect, $sqlTemp);
                if(isset($resultTemp)){
                    // Lặp mảng để lấy ra chi tiết từng bản ghi
                    foreach ($resultTemp as $each){
                        // $temp[$prd_id]['name'] = $each['name'];
                        // $temp[$prd_id]['price'] = $each['price'];
                        // $temp[$prd_id]['image_product'] = $each['image_product'];
                        // $temp[$prd_id]['quantity'] = $each['quantity'];
                        // $temp[$prd_id]['amount'] = $value;
                        $temp[$prd_id][$id_size]['color'] = $each['color_name'];
                        $temp[$prd_id][$id_size]['name'] = $each['name'];
                        $temp[$prd_id][$id_size]['price'] = $each['price_detail']; 
                        $temp[$prd_id][$id_size]['detail_id'] = $each['detail_id'];
                        $temp[$prd_id][$id_size]['image_product'] = $each['image_product'];
                        $temp[$prd_id][$id_size]['quantity'] = $each['quantity'];
                        $temp[$prd_id][$id_size]['size_name'] = $each['size_name'];
                        $temp[$prd_id][$id_size]['amount'] = $quantity;
                     }
                  }
                }
            }
        }
    include_once('Config/close_connect.php');
    $arr = array();
    $arr['products'] = $query;
    $arr['image'] = $image;
    $arr['category'] = $cate;
    $arr['color'] = $color;
    $arr['size'] = $size;
    $arr['detail'] = $detail;
    $arr['product'] = $temp;
    return $arr;
}

switch($redirect){
    case 'product':
        $arr = indexx();
        break;
}
?>