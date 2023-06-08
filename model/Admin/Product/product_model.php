<?php
function index(){
    include_once('Config/connect.php');
    $limit = 3;
    $totalRecords =  "SELECT count(id) as total FROM product";
    $queryTotalRecords = mysqli_query($connect, $totalRecords);
    $result = mysqli_fetch_array($queryTotalRecords);
    $total_records = $result['total'];
    $total_page = ceil( $total_records/ $limit );
    if(isset($_GET['current_page'])){
        $current_page = $_GET['current_page'];
    }else{
        $current_page = 1;
    }
    if($current_page < 1){
        $current_page = 1 ;
    }
    if($current_page > $total_page){
        $current_page = $total_page;
    }
    $current_page = isset($_GET['current_page']) ? max(1, (int)$_GET['current_page']) : 1;

    $start = ($current_page - 1) * $limit;
    // $query = mysqli_query($connect)
    $recod = mysqli_query($connect, "SELECT * FROM product JOIN (SELECT * FROM image GROUP BY id_prd ASC ) as image ON product.id = image.id_prd INNER JOIN (SELECT name as name_color,id as id_color, color_image FROM color) as color ON product.prd_color = color.id_color
    INNER JOIN (SELECT name as name_cate, id as id_cate FROM category) as category ON product.prd_cate = category.id_cate ORDER BY product.id DESC LIMIT $start,$limit");
    include_once('Config/close_connect.php');
    $arr = array(
        'recod' => $recod,
        'current_page' => $current_page,
        'total_page' => $total_page
    );
    return $arr;
}

function create(){
    include_once('Config/connect.php');
    $recod= mysqli_query($connect, "SELECT * FROM category ORDER BY id ASC");
    $color = mysqli_query($connect, "SELECT * FROM color ORDER BY id ASC");
    $size = mysqli_query($connect, "SELECT * FROM size ORDER BY id ASC");
    include_once('Config/close_connect.php');
    $arr = array();
    $arr['cate'] = $recod;
    $arr['color'] = $color;
    $arr['size']= $size;
    return $arr;
}

function store(){
    include_once('Config/connect.php');
    $name = $_POST['name'];
    $price = $_POST['price'];
    $promotion = $_POST['promotion'];
    $color = $_POST['color'];
    $description = $_POST['description'];
    $arr = array();
    if(isset($_POST['featured'])){
        $featured = 1;
    }
    else{
        $featured = 0;
    }
    // echo $price;
    // echo '<br>';
    // echo $promotion;
    // echo '<br>';
    $price_detail = ($price - ($price * ($promotion / 100))) ;
    // echo $price_detail;
    // die();
    $cate = $_POST['prd_cate'];
    $image = $_FILES['image']['name'];
    $File_tmp = $_FILES['image']['tmp_name'];
    $sql = "INSERT INTO product (name,price,promotion,description,featured,prd_cate,prd_color) VALUES('$name','$price','$promotion','$description','$featured','$cate','$color')";
    mysqli_query($connect,$sql);
     foreach($image as $key => $value){
    move_uploaded_file($File_tmp[$key],"Public/images/".$value);
    }
   $id_prd = mysqli_insert_id($connect);
   
    foreach(mysqli_query($connect,"SELECT * FROM size") as $size){
        if(!isset($_POST['quantity_'.$size['name']]) || $_POST['quantity_'.$size['name']] == ''){
            $size_id = $size['id'];
            $ass_prd_detail = "INSERT INTO product_detail(id_prd,id_size,quantity, price_deatail) VALUES ('$id_prd','$size_id', '0','$price_detail')";
            $query = mysqli_query($connect,$ass_prd_detail);
        }else{ 
            $quantity = $_POST['quantity_'.$size['name']];
            $size_id = $size['id'];
            $ass_prd_detail = "INSERT INTO product_detail(id_prd, id_size,quantity,price_detail) VALUES ('$id_prd','$size_id', $quantity,'$price_detail')";
            $query = mysqli_query($connect,$ass_prd_detail);
        }
    }
    foreach($image as $key => $value){
        mysqli_query($connect,"INSERT INTO image(id_prd,image_product) VALUES ('$id_prd','$value')");
        // break;
    }

    // move_uploaded_file($File_tmp,"Public/images/".$image);
    include_once('Config/close_connect.php');
}

function getProduct(){
    include_once('Config/connect.php');
    $id = $_GET['id'];
    $sql = 'SELECT product.*, category.name as name_cate, category.id as id_cate ,image.*,color.id as id_color, color.name as name_color  FROM category INNER JOIN product ON category.id = product.prd_cate 
    INNER JOIN image ON product.id = image.id_prd INNER JOIN color ON product.prd_color = color.id WHERE product.id = '.$id.'';
    $recod = mysqli_query($connect,$sql);
    $cate = mysqli_query($connect,"SELECT name as category_name, id as category_id FROM category ORDER BY id ASC");
    $color = mysqli_query($connect,"SELECT name as color_name , id as color_id FROM color ORDER BY id ASC");
    $size_quantity = mysqli_query($connect,"SELECT size.name as name_size,size.id, product_detail.*, product.* FROM size INNER JOIN product_detail ON size.id = product_detail.id_size INNER JOIN product ON product_detail.id_prd = product.id WHERE product.id = ".$id."");
    $arr = array();
    $arr['product'] = $recod;
    $arr['category'] = $cate;
    $arr['color'] = $color;
    $arr['size_quantity'] = $size_quantity;
    return $arr;
    // die();
    include_once('Config/close_connect.php');

}



function update(){
    include_once('Config/connect.php');
    $id = $_POST['id']; 
    $name = $_POST['name'];
    $price = $_POST['price'];
    $promotion = $_POST['promotion'];
    $color = $_POST['color'];
    $description = $_POST['description'];
    if(isset($_POST['featured'])){
        $featured = 1;
    }
    else{
        $featured = 0;
    }      
    $price_detail = ($price - ($price * ($promotion / 100))) ;

    $arr = mysqli_fetch_array(mysqli_query($connect,"SELECT image_product FROM image WHERE id_prd ='.$id.'"));
    $image = $_FILES['image']['name'];
    $File_tmp = $_FILES['image']['tmp_name']; 
      if(!empty($_FILES['image']['name'][0])){
          
        mysqli_query($connect,"DELETE FROM image WHERE id_prd = $id");
         
        foreach($image as $key => $value){
        move_uploaded_file($File_tmp[$key],"Public/images/".$value);
        }
        foreach($image as $key => $value){
            mysqli_query($connect,"INSERT INTO image(id_prd,image_product) VALUES ('$id','$value')");
            // break;
        }   
    }
    $cate = $_POST['prd_cate'];
    $sql = "UPDATE product SET name ='$name', price =$price,promotion = '$promotion', prd_color='$color', description='$description',featured=$featured, prd_cate='$cate' WHERE id =".$id."";
    mysqli_query($connect,$sql);

    foreach(mysqli_query($connect,"SELECT * FROM size") as $size){
        if(!isset($_POST['quantity_'.$size['name']]) || $_POST['quantity_'.$size['name'].''] == '' ||  $_POST['quantity_'.$size['name']] == '0'){
            $size_id = $size['id'];
            
            
            $ass_prd_detail = "UPDATE product_detail SET quantity = '0', price_detail='$price_detail'  WHERE id_prd = $id AND id_size = $size_id";
            $query = mysqli_query($connect,$ass_prd_detail);
        }else{ 
            $quantity = $_POST['quantity_'.$size['name'].''];
            $size_id = $size['id'];
            $ass_prd_detail = "UPDATE product_detail SET quantity = '$quantity', price_detail='$price_detail'  WHERE id_prd = $id AND id_size = $size_id";
            $query = mysqli_query($connect,$ass_prd_detail);
        }
    }

    // foreach($image as $key => $value){
    //     mysqli_query($connect,"INSERT INTO image(id_prd,image_product) VALUES ('$id_prd','$value')");
    // }
    
   
    include_once('Config/close_connect.php');
}
function destroy(){
include_once('Config/connect.php');
    if(isset($_GET['id'])){
        $query = mysqli_query($connect,"DELETE FROM image WHERE id_prd =".$_GET['id']."");
        $del_detail = mysqli_query($connect,"DELETE FROM product_detail WHERE id_prd = ".$_GET['id']."");
        $sql = "DELETE FROM product WHERE id =".$_GET['id']."";
        mysqli_query($connect, $sql);
        header('location: ?controller=admin&redirect=product');
    }
    include_once('Config/close_connect.php');

}
switch($action){
    case '' : 
        $arr = index();break;
    case 'create':
        $arr = create();break;
    case 'store':
        store();
        break;
    case 'edit': $arr= getProduct();
    // $cate = getCate();
    break;
    case 'update' : update();
    break;
    case 'destroy' : destroy();
    break;
}
?>