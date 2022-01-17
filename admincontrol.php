<?php
if(isset($_SESSION["SESSION_EMAIL"])) {
    $uid=$_SESSION["SESSION_id"];
    $email = $_SESSION["SESSION_EMAIL"];

    $sql = "SELECT role FROM users WHERE id=$uid";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
    if($result["role"] != "admin"){
        header("Location: forbidden.php");
    }
} else{
        header("Location: forbidden.php");

}
