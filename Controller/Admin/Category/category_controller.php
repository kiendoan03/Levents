<?php
switch($action) {
    case '' :     
        require_once('model/Admin/Category/category_model.php');
         require_once('Views/Admin/Category/main.php');break;
    case 'create':
        require_once('Views/Admin/Category/add.php'); 
        break;
    case 'store':
        require_once('model/Admin/Category/category_model.php');
        // header('location: ?controler=product');
        // header('location: ?controller='.$controller.'');
        // header('location: index.php?controller='.$controller.'$redirect='.$redirect'');
        header('location: index.php?controller='.$controller.'&redirect='.$redirect.'');


        break;
    case 'edit' :
        require_once('model/Admin/Category/category_model.php');
        require_once('Views/Admin/Category/edit.php');
            break;
    case 'update':
        require_once('model/Admin/Category/category_model.php');
        // header('location: ?controller='.$controller.'');
        // header('location: index.php?controller='.$controller.'$redirect='.$redirect'');
        header('location: index.php?controller='.$controller.'&redirect='.$redirect.'');

                // require_once('Views/User/add.php');
        break;
    case 'destroy':
        require_once('model/Admin/Category/category_model.php');
        // header('location: index.php?controller='.$controller.'$redirect='.$redirect'');
        header('location: index.php?controller='.$controller.'&redirect='.$redirect.'');

        break;
}
?>