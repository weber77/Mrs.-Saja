<?php // <--- do NOT put anything before this PHP tag
include('functions.php');
$cookieMessage = getCookieMessage();

authenticate();
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Shoper | Order List</title>
    <link rel="stylesheet" type="text/css" href="shopstyle.css" />
</head>

<body>
    <?php include "./includes/nav.php"; ?>
    <div class="main">
        <h1>Order Lists</h1>
        <div class="customers-container">

            <?php
            $dbh = connectToDatabase();
            $statement = $dbh->prepare('
                SELECT o.id as orderID, o.created_on,  c.id as clientID, c.user_name, c.first_name, c.last_name, c.address, c.city
                FROM orders AS o
                INNER JOIN clients AS c ON o.clients_id = c.id
            ');
            $statement->execute();
            ?>

            <table class="customers-table">
                <thead>
                    <tr>
                        <th>OrderID</th>
                        <th>Time placed</th>
                        <th>Client UserName</th>
                        <th>Client FirstName</th>
                        <th>Client LastName</th>
                        <th>client Address</th>
                        <th>client City</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $row['orderID'] ?></td>
                            <td><?php echo $row['created_on'] ?></td>
                            <td><?php echo $row['user_name'] ?></td>
                            <td><?php echo $row['first_name'] ?></td>
                            <td><?php echo $row['last_name'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['city'] ?></td>
                            <td>
                                <a href="ViewOrderDetails.php?OrderID=<?php echo $row['orderID'] ?>" class="order-view-btn">View</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
    <?php include "./includes/footer.php"; ?>
</body>

</html>