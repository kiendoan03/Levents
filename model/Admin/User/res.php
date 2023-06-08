<?php
$id = $_GET['ID'];
mysqli_query($connect,"UPDATE user SET password = '123456' WHERE ID =".$id."");
header('location:index.php');
?>