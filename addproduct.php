<?php
session_start();
include 'config.php';
include 'admincontrol.php';

if (isset($_POST["add_product"])) {
    include 'config.php';

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $img= mysqli_real_escape_string($conn, $_POST['img']);

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM products WHERE title='{$title}'")) > 0) {
        echo "<script>alert('{$email} - This product is already in the list.');</script>";
    } else {
            $sql = "INSERT INTO products (title, description, category, price, quantity, img) VALUES ('{$title}', '{$description}','{$category}', $price, $quantity, '{$img}')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: admin.php");
            } else {
                echo "<script>Error: " . $sql . mysqli_error($conn) . "</script>";
            }
    }
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
    <title>Admin | Add Product</title>
</head>

<body>
    <div class="container">
        <?php
        include 'navbar.php';
        ?>
    </div>

    <!--Create account page -->
    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="images/image1.png" width="100%">
                </div>
                <div class="col-2">
                    <div class="form-container" style="height:650px;">
                        <h2 class="title">Add New Product</h2>
                        <form action="" method="post" class="form">
                            <div class="input-field">
                                <input type="name" name="title" id="title" class="input" placeholder="Enter product title" required>
                            </div>
                            <div class="input-field">
                            <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter your description"></textarea>
                                <!-- <input type="text" name="description" id="description" class="input" placeholder="Enter your description" required> -->
                            </div>
                            <div class="input-field">
                                <input type="text" name="category" id="category" class="input" placeholder="Enter your category." required>
                            </div>
                            <div class="input-field">
                                <input type="number" name="quantity" id="quantity" class="input" placeholder="Enter your quantity" required>
                            </div>
                            <div class="input-field">
                                <input type="number" name="price" id="price" class="input" placeholder="Enter your price" required>
                            </div>
                            <div class="input-field">
                                <input type="text" name="img" id="img" class="input" placeholder="Enter image id: p13" required>
                            </div>
                            <button class="btn" name="add_product">Add Product</button>
                            <p>Check the image code before carefully adding.</p>
                        </form>

                    </div>
                </div>
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
</body>

</html>