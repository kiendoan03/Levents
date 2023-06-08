<?php
// $redirect = $_GET['redirect']??'';
$redirect = $_GET['redirect'] ?? '';

if($redirect == ''){
    require_once('model/Client/index_model.php');
    require_once('Views/Client/index.php'); 
}else{
    switch($redirect){
    case'product': 
        require_once('model/Client/Product/product_model.php');
        require_once('Views/Client/index.php');
        require_once('Views/Client/product_detail.php');
        break;
    case 'contact': 
        require_once('model/Client/index_model.php');
        require_once('Views/Client/index.php');
        require_once('Views/Client/contact.php');
        break;
    case 'about': 
        require_once('model/Client/index_model.php' );
        require_once('Views/Client/index.php');
        require_once('Views/Client/about.php');
        break;
    case 'pay':
        // require_once('Views/Client/index.php');
        require_once('Controller/Client/Cart/cart_controller.php');
        require_once('Views/Client/pay.php');
        // require_once('model/Client/index_model.php' );
        // require_once('Views/Client/index.php');
        // require_once('Views/Client/cart.php');
        break;
    case 'category':
        require_once('model/Client/Category_product/cate_prd_model.php');
        require_once('Views/Client/index.php');
        require_once('Views/Client/category_product.php');
        break;
    case 'search':
        // if(isset($_POST['search_content']) || isset($_GET['search'])){
            require_once('model/Client/Search/search_model.php');
            require_once('Views/Client/index.php');
            require_once('Views/Client/search_result.php');
        // }else{
        //     header('Location:index.php');
        // }
        
        break;
}
}

?>  