<?php
function index() {
        include_once('Config/connect.php');
        $limit = 3;
        $totalRecords =  "SELECT count(id_order) as total FROM  `order`";
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

        $sql = "SELECT `order`.*, customer.*,user.* FROM `order` INNER JOIN customer ON `order`.id_cus = customer.id 
        LEFT JOIN user ON user.ID = `order`.id_user 
        ORDER BY `order`.id_order DESC LIMIT $start,$limit";
        $recod = mysqli_query($connect, $sql);
        include_once('Config/close_connect.php');
        $arr = array(
            'recod' => $recod,
            'current_page' => $current_page,
            'total_page' => $total_page
        );
        return $arr;
}

function detail() {
    include_once('Config/connect.php');
    $id_order = $_GET['id_order'];
    $sql ="SELECT product.*,product_detail.*,order_detail.*,`order`.*,color.id as id_color, color.name as name_color ,image.*,size.*,customer.* FROM `order` 
    INNER JOIN (SELECT customer.id as id_cus, customer.name as name_cus,customer.phonenumber as phone, customer.address as address FROM customer) as customer 
    ON `order`.id_cus = customer.id_cus INNER JOIN order_detail ON `order`.id_order = order_detail.id_order INNER JOIN product_detail
    ON order_detail.id_prd_detail = product_detail.id INNER JOIN product ON product.id = product_detail.id_prd 
    INNER JOIN (SELECT size.name as name_size, size.id as id_size FROM size) as size ON product_detail.id_size = size.id_size 
    INNER JOIN color ON product.prd_color = color.id
    INNER JOIN (SELECT * FROM image GROUP BY id_prd ASC ) as image ON image.id_prd = product.id WHERE `order`.id_order = ".$id_order."";
    $query = mysqli_query($connect,$sql);
    include_once('Config/close_connect.php');
    return $query;
}

function confirm() {
    include_once('Config/connect.php');
    $id_order = $_GET["id_order"];
    $query = mysqli_query($connect,"UPDATE `order` SET status = 2 WHERE id_order = ".$id_order."");
    if(isset($_SESSION['id_user'])){
        $id_user = $_SESSION['id_user'];
        // echo $id_user;
        // die();
        $change = mysqli_query($connect,"UPDATE `order` SET id_user = ($id_user) WHERE id_order = ".$id_order." ");
    }
    // echo '123';
    // die();
   
    include_once('Config/close_connect.php');
}

function deny() {
    include_once('Config/connect.php');
    $id_order = $_GET["id_order"];
    $status = $_GET["status"];
    if($status == 1 || $status == 2){
         mysqli_query($connect,"DELETE FROM order_detail WHERE id_order =".$id_order."");
         mysqli_query($connect,"DELETE FROM `order` WHERE id_order = ".$id_order." ");
    }
    include_once('Config/close_connect.php');
}

function ship() {
    include_once('Config/connect.php');
    $id_order = $_GET["id_order"];
    $query = mysqli_query($connect,"UPDATE `order` SET status = 3 WHERE id_order = ".$id_order."");
    if(isset($_SESSION['id_user'])){
        $id_user = $_SESSION['id_user'];
        // echo $id_user;
        // die();
        $change = mysqli_query($connect,"UPDATE `order` SET id_user = ($id_user) WHERE id_order = ".$id_order." ");
    }
    include_once('Config/close_connect.php');
}

function delivered() {
    include_once('Config/connect.php');
    $id_order = $_GET["id_order"];
    $query = mysqli_query($connect,"UPDATE `order` SET status = 4 WHERE id_order = ".$id_order."");
    if(isset($_SESSION['id_user'])){
        $id_user = $_SESSION['id_user'];
        // echo $id_user;
        // die();
        $change = mysqli_query($connect,"UPDATE `order` SET id_user = ($id_user) WHERE id_order = ".$id_order." ");
    }
    include_once('Config/close_connect.php');
}

switch($action){
    case '' :
        $arr = index();
        break;
    case 'detail' :
        $recod = detail();
        break;
    case 'confirm':
        confirm();
        break;
    case 'deny':
        deny();
        break;
    case 'ship':
        ship();
        break;
    case 'delivered':
        delivered();
        break;
}
?>