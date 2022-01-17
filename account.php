<?php
session_start();
include 'config.php';

if (isset($_SESSION["SESSION_EMAIL"])) {
    $email = $_SESSION["SESSION_EMAIL"];
    $sql = "SELECT id FROM users WHERE email='{$email}'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $uid = $result["id"];
}

if (!isset($_SESSION["SESSION_EMAIL"])) {
    header("Location: login.php");
}

$sql = "SELECT * FROM users WHERE id=$uid";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

$id = $row["id"];
$name = $row["name"];
$email = $row["email"];
$address = $row["address"];
$contact = $row["contact"];
$role = $row["role"];

if (isset($_POST["save"])) {

    include 'config.php';

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 1) {
        echo "<script>alert('{$email} - This email has already taken.');</script>";
    } else {

        $sql = "UPDATE users SET name='{$name}', email='{$email}', address='{$address}', contact='{$contact}' WHERE id=$id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: account.php");
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
    <title>Create Account</title>
</head>

<body>
    <div class="container">
        <?php
        include 'navbar.php';
        ?>
    </div>

    <!-- account page -->
    <div class="account-page">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <img src="images/image1.png" width="100%">
                    </div>
                    <div class="col-2">
                        <div class="form-container" style="height:450px;">
                            <h2 class="title">Account Info</h2>
                            <form action="" method="post" class="form">
                                <div class="input-field">
                                    <input type="text" id="name" name="name" class="input" placeholder="Enter your name" required value="<?= $name; ?>">
                                </div>
                                <div class="input-field">
                                    <input type="text" id="email" name="email" class="input" placeholder="Enter your email" required value="<?= $email; ?>">
                                </div>
                                <div class="input-field">
                                <textarea name="address" id="address" class="input" placeholder="Enter your address"cols="30" rows="3" required><?= $address; ?></textarea>
                                    <!-- <input type="text" id="address" name="address" class="input" placeholder="Enter your address" required value="<?= $address; ?>"> -->
                                </div>
                                <div class="input-field">
                                    <input type="text" id="contact" name="contact" class="input" placeholder="Enter your phone no" required value="<?= $contact; ?>">
                                </div>

                                <button type="submit" class="btn" name="save">Save Change</button>
                                <p>Go where you heart beats. <a href="logout.php" style="color: indianred;">Logout</a>.</p>
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