<?php
// Start the session
session_start();
// Include the database connection and component files

require_once("php/CreateDb.php");
require_once("php/component.php");
// Create instance of CreateDb class
$database = new CreateDb(dbname:"productdb", tablename: "productdb");
 if (isset($_POST['add'])){
    /// print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}


?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- font awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <!-- bootstrap css-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Moyo Shopping Cart</title>
    </head>


    <body>
        <!-- to call the from header.php -->
        <?php
         require_once("php/header.php");
         ?>
        <div class="container">
            <!-- deleted and pasted to php component.php -->
            <div class="row text-center py-5">
                <?php
                // to call the function many times use the function name
               //component(productname:"product1", productprice:"R1500", productimg:"./upload/product1.png");
               // component(productname:"product2", productprice:"R200", productimg:"./upload/product2.png");
               // component(productname:"product3", productprice:"R500", productimg:"./upload/product3.png");
               //component(productname:"product4", productprice:"R1000", productimg:"./upload/product4.png");

               $result = $database->getData();
                 while ($row = mysqli_fetch_assoc($result)) {
                    component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);  
                 }
               
               ?>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    </body>

</html>