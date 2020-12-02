<?php
include_once('functionalPage/dbConnOps.php');
include('header_BoV.php');

if (!isset($_SESSION['userType']) && !isset($_SESSION['userID'])) {
	echo('<h1> لا يمكن عرض هذه الصفحة, يرجى التأكد من صحة الرابط المدخل </h1>');
	exit();
} else {
	$userType = $_SESSION['userType'];
	$userID = $_SESSION['userID'];
}

?>
<div class="sectionMainTitle">
	<span></span>
	<label>الجهات</label>
	<span></span>
</div>

<?php
if(isset($_POST['agType']))
$agTypedef=$_POST['agType'];
else
$agTypedef=-1;
if(isset($_POST['agClass']))
$agClassdef=$_POST['agClass'];
else
$agClassdef=-1;
if(isset($_POST['agSpecialty']))
$agSpecialtydef=$_POST['agSpecialty'];
else
$agSpecialtydef=-1;

echo("<form method='POST' id='filterAgyFrm'>");
echo (addComboValues($agencyType, "", "الكل", $agTypedef, "agType"));
echo (addComboValues($agencyClass, "", "الكل", $agClassdef, "agClass"));
echo (addComboValues($agencySpecialty, "", "الكل", $agSpecialtydef, "agSpecialty"));
echo("<button type='submit' id='vol_submit' name='filterAgBtn' value='show'> تصفية </button></form>");
?>

<section id="begin_div_agency">

<!-- Agency From Chance -->

<?php
if ($userType == "ag_uid") {
		header("Location: index.php");
		exit();
}

$agencyFilter = "";
if (isset($_POST['filterAgBtn'])) {
	if (isset($_POST['agType']) && $_POST['agType'] != -1) {
		$agencyFilter = $agencyFilter." AND ag_Type = ".$_POST['agType'];
	}
	if (isset($_POST['agClass']) && $_POST['agClass'] != -1) {
		$agencyFilter = $agencyFilter." AND ag_Class = ".$_POST['agClass'];
	}
	if (isset($_POST['agSpecialty']) && $_POST['agSpecialty'] != -1) {
		$agencyFilter .= " AND ag_Specialty = ".$_POST['agSpecialty'];
	}
}
showAgency('all', '', $agencyFilter);
?>

</section>

<?php
	include('footer_BoV.php');
?>
