<?php
session_start();
include 'config.php';
include 'admincontrol.php';


if (isset($_POST["remove"])) {
    $pid = $_POST["pid"];

    $sql = "DELETE FROM products WHERE id=$pid";
    $result = mysqli_query($conn, $sql);
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
    <title>Admin | Products</title>
</head>

<body>
    <div class="container">
    <?php
                include 'navbar.php';
            ?>
    </div>
    </div>
    <!-- cart items details -->
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Category</th>
            </tr>
            <?php
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            while ($row = mysqli_fetch_assoc($result)) {
                $subtotal = 0;
                $pid = $row["id"];
                $quantity = $row["quantity"];
                $img = './images/' . $row["img"] . 'e1.jpeg';
                $title = $row["title"];
                $price = $row["price"];
                $category = $row["category"];
            ?>
                <tr>
                    <td>
                        <div class="cart-info">
                        <a href="productdetails.php?pid=<?=$pid?>"><img src="<?= $img; ?>"></a>
                            <div>
                            <a style="font-size: 18px;" href="productdetails.php?pid=<?=$pid?>"><p><?= $title; ?></p></a>
                                <small>Price: <?= $price; ?></small>
                                <br>
                                <form method="post" action="admin.php?uid=<?=$uid; ?>">
                                    <input type="submit" name="remove" style="background: none; width:auto; border: none;
                                     color: #ff6d6d; cursor:pointer; margin: 0; text-align:left; padding: 0;" value="Remove" />
                                    <input type="hidden" name="pid" value="<?=$pid?>">
                                </form>
                            </div>
                        </div>
                    </td>
                    <td><input disabled type="text" value="<?=$quantity?>"></td>
                    <td><?= $category; ?></td>
                </tr>

            <?php
            }
            ?>
        </table>
        <a href="addproduct.php" class="btn" name="add_product">Add New Product</a>

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