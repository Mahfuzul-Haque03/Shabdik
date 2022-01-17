<?php
$conn = mysqli_connect("localhost", "root", "", "gtech");
if(!$conn) {
    echo "<script>alert('Connection failed.');</script>";
}

$uid = 0;
$admin = "none";
if(isset($_SESSION["SESSION_EMAIL"])) {
    $uid = $_SESSION["SESSION_id"];

    $sql = "SELECT role FROM users WHERE id=$uid";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    if($result["role"] == "admin"){
        $admin = "";
    }

} else {
    $_SESSION["SESSION_id"] = 0;
}
?>