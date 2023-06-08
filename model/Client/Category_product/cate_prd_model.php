<?php
function index(){
    $id = $_GET['id'];
    include_once('Config/connect.php');
    $limit = 8;
    $totalRecords =  "SELECT count(id) as total FROM product WHERE prd_cate = '$id'";
    $queryTotalRecords = mysqli_query($connect, $totalRecords);
    $result = mysqli_fetch_array($queryTotalRecords);
    $total_records = $result['total'];
    $total_page = ceil( $total_records/ $limit );
    if(isset($_GET['current_page'])){
        $current_page = $_GET['current_page'];
    }else{
        $current_page = 1;
    }
    if($current_page < 1){
        $current_page = 1 ;
    }
    if($current_page > $total_page){
        $current_page = $total_page;
    }
    $current_page = isset($_GET['current_page']) ? max(1, (int)$_GET['current_page']) : 1;
    $start = ($current_page - 1) * $limit;
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }else{
        $action = '';
    }
    $cate = mysqli_query($connect,"SELECT * FROM category ORDER BY id ASC");
    $query = mysqli_query($connect, "SELECT product.*,category.id as cate_id , category.name as name_cate,category.image_cate,category.image_size FROM product INNER JOIN category ON product.prd_cate = category.id WHERE category.id = '$id'  LIMIT $start,$limit");
    $image = "SELECT * FROM image";
    $query_image = mysqli_query($connect,$image);  
    $color = mysqli_query($connect,"SELECT * FROM color");
    $detail = mysqli_query($connect,"SELECT * FROM product_detail"); 
    
   
    $temp = array();
    // Gọi tổng sản phẩm cho thông báo
    if(isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $prd_id => $value) {
            foreach($_SESSION['cart'][$prd_id] as $id_size => $quantity){

            // Tìm bản ghi cần thêm vào giỏ hàng
            
            // $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC  ) as image ON product.id = image.id_prd INNER JOIN (SELECT id_prd,quantity FROM product_detail ) as product_detail ON product.id = product_detail.id_prd WHERE product.id = '$prd_id'";
            $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC) as image ON product.id = image.id_prd 
            INNER JOIN (SELECT id as detail_id,id_prd,quantity,id_size ,price_detail FROM product_detail ) as product_detail ON product.id = product_detail.id_prd
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
    $arr['category'] = $cate;
    $arr['color'] = $color;
    $arr['detail'] = $detail;
    $arr['image'] = $query_image;
    $arr['product'] = $temp;
    $arr['current_page'] = $current_page;
    $arr['total_page'] = $total_page;
    $arr['action'] = $action;
    return $arr;
    
}



function filterMax(){
    $id = $_GET['id'];
    include_once('Config/connect.php');
    $limit = 8;
    $totalRecords =  "SELECT count(id) as total FROM product WHERE prd_cate = '$id'";
    $queryTotalRecords = mysqli_query($connect, $totalRecords);
    $result = mysqli_fetch_array($queryTotalRecords);
    $total_records = $result['total'];
    $total_page = ceil( $total_records/ $limit );
    if(isset($_GET['current_page'])){
        $current_page = $_GET['current_page'];
    }else{
        $current_page = 1;
    }
    if($current_page < 1){
        $current_page = 1 ;
    }
    if($current_page > $total_page){
        $current_page = $total_page;
    }
    $current_page = isset($_GET['current_page']) ? max(1, (int)$_GET['current_page']) : 1;
    $start = ($current_page - 1) * $limit;
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }else{
        $action = '';
    }
    $cate = mysqli_query($connect,"SELECT * FROM category ORDER BY id ASC");
    $query = mysqli_query($connect, "SELECT product.*, category.id as cate_id, category.name as name_cate,category.image_cate,category.image_size FROM product INNER JOIN category ON product.prd_cate = category.id WHERE category.id = '$id' ORDER BY product.price DESC LIMIT $start,$limit");
    $image = "SELECT * FROM image";
    $query_image = mysqli_query($connect,$image); 
    $color = mysqli_query($connect,"SELECT * FROM color");
    $detail = mysqli_query($connect,"SELECT * FROM product_detail");
    $temp = array();
    // Gọi tổng sản phẩm cho thông báo
    if(isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $prd_id => $value) {
            foreach($_SESSION['cart'][$prd_id] as $id_size => $quantity){

            // Tìm bản ghi cần thêm vào giỏ hàng
            
            // $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC  ) as image ON product.id = image.id_prd INNER JOIN (SELECT id_prd,quantity FROM product_detail ) as product_detail ON product.id = product_detail.id_prd WHERE product.id = '$prd_id'";
            $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC) as image ON product.id = image.id_prd 
            INNER JOIN (SELECT id as detail_id,id_prd,quantity,id_size ,price_detail FROM product_detail ) as product_detail ON product.id = product_detail.id_prd
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
    $arr['category'] = $cate;
    $arr['image'] = $query_image;
    $arr['color'] = $color;
    $arr['detail'] = $detail;
    $arr['product'] = $temp;
    $arr['current_page'] = $current_page;
    $arr['total_page'] = $total_page;
    $arr['action'] = $action;
    return $arr;
    
}

function filterMin(){
    $id = $_GET['id'];
    include_once('Config/connect.php');
    $limit = 8;
    $totalRecords =  "SELECT count(id) as total FROM product WHERE prd_cate = '$id'";
    $queryTotalRecords = mysqli_query($connect, $totalRecords);
    $result = mysqli_fetch_array($queryTotalRecords);
    $total_records = $result['total'];
    $total_page = ceil( $total_records/ $limit );
    if(isset($_GET['current_page'])){
        $current_page = $_GET['current_page'];
    }else{
        $current_page = 1;
    }
    if($current_page < 1){
        $current_page = 1 ;
    }
    if($current_page > $total_page){
        $current_page = $total_page;
    }
    $current_page = isset($_GET['current_page']) ? max(1, (int)$_GET['current_page']) : 1;
    $start = ($current_page - 1) * $limit;
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }else{
        $action = '';
    }
    $cate = mysqli_query($connect,"SELECT * FROM category ORDER BY id ASC");
    $query = mysqli_query($connect, "SELECT product.*, category.id as cate_id, category.name as name_cate,category.image_cate,category.image_size FROM product INNER JOIN category ON product.prd_cate = category.id WHERE category.id = '$id' ORDER BY product.price ASC LIMIT $start,$limit");
    $image = "SELECT * FROM image";
    $query_image = mysqli_query($connect,$image); 
    $color = mysqli_query($connect,"SELECT * FROM color");
    $detail = mysqli_query($connect,"SELECT * FROM product_detail");
    $temp = array();
    // Gọi tổng sản phẩm cho thông báo
    if(isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $prd_id => $value) {
            foreach($_SESSION['cart'][$prd_id] as $id_size => $quantity){

            // Tìm bản ghi cần thêm vào giỏ hàng
            
            // $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC  ) as image ON product.id = image.id_prd INNER JOIN (SELECT id_prd,quantity FROM product_detail ) as product_detail ON product.id = product_detail.id_prd WHERE product.id = '$prd_id'";
            $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC) as image ON product.id = image.id_prd 
            INNER JOIN (SELECT id as detail_id,id_prd,quantity,id_size ,price_detail FROM product_detail ) as product_detail ON product.id = product_detail.id_prd
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
    $arr['category'] = $cate;
    $arr['image'] = $query_image;
    $arr['color'] = $color;
    $arr['detail'] = $detail;
    $arr['product'] = $temp;
    $arr['current_page'] = $current_page;
    $arr['total_page'] = $total_page;
    $arr['action'] = $action;
    return $arr;
    
}

function filterFeatured(){
    $id = $_GET['id'];
    include_once('Config/connect.php');
    $limit = 8;
    $totalRecords =  "SELECT count(id) as total FROM product WHERE prd_cate = '$id' AND featured = 1";
    $queryTotalRecords = mysqli_query($connect, $totalRecords);
    $result = mysqli_fetch_array($queryTotalRecords);
    $total_records = $result['total'];
    $total_page = ceil( $total_records/ $limit );
    if(isset($_GET['current_page'])){
        $current_page = $_GET['current_page'];
    }else{
        $current_page = 1;
    }
    if($current_page < 1){
        $current_page = 1 ;
    }
    if($current_page > $total_page){
        $current_page = $total_page;
    }
    $current_page = isset($_GET['current_page']) ? max(1, (int)$_GET['current_page']) : 1;

    $start = ($current_page - 1) * $limit;
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }else{
        $action = '';
    }
    $cate = mysqli_query($connect,"SELECT * FROM category ORDER BY id ASC");
    $query = mysqli_query($connect, "SELECT product.*, category.id as cate_id, category.name as name_cate,category.image_cate,category.image_size FROM product INNER JOIN category ON product.prd_cate = category.id WHERE category.id = '$id' AND product.featured='1' LIMIT $start,$limit");
    $image = "SELECT * FROM image";
    $query_image = mysqli_query($connect,$image); 
    $color = mysqli_query($connect,"SELECT * FROM color");
    $detail = mysqli_query($connect,"SELECT * FROM product_detail");
    $temp = array();
    // Gọi tổng sản phẩm cho thông báo
    if(isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $prd_id => $value) {
            foreach($_SESSION['cart'][$prd_id] as $id_size => $quantity){

            // Tìm bản ghi cần thêm vào giỏ hàng
            
            // $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC  ) as image ON product.id = image.id_prd INNER JOIN (SELECT id_prd,quantity FROM product_detail ) as product_detail ON product.id = product_detail.id_prd WHERE product.id = '$prd_id'";
            $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC) as image ON product.id = image.id_prd 
            INNER JOIN (SELECT id as detail_id,id_prd,quantity,id_size ,price_detail FROM product_detail ) as product_detail ON product.id = product_detail.id_prd
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
    $arr['category'] = $cate;
    $arr['image'] = $query_image;
    $arr['color'] = $color;
    $arr['detail'] = $detail;
    $arr['product'] = $temp;
    $arr['current_page'] = $current_page;
    $arr['total_page'] = $total_page;
    $arr['action'] = $action;
    return $arr;
    
}
function filterNew(){
    $id = $_GET['id'];
    include_once('Config/connect.php');
    $limit = 8;
    $totalRecords =  "SELECT count(id) as total FROM product WHERE prd_cate = '$id'";
    $queryTotalRecords = mysqli_query($connect, $totalRecords);
    $result = mysqli_fetch_array($queryTotalRecords);
    $total_records = $result['total'];
    $total_page = ceil( $total_records/ $limit );
    if(isset($_GET['current_page'])){
        $current_page = $_GET['current_page'];
    }else{
        $current_page = 1;
    }
    if($current_page < 1){
        $current_page = 1 ;
    }
    if($current_page > $total_page){
        $current_page = $total_page;
    }
    $current_page = isset($_GET['current_page']) ? max(1, (int)$_GET['current_page']) : 1;

    $start = ($current_page - 1) * $limit;
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }else{
        $action = '';
    }
    $cate = mysqli_query($connect,"SELECT * FROM category ORDER BY id ASC");
    $query = mysqli_query($connect, "SELECT product.*, category.id as cate_id,category.name as name_cate,category.image_cate,category.image_size FROM product INNER JOIN category ON product.prd_cate = category.id WHERE category.id = '$id'ORDER BY product.id DESC LIMIT $start,$limit");
    $image = "SELECT * FROM image";
    $query_image = mysqli_query($connect,$image); 
    $color = mysqli_query($connect,"SELECT * FROM color");
    $detail = mysqli_query($connect,"SELECT * FROM product_detail");
    $temp = array();
    // Gọi tổng sản phẩm cho thông báo
    if(isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $prd_id => $value) {
            foreach($_SESSION['cart'][$prd_id] as $id_size => $quantity){

            // Tìm bản ghi cần thêm vào giỏ hàng
            
            // $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC  ) as image ON product.id = image.id_prd INNER JOIN (SELECT id_prd,quantity FROM product_detail ) as product_detail ON product.id = product_detail.id_prd WHERE product.id = '$prd_id'";
            $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC) as image ON product.id = image.id_prd 
            INNER JOIN (SELECT id as detail_id,id_prd,quantity,id_size ,price_detail FROM product_detail ) as product_detail ON product.id = product_detail.id_prd
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
    $arr['category'] = $cate;
    $arr['image'] = $query_image;
    $arr['color'] = $color;
    $arr['detail'] = $detail;
    $arr['product'] = $temp;
    $arr['current_page'] = $current_page;
    $arr['total_page'] = $total_page;
    $arr['action'] = $action;
    return $arr;
    
}


switch($action) {
    case '':
        $arr = index();
        break;
    case 'filter_max_to_min':
        $arr = filterMax();
        break; 
    case 'filter_min_to_max':
        $arr = filterMin();
        break; 
    case 'filter_feature':
        $arr = filterFeatured();
        break;
    case 'filter_new':
        $arr = filterNew();
        break; 
    
}
?>