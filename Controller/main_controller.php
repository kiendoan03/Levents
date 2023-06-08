<?php
// Lay gia tri Controller nao dang lam viec voi Client
$controller = $_GET['controller'] ?? '';

// Dieu khien controller lam gi
$action = $_GET['action'] ?? '';



// Goi chuc nang cho Client

if(!isset($_GET['controller'])) {
    require_once('Controller/Client/main_client_controller.php');
}else {
    switch($controller) {
        case 'admin' : require_once('Controller/Admin/main_admin_controller.php'); break;
        case 'login' : require_once('Controller/login/login_controller.php'); break;
    }
}
?>