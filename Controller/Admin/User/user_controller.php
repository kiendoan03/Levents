<?php
switch($action) {
    case '':
        require_once('model/Admin/User/user_model.php');
        require_once('Views/Admin/User/main.php');
        break;
        case 'create':
            require_once('Views/Admin/User/add.php');
            break;
        case 'store':
            require_once('model/Admin/User/user_model.php');
            // header('location: ?controller='.$controller.'');
            if(isset($error)) {
                require_once('Views/Admin/User/add.php');
            }else{
                header('location: index.php?controller='.$controller.'&redirect='.$redirect.'');
            }
            

            // require_once('Views/User/add.php');
            break;
        case 'edit':
            require_once('model/Admin/User/user_model.php');
            require_once('Views/Admin/User/edit.php');
            break;
        case 'update':
            require_once('model/Admin/User/user_model.php');
            if(isset($error)) {
                $id = $_GET['ID'];
                header('location: index.php?controller='.$controller.'&redirect='.$redirect.'&action=edit&ID='.$id.'');
            }else{
                header('location: index.php?controller='.$controller.'&redirect='.$redirect.'');
            }
            break;
        case 'destroy':
            require_once('model/Admin/User/user_model.php');
            header('location: index.php?controller='.$controller.'&redirect='.$redirect.'');

            break;

}

?>