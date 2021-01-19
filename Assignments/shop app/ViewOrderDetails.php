<!DOCTYPE HTML>
<html>

<head>
	<title>Shoper | Order Details</title>
	<link rel="stylesheet" type="text/css" href="shopstyle.css" />
	<meta charset="UTF-8" />
</head>

<body>
	<?php include "./includes/nav.php"; ?>
	<div class="main">
		<h1>Order Details</h1>
		<div class="cart-container">
			<div class="order-products-list">
				<?php

				// did the user provided an OrderID via the URL?
				if (isset($_GET['OrderID'])) {
					$UnsafeOrderID = $_GET['OrderID'];

					include('functions.php');
					$dbh = connectToDatabase();

					// select the order details and customer details. (you need to use an INNER JOIN)
					// but only show the row WHERE the OrderID is equal to $UnsafeOrderID.
					$statement = $dbh->prepare('
					SELECT o.id as orderID, o.created_on, c.id as clientID, c.user_name, c.first_name, c.last_name, c.address, c.city
					FROM orders as o 
					INNER JOIN clients as c ON c.id = o.clients_id 
					WHERE o.id = ? ; 
				');
					$statement->bindValue(1, $UnsafeOrderID);
					$statement->execute();

					// did we get any results?
					if ($row1 = $statement->fetch(PDO::FETCH_ASSOC)) {
						// Output the Order Details.
						$FirstName = makeOutputSafe($row1['first_name']);
						$LastName = makeOutputSafe($row1['last_name']);
						$UserName = makeOutputSafe($row1['user_name']);
						$OrderID = makeOutputSafe($row1['orderID']);
						$CreatedOn = makeOutputSafe($row1['created_on']);
						$Address = makeOutputSafe($row1['address']);
						$City = makeOutputSafe($row1['city']);
						// display the OrderID
						echo "<h2>OrderID: $OrderID</h2>";

						// its up to you how the data is displayed on the page. I have used a table as an example.
						// the first two are done for you.
						echo "<table>";
						echo "<tr><th>UserName:</th><td>$UserName</td></tr>";
						echo "<tr><th>Customer Name:</th><td>$FirstName $LastName </td></tr>";
						echo "<tr><th>UserName:</th><td>$UserName</td></tr>";
						echo "<tr><th>Address:</th><td>$Address</td></tr>";
						echo "<tr><th>City:</th><td>$City</td></tr>";
						echo "<tr><th>Created on:</th><td>$CreatedOn</td></tr>";
						//TODO show the Customers Address and City.
						//TODO show the date and time of the order.

						echo "</table>";

						// TODO: select all the products that are in this order (you need to use INNER JOIN)
						// this will involve three tables: OrderProducts, Products and Brands.
						$statement2 = $dbh->prepare('
			
					SELECT p.id as productID, p.name, p.description, p.image, p.price, p.quantity, b.name as brand_name, b.logo as brand_logo
					FROM orders_products as op
					INNER JOIN products as p ON p.id = op.products_id
					INNER JOIN brands as b ON b.id = p.brands_id 
					WHERE op.orders_id = ? ; 
					');
						$statement2->bindValue(1, $UnsafeOrderID);
						$statement2->execute();

						$totalPrice = 0;
						echo "<h2>Order Products:</h2>";

						// loop over the products in this order. 
						while ($row2 = $statement2->fetch(PDO::FETCH_ASSOC)) {
							//NOTE: pay close attention to the variable names.
							$ProductID = makeOutputSafe($row2['productID']);
							$Description = makeOutputSafe($row2['description']);

							$totalPrice += $row2['price'] * $row2['quantity'];
				?>

							<div class="product">
								<a href="./ViewProduct.php?ProductID=<?php echo $row2['productID'] ?>">
									<img src="./images//products/<?php echo $row2['image'] ?>" alt="product image">
								</a>

								<div class="product-details">
									<span class="name"><?php echo $row2['name'] ?></span>
									<span class="brand"><?php echo $row2['brand_name'] ?></span>
									<span class="price"><?php echo $row2['price'] ?>£ x <?php echo $row2['quantity'] ?></span>
									<div class="order-product-brand">
										<img src="./images/brands/<?php echo $row2['brand_logo'] ?>" alt="">
										<span><?php echo $row2['brand_name'] ?></span>
									</div>
								</div>
							</div>

				<?php
							// TODO show the Products Description, Brand, Price, Picture of the Product and a picture of the Brand.
							// TODO The product Picture must also be a link to ViewProduct.php.

							// TODO add the price to the $totalPrice variable.
						}

						//TODO display the $totalPrice .
						echo '<div class="total-price-amount">';
						echo '<span class="total-title">Total Amount</span>';
						echo '<span class="total-amount">' . $totalPrice . '£</span>';
						echo '</div>';
					} else {
						echo "System Error: OrderID not found";
					}
				} else {
					echo "System Error: OrderID was not provided";
				}
				?>
			</div>
		</div>
	</div>
	<?php include "./includes/footer.php"; ?>
</body>

</html>