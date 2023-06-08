<?php
function index(){
    include_once('Config/connect.php');
    $sql_cate ="SELECT * FROM category ORDER BY id ASC";
    $query_cate = mysqli_query($connect,$sql_cate);
    $sql_featured = "SELECT * FROM product WHERE featured = 1 ORDER BY id DESC LIMIT 8;";
    $query_featured = mysqli_query($connect,$sql_featured);
    $image = "SELECT * FROM image";
    $query_image = mysqli_query($connect,$image);   
    $color = mysqli_query($connect,"SELECT * FROM color");
    $detail = mysqli_query($connect,"SELECT * FROM product_detail");
    $sql_new = "SELECT * FROM product ORDER BY id ASC LIMIT 8";
    $query_new = mysqli_query($connect,$sql_new);
    $arr = array();
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
    $arr['category'] = $query_cate;
    $arr['featured'] = $query_featured;
    $arr['new'] = $query_new;
    $arr['image'] = $query_image;
    $arr['color'] = $color;
    $arr['detail'] = $detail;
    $arr['product'] = $temp;
    return $arr;
}
switch($redirect){
    case '' :
        $arr = index();
        break;
    case 'product' :
        $arr = index();
        break;
    case 'contact' :
        $arr = index();
        break;
    case  'about':
        $arr = index();
        break;
    case  'category':
        $arr = index();
        break;
    case 'pay':
        $arr = index();
        break;
    case 'search':
        $arr = index();
        break;
//   case 'cart':
//         $arr = index();
//         break;   
}

?>