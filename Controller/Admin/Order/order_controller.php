<?php
switch($action) {
    case '' :     
        require_once('model/Admin/Order/order_model.php');
        require_once('Views/Admin/Order/main.php');
        break;
    case 'detail' :     
        require_once('model/Admin/Order/order_model.php');
        require_once('Views/Admin/Order/detail.php');
        break;
    case 'confirm' :     
        require_once('model/Admin/Order/order_model.php');
        header('location: index.php?controller=admin&redirect=order');
        break;
    case 'deny' :     
        require_once('model/Admin/Order/order_model.php');
        header('location: index.php?controller=admin&redirect=order');
        break;
    case 'ship' :     
        require_once('model/Admin/Order/order_model.php');
        header('location: index.php?controller=admin&redirect=order');
        break;
    case 'delivered' :     
        require_once('model/Admin/Order/order_model.php');
        header('location: index.php?controller=admin&redirect=order');
        break;
}
?>