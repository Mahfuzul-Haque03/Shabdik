<?php
session_start();
include 'config.php';

if(isset($_SESSION["SESSION_EMAIL"])) {
    $email = $_SESSION["SESSION_EMAIL"];
    $sql = "SELECT id FROM users WHERE email='{$email}'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $uid = $result["id"];
}

// cookie

$cookie_name = "lastviewed";
$cookie_value = $_GET["pid"];
setcookie($cookie_name, $cookie_value, time() + (60*60*24 * 7));
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" 
    integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Product</title>
</head>

<body>
    <div class="container">
    <?php
                include 'navbar.php';
            ?>
    </div>
    </div>

    <!-- single product details -->
    <div class="small-container single-product">
        <div class="row">
            <?php
            $id = $_GET["pid"];
            $sql = "SELECT * FROM products WHERE id=$id";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $title = $row["title"];
                $description = $row["description"];
                $category = $row["category"];
                $quantity = $row["quantity"];
                $price = $row["price"];
                $img1 = './images/' . $row["img"] . 'e1.jpeg';
                $img2 = './images/' . $row["img"] . 'e2.jpeg';
                $img3 = './images/' . $row["img"] . 'e3.jpeg';
                $img4 = './images/' . $row["img"] . 'e4.jpeg';

            ?>
                <div class="col-2">

                    <img src="<?=$img1;?>" width="100%" id="productImg">

                    <div class="small-img-row">
                        <div class="small-img-col">
                            <img src="<?=$img1;?>" width="100%" class="small-img">
                        </div>
                        <div class="small-img-col">
                            <img src="<?=$img2;?>" width="100%" class="small-img">
                        </div>
                        <div class="small-img-col">
                            <img src="<?=$img3;?>" width="100%" class="small-img">
                        </div>
                        <div class="small-img-col">
                            <img src="<?=$img4;?>" width="100%" class="small-img">
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <p><a href="products.php">Products</a> / <?=$title?></p>
                    <h1><?=$title;?></h1>
                    <h4>Price: <?=$price;?>/-</h4>

                    <form method="post" action="cart.php?uid=<?=$uid; ?>">
                        <input type="number" style="display: inline;" name="quantity" value="1" min="1">
                        <input type="hidden" style="display: inline;" name="pid" value="<?=$id?>">
                        <input type="submit" name="add_to_cart" style="display: inline;" class="btn" value="Add to Cart" />
                    </form>

                    <h3>Product Details<i class="fas fa-indent"></i></h3>
                    <br>
                    <p><?=$description;?></p>
                </div>
                </div>
                </div>
                <!-- title -->
                <div class="small-container">
                    <div class="row row-2">
                        <h2>Related Products</h2>
                        <p>View more</p>
                    </div>
                </div>
            <?php
                    }

            ?>


<!--Related  products -->

<div class="small-container">

    <div class="row">
        <div class="col-4">
            <img src="images/product-9.jpg">
            <h4>Red printed T-shirt</h4>
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>$50.00</p>
        </div>
        <div class="col-4">
            <img src="images/product-10.jpg">
            <h4>Red printed T-shirt</h4>
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <i class="far fa-star"></i>
            </div>
            <p>$50.00</p>
        </div>
        <div class="col-4">
            <img src="images/product-11.jpg">
            <h4>Red printed T-shirt</h4>
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <p>$50.00</p>
        </div>
        <div class="col-4">
            <img src="images/product-12.jpg">
            <h4>Red printed T-shirt</h4>
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>$50.00</p>
        </div>
    </div>

</div>

<!-- footer -->
<?php
        include 'footer.php';
    ?>
<!-- js for toggle menu -->
<script>
    var MenuItems = document.getElementById("MenuItems");

    MenuItems.style.maxHeight = "0px";

    function menutoggle() {
        if (MenuItems.style.maxHeight == "0px") {
            MenuItems.style.maxHeight = "200px";
        } else {
            MenuItems.style.maxHeight = "0px";
        }
    }
</script>

<!-- js for small image -->

<script>
    var productImg = document.getElementById("productImg");
    var smallImg = document.getElementsByClassName("small-img");

    smallImg[0].onclick = function() {
        productImg.src = smallImg[0].src;
    }
    smallImg[1].onclick = function() {
        productImg.src = smallImg[1].src;
    }
    smallImg[2].onclick = function() {
        productImg.src = smallImg[2].src;
    }
    smallImg[3].onclick = function() {
        productImg.src = smallImg[3].src;
    }
</script>

</body>

</html>