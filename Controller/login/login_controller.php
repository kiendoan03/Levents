<?php
$action = '';
if(isset($_GET['action'])){
    $action = $_GET['action'];
}
switch($action){
    case 'login' : require_once('Views/login-logout/login.php');
    case 'checkLogin' : 
        require_once('model/Login/login_model.php');
        if(isset($checklog)){
            if($checklog == 1){
               header('location: index.php?controller=admin'); 
            }elseif($checklog == 2){
                header('location: index.php');
            }else{
            include_once('Views/login-logout/login.php');
            }
            
        }else{
            include_once('Views/login-logout/login.php');
        }
        ;break;
    case 'logout' :
        session_destroy();
        header('location: index.php');
        break;
    case 'register':
        require_once('Views/login-logout/register.php');
        break;
    case 'add_user':
        require_once('model/Login/login_model.php');
        if(isset($error)) {
            // require_once('Views/Admin/User/add.php');
            require_once('Views/login-logout/register.php');
        }else{
            // header('location: index.php?controller='.$controller.'&redirect='.$redirect.'');
           include_once('Views/login-logout/login.php'); 
        }
        
        
        break;
}
?>