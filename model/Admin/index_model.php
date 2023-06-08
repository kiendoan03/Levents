<?php
function index(){
    include_once('Config/connect.php');
    $query_user = mysqli_query($connect,"SELECT COUNT(*) FROM user");
    $query_product = mysqli_query($connect,"SELECT COUNT(*) FROM product");
    $query_category = mysqli_query($connect,"SELECT COUNT(*) FROM category");
    $query_order = mysqli_query($connect,"SELECT COUNT(*) FROM `order`");
    // $sql_cate ="SELECT * FROM category ORDER BY id ASC";
    // $query_cate = mysqli_query($connect,$sql_cate);
    // $sql_featured = "SELECT * FROM product WHERE featured = 1 ORDER BY id ASC LIMIT 8";
    // $query_featured = mysqli_query($connect,$sql_featured);
    // $sql_new = "SELECT * FROM product ORDER BY id ASC LIMIT 8";
    // $query_new = mysqli_query($connect,$sql_new);
    include_once('Config/close_connect.php');
    $arr = array();
    $arr['user']=$query_user;
    $arr['category'] = $query_category;
    $arr['product'] = $query_product;
    $arr['order'] = $query_order;
    return $arr;
}
switch($redirect){
    case '' :
        $arr = index();
        break;
}
?>