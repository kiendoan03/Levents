<?php
function index() {
    include_once('Config/connect.php');
    $limit = 3;
    $totalRecords =  "SELECT count(id) as total FROM category";
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
    $sql = "SELECT * FROM category ORDER BY id DESC LIMIT $start,$limit";
    $recod = mysqli_query($connect, $sql);
    include_once('Config/close_connect.php');
    $arr = array(
        'recod' => $recod,
        'current_page' => $current_page,
        'total_page' => $total_page
    );
    return $arr;
}
function store(){
    include_once('Config/connect.php');
    $name = $_POST['name_cate'];
    if(isset($_FILES['image_cate'])){
         $image_cate= $_FILES['image_cate']['name'];
    $File_tmp = $_FILES['image_cate']['tmp_name'];
        move_uploaded_file($File_tmp,"Public/images/".$image_cate);
    }
   
    if(isset($_FILES['image_size'])){
    $size=$_FILES['image_size'];
    $image_size= $size['name'];  
    move_uploaded_file($size['tmp_name'],"Public/images/".$image_size);
    // echo $image_size;
    
    }
    // echo $image_cate;
    //  echo $image_size;
    // die(); 
   
    // $File_tmp1 = $_FILES['image_size']['tmp_name'];
    $sql ="INSERT INTO category (name,image_cate, image_size) VALUES('$name', '$image_cate', '$image_size')";
    $recod = mysqli_query($connect, $sql);
   
    include_once('Config/close_connect.php');
    return $recod;
} 

function getCate(){
    include_once('Config/connect.php');
   $id = $_GET['id'];
    $sql = 'SELECT * FROM category WHERE id = '.$id.'';
   $recod = mysqli_query($connect,$sql);
    return $recod;
    // die();
    include_once('Config/close_connect.php');

}
function edit(){
    include_once('Config/connect.php');
    $id = $_POST['id']; 
    $name = $_POST['name_cate'];
    
    $arr = mysqli_fetch_array(mysqli_query($connect,"SELECT image_cate FROM category WHERE id =".$id.""));
    if($_FILES['image_cate']['name'] == ''){
        $image_cate = $arr['image_cate'];
    }
    else{
        $image_cate = $_FILES['image_cate']['name'];
    $File_tmp = $_FILES['image_cate']['tmp_name'];
     move_uploaded_file($File_tmp,"Public/images/".$image_cate);
    }
    $arr = mysqli_fetch_array(mysqli_query($connect,"SELECT image_size FROM category WHERE id =".$id.""));
    $size = $_FILES['image_size'];
    if($size['name'] == ''){
        $image_size = $arr['image_size'];
    }
    else{
        $image_size = $_FILES['image_size']['name'];
    // $File_tmp = $size['tmp_name'];
     move_uploaded_file($size['tmp_name'],"Public/images/".$image_size);
    }
    
    $sql = "UPDATE category SET name ='$name', image_cate ='$image_cate',image_size='$image_size' WHERE id =".$id."";
    mysqli_query($connect,$sql);
   
    include_once('Config/close_connect.php');
    
}
function destroy(){
    include_once('Config/connect.php');
if(isset($_GET['id'])){
    $sql = "DELETE FROM category WHERE id =".$_GET['id']."";
    
    mysqli_query($connect, $sql);
    
    header('location: ?controller=admin&redirect=user');
}
include_once('Config/close_connect.php');

}
switch($action) {
    case '': $arr = index();break;
    case 'store': store(); break;
    case 'edit': $recod = getCate(); break;
    case 'update': edit(); break;
    case 'destroy' :destroy();
    break;

}
?>