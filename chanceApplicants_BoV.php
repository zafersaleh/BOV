

<?php
	include_once('functionalPage/dbConnOps.php');
	include_once('header_BoV.php');
?>

<?php

	if (isset($_SESSION['userType']) && isset($_SESSION['userID']) && isset($_GET['showApplicants'])) {
		$userType = $_SESSION['userType'];
		$userID = $_SESSION['userID'];

		if ($userType == "vl_uid") {
			header("Location: index.php");
			exit();
		}

		
			
			

		$chanceKey = $_GET['showApplicants'];
		$chanceName = mysqli_real_escape_string($conn, $chanceKey);

		$chanceID = getSingleValue("chance", "ch_ID", "ch_Title = '".$chanceName."'", -1);
		if (!(is_null($chanceID)) && $chanceID != -1){
			if (isset($_GET['appReq'])) {
				$appReqDetail = explode('%', $_GET['appReq']);
				for ($reqNo = 0; $reqNo <= count($appReqDetail) - 1; $reqNo++) {
					switch ($appReqDetail[$reqNo]) {
						case 'appCapacity':
							$volCapacity = getSingleValue("chance", "ch_VolCapacity", "ch_ID = ".$chanceID);
							$acceptedVolNum =
								getSingleValue("chanceapplication", "COUNT(ap_ID)", "ap_chnID = ".$chanceID." AND ap_AcceptVol = 1");
							if ($acceptedVolNum >= $volCapacity)
								echo("<p>عدد المتطوعين المقبولين قد تجاوز العدد المطلوب للفرصة</p>");
							break;
						case 'appDead':
							echo("<p>لا يمكن قبول المزيد من المتطوعين!.</p>");
							break;
					}
				}

			}

			$applicantsNumber = getSingleValue("chanceapplication INNER JOIN volunteer ON volunteer.vl_ID = chanceapplication.ap_volID ", "COUNT(ap_ID)", "ap_chnID = ".$chanceID." AND vl_AccActive = 1", -1);

			echo('
			<div class="sectionMainTitle">
				<span></span>
				<label>المتقدمون</label>
				<span></span>
			</div>');

			if ($applicantsNumber > 0) {
				  //start AD editing
			if(isset($_POST['chType']))
			$chanceTypeDef=$_POST['chType'];
			else
			$chanceTypeDef=-1;
			if(isset($_POST['chLocation']))
			$chanceLocationDef=$_POST['chLocation'];
			else
			$chanceLocationDef=-1;
			if(isset($_POST['chWorkField']))
			$chanceWorkFieldDef=$_POST['chWorkField'];
			else
			$chanceWorkFieldDef=-1;

			echo("<form method='POST' id='filterAgyFrm'>");
			echo (addComboValues($volEduQualification, "", "الكل", $chanceTypeDef, "chType"));
			echo (addComboValues($volEduSpecialty, "", "الكل", $chanceLocationDef, "chLocation"));
			echo (addComboValues($chanceLocation, "", "الكل", $chanceWorkFieldDef, "chWorkField"));
			echo("<button type='submit' id='vol_submit' name='filterChBtn' value='show'> تصفية </button></form>");
		$ap_ch_filter=" ";
		if (isset($_POST['filterChBtn'])) {
			if (isset($_POST['chType']) && $_POST['chType'] != -1) {
				$ap_ch_filter = $ap_ch_filter." AND vl_Qualification = ".$_POST['chType'];
			}
			if (isset($_POST['chLocation']) && $_POST['chLocation'] != -1) {
				$ap_ch_filter = $ap_ch_filter." AND vl_Specialty= ".$_POST['chLocation'];
			}
			if (isset($_POST['chWorkField']) && $_POST['chWorkField'] != -1) {
				$ap_ch_filter .= " AND vl_LocationArea = ".$_POST['chWorkField'];
			}
		}
				echo('<div id="viewChanceApplicatnScr">
					<div id="chane_title_div">
						<h1 id="chane_title">'.$chanceName.'</h1>
						<h2 id="number_applicants">عدد المتقدمين: '.$applicantsNumber.' متقدم</h2>
					</div>

					<h1 id="selectAplTitle">تحديد</h1>
					<form action="functionalPage/agencyPrivilege.php" method="POST" class="containerBox" id="apolicantsFrm">');
				showApplicant($chanceID,$ap_ch_filter);
				echo('
				<div id="extract_buttons">
				<hr id="applicants_line3">
							<p class="Error-Text" id="selectApsErr"></p>
					<button id="extSelAppls" name="expApsToExcelBtn" type="button" onClick="checkSelectedAps('.$chanceID.')">استخراج المحدد</button>
					<button id="selAllAppls" type="button" onClick="selectAllAps()">استخراج الكل</button>
				</div>
			</div></form>');

			} else {
				echo('<div id="chane_title_div">
						<h1 id="chane_title">'.$chanceName.'</h1>
						<h id="number_applicants"> لا يوجد اي متقدمين بعد! </h>
					</div>');
			}
		} else {
			header("Location: index.php");
			exit();
		}

	} else {
		header("Location: index.php");
		exit();
	}
?>

<?php
	include_once('footer_BoV.php');
?>
