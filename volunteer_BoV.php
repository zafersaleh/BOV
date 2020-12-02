<?php
	include_once('functionalPage/dbConnOps.php');
	include_once('header_BoV.php');
?>

<section id="volsView">

<?php
if(isset($_POST['DeletVolExp'])){
	$zafer = $_POST['DeletVolExp'];
	echo $zafer;
}
	if (!isset($_SESSION['userType']) && !isset($_SESSION['userID'])) {
		echo("<h1>يرجى تسجيل الدخول لعرض الصفحة</h1>");
	} else {
		$userType = $_SESSION['userType'];
		$userID = $_SESSION['userID'];
		if (isset($_GET['showVol'])) {
			$volToShow = mysqli_real_escape_string($conn, $_GET['showVol']);
			$volAccToShow = getSingleValue('volunteer', 'vl_ID', "vl_UserName = '".$volToShow."'", -1);
			if ($volAccToShow == $userID && $userType == 'vl_uid')
				showVolunteer($volAccToShow,'');
			else
				echo('<h1> لا يمكن عرض هذه الصفحة, يرجى التأكد من صحة الرابط المدخل </h1>');
		} elseif ($userType == 'au_uid') {
			showVolunteer('','');
		} else {
			echo('<h1> لا يمكن عرض هذه الصفحة, يرجى التأكد من صحة الرابط المدخل </h1>');
		}
	}
	
	
?>

</section>

<?php
	include('footer_BoV.php');
?>
