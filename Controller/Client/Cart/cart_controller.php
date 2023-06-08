<?php
switch($action) {
    case '' : // Gọi giao diện giỏ hàng
        require_once('model/Client/Cart/cart_model.php');
        require_once('Views/Client/index.php');
        // require_once('Views/Client/pay.php');
        break;
    case 'add' : // Gọi phương thức thêm giỏ hàng
        require_once('model/Client/Cart/cart_model.php');
        
        break;
    case 'update' : // Gọi phương thức cập nhật
        require_once('model/Client/Cart/cart_model.php');
        header('Location:index.php?redirect=pay');

        break;
    case 'del' : // Xóa sản phẩm trong giỏ hàng
        require_once('model/Client/Cart/cart_model.php');
        
        header('Location:index.php');
        break;
    case 'checkaccess' : // Thanh toán mua hàng
        require_once('model/Client/Cart/cart_model.php');
        // header('Location:index.php?redirect=pay');
        header('Location:index.php');
        break;
}
?>