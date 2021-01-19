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
        <h1>Customers Lists</h1>
        <div class="customers-container">

            <?php
            $dbh = connectToDatabase();
            $statement = $dbh->prepare('
                SELECT * FROM clients
            ');
            $statement->execute();
            ?>

            <table class="customers-table">
                <thead>
                    <tr>
                        <th>CustomerID</th>
                        <th>User Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['user_name'] ?></td>
                            <td><?php echo $row['first_name'] ?></td>
                            <td><?php echo $row['last_name'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['city'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
    <?php include "./includes/footer.php"; ?>
</body>

</html>