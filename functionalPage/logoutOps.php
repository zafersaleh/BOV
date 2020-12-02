<?php

	session_start();
	session_unset();
	session_destroy();
	//
	unset($_SESSION['userType']);
	unset($_SESSION['userID']);
	//
	header("Location: ../index.php");


?>