<nav>
    <a href="./index.php" class="nav-brand">Shoper</a>
    <ul>
        <li class="nav-item">
            <a href="./index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
            <a href="./ProductList.php" class="nav-link">ProductList</a>
        </li>
        <li class="nav-item">
            <a href="./ViewCart.php" class="nav-link">ViewCart</a>
        </li>
        <li class="nav-item">
            <a href="./SignUp.php" class="nav-link">SignUp</a>
        </li>
        <li class="nav-item active">
            <a href="./CustomerList.php" class="nav-link">CustomerList</a>
        </li>
        <li class="nav-item active">
            <a href="./OrderList.php" class="nav-link">OrderList</a>
        </li>
        <li class="nav-item active">
            <a href="./AdminProductView.php" class="nav-link">Products Statistics</a>
        </li>
    </ul>
</nav>

<?php
// display any cookie messages. TODO style this message so that it is noticeable.
echo isset($cookieMessage)&& strlen($cookieMessage)>0 ?'<h4 class="notice-message">'.$cookieMessage.'</h4>':"";
?>