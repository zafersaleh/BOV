<?php
	include_once('functionalPage/dbConnOps.php');
	include_once('header_BoV.php');

if (isset($_SESSION['userType']) && isset($_SESSION['userID']) && isset($_GET['showAgency'])) {
	$userType = $_SESSION['userType'];
	$userID = $_SESSION['userID'];
	
	$agencyKey = mysqli_real_escape_string($conn, $_GET['showAgency']);
			
	$agencyExist = getSingleValue("agency", "count(ag_ID)","ag_Name = '".$agencyKey."'",-1);
	if ($agencyExist > 0) {
		echo('<section id="agProfileView">');
		showAgency("single", $agencyKey, "");
		echo('</section>');
	} else {
		echo('<h1> لا يمكن عرض هذه الصفحة, يرجى التأكد من صحة الرابط المدخل </h1>');
		
	}
	
} else {
	echo('<h1> لا يمكن عرض هذه الصفحة, يرجى التأكد من صحة الرابط المدخل </h1>');
		
	}


?>

	
<?php
	include('footer_BoV.php');
?>