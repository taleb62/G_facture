
<?php   include '../conn.php';  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="#">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart JS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <!-- <div class="app-container">
        <div class="app-bg">
            <div class="left-side"></div>
            <div class="right-side"></div>
        </div> -->
        <header>

            <!-- select  -->
            <div class="container">
                <h2>Select Client</h2>

                <div class="select-box">
                    <div class="options-container">
                    
                        <?php
                            $sql="SELECT * FROM customer";
                            $result=mysqli_query($conn, $sql);

                            if($result){
                                while($row=mysqli_fetch_assoc($result)){
                                    $id=$row['customer_id'];
                                    $name=$row['customer_name'];

                        ?>

                                <div class="option" c_id="<?=$id?>">
                                    <input
                                    type="radio"
                                    class="radio"
                                    id="<?=$name?>"
                                    name="category"
                                    />
                                    <label for="<?=$name?>"><?=$name?></label>
                                </div>

                                <?php
                                }
                            }
                                ?> 
                   
                    </div>

                    <div class="selected">
                    Selectionner un Client 
                    </div>
                </div>
            </div>

            <!-- end select -->

            <div class="shopping-bag">
                <a href="#">
                    <img src="./icons/bag.png" alt="cart">
                    Cart
                    <div class="total-items-in-cart">
                        0
                    </div>
                </a>
            </div>
        </header>
    
        <?php  
            $sql="SELECT * FROM product";
              $result=mysqli_query($conn, $sql);

              if ($result) {
                while($row=mysqli_fetch_assoc($result)){                  
                  $id=$row['id']; 
                  $name = $row['product_name']; 
                  $qnt = $row['qty']; 
                  $catagorie = $row['category_id']; 
                  $price = $row['price'];
                  $image = $row['photo'];
                     
        ?>
                <div style="display:none" class="infos"><?php echo "$id@$name@$qnt@$catagorie@$price@$image" ?></div>
            <?php 
                }
            }
            ?>    


    <div class="products-list">
        <div class="products">
            <!-- render porducts here -->
        </div>
        <div class="cart">
            <div class="cart-header">
                <div class="column1">Item</div>
                <div class="column2">Unit price</div>
                <div class="column3">Units</div>
            </div>
            <div class="cart-items">
                <!-- render cart items here -->
            </div>
            <div class="cart-footer">
                <div class="subtotal">
                    total (0 items): 0
                </div>
                <div id="made">
                    generer une facture
                </div>
            </div>
        </div>
    </div>

    <div class="form" style="display:none">
        <form class="dataFacture" action="uploadFacture.php" method="post">
            <input type="text" id="c_name" name="c_name">
            <input type="text" id="c_id" name="c_id">
            <input type="text" name="f_date" value="<?php echo date("Y-m-d"); ?>">
            <input type="text" id="f_price" name="f_price">
            
            <div class="productsData">

            </div>
            <button type="submit" id="submit"></button>
        </form>
    </div>

    <script src="./products.js"></script>
    <script src="./fuc.js"></script>
    <script src="./select.js"></script>
    <script>
        const submit = document.querySelector("#submit");
        const made = document.querySelector("#made");

        made.addEventListener("click", () =>{
            submit.click();
        });
    </script>
</body>
</html>