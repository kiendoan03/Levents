<?php
include_once('Config/connect.php');
if(isset($_GET['ID'])){
    $sql = "DELETE FROM user WHERE ID =".$_GET['ID']."";
    
    mysqli_query($connect, $sql);
    
    header('location: ?controller=user');
}
?>  