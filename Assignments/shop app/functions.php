<?php // <--- do NOT put anything before this PHP tag

// in PHP we can create our own functions to do whatever we need.
// the benefit of using a function is that we can reduce duplicate code.

// here is a function that will connect the Database
// wherever we need to connect to the database we just call this function.
function connectToDatabase()
{
	// connect to our SQLITE database 
	// $dbh = new PDO("sqlite:./database/OnlineShop.db");

	// if you had a MYSQL server you could use this instead:
	$dbh = new PDO("mysql:host=localhost;dbname=shoper", "root", "");

	// enable errors
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//Turn OFF emulated prepared statements.
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	// return the database handle.
	return $dbh;
}

function showErrorMessage($cookieMessage)
{
	echo "<h4 class = 'errormsg'>Error: $cookieMessage </h4>";
}

// run this function on untrusted data before we echo it on the page.
function makeOutputSafe($unsafeString)
{
	$safeOutput = htmlspecialchars($unsafeString, ENT_QUOTES, "UTF-8");
	return $safeOutput;
}

// this function lets you redirect the user to a different web page.
function redirect($newURL)
{
	// the header location function will send a user to the specified URL.
	// please note that this function MUST be called before any HTML is displayed on the page or it wont work.
	header("Location: $newURL");

	// we just redirected the user, that means there is no one around to view this page.
	// so we can just stop processing this page.
	die();
}

// please note that this function MUST be called before any HTML is displayed on the page or it wont work.
function setCookieMessage($cookieMessage)
{
	setcookie("CookieMessage", $cookieMessage);
}

// please note that this function MUST be called before any HTML is displayed on the page or it wont work.
function getCookieMessage()
{
	if (isset($_COOKIE['CookieMessage'])) {
		$message = $_COOKIE['CookieMessage'];
		deleteCookie("CookieMessage");
		return makeOutputSafe($message);
	} else return "";
}

// please note that this function MUST be called before any HTML is displayed on the page or it wont work.
function deleteCookie($cookieName)
{
	// to delete a cookie, you set the expiry date to a date in the past.
	// in this case set the expiry date to 1 second past midnight 1st of Jan 1970
	setcookie($cookieName, "", 1);
}

// this function will return true if $needle is found inside $haystack.
function stringContains($haystack, $needle)
{
	return strpos($haystack, $needle) !== false;
}


// Authentication function
function authenticate()
{
	$valid_passwords = array("admin" => "password12345");
	$valid_users = array_keys($valid_passwords);
	if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
		$user = $_SERVER['PHP_AUTH_USER'];
		$pass = $_SERVER['PHP_AUTH_PW'];
		$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

		if (!$validated) {
			header('WWW-Authenticate: Basic realm="My Realm"');
			header('HTTP/1.0 401 Unauthorized');
			die("Not authorized");
		}
	} else {
		header('WWW-Authenticate: Basic realm="My Realm"');
		header('HTTP/1.0 401 Unauthorized');
		die("Not authorized");
	}
}


// I strongly suggest you do not close the PHP tag in this file.
// it can cause issues with setcookie() and header()