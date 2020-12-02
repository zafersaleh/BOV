<?php

include_once('dbConnOps.php');


if (!isset($_SESSION['userType']) && !isset($_SESSION['userID'])) {
	header("Location: ../index.php"); 
	exit();
} else {
	$userType = $_SESSION['userType'];
	$userID = $_SESSION['userID'];
}

if ($userType != "ag_uid") 
	exit();


if (isset($_POST['acceptVolApp'])) {
	$appID = $_POST['acceptVolApp'];
	$chanceNo = getSingleValue("chanceapplication", "ap_chnID", "ap_ID = ".$appID, -1);
	$chanceTitle = getSingleValue("chance", "ch_Title", "ch_ID = ".$chanceNo, -1);
	
	$isAcceptAppValid = checkAgAccRejAppReq($appID);
	$appMissingReqs = "";
	if (in_array(0, $isAcceptAppValid)) {
		$appMissingReqs = "&appReq=";
		if ($isAcceptAppValid['appCapacity'] == 0)
			$appMissingReqs .= "appCapacity";
		if ($isAcceptAppValid['appDead'] == 0)
			$appMissingReqs .= "%appDead";
		header("Location: ../chanceApplicants_BoV.php?showApplicants=".$chanceTitle.$appMissingReqs);
		exit();
	} else {
		$changeVolAcc = acceptRejectApplication($appID);
		
		if ($changeVolAcc == "noneAccRej") 
			header("Location: ../index.php");
		elseif ($changeVolAcc == "doneAccRej") 
			header("Location: ../chanceApplicants_BoV.php?showApplicants=".$chanceTitle);
		
	}
} elseif (isset($_POST['disableChanceApplyBtn']) || isset($_POST['enableChanceApplyBtn'])) {
	if (isset($_POST['disableChanceApplyBtn']))
		$chanceID = $_POST['disableChanceApplyBtn'];
	if (isset($_POST['enableChanceApplyBtn']))
		$chanceID = $_POST['enableChanceApplyBtn'];
	$changeChApply = activeAgencyChanceApplicantion ($chanceID);
	if ($changeChApply == "doneActiveChApp") {
		header("Location: ../chance_BoV.php");
	}
} elseif (isset($_POST['doRateVol'])) {
	$volAppID = mysqli_real_escape_string($conn, $_POST['doRateVol']);
	$volNewRate = $_POST['volRate'];
	$volNewCommentRate = $_POST['volRateComment'];
	
	$addRateOkay = true;
	if (!empty($volAppID)) {
		$rateChnID = getSingleValue('chanceapplication', 'ap_chnID', 'ap_ID = '.$volAppID, -1);
		$rateChanceApplicant = getSingleValue('chance', 'ch_Title', 'ch_ID = '.$rateChnID, -1);
		if ($rateChanceApplicant == '' || is_null($rateChanceApplicant) || $rateChanceApplicant == -1) {
			$addRateOkay = false;
			// echo($rateChnID." ".$rateChanceApplicant);
			header("Location: ../index.php");
		}
	} else {
		$addRateOkay = false;
		header("Location: ../index.php");
		exit();
	}
		
	if (empty($volNewRate) || empty($volNewCommentRate)) {
		$addRateOkay = false;
		header("Location: ../chanceApplicants_BoV.php?showApplicants=".$rateChanceApplicant."&rateVol=misReq");
	}
	
	if ($addRateOkay == true) {
		$isVolAppRated = getSingleValue('chanceapplication', 'ap_volRateComment', 'ap_ID = '.$volAppID, -1);
		if (is_null($isVolAppRated)) {
		$addRateToVolRes = addReateToVolApp($volNewRate, $volNewCommentRate, $volAppID);
		if ($addRateToVolRes == 'rateVolNone') {
			header("Location: ../chanceApplicants_BoV.php?showApplicants=".$rateChanceApplicant."&rateVol=errorRate");
			exit();
		} elseif ($addRateToVolRes == 'rateVolDone') {
			header("Location: ../chanceApplicants_BoV.php?showApplicants=".$rateChanceApplicant."&rateVol=doneRate");
			exit();
		}
		} else {
			header("Location: ../chanceApplicants_BoV.php?showApplicants=".$rateChanceApplicant);
			exit();
		}
	}
	
} elseif (isset($_POST['doAddChance'])) {
	$chTitle = mysqli_real_escape_string($conn, $_POST['ChnTitle']);
	$chType = mysqli_real_escape_string($conn, $_POST['ChnType']);
	$chField = mysqli_real_escape_string($conn, $_POST['ChnField']);
	$chSpecialty = mysqli_real_escape_string($conn, $_POST['ChnSpec']);
	$chCapacity = mysqli_real_escape_string($conn, $_POST['ChnCapacity']);
	$chStartDate = mysqli_real_escape_string($conn, $_POST['ChnStart']);
	$chEndDate = mysqli_real_escape_string($conn, $_POST['ChnEnd']);
	$chDeadline = mysqli_real_escape_string($conn, $_POST['ChnDeadLine']);
	$chLocation = mysqli_real_escape_string($conn, $_POST['ChnLocation']);
	$chNote = mysqli_real_escape_string($conn, $_POST['ChnNote']);
    $chFileDoc = $_FILES['ChnFile'];
    
    $chTasks = '';
    $chTerms = '';
    for ($pointNu = 0; $pointNu <= count($_POST) - 1; $pointNu++) {
        if (isset($_POST['ChnTasks'.$pointNu]))
            $chTasks .= mysqli_real_escape_string($conn, $_POST['ChnTasks'.$pointNu]).'(&)';
        if (isset($_POST['ChnTerms'.$pointNu]))
            $chTerms .= mysqli_real_escape_string($conn, $_POST['ChnTerms'.$pointNu]).'(&)';
    }
    
    $chTasks = substr($chTasks, 0, strlen($chTasks) - 3);
    $chTerms = substr($chTerms, 0, strlen($chTerms) - 3);
    
    // o($chTasks.'<br>'.$chTerms);
    
	if (isset($_POST['ChnPayment']))
		$chPayment = 1;
	else
		$chPayment = 0;
	
	$newChnAddState = addNewChance($chTitle, $chType, $chField, $chSpecialty, $chCapacity, $chStartDate, $chEndDate, 
					  $chDeadline, $chLocation, $chTasks, $chTerms, $chNote, $chFileDoc, $chPayment);
	header("Location: ../chance_BoV.php?newChance=".$newChnAddState);
} elseif (isset($_POST['alterAgNewInf'])) {
	$agAlterPrfRes = '';
	
	$agAlter_ID = mysqli_real_escape_string($conn, $_POST['alterAgNewInf']);
	$agNew_Appr = mysqli_real_escape_string($conn, $_POST['agNewApprTxt']);
	$agNew_Phone = mysqli_real_escape_string($conn, $_POST['agNewPhoneTxt']);
    $ag_OldPass = mysqli_real_escape_string($conn, $_POST['agOldPassTxt']);
	$agNew_Branch = mysqli_real_escape_string($conn, $_POST['agNewBranchTxt']);
	$agNew_Address = mysqli_real_escape_string($conn, $_POST['agNewِAddressTxt']);
	$agNew_Links = mysqli_real_escape_string($conn, $_POST['agNewSocTxt']);
    
      if ($ag_OldPass == '')
        $agNew_Pass = '';
    else
        $agNew_Pass = mysqli_real_escape_string($conn, $_POST['agNewPassTxt']);
    
	$agNew_Photo = $_FILES['agNewPhoto'];
	
    $agencyReturnToName = getSingleValue('agency', 'ag_Name', 'ag_ID = '.$agAlter_ID, 'none');
	$agAlterPrfState = 
		alterAgPrf($agAlter_ID, $agNew_Appr, $agNew_Phone, $agNew_Pass, $agNew_Branch, $agNew_Address, $agNew_Links, $agNew_Photo);
    header("Location: ../singleAg_BoV.php?showAgency=".$agencyReturnToName."&alterAgPrf=".$agAlterPrfState);
} elseif (isset($_POST['expApsToExcelBtn'])) {
	$apChID = mysqli_real_escape_string($conn, $_POST['expApsToExcelBtn']);
	$apChnName = getSingleValue('chance', 'ch_Title', 'ch_ID = '.$apChID, '');
	$apChnCount = getSingleValue('chanceapplication', 'COUNT(ap_ID)', 'ap_chnID = '.$apChID, '');
	$apApsIds = '';
	for ($checkNu = 0; $checkNu < $apChnCount; $checkNu++) {
		if(isset($_POST['applicantSel'.$checkNu])) {
			$apApsIds .= mysqli_real_escape_string($conn, $_POST['applicantSel'.$checkNu]).',';
		}
	}	
	if (empty($apApsIds)) {
		if (!is_null($apChnName) && !empty($apChnName))
			header("Location: ../chanceApplicants_BoV.php?showApplicants=".$apChnName);
		else
			header("Location: ../index.php");
	} else {
		$apApsIds = substr($apApsIds, 0, strlen($apApsIds) - 1);
	}
	
	$newFileName = getSingleValue('chance', 'ch_Title', 'ch_ID = '.$apChID, 'excelFileFromBoV.com').'_'.getRealTimeDate();
	
	header("Content-type: public");
	header("Content-Disposition: attachment; filename=$newFileName.xls");

	$exportApsSql = "SELECT vl_UserName, vl_Email, vl_PhoneNumber, vl_Gender, timestampdiff(year, vl_BirthDate, DATE(NOW())) AS vl_Age, vl_Qualification, vl_Specialty FROM volunteer WHERE vl_ID IN ($apApsIds);";
	$exportApsQry = mysqli_query($conn, $exportApsSql);

	if ($exportApsQry || mysqli_num_rows($exportApsQry) > 0) {
		echo('
		<table>
			<tr>
				<th>إسم المتطوع</th>
				<th>العمر</th>
				<th>الجنس</th>
				<th>البريد الإلكتروني</th>
				<th>رقم الهاتف</th>
				<th>المؤهل العلمي</th>
				<th>التخصص - إن وجد</th>
			</tr>');
		while($vlExportInfo = mysqli_fetch_assoc($exportApsQry)) {
			if($vlExportInfo['vl_Specialty'] > 0)
				$volSpecialty = $volEduSpecialty[$vlExportInfo['vl_Specialty']];
			else
				$volSpecialty = 'لا يوجد';
		
			echo('
			<tr>
				<td>'.$vlExportInfo['vl_UserName'].'</td>
				<td>'.$vlExportInfo['vl_Age'].'</td>
				<td>'.$volGender[$vlExportInfo['vl_Gender']].'</td>
				<td>'.$vlExportInfo['vl_Email'].'</td>
				<td>'.$vlExportInfo['vl_PhoneNumber'].'</td>
				<td>'.$volEduQualification[$vlExportInfo['vl_Qualification']].'</td>
				<td>'.$volSpecialty.'</td>
			</tr>');
		}
		echo('</table>');
	}
	exit();
} else {
	header("Location: ../index.php");
}

function checkAgAccRejAppReq ($volAppID) {
	global $conn;
	$agCheckAppRes = array();
	// Get essential information from applications
	$appInfQry = mysqli_query($conn, "SELECT * FROM chanceapplication WHERE ap_ID = $volAppID");
	if (!$appInfQry) {
		header("Location: ../index.php");
		exit();
	}
	$appInfo = mysqli_fetch_assoc($appInfQry);
	$chnInfQry = mysqli_query($conn, "SELECT * FROM chance WHERE ch_ID = ".$appInfo['ap_chnID']);
	if (!$chnInfQry) {
		header("Location: ../index.php");
		exit();
	}
	$chnInfo = mysqli_fetch_assoc($chnInfQry);
	$numApplicants = 
		getSingleValue("chanceapplication", "COUNT(ap_ID)", "ap_chnID = ".$chnInfo['ch_ID']." AND ap_AcceptVol = 1");
	$realTimeQry = mysqli_query($conn, "SELECT DATE(NOW()) AS realTimeDate");
	$realTimeDate = mysqli_fetch_assoc($realTimeQry);
	
	if ($numApplicants >= $chnInfo['ch_VolCapacity'] && $appInfo['ap_AcceptVol'] == 0) 
		$agCheckAppRes['appCapacity'] = 0;
	elseif ($realTimeDate['realTimeDate'] >= $chnInfo['ch_EndAt'])
		$agCheckAppRes['AppDead'] = 0;
	else {
		$agCheckAppRes['appCapacity'] = 1;
		$agCheckAppRes['AppDead'] = 1;
	}

	return($agCheckAppRes);		
}

function acceptRejectApplication ($apID) {
	global $conn;
	
	$accRejValue = getSingleValue("chanceapplication", "ap_AcceptVol", "ap_ID = ".$apID, -1);
	$accRejValue == 0 ? $accRejValue = 1 : $accRejValue = 0;
	$accRejSql = "UPDATE chanceapplication SET ap_AcceptVol = $accRejValue WHERE ap_ID = $apID";
	try {
		mysqli_autocommit($conn, false);
		$accRejQry = mysqli_query($conn, $accRejSql);
		if (!$accRejQry) {
			throw new Exception('acceptRejApplErr');
		} else {
			mysqli_commit($conn);
			$accRegState = "doneAccRej";
		}
	} catch(Exception $acceptAplErr) {
		mysqli_rollback($conn);
		$accRegState = "noneAccRej";
	} finally {
		mysqli_autocommit($conn, true);
		return($accRegState);
	}
}

function activeAgencyChanceApplicantion ($chID) {
	global $conn;
	
	$chApplyState = getSingleValue("chance", "ch_ActiveApply", "ch_ID = ".$chID, -1);
	if ($chApplyState != -1 && $chApplyState == 0) 
		$chApplyValue = 1;
	elseif ($chApplyState != -1 && $chApplyState == 1) 
		$chApplyValue = 0;
	
	$chApplyActiveSql = "UPDATE chance SET ch_ActiveApply = $chApplyValue WHERE ch_ID = $chID;";
	
	try {
		mysqli_autocommit($conn, false);
		$chApplyActiveQry = mysqli_query($conn, $chApplyActiveSql);
		if (!$chApplyActiveQry) {
			throw new Exception('activeChnErr');
		} else {
			mysqli_commit($conn);
			$activeCahnceState = "doneActiveChApp";
		}
	} catch (Exception $activeChnErr) {
		mysqli_rollback($conn);
		$activeCahnceState = "noneActiveChApp";
	} finally {
		mysqli_autocommit($conn, true);
		return($activeCahnceState);
	}
}

function addNewChance($ChTitle, $ChType, $ChField, $ChSpecialty, $ChCapacity, $ChStartDate, $ChEndDate, 
					  $ChDeadlineDate, $ChLocation, $ChTasks, $ChTerms, $ChNote, $ChFileUp, $ChPayment) {
	global $conn, $userID;
	$newChanceRes = "";
	
	$ChNewID = getSingleValue("chance", "MAX(ch_ID) + 1", "", 1);
	if (is_null($ChNewID)) 
		$ChNewID = 1;
    
    if (!empty($ChFileUp['name'])) {
        $chFileExploding = explode('.', $ChFileUp['name']);
		$chFileExt = end($chFileExploding);
        $chFileName = $ChNewID."_".getRealTimeDate().".".$chFileExt;
		$chFileNameParam = "'".$chFileName."'";
    } else {
        $chFileNameParam = 'NULL';
        $chFileName = '';
    }
	
	$newChanceSql = "INSERT INTO chance VALUES ($ChNewID, $userID, '$ChTitle', $ChType, $ChCapacity, '$ChStartDate', '$ChEndDate', $ChLocation, $ChPayment, '$ChTasks', DATE(NOW()), '$ChDeadlineDate', '$ChTerms', '$ChNote', $chFileNameParam, $ChField, $ChSpecialty, 1, NULL)";
	
	try {
		mysqli_autocommit($conn, false);
		$newChanceQry = mysqli_query($conn, $newChanceSql);
		if ($newChanceQry) {
        	if (!empty($chFileName)) {
            	$ChFileSaveRes = move_uploaded_file($ChFileUp['tmp_name'], "../chnF/".$chFileName);
				if (!$ChFileSaveRes)
					throw new Exception('saveChnFileErr');
			}
			//
			mysqli_commit($conn);
			$newChanceRes = "doneNewChance";
		} else {
			throw new Exception('saveChnErr');
		}
	} catch(Exception $addChnErr) {
		if (file_exists("../chnF/".$chFileName))
			unlink("../chnF/".$chFileName);
		
		mysqli_rollback($conn);
		$newChanceRes = "noneNewChance";
	} finally {
		mysqli_autocommit($conn, true);
		return($newChanceRes);
	}
}

function addReateToVolApp ($app_Rate, $app_RateComment, $app_ID) {
	global $conn;
	
	$volAppRate = mysqli_real_escape_string($conn, $app_Rate);
	$volAppRateComment = mysqli_real_escape_string($conn, $app_RateComment);
	$volAppID = mysqli_real_escape_string($conn, $app_ID);
	
	$rateVolAppSql = "UPDATE chanceapplication SET ap_volRate = $volAppRate, ap_volRateComment = '$volAppRateComment' 
	WHERE ap_ID = $volAppID";
	$rateVolAppQry = mysqli_query($conn, $rateVolAppSql);
	if (!$rateVolAppQry) {
		//echo($rateVolAppSql);
		return('rateVolNone');
	}
	else
		return('rateVolDone');
}

function alterAgPrf($agAlterID, $agNewAppr, $agNewPhone, $agNewPass, $agNewBranch, $agNewAddress, $agNewLinks, $agNewPhoto) {
	global $conn, $userID;
	$agEditPrfRes = '';
    
	$agAlterID = mysqli_real_escape_string($conn, $agAlterID);
	$agNewAppr = mysqli_real_escape_string($conn, $agNewAppr);
	$agNewPhone = mysqli_real_escape_string($conn, $agNewPhone);
	$agNewBranch = mysqli_real_escape_string($conn, $agNewBranch);
	$agNewAddress = mysqli_real_escape_string($conn, $agNewAddress);
	$agNewLinks = mysqli_real_escape_string($conn, $agNewLinks);
	
    
	if (!empty($agNewPass)) {
		$agNewPass = mysqli_real_escape_string($conn, password_hash($agNewPass, PASSWORD_DEFAULT));
        $agEditPassCond = "ag_Password = '".$agNewPass."', ";
    }
	else {
		$agNewPass = '';
        $agEditPassCond = '';
    }
	
	if (!empty($agNewPhoto['name'])) {
		$agPhotoExploding = explode('.', $agNewPhoto['name']);
		$agPhotoExt = end($agPhotoExploding);
		$agName = getSingleValue('agency', 'ag_Name', 'ag_ID = '.$agAlterID, -1);
		$agNewPhotoName = $agName."_".getRealTimeDate().".".$agPhotoExt;
		$agEidtPhotoCond = "ag_Photo = '".$agNewPhotoName."', ";
	} else {
		$agEidtPhotoCond = "";
		$agNewPhotoName = "";
	}
	
	$agAlterPrfSql = 
		"UPDATE agency SET ".$agEditPassCond.$agEidtPhotoCond." ag_Appreviation = '$agNewAppr', ag_PhoneNumber = $agNewPhone, ag_Branch = '$agNewBranch', ag_Address = '$agNewAddress', ag_SocialLinks = '$agNewLinks' WHERE ag_iD = $agAlterID;";
    
	try {
		mysqli_autocommit($conn, false);
    	$agAlterPrfQry = mysqli_query($conn, $agAlterPrfSql);
    	if ($agAlterPrfQry) {
			if (!empty($agNewPhotoName)) {
				$saveAgNewPhoto = move_uploaded_file($agNewPhoto['tmp_name'], "../agPP/".$agNewPhotoName);
				if (!$saveAgNewPhoto)
					throw new Exception('agNewPhotoErr');
			}
			mysqli_commit($conn);
			$agEditPrfRes = 'doneEditAgPrf';
		} else {
			throw new Exception('agSaveNewInfErr');
		}
	} catch (Exception $agNewPrfErr) {
		mysqli_rollback($conn);
		$agEditPrfRes = 'noneEditAgPrf';
	} finally {
		// echo($agAlterPrfSql);
		mysqli_autocommit($conn, false);
		return($agEditPrfRes);
	}
}



	













	

?>