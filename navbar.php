<div class="navbar">
    <div class="logo">
        <a href="index.php"><img src="images/logo.png" width="155px"></a>
    </div>
    <nav>
        <ul id="MenuItems">
            <li><form action="products.php" method="POST">
                    <li><div class="input-field">
                        <input type="text" name="key" placeholder="eg: Headset, airdot" style="padding: 6px;">
                    </div></li>
            <li><button type="submit" style="padding: 5px; " name="search_btn" >Search</button></li>
            </form></li>
            <li><a href="index.php">HOME</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="account.php">Account</a></li>
            <li><a href="admin.php?uid=<?= $uid; ?>" style="display: <?= $admin; ?>;">Admin</a></li>
        </ul>
    </nav>
    <a href="cart.php?uid=<?= $uid; ?>"><img src="images/cart.png" width="30px" height="30px"></a>
    <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
</div>