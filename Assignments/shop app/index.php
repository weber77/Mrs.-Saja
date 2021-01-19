<?php // <--- do NOT put anything before this PHP tag
include('functions.php');
$cookieMessage = getCookieMessage();

?>
<!doctype html>
<html>

<head>
	<meta charset="UTF-8" />
	<title>TODO put title here</title>
	<link rel="stylesheet" type="text/css" href="shopstyle.css" />
</head>

<body>
	<?php include "./includes/nav.php"; ?>
	<header class="home">
		<div class="overlay-bg">
			<form action="ProductList.php" method="GET" class="product-search-form">
				<h3>Tell us what you need!</h3>
				<input type="text" name="searchTerm" placeholder="what are you looking for?">
				<input type="submit" value="Search">
			</form>
		</div>
	</header>
	<div class="service-advantages">
		<span>Fast delivery</span>
		<span>Free shipping</span>
		<span>Available Globally</span>
		<span>Fast & Relieble</span>
	</div>
	<div class="main">
		<h1>Welcome to SHOPER</h1>

		<div class="new-arivals-section">

			<h2>New Arrivals</h2>
			<div class="product-list">
				<?php
				$dbh = connectToDatabase();
				$statement = $dbh->prepare('
                SELECT p.id, p.name as name, p.image, p.price, b.name as brand FROM products AS p
				JOIN brands AS b ON b.id = p.brands_id
				ORDER BY p.id DESC 
            ');
				$statement->execute();
				?>

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
			<!-- 
	
		// TODO put a search box here and a submit button.
		
		// TODO the rest of this page is your choice, but you must not leave it blank.
		
		Possible ideas:
		•	List the 10 most recently purchased products.
		•	Use a CSS Animated Slider.
		•	Display any sales or promotions (using an image)

	-->
		</div>


	</div>
	<?php include "./includes/footer.php"; ?>
</body>

</html>