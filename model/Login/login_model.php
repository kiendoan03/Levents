<?php
function checkLogin(){
    include_once('Config/connect.php');
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM user WHERE username = '$user' AND password = '$pass'";

    $query = mysqli_query($connect,$sql);
    $arr = array();
    $arr = $query;
    $count = mysqli_num_rows($query);
    if($count == 0 ){
        // $error = '<div class="alert alert-danger">Username or password incorrect</div>';
        return 0;
    }else{
        foreach($arr as $role){
            $_SESSION['role'] = $role['role'];
            $_SESSION['id_user'] = $role['ID'];
        }
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        if($role['role'] == '1'){
            return 1;
        }else{
            return 2;
        }
        // return $role['role'];
    }
    include_once('Config/close_connect');

}
function add_user(){
    include_once('Config/connect.php');
    $username = $_POST['username'];
    $email = $_POST['email'];
    if($_POST['re_password'] === $_POST['password']){
        $password = $_POST['password'];
        $sql ="INSERT INTO user (username,email, password, role) VALUES('$username', '$email', '$password','0')";
        $recod = mysqli_query($connect, $sql);
    }else{
        $error = '<div class="alert alert-danger">Confirmation password does not match</div>';
    }
    
    include_once('Config/close_connect.php');
    if(isset($error)){
      return $error;  
    }
    
    // header('location: index.php?controller=login&action=login');
}
switch($action){
    case 'checkLogin':
        $checklog = checkLogin();
        break;
    case 'add_user':
        $error = add_user();
        break;
}

?>