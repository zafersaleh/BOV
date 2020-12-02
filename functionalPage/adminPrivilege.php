<?php
include_once('dbConnOps.php');


if (isset($_SESSION['userType']) && isset($_SESSION['userID'])) {
	$userType = $_SESSION['userType'];
	$userID = $_SESSION['userID'];
} else {
	header("Location: ../index.php");
	exit();
}

if ($userType != "au_uid"){
	header("Location: ../index.php");
	exit();
}

if (isset($_POST['addNewAdmin'])) {
	$adminUserNew = mysqli_real_escape_string($conn, $_POST['auUserName']);
	$adminPassNew = mysqli_real_escape_string($conn, $_POST['auNewPass']);
    
    if (isset($_POST['auAccActive']))
        $auAccState = 1;
    else
        $auAccState = 0;
    
	$userAuths = array();
	foreach($adminAuthsArr as $XAuth) {
		if (isset($_POST[$XAuth]))
			$userAuths[$XAuth] = 1;
        else
			$userAuths[$XAuth] = 0;
	}
    $authsNewStr = '';
    foreach ($userAuths as $authName => $authVal) {
        $authsNewStr .= $authName.'='.$authVal.',';
    }
    
    $authsNewStr = substr($authsNewStr, 0, strlen($authsNewStr) - 1);
	$newAdminAddState = addNewAdmin($adminUserNew, $adminPassNew, $authsNewStr, $auAccState);
	header("Location: ../adminEditor_BoV.php?newAdmin=".$newAdminAddState);
}

if (isset($_POST['addNewPost'])) {
    $postTitle = mysqli_real_escape_string($conn, $_POST['post_title']);
    $postContent = mysqli_real_escape_string($conn, $_POST['post_content']);
    $postMedia = $_FILES['post_media'];
    $newPostRes = addNewPost($postTitle, $postContent, $postMedia);
    header("Location: ../adminEditor_BoV.php?newPost=".$newPostRes);
}

if (isset($_POST['addBankInfBtn'])) {
    $inf_Class = mysqli_real_escape_string($conn, $_POST['infClass']);
    $inf_Title = mysqli_real_escape_string($conn, $_POST['infTitle']);
    $inf_Content = mysqli_real_escape_string($conn, $_POST['infContent']);
    $inf_Img = $_FILES['infPhoto'];
    $newInfRes = addNewInf($inf_Class, $inf_Title, $inf_Content, $inf_Img);
    header("Location: ../adminEditor_BoV.php?newInf=".$newInfRes);
}


if (isset($_POST['enableAgencyAccountBtn'])) {
	$agID = $_POST['enableAgencyAccountBtn'];
	$fields = array('ag_AccActive', 'ag_AdminUserID');
	$values = array(1, $userID);
	adminEditField("agency", $fields, $values, "ag_ID = ".$agID, "activeAgAcc");
    
} elseif (isset($_POST['disableAgencyAccountBtn'])) {
	$agID = $_POST['disableAgencyAccountBtn'];
	$fields = array('ag_AccActive', 'ag_AdminUserID');
	$values = array(0, $userID);
	adminEditField("agency", $fields, $values, "ag_ID = ".$agID, "stopAgAcc");
    
} elseif (isset($_POST['enableAgencyAddChanceBtn'])) {
	$agID = $_POST['enableAgencyAddChanceBtn'];
	$fields = array('ag_CanAddChance', 'ag_AdminUserID');
	$values = array(1, $userID);
	adminEditField("agency", $fields, $values, "ag_ID = ".$agID, "activeAgPostChance");
    
} elseif (isset($_POST['disableAgencyAddChanceBtn'])) {
	$agID = $_POST['disableAgencyAddChanceBtn'];
	$fields = array('ag_CanAddChance', 'ag_AdminUserID');
	$values = array(0, $userID);
	adminEditField("agency", $fields, $values, "ag_ID = ".$agID, "stopAgPostChance");
    
} elseif (isset($_POST['disableVolunteerAccountBtn'])) {
	$vlID = $_POST['disableVolunteerAccountBtn'];
	$fields = array('vl_AccActive', 'vl_AdminUserID');
	$values = array(0, $userID);
	adminEditField("volunteer", $fields, $values, "vl_ID = ".$vlID, "stopVlAcc");
    
} elseif (isset($_POST['enableVolunteerAccountBtn'])) {
	$vlID = $_POST['enableVolunteerAccountBtn'];
	$fields = array('vl_AccActive', 'vl_AdminUserID');
	$values = array(1, $userID);
	adminEditField("volunteer", $fields, $values, "vl_ID = ".$vlID, "activeVlAcc");
    
} elseif (isset($_POST['enableChanceApplyBtn'])) {
	$chID = $_POST['enableChanceApplyBtn'];
	$fields = array('ch_ActiveApply', 'ch_AdminUserID');
	$values = array(1, $userID);
	adminEditField("chance", $fields, $values, "ch_ID = ".$chID, "activeChnApp");
    
} elseif (isset($_POST['disableChanceApplyBtn'])) {
	$chID = $_POST['disableChanceApplyBtn'];
	$fields = array('ch_ActiveApply', 'ch_AdminUserID');
	$values = array(0, $userID);
	adminEditField("chance", $fields, $values, "ch_ID = ".$chID, "stopChnApp");
    
} elseif (isset($_POST['adminAlterAgPass'])) {
	$agNewAlteredPswd = mysqli_real_escape_string($conn, $_POST['accNewPassAdmin']);
	$agToChangePswd = mysqli_real_escape_string($conn, $_POST['adminAlterAgPass']);
	$fields = array('ag_Password', 'ag_AdminUserID');
	$values = array("'".password_hash($agNewAlteredPswd, PASSWORD_DEFAULT)."'", $userID);
	adminEditField("agency", $fields, $values, "ag_ID = ".$agToChangePswd, "editAgAcc");
    
} elseif (isset($_POST['adminAlterVlPass'])) {
	$vlNewAlteredPswd = mysqli_real_escape_string($conn, $_POST['accNewPassAdmin']);
	$vlToChangePswd = mysqli_real_escape_string($conn, $_POST['adminAlterVlPass']);
	$fields = array('vl_Password', 'vl_AdminUserID');
	$values = array("'".password_hash($vlNewAlteredPswd, PASSWORD_DEFAULT)."'", $userID);
	adminEditField("volunteer", $fields, $values, "vl_ID = ".$vlToChangePswd, "editVlAcc");
    
} elseif (isset($_POST['disablePostActBtn'])) {
	$po_ID = mysqli_real_escape_string($conn, $_POST['disablePostActBtn']);
	$fields = array('po_Active', 'po_AdminUserID');
	$values = array(0, $userID);
	adminEditField("adminpost", $fields, $values, "po_ID = ".$po_ID, "stopPost");
    
} elseif (isset($_POST['enablePostActBtn'])) {
	$po_ID = mysqli_real_escape_string($conn, $_POST['enablePostActBtn']);
	$fields = array('po_Active', 'po_AdminUserID');
	$values = array(1, $userID);
	adminEditField("adminpost", $fields, $values, "po_ID = ".$po_ID, "activePost");
    
} elseif (isset($_POST['editOldPost'])) {
	$oldPoID = mysqli_real_escape_string($conn, $_POST['editOldPost']);
	$newPoTitle = mysqli_real_escape_string($conn, $_POST['post_title']);
    $newPoContent = mysqli_real_escape_string($conn, $_POST['post_content']);
    $newPoPhotoFile = $_FILES['post_media'];
    if ($newPoPhotoFile['name'] != '') {
        $newPoPhotoExploding = explode('.', $newPoPhotoFile['name']);
		$newPoPhotoExt = end($newPoPhotoExploding);
		$newPoPhoto = $oldPoID."_".getRealTimeDate().".".$newPoPhotoExt;
        
        $fields = array('po_Title', 'po_Content', 'po_Photo', 'po_EditingUserID');
        $values = array("'".$newPoTitle."'", "'".$newPoContent."'", "'".$newPoPhoto."'", $userID);
        if (!empty($newPoPhoto))
			move_uploaded_file($newPoPhotoFile['tmp_name'], "../poPP/".$newPoPhoto);
    } else {
        $fields = array('po_Title', 'po_Content', 'po_EditingUserID');
        $values = array("'".$newPoTitle."'", "'".$newPoContent."'", $userID);
    }
	adminEditField("adminpost", $fields, $values, "po_ID = ".$oldPoID, "editPosts");
    //
} elseif (isset($_POST['editBankInfBtn'])) {
	$oldInfID = mysqli_real_escape_string($conn, $_POST['editBankInfBtn']);
    $newInfClass = mysqli_real_escape_string($conn, $_POST['infClass']);
	$newInfTitle = mysqli_real_escape_string($conn, $_POST['infTitle']);
    $newInfContent = mysqli_real_escape_string($conn, $_POST['infContent']);
    $newInfPhotoFile = $_FILES['infPhoto'];
    
    if ($newInfPhotoFile['name'] != '') {
        $newInfPhotoExploding = explode('.', $newInfPhotoFile['name']);
		$newInfPhotoExt = end($newInfPhotoExploding);
		$newInfPhoto = $oldInfID."_".getRealTimeDate().".".$newInfPhotoExt;
        
        $fields = array('nf_Class', 'nf_Title', 'nf_Content', 'nf_Photo', 'nf_EditingUserID');
        $values = array($newInfClass, "'".$newInfTitle."'", "'".$newInfContent."'", "'".$newInfPhoto."'", $userID);
        if (!empty($newInfPhoto))
			move_uploaded_file($newInfPhotoFile['tmp_name'], "../nfPP/".$newInfPhoto);
    } else {
        $fields = array('nf_Class', 'nf_Title', 'nf_Content', 'nf_EditingUserID');
        $values = array($newInfClass, "'".$newInfTitle."'", "'".$newInfContent."'", $userID);
    }
	adminEditField("admininfo", $fields, $values, "nf_ID = ".$oldInfID, "editBankInf");
    //
} elseif(isset($_POST['disableInfoActBtn'])) {
    $nf_ID = mysqli_real_escape_string($conn, $_POST['disableInfoActBtn']);
	$fields = array('nf_Active', 'nf_AdminUserID');
	$values = array(0, $userID);
	adminEditField("admininfo", $fields, $values, "nf_ID = ".$nf_ID, "stopBankInf");
    
} elseif(isset($_POST['enableInfoActBtn'])) {
    $nf_ID = mysqli_real_escape_string($conn, $_POST['enableInfoActBtn']);
	$fields = array('nf_Active', 'nf_AdminUserID');
	$values = array(1, $userID);
	adminEditField("admininfo", $fields, $values, "nf_ID = ".$nf_ID, "activeBankInf");
    
} elseif (isset($_POST['alterAuAccInf'])) {
    $auOldID = mysqli_real_escape_string($conn, $_POST['alterAuAccInf']);
    
    if (isset($_POST['auAccActive']))
        $auAccActive = 1;
    else
        $auAccActive = 0;
    
    $userAuths = array();
	foreach($adminAuthsArr as $XAuth) {
		
		if (isset($_POST[$XAuth]))
			$userAuths[$XAuth] = 1;
        else
			$userAuths[$XAuth] = 0;
	}
    $auNewAuthsStr = '';
    foreach ($userAuths as $authName => $authVal) {
        $auNewAuthsStr .= $authName.'='.$authVal.',';
    }
    $auNewAuthsStr = substr($auNewAuthsStr, 0, strlen($auNewAuthsStr) - 1);
    // echo($auNewAuthsStr);
    if (isset($_POST['auNewPass']) && !empty($_POST['auNewPass'])) {
        $auNewPass = mysqli_real_escape_string($conn, $_POST['auNewPass']);
        $fields = array('au_Password', 'au_AccActive', 'au_Authentication');
        $values = array("'".password_hash($auNewPass, PASSWORD_DEFAULT)."'", $auAccActive, "'".$auNewAuthsStr."'");
    } else {
        $fields = array('au_AccActive', 'au_Authentication');
        $values = array($auAccActive, "'".$auNewAuthsStr."'");
    }
     
    adminEditField("adminuser", $fields, $values, "au_ID = ".$auOldID, "editAdminAcc");
}

function adminEditField ($tableToEffect, $fieldToEffect = array(), $valueToPut = array(), $editCondition, $privilege) {
	global $conn, $userID, $ourEmail;
	$fieldsAndValues = "";
	$isUserAuthorized = checkUserPrivelage($userID, $privilege);
	if ($isUserAuthorized != 1) {
		header("Location: ../index.php?noAuth");
		exit();
	}
	for ($no = 0; $no <= count($fieldToEffect) - 1; $no ++) {
		$no != count($fieldToEffect) - 1 ? $seperator = ", " : $seperator = " ";
		$fieldsAndValues .= $fieldToEffect[$no]." = ".$valueToPut[$no].$seperator;
	}
	$editFieldSql = "UPDATE ".$tableToEffect." SET ".$fieldsAndValues."WHERE ".$editCondition;
	
	try {
		mysqli_autocommit($conn, false);
		$editFieldQry = mysqli_query($conn, $editFieldSql);
		if ($editFieldQry) {
			if ($privilege == 'activeAgAcc') {
				$agIdInfo = str_replace(' ', '', $editCondition);
				$agIdInfo = explode('=', $agIdInfo);
				$agEmailID = $agIdInfo[1];
				//
				$agActiveAccToMail = getSingleValue('agency', 'ag_Email', 'ag_ID = '.$agEmailID, '');
				$agActiveAccMailTitle = 'تفعيل حسابكم بموقع بنك المتطوعين';
				$agActiveAccMailSub = 'From: '.$ourEmail;
				// echo($agActiveAccToMail);
				$agActiveAccMailCont = 'نشكركم لتسجيلكم بموقع بنك امتطوعين. نعلمكم انه تم تفعيل حسابكم في الموقع.'.'\n\n';
				$agActiveAccMailCont .= 'يمكنكم الآن نشر الفرس من حسابكم والإستفادة من خدمات الموقع لاعمالكم التطوعية.';
				$agActiveAccMailRes = sendBoVMail($agActiveAccToMail, $agActiveAccMailTitle, $agActiveAccMailCont, $agActiveAccMailSub);
				if (!$agActiveAccMailRes)
					throw new Exception('senMailToAgErr');
			}
		} else
			throw new Exception('adminEditErr');
		
		mysqli_commit($conn);
		$editState = "Success";
	} catch(Exception $adminEditErr) {
		mysqli_rollback($conn);
		$editState = "Failure";
	} finally {
		mysqli_autocommit($conn, true);
	}

    if ($tableToEffect == "agency") {
		$agReturnToName = getSingleValue('agency', 'ag_Name', $editCondition, 'none');
    header("Location: ../agency_BoV.php?&edit=".$editState);
	} elseif ($tableToEffect == "chance") {
		$chanceAgcID = getSingleValue("chance", "ch_agcID", $editCondition, 0);
		$singleAgencyName = getSingleValue("agency", "ag_Name", "ag_ID = ".$chanceAgcID, 0);
	 	header("Location: ../chance_BoV.php?&edit=".$editState);
	} elseif ($tableToEffect == "volunteer") {
		$volunteerName = getSingleValue("agency", "ag_Name", "ag_ID = ".$chanceAgcID, 0);
	 	header("Location: ../volunteer_BoV.php?edit=".$editState);
	} elseif ($tableToEffect == "adminuser" || $tableToEffect == "adminpost" || $tableToEffect == "admininfo") {
	 	header("Location: ../adminEditor_BoV.php?edit=".$editState);
	}
}

function addNewAdmin ($adminNewName, $adminNewPass, $adminAuthintications, $accActive = 1) {
	global $conn, $userID;
	$newAdminAddRes;
	// Hashing the password
	$hashedAuPwd = password_hash($adminNewPass, PASSWORD_DEFAULT);
	$auAccID = getSingleValue("adminuser", "MAX(au_ID) + 1", "", 1);
	if (is_null($auAccID))
		$auAccID = 1;

	$newAdminSql = "INSERT INTO adminuser VALUES ($auAccID, '$adminNewName', '$hashedAuPwd',
	DATE(NOW()), '$adminAuthintications', $userID, $accActive)";
    //echo($newAdminSql);
    try {
		mysqli_autocommit($conn, false);
		$newAdminQry = mysqli_query($conn, $newAdminSql);
		if ($newAdminQry) {
			mysqli_commit($conn);
			$newAdminAddRes = "doneNewAdmin";
		} else {
			throw new Exception('noneNewAdmin');
		}
	} catch(Exception $newAdminErr) {
		mysqli_rollback($conn);
		$newAdminAddRes = "noneNewAdmin";
	} finally {
		mysqli_autocommit($conn, true);
		return($newAdminAddRes);
	}
}


function addNewPost($postTitle, $postContent, $mediaDes) {
    global $conn, $userID;

    $postTitle = mysqli_real_escape_string($conn, $postTitle);
	$postContent = mysqli_real_escape_string($conn, $postContent);
    
	$poID = getSingleValue("adminpost", "MAX(po_ID) + 1", "", 1);
    if (is_null($poID))
        $poID = 1;
	
	/*
    if (!empty($mediaDes['name'])) {
		$poPhotoExploding = explode('.', $mediaDes['name']);
		$poPhotoExt = end($poPhotoExploding);
		$poPhoto = $poID."_".getRealTimeDate().".".$poPhotoExt;
	} else {
		$poPhoto = '';
	}
	*/
	
	$postSql = 
		"INSERT INTO adminpost VALUES ($poID, '$postTitle', $userID, NULL, DATE(NOW()), NULL, '$postContent', 1, NULL);";
	
	try { 
		mysqli_autocommit($conn, false);
		$postQry = mysqli_query($conn, $postSql);
	
		if (!$postQry) {
			throw new Exception('postError');
		} else {
        	/*if (!empty($poPhoto)) {
				$postPhotoRes = move_uploaded_file($mediaDes['tmp_name'], "../poPP/".$poPhoto);
				if (!$postPhotoRes)
					throw new Exception('postError');
			}*/
			mysqli_commit($conn);	
			$postState = "postSuccess";
		}
	} catch(Exception $newPostErr) {
		mysqli_rollback($conn);
		
		/*if (file_exists("../poPP/".$poPhoto))
			unlink("../poPP/".$poPhoto);*/
				
		$postState = "postError";
	} finally {
		// echo($postSql);
		mysqli_autocommit($conn, true);
    	return($postState);
	}
}


function addNewInf($infClass, $infTitle, $infContent, $infImg) {
    global $conn, $userID;
    $addInfRes = '';
    
    $infClass = mysqli_real_escape_string($conn, $infClass);
    $infTitle = mysqli_real_escape_string($conn, $infTitle); 
    $infContent = mysqli_real_escape_string($conn, $infContent); 
    
    if (empty($infTitle))
        $infTitle = 'NULL';
    else
        $infTitle = "'".$infTitle."'";
        
    if (empty($infContent))
        $infContent = 'NULL';
    else
        $infContent = "'".$infContent."'";
        
    
    $infID = getSingleValue('admininfo', 'MAX(nf_ID) + 1', '', 1);
    if (is_null($infID))
        $infID = 1;
    
    if(!empty($infImg['name'])) {
        $infPhotoExploding = explode('.', $infImg['name']);
		$infPhotoExt = end($infPhotoExploding);
		$infPhoto = $infID."_".getRealTimeDate().".".$infPhotoExt;
        $infPhotoParam = "'".$infPhoto."'";
	} else {
        $infPhoto = '';
		$infPhotoParam = 'NULL';
	}
    
    $newInfSql = "INSERT INTO admininfo VALUES($infID, DATE(NOW()), $infClass, $infTitle, $infContent, $infPhotoParam, $userID, NULL, 1, NULL);";
    
    mysqli_autocommit($conn, false);
    $newInfQry = mysqli_query($conn, $newInfSql);
	try {
    	if ($newInfQry) {
        	if ($infPhoto != '') {
				$adminInfPhotoRes = move_uploaded_file($infImg['tmp_name'], "../nfPP/".$infPhoto);
				if (!$adminInfPhotoRes)
					throw new Exception('none');
			}
			mysqli_commit($conn);
        	$addInfRes = 'done';
    	} else {
        	throw new Exception('none');
    	}
	} catch(Exception $adminInfErr) {
		mysqli_rollback($conn);
		
		if (file_exists("../nfPP/".$infPhoto))
			unlink("../nfPP/".$infPhoto);
		
        $addInfRes = 'none';
	} finally {
    	mysqli_autocommit($conn, true);
    	// echo($newInfSql);
    	return($addInfRes);
	}
}

/*function alterAgNewPass($agAcc, $agPass) {
	global $conn, $userID, $userType;
	$adminAlterAgPassRes = '';

	if ($userType != 'au_uid') {
		header("Location: index.php");
		exit();
	}
	$hashedAgPass = password_hash($agPass, PASSWORD_DEFAULT);

	$alterAgPassSql = "UPDATE agency SET ag_Password = '$hashedAgPass', ag_AdminUserID = $userID WHERE ag_ID = $agAcc";

	mysqli_autocommit($conn, false);
	$alterAgPassQry = mysqli_query($conn, $alterAgPassSql);
	if ($alterAgPassQry) {
		mysqli_commit($conn);
		$adminAlterAgPassRes = 'doneNewPassAg';
	} else {
		mysqli_rollback($conn);
		$adminAlterAgPassRes = 'noneNewPassAg';
	}
	mysqli_autocommit($conn, true);
	return($adminAlterAgPassRes);

}*/













?>
