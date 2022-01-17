<?php
if (isset($_POST["submit"])) {
    include 'config.php';

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpassword = mysqli_real_escape_string($conn, md5($_POST['password']));
    $role = "user";

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        echo "<script>alert('{$email} - This email has already taken.');</script>";
    } else {
        if ($password === $cpassword) {
            $sql = "INSERT INTO users (name, email, password, address, contact, role) VALUES ('{$name}', '{$email}','{$password}','{$address}','{$contact}','{$role}')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: login.php");
            } else {
                echo "<script>Error: " . $sql . mysqli_error($conn) . "</script>";
            }
        } else {
            echo "<script>alert('Password and confirm password do not match.');</script>";
        }
    }
    var_dump($name);
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

    <!--Create account page -->
    <div class="account-page">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="images/image1.png" width="100%">
                </div>
                <div class="col-2">
                    <div class="form-container" style="height:550px;">
                        <h2 class="title">Register</h2>
                        <form action="" method="post" class="form">
                            <div class="input-field">
                                <input type="name" name="name" id="name" class="input" placeholder="Enter your full name" required>
                            </div>
                            <div class="input-field">
                                <input type="email" name="email" id="email" class="input" placeholder="Enter your email" required>
                            </div>
                            <div class="input-field">
                                <input type="password" name="password" id="password" class="input" placeholder="Enter your password" required>
                            </div>
                            <div class="input-field">
                                <input type="password" name="cpassword" id="cpassword" class="input" placeholder="Enter your password" required>
                            </div>
                            <div class="input-field">
                                <textarea name="address" id="address" class="input" placeholder="Enter your address"cols="30" rows="3"required></textarea>
                            </div>
                            <div class="input-field">
                                <input type="text" name="contact" id="contact" class="input" placeholder="Enter your phone number" required>
                            </div>
                            <button class="btn" name="submit">Register</button>
                            <p>You have already an Account! <a href="login.php">Login</a>.</p>
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