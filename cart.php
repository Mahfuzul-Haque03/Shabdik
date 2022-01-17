<?php
session_start();
include 'config.php';

if (!isset($_SESSION["SESSION_EMAIL"])) {
    header("Location: login.php");
}

if (isset($_POST["add_to_cart"])) {

    $uid = $_GET["uid"];
    $pid = $_POST["pid"];
    $quantity = $_POST["quantity"];

    $sql = "SELECT * FROM cart WHERE uid=$uid AND pid=$pid";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count) {
        $sql = "UPDATE cart SET quantity = $quantity WHERE pid=$pid and uid=$uid";
    } else {
        $sql = "INSERT INTO cart (pid, uid, quantity) VALUES ('{$pid}', '{$uid}','{$quantity}')";
    }
    $result = mysqli_query($conn, $sql);
}
if (isset($_POST["remove"])) {
    $uid = $_GET["uid"];
    $pid = $_POST["pid"];

    $sql = "DELETE FROM cart WHERE uid=$uid AND pid=$pid";
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
    <title>Cart | Shabdik</title>
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
                <th>Subtotal</th>
            </tr>
            <?php
            $uid = $_GET["uid"];
            $sql = "SELECT * FROM cart WHERE uid=$uid";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            $total = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $subtotal = 0;
                $id = $row["id"];
                $pid = $row["pid"];
                $uid = $row["uid"];
                $quantity = $row["quantity"];

                $sqlp = "SELECT * FROM products WHERE id=$pid";
                $resultp = mysqli_query($conn, $sqlp);
                $rowp = mysqli_fetch_assoc($resultp);
                $title = $rowp["title"];
                $price = $rowp["price"];
                $img = './images/' . $rowp["img"] . 'e1.jpeg';
                $subtotal += $price * $quantity;
                $total += $subtotal;
            ?>
                <tr>
                    <td>
                        <div class="cart-info">
                            <a href="productdetails.php?pid=<?= $pid ?>"><img src="<?= $img; ?>"></a>
                            <div>
                                <a style="font-size: 18px;" href="productdetails.php?pid=<?= $pid ?>">
                                    <p><?= $title; ?></p>
                                </a>
                                <small>Price: <?= $price; ?></small>
                                <br>
                                <form method="post" action="cart.php?uid=<?= $uid; ?>">
                                    <input type="submit" name="remove" style="background: none; width:auto; border: none;
                                     color: #ff6d6d; cursor:pointer; margin: 0; text-align:left; padding: 0;" value="Remove" />
                                    <input type="hidden" name="pid" value="<?= $pid ?>">
                                </form>
                            </div>
                        </div>
                    </td>
                    <td><input disabled type="text" value="<?= $quantity ?>"></td>
                    <td><?= $subtotal; ?>/-</td>
                </tr>

            <?php
            }
            if ($total) {
                $shipping = 100;
            } else {
                $shipping = 0;
            }
            ?>

        </table>
        <div class="total-price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td><?= $total ?>/-</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td><?= $shipping; ?>/-</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><?= $total + $shipping ?>/-</td>
                </tr>
            </table>
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