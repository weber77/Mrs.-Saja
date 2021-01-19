<?php // <--- do NOT put anything before this PHP tag

include('functions.php');

// Did the user click the buy button AND did they provide a ProductID?
if(!isset($_POST['BuyButton']))
{
	echo "BuyButton not provided, the submit button should be named BuyButton and the form method should be POST"; 
}
elseif(!isset($_GET['ProductID']))
{
	echo "ProductID not provided, make sure you have passed the ProductID in the URL"; 
}
else 
{
	$productToBuy = trim($_GET['ProductID']);
	
	// add the product to the shopping cart cookie
	// if the cookie is defined AND not an empty string
	if(isset($_COOKIE['ShoppingCart']) && $_COOKIE['ShoppingCart'] != "")
	{
		$products_list = $_COOKIE['ShoppingCart'];
		setcookie("ShoppingCart", $products_list.",".$productToBuy);
	}
	else 
	{
		setcookie("ShoppingCart", $productToBuy);
	}
	
	// redirect the user back to ViewProduct.php 
	redirect("ViewProduct.php?ProductID=$productToBuy");
}
