<!-- <?php
// Hiển thị giỏ hàng theo SESSION
function view_cart() {
    $arr = array();
    $temp = array();
    include_once('Config/connect.php');
    $cate = mysqli_query($connect, "SELECT * FROM category ORDER BY id ASC");
    if(isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $prd_id => $value) {
            foreach($_SESSION['cart'][$prd_id] as $id_size => $quantity){
                // $query = mysqli_query($connect, "INSERT INTO test(id,size) VALUES ('$prd_id','$id_size')");
                
                // die();
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
                        $temp[$prd_id][$id_size]['color'] = $each['color_name']; 
                        $temp[$prd_id][$id_size]['name'] = $each['name'];
                        $temp[$prd_id][$id_size]['price'] = $each['price_detail']; 
                        $temp[$prd_id][$id_size]['detail_id'] = $each['detail_id'];
                        $temp[$prd_id][$id_size]['image_product'] = $each['image_product'];
                        $temp[$prd_id][$id_size]['quantity'] = $each['quantity'];
                        $temp[$prd_id][$id_size]['size_name'] = $each['size_name'];
                        $temp[$prd_id][$id_size]['amount'] = $quantity;
                        // $temp[$prd_id]['name'] = $each['name'];
                        // $temp[$prd_id]['price'] = $each['price']; 
                        // // $temp[$prd_id]['detail_id'] = $each['detail_id'];
                        // $temp[$prd_id]['image_product'] = $each['image_product'];
                        // $temp[$prd_id]['quantity'] = $each['quantity'];
                        // // $temp[$prd_id]['size_name'] = $each['size_name'];
                        // $temp[$prd_id]['amount'] = $value;
                    }
                }
            }
           
        }
    }
    // 
    include_once('Config/close_connect.php');
    $arr['product'] = $temp;
    $arr['category'] = $cate;
    return $arr;
    // header('Location:?redirect=pay');
    // require_once('Views/Client/index.php');
}




// Thêm sản phẩm vào giỏ hàng
function add_cart() {
   
    $prd_id = $_POST['id_prd'];
    $id_size = $_POST['size_id'];
   
    if(isset($_SESSION['cart'])){
        if(isset($_SESSION['cart'][$prd_id][$id_size])){
            $_SESSION['cart'][$prd_id][$id_size]++;
        } else {
            $_SESSION['cart'][$prd_id][$id_size] = 1;
        }
    } else {
        $_SESSION['cart'] = array();
        $_SESSION['cart'][$prd_id][$id_size] = 1;
    }
    

    header("Location:?redirect=product&id=".$prd_id);
    // header('Location:index.php?redirect=pay');
}
// Cập nhật giỏ hàng
function update_cart() {
    // $quantity = $_POST['qtt']; // Lấy số lượng sản phẩm được gửi từ giỏ hàng lên
    // foreach($quantity as $prd_id => $qtt) {
    //     if(isset($_SESSION['cart'][$prd_id])){
    //         foreach($quantity_size as $id_size => $qtt){
    //             $_SESSION['cart'][$prd_id][$id_size] = $qtt;
    //         }
    //      }else{
    //         $_SESSION['cart'][$prd_id] = $qtt;
    //     }   
    //     $_SESSION['cart'][$prd_id] = $qtt;
    // }
    $quantity = $_POST['qtt']; // Lấy số lượng sản phẩm được gửi từ giỏ hàng lên
    foreach($quantity as $prd_id => $qtt_size) {
        foreach($qtt_size as $id_size => $qtt){
        $_SESSION['cart'][$prd_id][$id_size] = $qtt;
        }
    }
}
// Xóa giỏ hàng
function del_cart() {
    $redirect = $_GET[$redirect];
    $prd_id = $_GET["id"];
    $id_size = $_GET["id_size"];
    unset($_SESSION["cart"][$prd_id][$id_size]);
    echo count($_SESSION["cart"]);
    // die('abc');
    // die;
    if(count($_SESSION["cart"]) == 0){
        unset($_SESSION["cart"]);
    }
    // header("Location:?redirect=".$redirect);
}
function checkaccess() {
    include_once('Config/connect.php');
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['dateOfBirth']; 
    $note = $_POST['note'];
    $status = 1;
    date_default_timezone_set('Asia/Bangkok');
    $datebuy = date('Y-m-d H:i:s');
    // $id_detail = $_POST['id_detail'];
    // $amount = $_POST['amount'];
    $sql_customer = "INSERT INTO customer(name,date_of_birth,address,phonenumber,email)
                     VALUES ('$name','$dateOfBirth','$address','$phone','$email')";
    $query_customer = mysqli_query($connect,$sql_customer);
    $id_cus = mysqli_insert_id($connect);
    $sql_order = "INSERT INTO `order`(date_buy,id_cus,status,note)
                  VALUES ('$datebuy', '$id_cus',' $status', '$note')";
    $query_order = mysqli_query($connect, $sql_order);
    $id_order = mysqli_insert_id($connect);

    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $prd_id => $size){
            foreach($size as $id_size => $quantity){
                $sqlTemp = "SELECT * FROM product INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC) as image ON product.id = image.id_prd 
                INNER JOIN (SELECT id as detail_id,id_prd,quantity,id_size FROM product_detail ) as product_detail ON product.id = product_detail.id_prd
                INNER JOIN (SELECT id as id_size, name as size_name FROM size) as size ON product_detail.id_size = size.id_size
                WHERE product.id = '$prd_id' AND product_detail.id_size = '$id_size'";
                $resultTemp = mysqli_query($connect, $sqlTemp);
                    // Lặp mảng để lấy ra chi tiết từng bản ghi
                    foreach ($resultTemp as $value){ 
                       $id_detail_prd = $value['detail_id'];
                        $amount = $quantity;
                        
                }
                  $sql_order_detail = "INSERT INTO order_detail(id_prd_detail,id_order,amount_prd) VALUES('$id_detail_prd','$id_order','$amount')";
                  $query_order_detail = mysqli_query($connect,$sql_order_detail); 
            }
        }
    }

    
    require_once('Config/close_connect.php');
    unset($_SESSION['cart']);
}
// Trả kết quả về Controller
switch($action) {
    case '': $arr = view_cart(); break;
    case 'add': add_cart(); break;
    case 'update': update_cart(); break;
    case 'del': del_cart(); break;
    case 'checkaccess': checkaccess(); break;
}

?>