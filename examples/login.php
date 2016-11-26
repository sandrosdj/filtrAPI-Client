<?php

// The "cookie setter" is in this file. This will allow Filtr. to set token cookies for your domain.
if (isset($_GET['token'])) { setcookie('filtr_token', $_GET['token']); header('Location: /'); exit; }

// Filtr.'s default class
include "filtr.class.php";

// Open up a Filtr. session
$filtr = new filtrLogin();

/* ----
	Filtr. app details
	KEEP IT PRIVATE!!!

	Demo app: - App ID:		1
	App Token:	9cd80d8df1e1a177bac3c867848845e4ad6820bb374ce0e8e8

	The original demo app won't work with your setup, because you have to enter your personal "cookie setter" url.
	In this case the cookie setter url is "http://your.site/home.php?token={token}"

	If you are using unencrypted connection, the users will be noticed about it. THIS IS BAD!
---- */

$filtr->setAppid(1); // App ID
$filtr->setApptoken('9cd80d8df1e1a177bac3c867848845e4ad6820bb374ce0e8e8'); // App token

// Check if the token cookie already exists
if (isset($_COOKIE['filtr_token']))
{
	// Send the token for Filtr.
	$filtr->setToken($_COOKIE['filtr_token']);
	$filtr->Login();

	// The results.
	if ($filtr->status())
	{
		echo "Amazing!<hr/>";
		print_r($filtr->getData());

		// Write and read test data
		echo "<hr/>DataStorage<hr/>";
		$filtr->DataStorage('write', 'test_variable', 'This is the test variables value.');
		print_r($filtr->getData());
	} else
	{
		echo "Sorry, access denied.<hr/>";
		print_r($filtr->getData()); // You can still use getData() to see, what's the problem.
	}
} else
	echo "<a href='https://filtr.sandros.hu/app_login/1'>Login</a>"; // You can open this in a cute popup window like facebook does.
?>
