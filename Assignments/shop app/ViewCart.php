<?php // <--- do NOT put anything before this PHP tag

include('functions.php');

// get the cookieMessage, this must be done before any HTML is sent to the browser.$cookieMessage= gtCookieMessage);
$cookieMessage = getCookieMessage();

?>
<!doctype html>
<html>

<head>
	<meta charset="UTF-8" />
	<title>Shoper | cart</title>
	<link rel="stylesheet" type="text/css" href="shopstyle.css" />
</head>

<body>
	<?php include "./includes/nav.php"; ?>
	<div class="main">
		<h1>Your Cart</h1>
		<div class="cart-container">
			<?php

			// does the user have items in the shopping cart?
			if (isset($_COOKIE['ShoppingCart']) && $_COOKIE['ShoppingCart'] != '') {
				// the shopping cart cookie contains a list of productIDs separated by commas
				// we need to split this string into an array by exploding it.
				$productID_list = explode(",", $_COOKIE['ShoppingCart']);

				// remove any duplicate items from the cart. although this should never happen we 
				// must make absolutely sure because if we don't we might get a primary key violation.
				$productID_list = array_unique($productID_list);

				$dbh = connectToDatabase();

				// create a SQL statement to select the product and brand info about a given ProductID
				// this SQL statement will be very similar to the one in ViewProduct.php
				// TODO the complete this SQL statment, you should read lectures 14 and 5.
				$statement = $dbh->prepare('
				SELECT p.id, p.name as name, p.image, p.price, p.description, p.quantity,
				b.name as brand_name, b.description as brand_description, b.logo as brand_logo , b.link as brand_link
				FROM products AS p
				JOIN brands AS b ON b.id = p.brands_id
				WHERE p.id=?
			');

				$totalPrice = 0;
				echo '<div class="order-products-list">';
				// loop over the productIDs that were in the shopping cart.
				foreach ($productID_list as $productID) {
					// great thing about prepared statements is that we can use them multiple times.
					// bind the first question mark to the productID in the shopping cart.
					$statement->bindValue(1, $productID);
					$statement->execute();

					// did we find a match?
					if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
						$totalPrice += $row['price'];
			?>
						<div class="product">
							<img src="./images//products/<?php echo $row['image'] ?>" alt="product image">
							<div class="product-details">
								<span class="name"><?php echo $row['name'] ?></span>
								<span class="brand"><?php echo $row['brand_name'] ?></span>
								<span class="price"><?php echo $row['price'] ?>£ x <?php echo $row['quantity'] ?></span>
								<div class="order-product-brand">
									<img src="./images/brands/<?php echo $row['brand_logo'] ?>" alt="">
									<span><?php echo $row['brand_name'] ?></span>
								</div>
							</div>
						</div>
				<?php
						//TODO Output information about the product. including pictures, description, brand etc.	

						//TODO add the price of this item to the $totalPrice
					}
				}
				echo '<div class="total-price-amount">';
				echo '<span class="total-title">Total Amount</span>';
				echo '<span class="total-amount">' . $totalPrice . '£</span>';
				echo '</div>';

				echo '</div>';

				// TODO: output the $totalPrice.

				// if we have any error messages echo them now. TODO style this message so that it is noticeable.
				

				// you are allowed to stop and start the PHP tags so you don't need to use lots of echo statements.
				?>

				<div class="total-block">
					<form action='ProcessOrder.php' method='POST'>
						<input type="text" name="UserName" placeholder="Please enter your userName" required>
						<input class="submit-order" type='submit' name='SubmitOrder' value='Submit your order' />
					</form>

					<form action='EmptyCart.php' method='POST'>
						<input class="empty-cart" type='submit' name='EmptyCart' value='Empty Shopping Cart' id='EmptyCart' />
					</form>
				</div>

			<?php
			} else {
				// if we have any error messages echo them now. TODO style this message so that it is noticeable.
				echo "$cookieMessage <br/>";

				echo "You Have no items in your cart!";
			}
			?>
		</div>
	</div>

	<?php include "./includes/footer.php"; ?>

</body>

</html>