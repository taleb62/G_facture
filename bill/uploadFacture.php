
<?php
include '../conn.php';

    // INSERT IVOICE DATA

$client_id = $_POST['c_id'];
$f_price = $_POST['f_price'];
$date = $_POST['f_date'];

$sql = "INSERT INTO invoice ( invoice_date, total, customer_id) VALUES ( '$date', $f_price, '$client_id')";
$res = mysqli_query($conn, $sql);
if($res){
    $f_id = mysqli_insert_id($conn);

    for($i = 0; $i < count($_POST['p_name']); $i++){
        $id = $_POST['p_id'][$i];
        $name = $_POST['p_name'][$i];
        $price = $_POST['p_price'][$i];
        $qnt = $_POST['p_qnt'][$i];
        $total_price = $_POST['p_total'][$i];

        $sql = "INSERT INTO invoice_products (id, name, price_of_unit, total_price, qnt) VALUES ('$f_id', '$name', $price, $total_price, $qnt )";
        mysqli_query($conn, $sql); 
        
        $rqt1 = "SELECT qty FROM product WHERE id=$id" ;
        $old_qnt = mysqli_query($conn, $rqt1);
          $old=mysqli_fetch_array( $old_qnt);

        $rqt2 = "UPDATE product SET qty = $old[0]-$qnt WHERE id=$id";    
        mysqli_query($conn, $rqt2);     
    }

    header("location: ../saleslist.php");
}

?>