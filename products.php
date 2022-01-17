<?php
session_start();
include 'config.php';


if (isset($_POST["search_btn"])) {

    $key = mysqli_real_escape_string($conn, $_POST["key"]);

    $sql = "SELECT * FROM products WHERE title like '%$key%' OR category like '%$key%'";
    
} else if(isset($_GET["key"])){
    $key = $_GET["key"];
    $sql = "SELECT * FROM products WHERE title like '%$key%' OR category like '%$key%'";
}
else{
    $sql = "SELECT * FROM products";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>All Products | Shabdik</title>
</head>

<body>
    <div class="container">
        <?php
        include 'navbar.php';
        ?>
    </div>

    <div class="small-container">
        <div class="row row-2">
            <h2>All Products</h2>
            <!-- <select>
                <option>Default Sotring</option>
                <option>Sort by price</option>
                <option>Sort by popularity</option>
                <option>Sort by rating</option>
                <option>Sort by sale</option>
            </select> -->
        </div>
        <div class="row">
            <?php
            // $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $title = $row["title"];
                $description = $row["description"];
                $category = $row["category"];
                $quantity = $row["quantity"];
                $price = $row["price"];
                $img = './images/' . $row["img"] . 'e1.jpeg';

            ?>
                <div class="col-4">
                    <a href="productdetails.php?pid=<?= $id; ?>"><img src="<?= $img; ?>"></a>
                    <a href="productdetails.php?pid=<?= $id; ?>">
                        <h4><?= $title; ?></h4>
                    </a>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <p><?= $price; ?></p>
                </div>
            <?php
            }

            ?>

        </div>
        <div class="page-btn">
            <span>1</span>
            <span>2</span>
            <span>3</span>
            <span>4</span>
            <span>&#8594;</span>
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

</body>

</html>