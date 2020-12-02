<?php
include('dbConnOps.php');


if (isset($_POST['searchText'])) {
	$searchText = mysqli_real_escape_string($conn, $_POST['searchText']);
	showSearchRes($searchText);
	include('../footer_BoV.php');
}

if (isset($_POST['notfun'])) {
	Notification();
	exit();
}
if (isset($_POST['notnumber'])) {
    countNot();
	exit();
}
if (isset($_POST['read'])) {
    global $conn,$col;
    $read = $_POST['read'];
    $userType = $_SESSION['userType'];
    if ($userType == 'ag_uid'){
        $col ="ag_read";
    }
    elseif ($userType == 'vl_uid'){
        $col ="ap_read";
    }
    $newExpRes = '';
	$expSql = "UPDATE chanceapplication SET ".$col."  = 1 WHERE ap_id = ".$read." ";

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
	exit();
}


if (isset($_POST['showChInfo'])) {
    $showChInfoID = mysqli_real_escape_string($conn, $_POST['showChInfo']);
    echo(showChance(-1, $showChInfoID));
    exit();
}

if (isset($_POST['copyChnLinkID'])) {
	//error_reporting(0);
	$shareChnId = mysqli_real_escape_string($conn, $_POST['copyChnLinkID']);
	$shareChnName = getSingleValue('chance', 'ch_Title', 'ch_ID = '.$shareChnId, 'none');
	$shareChnHashed = password_hash($shareChnName, PASSWORD_DEFAULT);
	echo($_SERVER['HTTP_HOST'].'/FinalBov/chance_BoV.php?sharedChance='.$shareChnName);
	exit();
}

if (isset($_POST['getChnComboes'])) {
    $chnLocationCombo = addComboValues($chanceLocation, '', '--موقع الفرصة--', -1, 'ChnLocation');
    $chnTypeCombo = addComboValues($chanceType, '', '--نوع الفرصة--', -1, 'ChnType');
    $chnFieldCombo = addComboValues($chanceWorkField, 'onChange="ChnSpecChange(0)"', '--مجال عمل الفرصة--', -1, 'ChnField');
    $chnFieldSpecCombo = addComboValues($chanceWorkSpecialty[0], '', '--تخصص مجال العمل--', -1, 'ChnSpec');

    echo($chnTypeCombo.'%'.$chnFieldCombo.'%'.$chnFieldSpecCombo.'%'.$chnLocationCombo);
    exit();
}

if (isset($_POST['getChnSpecCmboVal'])) {
    $chnFieldVal = $_POST['getChnSpecCmboVal'];

    $allSelectTag = '<option value="-1" selected="selected">--تخصص مجال العمل--</option>';
    foreach ($chanceWorkSpecialty[$chnFieldVal] as $index => $indexVal) {
		$allSelectTag .= '<option value = "'.$index.'">'.$indexVal.'</option>';
	}

    echo($allSelectTag);
    exit();
}

if (isset($_FILES['ChnFile'])) {
    $chDoc = $_FILES['ChnFile'];
    $docAllowedExt = array('pdf', 'doc', 'docx', 'xlsx', 'xls');

    $docExploded = explode('.', $chDoc['name']);
    $docExt = strtolower(end($docExploded));

    if (in_array($docExt, $docAllowedExt)) {
        if ($chDoc['error'] === 0) {
            if ($chDoc['size'] <= 1000000) {
                echo('');
                exit();
            } else {
                echo('لا يمكن رفع مستند يتجاوز حجمه 1MB');
                exit();
            }
        } else {
            echo('عذراً! حدث خطاء اثناء تحميل المستند يرجى إعادة رفعه');
            exit();
        }
    } else {
        echo('يرجى إختيار مستند من الصيغ التالية (pdf - doc - docx - xlsx - xls)');
        exit();
    }
    exit();
}

if (isset($_GET['saveChnFile'])) {
	$chnDocName = $_GET['saveChnFile'];
	$chnDocDir = "../chnF/".$chnDocName;

	if (file_exists($chnDocDir)) {
		header("Content-type: public");
		header("Content-Disposition: attachment; filename=$chnDocName");
		readfile($chnDocDir);
	} else {
		header("Location: ../index.php");
		exit();
	}
	exit();
}


if (isset($_FILES['volNewPic'])) {
    $vlNewPp = $_FILES['volNewPic'];

    if (empty($vlNewPp['name'])) {
        echo('');
        exit();
    } else {
		checkPhotoValidation($vlNewPp);
	}
}

if (isset($_POST['checkVlCurPass']) && isset($_POST['volPassToCheck'])) {
    $vol_ID = mysqli_real_escape_string($conn, $_POST['volPassToCheck']);
    $volEnteredPass = mysqli_real_escape_string($conn, $_POST['checkVlCurPass']);

    if (empty($volEnteredPass)) {
        echo('');
        exit();
    }

    $volRealPass = getSingleValue('volunteer', 'vl_Password', 'vl_ID = '.$vol_ID, 'none');
    $checkCurrPassRes = password_verify($volEnteredPass, $volRealPass);

    if ($checkCurrPassRes == true){
        echo("");
        exit();
    } else {
        echo("كلمة المرور التي ادخلتها غير صحيحة!");
        exit();
    }
}

if (isset($_POST['getVlEditAreaVal'])) {
    $vlGovVal = $_POST['getVlEditAreaVal'];

    $allSelectTag = '<option value="-1" selected="selected">--اختر المديرية--</option>';
    foreach ($chanceLocGovsAreas[$vlGovVal] as $index => $indexVal) {
		$allSelectTag .= '<option value = "'.$index.'">'.$indexVal.'</option>';
	}

    echo($allSelectTag);
    exit();
}

if (isset($_POST['getVolEditInfo'])) {
    $vlEditInfID = $_POST['getVolEditInfo'];
    $vlEditInfo = '';
    $volEditInfSql = "SELECT vl_UserName, vl_PhoneNumber, vl_Photo, vl_Language, vl_Qualification, vl_Specialty, vl_locationGov, vl_LocationArea, vl_Skill FROM volunteer WHERE vl_ID = $vlEditInfID";
    $volEditInfQry = mysqli_query($conn, $volEditInfSql);
    while($volEditInfo = mysqli_fetch_assoc($volEditInfQry)) {
		$vlEditQual = addComboValues($volEduQualification, '', '--اختر المؤهل الدراسي--', $volEditInfo['vl_Qualification'],'edu_qual');
		$vlEditSpec = explode(',', $volEditInfo['vl_Specialty']);
		$vlEditSpecStr = '';
		foreach ($vlEditSpec as $volEditSpecID => $volEditSpecVal) {
			$vlEditSpecStr .= addComboValues($volEduSpecialty, '', '--اختر التخصص--', $volEditSpecVal,'edu_spec'.$volEditSpecID).'(,)';
		}
		$vlEditSpecStr = substr($vlEditSpecStr, 0, strlen($vlEditSpecStr) - 3);

        $vlEditInfo = $volEditInfo['vl_UserName']."(^)".$volEditInfo['vl_PhoneNumber']."(^)".
        $volEditInfo['vl_Skill']."(^)".$volEditInfo['vl_Photo']."(^)".tagVolLanguage($volEditInfo['vl_Language'], 'A')."(^)".$vlEditQual."(^)".$vlEditSpecStr."(^)".addComboValues($chanceLocation, '', '--اختر المحافظة--', $volEditInfo['vl_locationGov'], 'volLocGov')
			."(^)".addComboValues($chanceLocGovsAreas[$volEditInfo['vl_locationGov']], '', '--اختر المديرية--', $volEditInfo['vl_LocationArea'], 'volLocArea');
    }
    echo($vlEditInfo);
   	exit();
}

if (isset($_POST['addVolSpecCmbo'])) {
	$newVolSpecCmbo = addComboValues($volEduSpecialty, '', '--اختر التخصص--', -1,'edu_spec1');
	echo($newVolSpecCmbo);
	exit();
}

if (isset($_POST['showVlInfo'])) {
	$vl_InfoID = $_POST['showVlInfo'];
	showVolunteer($vl_InfoID, '', true);
	exit();
}

if (isset($_POST['showVolExpInf']) && isset($_POST['ExpShowType'])) {
	global $chanceWorkField, $chanceWorkSpecialty;
	//
    $volExp_ID = mysqli_real_escape_string($conn, $_POST['showVolExpInf']);
    $volExp_Type = mysqli_real_escape_string($conn, $_POST['ExpShowType']);
	//
	$volExpField = '';
	$volExpSpec = '';

    if ($volExp_Type == 'O') {
        $showVlExpSql = "SELECT * FROM volunteer_experience WHERE vl_ExpID = $volExp_ID";
        $showVlExpQry = mysqli_query($conn, $showVlExpSql);
		//
        $volExpInfStr = '';
        
		//
        if ($showVlExpQry) {
            while ($expInfo = mysqli_fetch_assoc($showVlExpQry)) {
				$volExpField = addComboValues($chanceWorkField, '', 'اختر مجال الخبرة', $expInfo['vl_ExpField'], 'volExpWorkField');
				$volExpSpec = addComboValues($chanceWorkSpecialty[$expInfo['vl_ExpField']], '', 'اختر تخصص الخبرة', $expInfo['vl_ExpSpec'], 'volExpWorkSpec');
				//
                $volNameExp = getSingleValue('volunteer', 'vl_UserName', 'vl_ID = '.$expInfo['vl_volID'], '');
                $volExpInfStr .= $volNameExp.'(EXP)'.$expInfo['vl_ExpPosition'].'(EXP)'.$expInfo['vl_ExpOrg'].'(EXP)'.$expInfo['vl_ExpStart'].'(EXP)'.$expInfo['vl_ExpEnd'].'(EXP)'.$expInfo['vl_ExpSup'].'(EXP)'.$expInfo['vl_ExpSupEmail'].'(EXP)'.$expInfo['vl_ExpDesc'].'(EXP)'.$volExpField.'(EXP)'.$volExpSpec;
            }
        } else {
            $volExpInfStr = '(EXP)(EXP)(EXP)(EXP)(EXP)(EXP)(EXP)';
        }
    } elseif ($volExp_Type == 'N') {
        $volNameExp = getSingleValue('volunteer', 'vl_UserName', 'vl_ID = '.$volExp_ID, '');
		//
		$volExpField = addComboValues($chanceWorkField, '', 'اختر مجال الخبرة', '-1', 'volExpWorkField');
		$volExpSpec = addComboValues($chanceWorkSpecialty[0], '', 'اختر تخصص الخبرة', '-1', 'volExpWorkSpec');
		//
        $volExpInfStr = $volNameExp.'(EXP)(EXP)(EXP)(EXP)(EXP)(EXP)(EXP)(EXP)'.$volExpField.'(EXP)'.$volExpSpec;
    }
    echo($volExpInfStr);
    exit();
}


if (isset($_POST['getAgcEditInfo'])) {
    $agEditInfID = $_POST['getAgcEditInfo'];
    $agEditInfo = '';
    $agcEditInfSql = "SELECT ag_Name, ag_Appreviation, ag_Type, ag_Photo, ag_PhoneNumber, ag_Branch, ag_Address, ag_SocialLinks FROM agency WHERE ag_ID = $agEditInfID";
    $agcEditInfQry = mysqli_query($conn, $agcEditInfSql);
    while($agcEditInfo = mysqli_fetch_assoc($agcEditInfQry)) {
        $agEditInfo = $agcEditInfo['ag_Name']."#".$agcEditInfo['ag_Appreviation']."#".$agencyType[$agcEditInfo['ag_Type']]
        ."#".$agcEditInfo['ag_PhoneNumber']."#".$agcEditInfo['ag_Branch']."#".
        $agcEditInfo['ag_Address']."#".$agcEditInfo['ag_SocialLinks']."#".$agcEditInfo['ag_Photo'];
    }
    echo($agEditInfo);
    exit();
}

if (isset($_FILES['agNewPhoto'])) {
	$agNewPhoto = $_FILES['agNewPhoto'];
	if (empty($agNewPhoto['name'])) {
        echo('');
        exit();
    } else {
		checkPhotoValidation($agNewPhoto);
	}
}

if (isset($_POST['agPass_Txt']) && isset($_POST['agPass_ID'])) {
	$ag_ID = mysqli_real_escape_string($conn, $_POST['agPass_ID']);
	$ag_EnteredPass = mysqli_real_escape_string($conn, $_POST['agPass_Txt']);

	if (empty($ag_EnteredPass)) {
		echo('');
		exit();
	}

	$agRealPass = getSingleValue('agency', 'ag_Password', 'ag_ID = '.$ag_ID, -1);
	$checkAgPassRes = password_verify($ag_EnteredPass, $agRealPass);

	if ($checkAgPassRes == true) {
		echo("");
		exit();
	} else {
		echo("كلمة المرور التي ادخلتموها غير صحيحة!");
		exit();
	}
}

if (isset($_POST['doSendNewPass']) && isset($_POST['forgetUserEmail'])) {
    $realEmail = mysqli_real_escape_string($conn, $_POST['forgetUserEmail']);

    $isForgEmailVol = getSingleValue('volunteer', 'COUNT(vl_ID)', "vl_Email = '".$realEmail."' AND vl_AccActive = 1", -1);
    $isForgEmailAgc = getSingleValue('agency', 'COUNT(ag_ID)', "ag_Email = '".$realEmail."' AND ag_AccActive = 1", -1);

    if ($isForgEmailVol > 0) {
        $sendNewPass = true;
        // echo("");
    } else {
        if ($isForgEmailAgc > 0) {
            $sendNewPass = true;
            // echo("");
        } else {
            echo('WorongEmail');
            exit();
        }
    }


    $newAutoPassLen = 7;
    $newautoPassChars = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789";
    $newAutoPassShuffeled = substr(str_shuffle($newautoPassChars), 0, $newAutoPassLen);
    $newAutoPass = password_hash($newAutoPassShuffeled, PASSWORD_DEFAULT);

    if ($isForgEmailVol > 0) {
        $newPass_VolID = getSingleValue('volunteer', 'vl_ID', "vl_Email = '".$realEmail."'", -1);
        $newPass_Sql = "UPDATE volunteer SET vl_Password = '$newAutoPass' WHERE vl_ID = $newPass_VolID;";
        $emailPassCont = 'لقد قمت بطلب تغيير كلمة المرور لحسابك في بنك المتطوعين'."\n";
    } else {
        if ($isForgEmailAgc > 0) {
            $newPass_AgcID = getSingleValue('agency', 'ag_ID', "ag_Email = '".$realEmail."'", -1);
            $newPass_Sql = "UPDATE agency SET ag_Password = '$newAutoPass' WHERE ag_ID = $newPass_AgcID;";
            $emailPassCont = 'لقد قمتم بطلب تغيير كلمة المرور لحسابكم في بنك المتطوعين'."\n";
        }
    }

	$newPassRegState = "";
	try {
		mysqli_autocommit($conn, false);
		$newPass_Qry = mysqli_query($conn, $newPass_Sql);
	   if ($newPass_Qry) {
		   $emailPassTitle = 'كلمة المرور الجديدة لحسابكم بموقع بنك المتطوعين';
           $emailPassSubject = "From: ".$ourEmail;
           $emailPassCont .= 'كلمة المرور الجديد هي: '.'\n'.$newAutoPassShuffeled.'\n\n';
		   $emailPassCont .= 'يرجى إستخدامها لتسجيل الدخول ومن ثم تغييرها من إعدادت الصفحةالخاصة بكم';

		   $mailPassRes = sendBoVMail($realEmail, $emailPassTitle, $emailPassCont, $emailPassSubject);
           if ($mailPassRes) {
               mysqli_commit($conn);
               $newPassRegState = "doneNewAutoPass";
           } else {
               throw new Exception("sendPassErr");
           }
	   } else {
           throw new Exception("editNewPassErr");
	   }
    } catch (Exception $emailPassErr) {
		$newPassRegState = "noneNewAutoPass";
        mysqli_rollback($conn);
    } finally {
       // echo($newPass_Sql);
	   mysqli_autocommit($conn, true);
	   echo($newPassRegState);
        exit();
	   // header("Location: ../index.php?changeForgPass=".$newPassRegState);
    }
}

if (isset($_POST['send_Email'])) {
    $emailSendRes = '';
    $senderName = mysqli_real_escape_string($conn, $_POST['send_name']);
    $senderEmail = mysqli_real_escape_string($conn, $_POST['send_email']);
    $senderMsg = mysqli_real_escape_string($conn, $_POST['send_message']);

    $senderNameErr = '';
    $senderEmailErr = '';
    $senderMsgErr = '';

    // check sender name as empty
    if (empty($senderName))
        $senderNameErr = 'يرجى إدخال اسمك!';

    // check sender email as empty or valid
    if (empty($senderEmail))
        $senderEmailErr = 'يرجى إدخال البريد الإلكتروني الخاص بك!';
    elseif (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL))
        $senderEmailErr = 'يرجى إدخال بريد إلكتروني صالح!';

    // check sender message as empty
    if (empty($senderMsg))
        $senderMsgErr = 'يرجى إدخال محتوى الرسالة!';


    if ($senderNameErr != '' || $senderEmailErr!= '' || $senderMsgErr != '') {
        $emailSendRes = $senderNameErr.'(#)'.$senderEmailErr.'(#)'.$senderMsgErr;
        echo($emailSendRes);
        exit();
    } else {
        try {
            $emailSub = "From: ".$senderEmail;
			$emailTitle = 'رسالة لكم عبر موقعكم';
			$emailCont = 'تم إرسال الرسال من قبل: '.'\n'.$senderName.'\n\n'.$senderMsg;
			$emailSendState = sendBoVMail($ourEmail, $emailTitle, $emailCont, $emailSub);
			if (!$emailSendState)
				throw new Exception('sendUsEmailErr');
            echo('good');
            exit();
        } catch(Exception $sendUsEmailErr) {
            echo('error');
            exit();
        }
    }
    exit();
}

if (isset($_POST['auNameChecked'])) {
    $auNameToCheck = mysqli_real_escape_string($conn, $_POST['auNameChecked']);
    $auNameChkRes = getSingleValue('adminuser', 'COUNT(au_ID)', "au_UserName = '$auNameToCheck'", -1);
    echo($auNameChkRes);
    exit();
}

if (isset($_POST['getAuInf'])) {
    $auID = $_POST['getAuInf'];

    $auName = getSingleValue('adminuser', 'au_UserName', 'au_ID = '.$auID, 'none');
    $auDate = getSingleValue('adminuser', 'au_AccCreatedIn', 'au_ID = '.$auID, 'none');
    $auAccActive = getSingleValue('adminuser', 'au_AccActive', 'au_ID = '.$auID, 'none');
    $auAuthsTags = adminAuthsShow($auID, 'C');

    echo($auName.'^'.$auDate.'^'.$auAccActive.'^'.$auAuthsTags);
    exit();
}

if (isset($_POST['getAuAuthChks'])) {
    $allAuthsTaged = '';
	for ($I = 0; $I < count($adminAuthsArr); $I++) {
		$adminAuthsName = $adminAuthsArr[$I];
		$adminAuthsText = $adminAuthsStrArabicArr[$I];
		$allAuthsTaged .= '<input type="checkbox" name="'.$adminAuthsName.'"><label>'.$adminAuthsText.'</label><br>';
	}
    /*foreach($adminAuthsArr as $adminAuthsName) {
        $allAuthsTaged .= '<input type="checkbox" name="'.$adminAuthsName.'"><label>'.$adminAuthsName.'</label><br>';
    }*/

    echo($allAuthsTaged);
    exit();
}

if (isset($_POST['getPostInf'])) {
    $po_ID = $_POST['getPostInf'];

    $po_Title = getSingleValue('adminpost', 'po_Title', 'po_ID = '.$po_ID, '');
    $po_Content = getSingleValue('adminpost', 'po_Content', 'po_ID = '.$po_ID, '');
    echo($po_Title.'^'.$po_Content);
    exit();
}

if (isset($_FILES['post_media'])) {
    $postImg = $_FILES['post_media'];
    checkPhotoValidation($postImg);
    exit();
}

if (isset($_POST['fetchInfDetail'])) {
    $infID = $_POST['fetchInfDetail'];

    $infShowSql = "SELECT nf_Class, nf_Title, nf_Content, nf_Photo FROM admininfo WHERE nf_ID = $infID;";
    $infShowQry = mysqli_query($conn, $infShowSql);

	$infClassCmbo = addComboValues($adminInfoType, '', '--نوع المعلومة--', -1, 'infClass');;
    $infTitle = '';
    $infContent = '';
	$infPhoto = '';

    if ($infShowQry) {
		if (mysqli_num_rows($infShowQry) > 0) {
        	$infInfo = mysqli_fetch_assoc($infShowQry);
        	$infClassID = $infInfo['nf_Class'];
        	$infClassCmbo = addComboValues($adminInfoType, '', '--نوع المعلومة--', $infInfo['nf_Class'], 'infClass');
        	$infTitle = $infInfo['nf_Title'];
        	$infContent = $infInfo['nf_Content'];
			$infPhoto = $infInfo['nf_Photo'];
		}
    }
    echo($infTitle.'^'.$infContent.'^'.$infClassCmbo.'^'.$infPhoto);
    exit();
}

if (isset($_FILES['infMemPhoto'])) {
    $infImg = $_FILES['infMemPhoto'];
    checkPhotoValidation($infImg);
    exit();
}

if (isset($_POST['checkInfVision']) && isset($_POST['checkInfVisionID'])) {
	$vis_ID = mysqli_real_escape_string($conn, $_POST['checkInfVisionID']);
  $doesVisionExist = getSingleValue('admininfo', 'COUNT(nf_ID)', 'nf_Class = 1 AND nf_Active = 1', -1);
	$isInfTheSameVis = getSingleValue('admininfo', 'COUNT(nf_ID)', 'nf_Class = 1 AND nf_Active = 1 AND nf_ID = '.$vis_ID, -1);
  if ($doesVisionExist > 0 && $isInfTheSameVis <= 0)
      echo('يوجد رؤية مضافة من قبل ومفعلة ولا يمكن إضافة اكثر من رؤية واحدة');
  else
      echo('');
  exit();
}

if (isset($_POST['checkInfMessage']) && isset($_POST['checkInfMessageID'])) {
	$msg_ID = mysqli_real_escape_string($conn, $_POST['checkInfMessageID']);
  $doesMessageExist = getSingleValue('admininfo', 'COUNT(nf_ID)', 'nf_Class = 2 AND nf_Active = 1', -1);
	$isInfTheSameMsg = getSingleValue('admininfo', 'COUNT(nf_ID)', 'nf_Class = 2 AND nf_Active = 1 AND nf_ID = '.$msg_ID, -1);
  if ($doesMessageExist > 0 && $isInfTheSameMsg <= 0)
      echo ('يوجد رسالة مضافة من قبل ومفعلة ولا يمكن إضافة اكثر من رسالة واحدة');
  else
      echo('');
  exit();
}

function checkPhotoValidation($newPhoto) {
	$photoAllowedExt = array('jpg', 'jpeg', 'png');

    $photoExploded = explode('.', $newPhoto['name']);
    $photoExt = strtolower(end($photoExploded));

    if (in_array($photoExt, $photoAllowedExt)) {
        if ($newPhoto['error'] === 0) {
            if ($newPhoto['size'] <= 1000000) {
                echo('');
                exit();
            } else {
                echo('لا يمكن رفع صورة يتجاوز حجمها 1MB');
                exit();
            }
        } else {
            echo('عذراً! حدث خطاء اثناء تحميل الصورة يرجى إعادة رفعها');
            exit();
        }
    } else {
        echo('يرجى إختيار صورة من الصيغ التالية (jpg - jpeg - png)');
        exit();
    }
}

?>
