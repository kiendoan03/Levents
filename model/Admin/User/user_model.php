<?php
function index() {
    include_once('Config/connect.php');
    $limit = 3;
    $totalRecords =  "SELECT count(id) as total FROM user";
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
    $sql = "SELECT * FROM user ORDER BY id DESC LIMIT $start,$limit";
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
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    
    if($_POST['re_password'] === $_POST['password']){
        $password = $_POST['password'];
        $sql ="INSERT INTO user (username,email, password, role) VALUES('$username', '$email', '$password','$role')";
        $recod = mysqli_query($connect, $sql);
    }else{
        $error = '<div class="alert alert-danger">Confirmation password does not match</div>';
    }
     if(isset($error)){
       return $error; 
    }
    include_once('Config/close_connect.php');
   
    
} 

function getUser(){
    include_once('Config/connect.php');
     $id = $_GET['ID'];
    $sql = 'SELECT * FROM user WHERE ID = '.$id.'';
     $recod = mysqli_query($connect,$sql);
    return $recod;
    // die();
    include_once('Config/close_connect.php');

}
function edit(){
    include_once('Config/connect.php');
    $id = $_GET['ID'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    // $role = $_POST['role'];
   
    
    $arr = mysqli_fetch_array(mysqli_query($connect,"SELECT role FROM user WHERE id =".$id.""));
    if($_POST['role'] == ''){
        $role = $arr['role'];
    }
    else{
        $role = $_POST['role'];
    } 
    if($_POST['re_password'] === $_POST['password']){
        $password = $_POST['password'];
         $sql = "UPDATE user SET email = '$email',username = '$username',password = '$password', role = '$role' WHERE ID = ".$id."";
    $recod = mysqli_query($connect, $sql);
    }else{
        $error = '<div class="alert alert-danger">Confirmation password does not match</div>';
    }
    include_once('Config/close_connect.php');
       if(isset($error)){
    include_once('Config/connect.php');
        return $error; 
     }
}
function destroy(){
    include_once('Config/connect.php');
    if(isset($_GET['ID'])){
    $sql = "DELETE FROM user WHERE ID =".$_GET['ID']."";
    
    mysqli_query($connect, $sql);
    
    header('location: ?controller=admin&redirect=user');
}
include_once('Config/close_connect.php');

}
switch($action) {
    case '': $arr = index();break;
    case 'store': $error = store(); break;
    case 'edit': $recod = getUser(); break;
    case 'update':$error = edit();break;
    case 'destroy' :destroy();
    break;

}
?>