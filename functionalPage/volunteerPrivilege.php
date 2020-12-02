<?php
include_once('dbConnOps.php');


if (!isset($_SESSION['userType']) && !isset($_SESSION['userID'])) {
	header("Location: ../index.php");
	exit();
} else {
	$userType = $_SESSION['userType'];
	$userID = $_SESSION['userID'];
}

if ($userType != "vl_uid")
	exit();

if (isset($_POST['applyToChance'])) {
	$chanceID = $_POST['applyToChance'];
	$canVolApply = checkVolValidToApply($userID, $chanceID);

	$volApplyErrUrl = "";
	if (isset($canVolApply['infoErr']) && $canVolApply['infoErr'] == 1)
		$volApplyErrUrl = "applyErr=";
	if (isset($canVolApply['volAccountActive']) && $canVolApply['volAccountActive'] == 0)
		$volApplyErrUrl .= "&volAccActive=";
	if (isset($canVolApply['chanceCanBeApplied']) && $canVolApply['chanceCanBeApplied'] == 0)
		$volApplyErrUrl .= "&chanceNotActive=";
	if (isset($canVolApply['chnNotAvailable']) && $canVolApply['chnNotAvailable'] == 0)
		$volApplyErrUrl .= "&chnDeadline=";

	if ($volApplyErrUrl != "")
		header("Location: ../chance_BoV.php?".$volApplyErrUrl);
	else {
		$volApply = volApplyChance($userID, $chanceID);
		if ($volApply == "volAppSuccess")
			header("Location: ../chance_BoV.php");
		elseif ($volApply == "volAppError")
			header("Location: ../index.php");
		elseif ($volApply == "alreadyApplied")
			header("Location: ../agency_BoV.php");
	}
} elseif (isset($_POST['doEditVolExp']) || isset($_POST['doAddVolExp'])) {

    if (isset($_POST['doEditVolExp'])) {
        $exp_ID = mysqli_real_escape_string($conn, $_POST['doEditVolExp']);
        $volID = getSingleValue('volunteer_experience', 'vl_volID', 'vl_ExpID = '.$exp_ID, -1);
    } elseif (isset($_POST['doAddVolExp'])) {
        $volID = mysqli_real_escape_string($conn, $_POST['doAddVolExp']);
    }

	$doesVolExist = getSingleValue('volunteer', 'COUNT(vl_ID)', 'vl_ID = '.$volID, -1);
    $expVolName = getSingleValue('volunteer', 'vl_UserName', 'vl_ID = '.$volID, 'none');

	if ($doesVolExist >= 1) {
		$newExpPos = mysqli_real_escape_string($conn, $_POST['volExpPos']);
		$newExpOrg = mysqli_real_escape_string($conn, $_POST['volExpOrg']);
		$newExpStart = mysqli_real_escape_string($conn, $_POST['volExpStart']);
		$newExpEnd = mysqli_real_escape_string($conn, $_POST['volExpEnd']);
		$newExpSup = mysqli_real_escape_string($conn, $_POST['volExpSup']);
		$newExpSupEmail = mysqli_real_escape_string($conn, $_POST['volExpSupEmail']);
		$newExpField = mysqli_real_escape_string($conn, $_POST['volExpWorkField']);
		$newExpSpec = mysqli_real_escape_string($conn, $_POST['volExpWorkSpec']);
    	$newExpDesc = mysqli_real_escape_string($conn, $_POST['volExpDesc']);

	  if (isset($_POST['doAddVolExp'])) {
	      $addVlExpRes = addEditVolExp('N', $volID, $newExpPos, $newExpOrg, $newExpStart, $newExpEnd, $newExpSup, $newExpSupEmail, $newExpDesc, $newExpField, $newExpSpec);
	  } elseif (isset($_POST['doEditVolExp'])) {
	      $addVlExpRes = addEditVolExp('O', $exp_ID, $newExpPos, $newExpOrg, $newExpStart, $newExpEnd, $newExpSup, $newExpSupEmail, $newExpDesc, $newExpField, $newExpSpec);
	  }
	  
		header("Location: ../volunteer_BoV.php?showVol=".$expVolName."&volNewExp=".$addVlExpRes);
	} else {
		header("Location: ../index.php");
		exit();
	}
} elseif (isset($_POST['DeletVolExp'])) {

	if (isset($_POST['DeletVolExp'])) {
        $exp_ID = mysqli_real_escape_string($conn, $_POST['DeletVolExp']);
        $volID = getSingleValue('volunteer_experience', 'vl_volID', 'vl_ExpID = '.$exp_ID, -1);
    } elseif (isset($_POST['DeletVolExp'])) {
        $volID = mysqli_real_escape_string($conn, $_POST['DeletVolExp']);
    }
    $expVolName = getSingleValue('volunteer', 'vl_UserName', 'vl_ID = '.$volID, 'none');

		global $conn;
		$exp_ID = mysqli_real_escape_string($conn, $_POST['DeletVolExp']);
		
		$expSql = "DELETE FROM volunteer_experience WHERE vl_ExpID = $exp_ID";
		$newExpRes = 'noneNewExp';
	try {
		mysqli_autocommit($conn, false);
		$newExpQry = mysqli_query($conn, $expSql);

		if (!$newExpQry)
			throw new Exception('volExpErr');

		mysqli_commit($conn);
		$newExpRes = 'doneNewExp';
	} catch (Exception $volExpErr) {
		mysqli_rollback($conn);
		$newExpRes = 'noneNewExp';
	} finally {
		// echo($expSql);
		mysqli_autocommit($conn, true);
		//return($newExpRes);
	}

	header("Location: ../volunteer_BoV.php?showVol=".$expVolName);

} 
elseif (isset($_POST['doEditVlAcc'])) {
	$editVolPrfState = '';
	$vl_EditID = mysqli_real_escape_string($conn, $_POST['doEditVlAcc']);
	$vl_EditPhone = mysqli_real_escape_string($conn, $_POST['vlNewPhone']);
	$vl_EditPass = mysqli_real_escape_string($conn, $_POST['vlNewPass']);
	$vl_EditLocGov = mysqli_real_escape_string($conn, $_POST['volLocGov']);
	$vl_EditLocArea = mysqli_real_escape_string($conn, $_POST['volLocArea']);

	$vl_EditQual = mysqli_real_escape_string($conn, $_POST['edu_qual']);
	if ($vl_EditQual == 0) {
		$vl_EditSpec = -1;
	} else {
		$vl_EditSpec = mysqli_real_escape_string($conn, $_POST['edu_spec0']);
		if (isset($_POST['edu_spec1']))
			$vl_EditSpec .= ','.mysqli_real_escape_string($conn, $_POST['edu_spec1']);
	}

	$volNewLngStr = '';
	$volCurLngStr = getSingleValue('volunteer', 'vl_Language', 'vl_ID = '.$vl_EditID, '');
	$volCurLngArr = explode('-', $volCurLngStr);
	for ($lNo = 0; $lNo  < count($volCurLngArr); $lNo++) {
		$volCurLngInf = explode('=', $volCurLngArr[$lNo]);
		if (isset($_POST['Lang'.$lNo.'Lvl'])) {
			$newCurLngVal = mysqli_real_escape_string($conn, $_POST['Lang'.$lNo.'Lvl']);
			$volNewLngStr .= $volCurLngInf[0].'='.$newCurLngVal.'-';
		}
	}

	$vl_EditSkill = '';
	for ($pNu = 0; $pNu < count($_POST); $pNu++) {
		if (isset($_POST['vlNewLangName'.$pNu]) && isset($_POST['langs'.$pNu.'Lvl'])) {
			$volNewLngStr .= mysqli_real_escape_string($conn, $_POST['vlNewLangName'.$pNu]).'='.
			mysqli_real_escape_string($conn, $_POST['langs'.$pNu.'Lvl']).'-';
		}
		//
    if (isset($_POST['vlSkill'.$pNu])) {
        $vl_EditSkill .= mysqli_real_escape_string($conn, $_POST['vlSkill'.$pNu]).'(&)';
    }
	}
	$vl_EditLangs = substr($volNewLngStr, 0, strlen($volNewLngStr) - 1);
	$vl_EditSkill = substr($vl_EditSkill, 0, strlen($vl_EditSkill) - 3);

	$vl_EidtPhoto = $_FILES['volNewPic'];
	$vl_RetToName = getSingleValue('volunteer', 'vl_UserName', 'vl_ID = '.$vl_EditID, 'none');

	//print_r($_POST);

	//echo($vl_EditQual);
	// echo($vl_EditSpec);
	$editVolPrfState = eidtVolProfile($vl_EditID, $vl_EditPhone, $vl_EidtPhoto, $vl_EditLangs, $vl_EditPass, $vl_EditSkill, $vl_EditQual, $vl_EditSpec, $vl_EditLocGov, $vl_EditLocArea);
  header("Location: ../volunteer_BoV.php?showVol=".$vl_RetToName."&volEditPrf=".$editVolPrfState);
} else {
	header("Location: ../index.php");
}


function eidtVolProfile($vlEditID, $vlEditPhone, $vlEidtPhoto, $vlEditLangs, $vlEditPass, $vlEditSkill, $vlEditQual, $vlEditSpec, $vlEditLocGov, $vlEditLocArea) {
	global $conn, $userID;
	$vlEditPrfRes = '';
	//
	$vlEditID = mysqli_real_escape_string($conn, $vlEditID);
	$vlEditPhone = mysqli_real_escape_string($conn, $vlEditPhone);
	$vlEditLangs = mysqli_real_escape_string($conn, $vlEditLangs);
	$vlEditSkill = mysqli_real_escape_string($conn, $vlEditSkill);
	$vlEditQual = mysqli_real_escape_string($conn, $vlEditQual);
	$vlEditSpec = mysqli_real_escape_string($conn, $vlEditSpec);
	$vlEditLocGov = mysqli_real_escape_string($conn, $vlEditLocGov);
	$vlEditLocArea = mysqli_real_escape_string($conn, $vlEditLocArea);

	if (!empty($vlEditPass))
		$vlEditPass = mysqli_real_escape_string($conn, password_hash($vlEditPass, PASSWORD_DEFAULT));
	else
		$vlEditPass = '';

	if (!empty($vlEidtPhoto['name'])) {
		$vlPhotoExploding = explode('.', $vlEidtPhoto['name']);
		$vlPhotoExt = end($vlPhotoExploding);
		$volName = getSingleValue('volunteer', 'vl_UserName', 'vl_ID = '.$vlEditID, -1);
		$vlNewPhotoName = $volName."_".getRealTimeDate().".".$vlPhotoExt;
		$vlEidtPhotoCond = "vl_Photo = '".$vlNewPhotoName."', ";
	} else {
		$vlEidtPhotoCond = "";
		$vlNewPhotoName = "";
	}

	empty($vlEditPhone) ? $vlEditPhoneCond = "" : $vlEditPhoneCond = "vl_PhoneNumber = ".$vlEditPhone."";
	// empty($vlEditQual) ? $vlEditQualCond = "" :
	$vlEditQualCond = "vl_Qualification = ".$vlEditQual.", ";
	empty($vlEditSpec) ? $vlEditSpecCond = "" : $vlEditSpecCond = "vl_Specialty = '".$vlEditSpec."', ";

	empty($vlEditPass) ? $vlEditPassCond = "" : $vlEditPassCond = "vl_Password = '".$vlEditPass."', ";
	empty($vlEditSkill) ? $vlEditSkillCond = "" : $vlEditSkillCond = "vl_Skill = '".$vlEditSkill."', ";
    empty($vlEditLangs) ? $vlEditLangCond = "" : $vlEditLangCond = "vl_Language = '".$vlEditLangs."', ";
	empty($vlEditLocGov) ? $vlEditGovCond = "" : $vlEditGovCond = "vl_locationGov = ".$vlEditLocGov.", ";
	empty($vlEditLocArea) ? $vlEditAreaCond = "" : $vlEditAreaCond = "vl_LocationArea = ".$vlEditLocArea.", ";

	$vlEditPrfSql =
		"UPDATE volunteer SET ".$vlEidtPhotoCond.$vlEditQualCond.$vlEditSpecCond.$vlEditLangCond.
		$vlEditSkillCond.$vlEditPassCond.$vlEditGovCond.$vlEditAreaCond.$vlEditPhoneCond." WHERE vl_ID = ".$vlEditID;

	try {
	mysqli_autocommit($conn, false);
	$vlEditPrfQry = mysqli_query($conn, $vlEditPrfSql);

	if ($vlEditPrfQry) {
		if (!empty($vlNewPhotoName)) {
			$volnewPhotoRes = move_uploaded_file($vlEidtPhoto['tmp_name'], "../vlPP/".$vlNewPhotoName);
			if (!$volnewPhotoRes)
				throw new Exception('saveVolNewPhotoErr');
		}
		//
		mysqli_commit($conn);
		$vlEditPrfRes = 'doneEditVlPrf';
	} else {
		throw new Exception('editVolPrfErr');
	}

	} catch(Exception $editVlPrfErr) {
		if (file_exists("../vlPP/".$vlNewPhotoName))
			unlink("../vlPP/".$vlNewPhotoName);

		mysqli_rollback($conn);
		$vlEditPrfRes = 'noneEditVlPrf';
	} finally {
		// echo($vlEditPrfSql);
		mysqli_autocommit($conn, true);
		return($vlEditPrfRes);
	}
}


function checkVolValidToApply($volID, $chnID) {
	global $conn;
	$volApplyValidRes = array();

	$isVolAccActive = getSingleValue("volunteer", "vl_AccActive","vl_ID = ".$volID, -1);
	$isChnValidToApply = getSingleValue("chance", "ch_ActiveApply", "ch_ID = ".$chnID, -1);
	$chnDeadline = getSingleValue("chance", "ch_Deadline", "ch_ID = ".$chnID, -1);

	if ($isVolAccActive == -1 || $isChnValidToApply == -1)
		$volApplyValidRes['infoErr'] = 0;
	else {
		$volApplyValidRes['volAccountActive'] = $isVolAccActive;
		$volApplyValidRes['chanceCanBeApplied'] = $isChnValidToApply;
		$volApplyValidRes['chnNotAvailable'] = 1;
		if (getRealTimeDate() >= $chnDeadline)
			$volApplyValidRes['chnNotAvailable'] = 0;
	}

	return($volApplyValidRes);
}

function volApplyChance($vlID, $chID) {
	global $conn;
	$applicationValue = getSingleValue("chanceapplication", "COUNT(ap_ID)", "ap_volID = ".$vlID." AND ap_chnID = ".$chID, -1);
	if ($applicationValue <= 0) {
		$volApplicationID = getSingleValue("chanceapplication", "MAX(ap_ID) + 1", "", 1);
		if (is_null($volApplicationID))
			$volApplicationID = 1;
		$volApplySql = "INSERT INTO chanceapplication VALUES ($volApplicationID, $chID, $vlID, DATE(NOW()), null, NULL,0,0,0)";

		try {
			mysqli_autocommit($conn, false);
			$volApplyQry = mysqli_query($conn, $volApplySql);

			if (!$volApplyQry) {
				throw new Exception('volApplyErr');
			} else {
				mysqli_commit($conn);
				$volApplyState = "volAppSuccess";
			}
		} catch(Exception $volApplyErr) {
			mysqli_rollback($conn);
			$volApplyState = "volAppError";
		} finally {
			//echo($volApplySql);
			mysqli_autocommit($conn, true);
		}

	} else
		$volApplyState = "alreadyApplied";

	return($volApplyState);
}

function addEditVolExp ($addOREdit, $exp_VlID, $exp_Title, $exp_Org, $exp_Start, $exp_End, $exp_Sup, $exp_SupEmail, $exp_Desc, $exp_Field, $exp_Spec) {
	global $conn;
	$newExpRes = '';

	$expVlID = mysqli_real_escape_string($conn, $exp_VlID);
	$expTitle = mysqli_real_escape_string($conn, $exp_Title);
	$expOrg = mysqli_real_escape_string($conn, $exp_Org);
	$expStart = mysqli_real_escape_string($conn, $exp_Start);
	$expEnd = mysqli_real_escape_string($conn, $exp_End);
	$expSup = mysqli_real_escape_string($conn, $exp_Sup);
	$expSupEmail = mysqli_real_escape_string($conn, $exp_SupEmail);
    $exp_Desc = mysqli_real_escape_string($conn, $exp_Desc);
	$exp_Field = mysqli_real_escape_string($conn, $exp_Field);
	$exp_Spec = mysqli_real_escape_string($conn, $exp_Spec);

	$volNewExpID = getSingleValue("volunteer_experience", "MAX(vl_ExpID) + 1", "", 1);
	if (is_null($volNewExpID))
		$volNewExpID = 1;

	if ($addOREdit == 'N')
		$expSql = "INSERT INTO volunteer_experience Values($volNewExpID, $expVlID, '$expTitle', '$expOrg', '$expStart', '$expEnd', $exp_Field, $exp_Spec, '$exp_Desc', '$expSup', '$expSupEmail')";
	elseif ($addOREdit == 'O')
		$expSql = "UPDATE volunteer_experience SET vl_ExpPosition = '$expTitle', vl_ExpOrg = '$expOrg', vl_ExpStart = '$expStart', vl_ExpEnd = '$expEnd', vl_ExpSup = '$expSup', vl_ExpSupEmail = '$expSupEmail', vl_ExpDesc = '$exp_Desc', vl_ExpField = $exp_Field, vl_ExpSpec = $exp_Spec WHERE vl_ExpID = $exp_VlID";

	try {
		mysqli_autocommit($conn, false);
		$newExpQry = mysqli_query($conn, $expSql);

		if (!$newExpQry)
			throw new Exception('volExpErr');

		mysqli_commit($conn);
		$newExpRes = 'doneNewExp';
	} catch (Exception $volExpErr) {
		mysqli_rollback($conn);
		$newExpRes = 'noneNewExp';
	} finally {
		// echo($expSql);
		mysqli_autocommit($conn, true);
		return($newExpRes);
	}
}






















?>
