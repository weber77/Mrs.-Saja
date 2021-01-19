<?php // <--- do NOT put anything before this PHP tag
include('functions.php');
$cookieMessage = getCookieMessage();
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Shoper | product detail</title>
    <link rel="stylesheet" type="text/css" href="shopstyle.css" />
</head>

<body>
    <?php include "./includes/nav.php"; ?>
    <div class="main">
        <h1>Product Details</h1>
        <div class="detail-container">

            <?php
            $productID = $_GET['ProductID'];
            $dbh = connectToDatabase();
            $statement = $dbh->prepare('
                SELECT p.id, p.name as name, p.image, p.price, p.description,
                b.name as brand_name, b.description as brand_description, b.logo as brand_logo , b.link as brand_link
                FROM products AS p
                JOIN brands AS b ON b.id = p.brands_id
                WHERE p.id=?
            ');
            $statement->bindValue(1, $productID);
            $statement->execute();
            ?>

            <?php
            // did we find a match?
            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="product-detail-block">
                    <img src="./images/products/<?php echo $row['image'] ?>" alt="">
                    <div class="product-details">
                        <h2 class="brand"><?php echo $row['name'] ?></h2>
                        <h3>Product Description</h3>
                        <p class="description"><?php echo $row['description'] ?></p>
                        <div class="brand-block">
                            <h3>Product By</h3>
                            <div class="brand-wrapper">
                                <img class="brand-logo" src="./images/brands/<?php echo $row['brand_logo'] ?>" alt="">
                                <div>
                                    <span class="brand-name"><?php echo $row['brand_name'] ?></span>
                                    <p class="brand-description">
                                        <?php echo $row['brand_description'] ?>
                                    </p>
                                    <a href="<?php echo $row['brand_link'] ?>">Visite the site</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-purchase-block">
                    <strong class="price"><?php echo $row['price'] ?>£</strong>
                    <p>You like this product? Purchase it now before its too late.</p>
                    <form action="./AddToCart.php?ProductID=<?php echo $row['id'] ?>" method="post">
                        <?php
                        $products_list = isset($_COOKIE['ShoppingCart']) ? $_COOKIE['ShoppingCart'] : "";
                        if (!in_array($row['id'], explode(",", $products_list))) { ?>
                            <button type="submit" class="view-btn" name="BuyButton">Add to Cart</button>
                        <?php } else {
                            echo '<strong>This product is already in your cart.</strong>';
                        } ?>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php include "./includes/footer.php"; ?>
</body>

</html>