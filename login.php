<?php
session_start();
include 'config.php';

if (isset($_SESSION["SESSION_EMAIL"])) {
    header("Location: account.php");
}

if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));

    $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count === 1) {
        $row = mysqli_fetch_assoc($result);
        $id=$row["id"];
        $_SESSION["SESSION_EMAIL"] = $email;
        $_SESSION["SESSION_id"] = $id;

        header("Location: index.php");
    } else {
        echo "<script>alert('Your login details is incorrect.');</script>";
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
    <title>Login | Shabdik</title>
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
                    <div class="form-container">
                        <h2 class="title">Login</h2>
                        <form action="" method="post" class="form">
                            <input style="padding: 3px;" type="email" id="email" name="email" class="input" placeholder="Enter your email" required>
                            <input style="padding: 3px;" type="password" id="password" name="password" class="input" placeholder="Enter your password" required>
                            <button type="submit" class="btn" name="login">Login</button>
                            
                            <p>Don't have an Account? <a href="register.php">Register</a>.</p>
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