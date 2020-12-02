<?php
	include_once('header_BoV.php');
	include_once('functionalPage/dbConnOps.php');

if (!isset($_SESSION['userType']) && !isset($_SESSION['userID'])) {
	header("Location: index.php");
} else {
	$userType = $_SESSION['userType'];
	$userID = $_SESSION['userID'];
}

?>

		 
<?php
	include('footer_BoV.php');
?>