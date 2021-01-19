<?php // <--- do NOT put anything before this PHP tag
include('functions.php');
$cookieMessage = getCookieMessage();
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Shoper | Products List</title>
    <link rel="stylesheet" type="text/css" href="shopstyle.css" />
</head>

<body>
    <?php include "./includes/nav.php"; ?>
    <div class="main">
        <h1>Products List</h1>
        <form action="" method="GET" id="sort-form">
            <select name="sort">
            <option value="ASC">Popularity</option>
                <option value="ASC" <?php echo (isset($_GET['sort'])&&$_GET['sort'] == 'ASC')?"selected":""; ?>>Name: A-Z</option>
                <option value="DESC" <?php echo (isset($_GET['sort'])&&$_GET['sort'] == 'DESC')?"selected":""; ?>>Name: Z-A</option>
                <option value="LH" <?php echo (isset($_GET['sort'])&&$_GET['sort'] == 'LH')?"selected":""; ?>>Price: LOW-HIGH</option>
                <option value="HL" <?php echo (isset($_GET['sort'])&&$_GET['sort'] == 'HL')?"selected":""; ?>>Price: HIGH-LOW</option>
            </select>
            <input type="submit" value="sort">
        </form>
        <?php

        $dbh = connectToDatabase();

        if (isset($_GET['searchTerm'])) {
            echo '<h3>Search Results for: <i>"'.$_GET['searchTerm'].'"</i></h3>';
            $statement = $dbh->prepare('
                SELECT p.id, p.name as name, p.image, p.price, p.description, b.name as brand FROM products AS p
                JOIN brands AS b ON b.id = p.brands_id
                WHERE p.name LIKE ? OR p.description LIKE ?
            ');
            $statement->bindValue(1, '%' . $_GET['searchTerm'] . '%');
            $statement->bindValue(2, '%' . $_GET['searchTerm'] . '%');
            $statement->execute();
        } else {
            if (isset($_GET['sort'])) {
                if ($_GET['sort'] === "ASC") {
                    $statement = $dbh->prepare('
                        SELECT p.id, p.name as name, p.image, p.price, b.name as brand FROM products AS p
                        JOIN brands AS b ON b.id = p.brands_id
                        ORDER BY p.id ASC
                    ');
                } else if ($_GET['sort'] === "DESC"){
                    $statement = $dbh->prepare('
                        SELECT p.id, p.name as name, p.image, p.price, b.name as brand FROM products AS p
                        JOIN brands AS b ON b.id = p.brands_id
                        ORDER BY p.id DESC
                    ');
                } else if ($_GET['sort'] === "LH"){
                    $statement = $dbh->prepare('
                        SELECT p.id, p.name as name, p.image, p.price, b.name as brand FROM products AS p
                        JOIN brands AS b ON b.id = p.brands_id
                        ORDER BY p.price ASC
                    ');
                } else if ($_GET['sort'] === "HL"){
                    $statement = $dbh->prepare('
                        SELECT p.id, p.name as name, p.image, p.price, b.name as brand FROM products AS p
                        JOIN brands AS b ON b.id = p.brands_id
                        ORDER BY p.price DESC
                    ');
                }else{
                    $statement = $dbh->prepare('
                    SELECT p.id, p.name as name, p.image, p.price, b.name as brand FROM products AS p
                    JOIN brands AS b ON b.id = p.brands_id
                    ORDER BY (SELECT COUNT(*) FROM orders_products WHERE products_id = p.id) DESC                   
                ');
                }
            } else {
                $statement = $dbh->prepare('
                    SELECT p.id, p.name as name, p.image, p.price, b.name as brand FROM products AS p
                    JOIN brands AS b ON b.id = p.brands_id
                    ORDER BY (SELECT COUNT(*) FROM orders_products WHERE products_id = p.id) DESC                   
                ');
            }
            $statement->execute();
        }
        ?>
        <div class="product-list">
            <?php
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="product">
                    <img src="./images//products/<?php echo $row['image'] ?>" alt="">
                    <div class="product-details">
                        <span class="name"><?php echo $row['name'] ?></span>
                        <span class="brand"><?php echo $row['brand'] ?></span>
                        <span class="price"><?php echo $row['price'] ?>£</span>
                        <a href="./ViewProduct.php?ProductID=<?php echo $row['id'] ?>" class="view-btn">View</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php include "./includes/footer.php"; ?>
</body>

</html>