<?php // <--- do NOT put anything before this PHP tag
include('functions.php');
$cookieMessage = getCookieMessage();

authenticate();
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Shoper | Customers List</title>
    <link rel="stylesheet" type="text/css" href="shopstyle.css" />
</head>

<body>
    <?php include "./includes/nav.php"; ?>
    <div class="main">
        <h1>Products Statistics</h1>
        <div class="customers-container">

            <?php
            $dbh = connectToDatabase();
            $statement = $dbh->prepare('
                SELECT p.id, p.name as name, p.image, p.price, b.name as brand_name,
                (SELECT SUM(opp.quantity*p.price) FROM orders_products AS opp WHERE products_id = p.id) as revenue,
                (SELECT COUNT(*) FROM orders_products WHERE products_id = p.id) as popularity,
                (SELECT SUM(opp.quantity) FROM orders_products AS opp WHERE products_id = p.id) as total_sold
                FROM products AS p
                JOIN brands AS b ON b.id = p.brands_id
                ORDER BY (SELECT COUNT(*) FROM orders_products WHERE products_id = p.id) DESC                   

            ');
            $statement->execute();
            ?>

            <table class="customers-table">
                <thead>
                    <tr>
                        <th>ProductsID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Brand Name</th>
                        <th>Popularity</th>
                        <th>Total sold</th>
                        <th>Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['price'] ?></td>
                            <td><?php echo $row['brand_name'] ?></td>
                            <td><?php echo $row['popularity'] ?></td>
                            <td><?php echo $row['total_sold'] ?></td>
                            <td><?php echo $row['revenue'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
    <?php include "./includes/footer.php"; ?>
</body>

</html>