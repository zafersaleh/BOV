<?php
include_once('dbConnOps.php');
// error_reporting(0);

if (isset($_POST['volAddInfReg'])) {
	isset($_POST['volFname']) ? $volFname = mysqli_real_escape_string($conn, $_POST['volFname']) : $volFname = "";
	isset($_POST['volLname']) ? $volLname = mysqli_real_escape_string($conn, $_POST['volLname']) : $volLname = "";
	isset($_POST['volPass']) ? $volPass = mysqli_real_escape_string($conn, $_POST['volPass']) : $volPass = "";
	isset($_POST['volPassConf']) ? $volPassConf = mysqli_real_escape_string($conn, $_POST['volPassConf']) : $volPassConf = "";
	isset($_POST['volemail']) ? $volemail = mysqli_real_escape_string($conn, $_POST['volemail']) : $volemail = "";
	isset($_POST['vol_gender']) ? $vol_gender = mysqli_real_escape_string($conn, $_POST['vol_gender']) : $vol_gender = "";
	isset($_POST['vlbirthDate']) ? $vlbirthDate = mysqli_real_escape_string($conn, $_POST['vlbirthDate']) : $vlbirthDate = "";
	//
	isset($_POST['edu_qual']) ? $edu_qual = mysqli_real_escape_string($conn, $_POST['edu_qual']) : $edu_qual = "";
	isset($_POST['edu_spec']) ? $edu_spec = mysqli_real_escape_string($conn, $_POST['edu_spec']) : $edu_spec = "";
	isset($_POST['vol_talent']) ? $vol_talent = mysqli_real_escape_string($conn, $_POST['vol_talent']) : $vol_talent = "";
	isset($_POST['vlSkill']) ? $vol_skills = mysqli_real_escape_string($conn, $_POST['vlSkill']) : $vol_skills = "";
	//
	isset($_POST['langAr']) ? $langAr = mysqli_real_escape_string($conn, $_POST['langAr']) : $langAr = "";
	isset($_POST['langEn']) ? $langEn = mysqli_real_escape_string($conn, $_POST['langEn']) : $langEn = "";
	isset($_POST['LangArLvl']) ? $langArLvl = mysqli_real_escape_string($conn, $_POST['LangArLvl']) : $langArLvl = "";
	isset($_POST['LangEngLvl']) ? $langEnLvl = mysqli_real_escape_string($conn, $_POST['LangEngLvl']) : $langEnLvl = "";
	//
	isset($_POST['volLocGov']) ? $vol_LocGov = mysqli_real_escape_string($conn, $_POST['volLocGov']) : $vol_LocGov = "";
	isset($_POST['volLocArea']) ? $vol_LocArea = mysqli_real_escape_string($conn, $_POST['volLocArea']) : $vol_LocArea = "";
	isset($_POST['vol_agree']) ? $vol_agree = mysqli_real_escape_string($conn, $_POST['vol_agree']) : $vol_agree = "";

	$resCheckBegReq = checkVlRegReq($volFname, $volLname, $volPass, $volPassConf, $volemail, $vol_gender, $vlbirthDate, $edu_qual, $edu_spec, $langAr, $langEn, $langArLvl, $langEnLvl, $vol_LocGov, $vol_LocArea, $vol_talent, $vol_skills, $vol_agree);

  $resCheckBegArr = explode('(#)', $resCheckBegReq);
	if ($resCheckBegArr[16] == 'R') {
		echo($resCheckBegReq);
		exit();
	} else {
		$regVlUserName = $volFname." ".$volLname;
		$regVlGender = $vol_gender;
		$regVlPass = $volPass;

		// Volunteer languages choices
		$regVlLangs = "";
		if (!empty($langAr))
			$regVlLangs .= "العربية=".$langArLvl.'-';
		if (!empty($langEn))
			$regVlLangs .= "English=".$langEnLvl.'-';
		$regVlLangs = substr($regVlLangs, 0, strlen($regVlLangs) - 1);
		//

		$skills = '';
		for ($sklId = 0; $sklId <= count($_POST) - 1; $sklId++) {
			if (isset($_POST['vlSkill'.$sklId]))
				$skills .= mysqli_real_escape_string($conn, $_POST['vlSkill'.$sklId]).'(&)';
		}
		$skills = substr($skills, 0, strlen($skills) - 3);

		$regVlAcc = regVolunteerAccount($regVlUserName, $volemail, $vol_gender, $volPass, $vlbirthDate, $edu_qual, $edu_spec, $regVlLangs, $skills, $vol_talent, $vol_LocGov, $vol_LocArea);

        echo($regVlAcc);
        exit();
	}
}


if (isset($_POST['signAgAcc'])) {
	isset($_POST['ag_name']) ? $ag_name = $_POST['ag_name'] : $ag_name = "";
	isset($_POST['ag_email']) ? $ag_email = $_POST['ag_email'] : $ag_email = "";
	isset($_POST['ag_phone']) ? $ag_phone = $_POST['ag_phone'] : $ag_phone = "";

	isset($_POST['ag_type']) ? $ag_type = $_POST['ag_type'] : $ag_type = "";
	isset($_POST['ag_class']) ? $ag_class = $_POST['ag_class'] : $ag_class = "";
	isset($_POST['ag_spec']) ? $ag_spec = $_POST['ag_spec'] : $ag_spec = "";

	isset($_POST['ag_pass']) ? $ag_pass = $_POST['ag_pass'] : $ag_pass = "";
	isset($_POST['ag_passconf']) ? $ag_passconf = $_POST['ag_passconf'] : $ag_passconf = "";
	isset($_POST['ag_agree']) ? $ag_agree = $_POST['ag_agree'] : $ag_agree = "";

	isset($_POST['ag_app']) ? $ag_app = $_POST['ag_app'] : $ag_app = "";
	isset($_POST['ag_branches']) ? $ag_branches = $_POST['ag_branches'] : $ag_branches = "";
	isset($_POST['ag_location']) ? $ag_location = $_POST['ag_location'] : $ag_location = "";
	isset($_POST['ag_SocialMedia']) ? $ag_SocialMedia = $_POST['ag_SocialMedia'] : $ag_SocialMedia = "";

	$agCheckReqResStr = checkAgSignUpReq($ag_name, $ag_email, $ag_phone, $ag_pass, $ag_passconf, $ag_type, $ag_class, $ag_spec, $ag_agree);

    $agCheckReqResArr = explode('^$', $agCheckReqResStr);

	if ($agCheckReqResArr[9] == 'R') {
		echo($agCheckReqResStr);
        exit();
	} else {
		$regAgAccRes = regAgencyAccount($ag_name, $ag_app, $ag_email, $ag_phone, $ag_pass, $ag_type, $ag_class, $ag_spec, $ag_branches, $ag_location, $ag_SocialMedia);

        echo($regAgAccRes);
		exit();
	}
}

function checkAgSignUpReq ($agName, $agEmail, $agPhone, $agPass, $agPassConf, $agType, $agClass, $agSpec, $agAgree) {
	global $conn;
	$agChekReq = array();
    $agCheckResStr = '';

	empty($agName) ? $agChekReq['agName'] = 'يرجى إدخال إسم الجهة الخاص بك' : $agChekReq['agName'] = '';
	empty($agEmail) ? $agChekReq['agEmail'] = 'يرجى إدخال البريد الإلكتروني الخاص بجهتكم' : $agChekReq['agEmail'] = '';
	empty($agPhone) ? $agChekReq['agPhone'] = 'يرجى إدخال رقم الهاتف الخاص بجهتكم' : $agChekReq['agPhone'] = '';
	empty($agPass) ? $agChekReq['agPass'] = 'يرجى إدخال كلمة المرور' : $agChekReq['agPass'] = '';
	empty($agPassConf) ? $agChekReq['agPassConf'] = 'يرجى تأكيد كلمة المرور في الحقل الخاص بها' : $agChekReq['agPassConf'] = '';
	!($agType >= 0) ? $agChekReq['agType'] = 'يرجى تحديد نوع جهتكم' : $agChekReq['agType'] = '';
	!($agClass >= 0) && $agType == 0 ? $agChekReq['agClass'] = 'يرجى تحديد تصنيف منظمتكم' : $agChekReq['agClass'] = '';
	!($agSpec >= 0) ? $agChekReq['agSpec'] = 'يرجى تحديد مجال عمل جهتكم' : $agChekReq['agSpec'] = '';
	!empty($agAgree) && $agAgree == "on" ? $agChekReq['agAgree'] = '' : $agChekReq['agAgree'] = 'يجب الموافقة على الشروط والأحكام لتسجيل حسابكم';


	if ($agChekReq['agName'] == '') {
		$agNameWithNoSpace = str_replace(' ', '', $agName);
		if((!preg_match("/^[a-zA-Z]*$/", $agNameWithNoSpace) && !preg_match("/^[\p{Arabic}]+$/u", $agNameWithNoSpace))
		   || preg_match('/^[0-9]*$/', $agNameWithNoSpace)) {
			$agChekReq['agName'] = 'يرجى إختيار إسم صحيح لجهتكم ويحتوي على الاحرف فقط';
		} else {
            $agNameToCheck = mysqli_real_escape_string($conn, $agName);
			$checkIfAgNameExist = getSingleValue("agency", "count(ag_ID)", "ag_Name = '$agNameToCheck'", -1);
			$checkIfVlNameExist = getSingleValue("volunteer", "count(vl_ID)", "vl_UserName = '$agNameToCheck'", -1);
			$checkIfAuNameExist = getSingleValue("adminuser", "count(au_ID)", "au_UserName = '$agNameToCheck'", -1);
			if ($checkIfAgNameExist > 0 || $checkIfVlNameExist > 0 || $checkIfAuNameExist > 0)
				$agChekReq['agName'] = 'إسم الجهة هذا موجود مسبقاً. يرجى إختيار إسم آخر';

        }
	}

	if ($agChekReq['agEmail'] == '') {
		if (!filter_var($agEmail, FILTER_VALIDATE_EMAIL)) {
			$agChekReq['agEmail'] = 'يرجى إدخال بريد إلكتروني صحيح';
		} else {
            $agEmailToCheck = mysqli_real_escape_string($conn, $agEmail);
			$checkIfAgEmailExist = getSingleValue("agency", "count(ag_ID)", "ag_Email = '$agEmailToCheck'", -1);
			$checkIfVlEmailExist = getSingleValue("volunteer", "count(vl_ID)", "vl_Email = '$agEmailToCheck'", -1);
			if ($checkIfAgEmailExist > 0 || $checkIfVlEmailExist > 0)
				$agChekReq['agEmail'] = 'هذا البريد الإلكتروني موجود مسبقاً';
        }
	}

	if ($agChekReq['agPass'] == '' && strlen($agPass) < 7)
        $agChekReq['agPass'] = 'يجب ان يكون طول كلمة المرور 7 احرف اواكثر';

	if ($agChekReq['agPass'] == '' && $agChekReq['agPassConf'] == '') {
		if ($agPass != $agPassConf)
            $agChekReq['agPassConf'] = 'كلمة المرور التي ادخلتموها لا تتطابق مع تأكيد كلمة المرور. يرجى إعادة إدخالها مجدداً';
    }

    $agChekReq['agRegOrNot'] = '';
    foreach($agChekReq as $agReqCheckName) {
        if (!empty($agReqCheckName)) {
            $agChekReq['agRegOrNot'] = 'R';
            break;
        } else {
            $agChekReq['agRegOrNot'] = 'G';
        }
    }


    $agCheckResStr = $agChekReq['agName'].'^$'.$agChekReq['agEmail'].'^$'.$agChekReq['agPass'].'^$'.$agChekReq['agPassConf'].'^$'.$agChekReq['agType'].'^$'.$agChekReq['agClass'].'^$'.$agChekReq['agSpec'].'^$'.$agChekReq['agPhone'].'^$'.$agChekReq['agAgree'].'^$'.$agChekReq['agRegOrNot'];

	return($agCheckResStr);
}

function regAgencyAccount($agAccName, $agAccApprev, $agAccEmail, $agAccPhone, $agAccPass, $agAccType, $agAccClass, $agAccSpec, $agAccBranch, $agAccLoc, $agAccSocLinks) {
	global $conn;

	if ($agAccType != 0)
		$agAccClass = -1;

	$agAccName = mysqli_real_escape_string($conn, $agAccName);
	$agAccApprev = mysqli_real_escape_string($conn, $agAccApprev);
	$agAccEmail = mysqli_real_escape_string($conn, $agAccEmail);
	$agAccPass = mysqli_real_escape_string($conn, $agAccPass);

	$agAccType = mysqli_real_escape_string($conn, $agAccType);
	$agAccClass = mysqli_real_escape_string($conn, $agAccClass);
	$agAccSpec = mysqli_real_escape_string($conn, $agAccSpec);

	$agAccPhone = mysqli_real_escape_string($conn, $agAccPhone);
	$agAccBranch = mysqli_real_escape_string($conn, $agAccBranch);
	$agAccLoc = mysqli_real_escape_string($conn, $agAccLoc);
	$agAccSocLinks = mysqli_real_escape_string($conn, $agAccSocLinks);

	// Hashing the password
	$hashedAgPwd = password_hash($agAccPass, PASSWORD_DEFAULT);

	$agAccID = getSingleValue("agency", "MAX(ag_ID) + 1", "", 1);
	if (is_null($agAccID)) $agAccID = 1;

	$agCreateAccSql = "INSERT INTO agency(ag_ID, ag_Name, ag_Appreviation, ag_Password, ag_photo, ag_AccCreatedIn, ag_Type, ag_Class, ag_Specialty, ag_PhoneNumber, ag_Email, ag_Branch, ag_Address, ag_SocialLinks, ag_AccActive, ag_CanAddChance)
	VALUES ($agAccID, '$agAccName', '$agAccApprev', '$hashedAgPwd', 'agencyDefault.jpg', DATE(NOW()), $agAccType, $agAccClass, $agAccSpec, $agAccPhone, '$agAccEmail', '$agAccBranch', '$agAccLoc', '$agAccSocLinks', 1, 0)";

	try {
		mysqli_autocommit($conn, false);
		$agCreateAccQry = mysqli_query($conn, $agCreateAccSql);

		if (!$agCreateAccQry) {
			throw new Exception('agRegError');
		} else {
			mysqli_commit($conn);
			$agRegState = "agRegSuccess";
		}
	} catch (Exception $agCreateAccErr) {
		mysqli_rollback($conn);
		$agRegState = "agRegError";
	} finally {
		//echo($agCreateAccSql);
		mysqli_autocommit($conn, true);
		return($agRegState);
	}

}

function checkVlRegReq($vlFName, $vlLName, $vlPass, $vlPassConf, $vlEmail, $vlGender, $vlBirthDate, $vlQual, $vlSpec, $vlArrLang, $vlEngLang, $vlArrLangLvl, $vlEngLangLvl, $vlLocationGov, $vlLocationArea, $vlTalent, $vlSkills, $vlCheckedTerms) {

	global $conn;
	global $getSingleValue;

	$reqCheck = array();
    $reqCheckStr = '';

	empty($vlFName) ? $reqCheck['vlFname'] = 'يرجى إدخال إسمك الاول' : $reqCheck['vlFname'] = '';
	empty($vlLName) ? $reqCheck['vlLname'] = 'يرجى إدخال اسمك الاخير' : $reqCheck['vlLname'] = '';
	empty($vlPass) ? $reqCheck['vlPass'] = 'يرجى إدخال كلمة المرور' : $reqCheck['vlPass'] = '';
	empty($vlPassConf) ? $reqCheck['vlPassCnf'] = 'يرجى إعادة كتابة كلمة المرور للتأكيد' : $reqCheck['vlPassCnf'] = '';
	empty($vlEmail) ? $reqCheck['vlEmail'] = 'يرجى إدخال البريد الإلكتروني الخاص بك' : $reqCheck['vlEmail'] = '';
	empty($vlSkills) ? $reqCheck['vlSkills'] = 'يرجى إدخال المهارة' : $reqCheck['vlSkills'] = '';
	!($vlGender >= 0) ? $reqCheck['vlGen'] = 'يرجى تحديد الجنس الخاص بك' : $reqCheck['vlGen'] = '';

	empty($vlBirthDate) ? $reqCheck['vlBirth'] = 'يرجى تحديد تاريخ ميلادك' : $reqCheck['vlBirth'] = '';
	!($vlQual >= 0) ? $reqCheck['vlQual'] = 'يرجى تحديد مستواك التعليمي' : $reqCheck['vlQual'] = '';
	!($vlSpec >= 0) && $vlQual != 0 ? $reqCheck['vlSpec'] = 'يرجى تحديد تخصصك' : $reqCheck['vlSpec'] = '';

	!($vlTalent >= 0) ? $reqCheck['vlTalent'] = 'يرجى تحديد موهبتك' : $reqCheck['vlTalent'] = '';
	empty($vlCheckedTerms) ?
        $reqCheck['vlCheckTerms'] = 'يرجى إختيار موافقتك على الشروط لإكمال تسجيل حسابك' : $reqCheck['vlCheckTerms'] = '';

	if (isset($reqCheck['vlPass']) && $reqCheck['vlPass'] == '') {
		strlen($vlPass) >= 7 ?
            $reqCheck['vlPass'] = '' : $reqCheck['vlPass'] = 'يجب ان يكون طول كلمة المرورو 7 حروف او اكبر';
	}

	if ($reqCheck['vlPass'] == '' && $reqCheck['vlPassCnf'] == '') {
		$vlPass != $vlPassConf ?
            $reqCheck['vlPassCnf'] = 'كلمة المرور التي ادخلتها لا تتوافق مع كلمةالمرور في مربع التأكيد!' : $reqCheck['vlPassCnf'] = '';
	}

	if ($reqCheck['vlFname'] == '' && $reqCheck['vlLname'] == '') {
		$userNameToCheck = mysqli_real_escape_string($conn, $vlFName.$vlLName);
		if((!preg_match("/^[a-zA-Z]*$/", $userNameToCheck) && !preg_match("/^[\p{Arabic}]+$/u", $userNameToCheck))
		   || preg_match('/^[0-9]*$/', $userNameToCheck)) {
			$reqCheck['vlLname'] = 'يرجى إدخال إسم مستخدم صحيح ويحتوي على الاحرف فقط';
		}
	}

	if ($reqCheck['vlEmail'] == '') {
        $vlEmailToCheck = mysqli_real_escape_string($conn, $vlEmail);
		if(!filter_var($vlEmail, FILTER_VALIDATE_EMAIL)) {
            $reqCheck['vlEmail'] = 'يرجى إدخال عنوان بريد إلكتروني صحيح';
        } else {
            $reqCheck['vlEmail'] = '';
            $doesVlEmailExist = getSingleValue("volunteer", "count(vl_Email)", "vl_Email = '$vlEmailToCheck'", -1);
						$doesAgEmailExist = getSingleValue("agency", "count(ag_Email)", "ag_Email = '$vlEmailToCheck'", -1);
            if ($doesVlEmailExist > 0 || $doesAgEmailExist > 0)
						$reqCheck['vlEmail'] = 'هذا البريد الإلكتروني موجود مسبقاً';
        }
	}

	if (empty($vlArrLang) && empty($vlEngLang)) {
		$reqCheck['vlEngLang'] = 'يرجى تحديد احد اللغات المطلوبة (العربية / الإنجليزية) او كلاهما';
		$reqCheck['vlArLang'] = '';
	} else {
		if (!empty($vlArrLang) && empty($vlArrLangLvl)) {
			$reqCheck['vlArLang'] = 'يرجى تحديد مستوى إتقانك للغة العربية';
		} else {
			$reqCheck['vlArLang'] = '';
		}

		if (!empty($vlEngLang) && empty($vlEngLangLvl))
			$reqCheck['vlEngLang'] = 'يرجى تحديد مستوى إتقانك للغة الإنجليزية';
		else
			$reqCheck['vlEngLang'] = '';

	}
	//
	!($vlLocationGov >= 0) ? $reqCheck['vlGov'] = 'برجى تحديد محافظتك' : $reqCheck['vlGov'] = '';
	!($vlLocationArea >= 0) ? $reqCheck['vlLoc'] = 'يرجى تحديد مديريتك' : $reqCheck['vlLoc'] = '';
	//
	$reqCheck['regVlOrNot'] = '';
	foreach ($reqCheck as $reqCheckName) {
	  if (!empty($reqCheckName)) {
	      $reqCheck['regVlOrNot'] = 'R';
	      break;
	  } else {
	      $reqCheck['regVlOrNot'] = 'G';
	  }
  }
	//
  $reqCheckStr = $reqCheck['vlFname'].'(#)'.$reqCheck['vlLname'].'(#)'.$reqCheck['vlPass'].'(#)'.$reqCheck['vlPassCnf'].'(#)'.$reqCheck['vlEmail'].'(#)'.$reqCheck['vlGen'].'(#)'.$reqCheck['vlBirth'].'(#)'.$reqCheck['vlQual'].'(#)'.$reqCheck['vlSpec'].'(#)'.$reqCheck['vlTalent'].'(#)'.$reqCheck['vlArLang'].'(#)'.$reqCheck['vlEngLang'].'(#)'.$reqCheck['vlGov'].'(#)'.$reqCheck['vlLoc'].'(#)'.$reqCheck['vlSkills'].'(#)'.$reqCheck['vlCheckTerms'].'(#)'.$reqCheck['regVlOrNot'];

	return($reqCheckStr);
}


function regVolunteerAccount($vlUser, $vlEmail, $vlGen, $vlPwd, $vlDoB, $vlQual, $vlSpec, $vlLangs, $vlSkill, $vlTalent, $vlLocGov, $vlLocArea) {
	global $conn, $ourEmail;

	$vlUser = mysqli_real_escape_string($conn, $vlUser);
	$vlEmail = mysqli_real_escape_string($conn, $vlEmail);
	$vlGen = mysqli_real_escape_string($conn, $vlGen);
	$vlPwd = mysqli_real_escape_string($conn, $vlPwd);
	$vlDoB = mysqli_real_escape_string($conn, $vlDoB);
	$vlQual = mysqli_real_escape_string($conn, $vlQual);
	$vlSpec = mysqli_real_escape_string($conn, $vlSpec);
	$vlLangs = mysqli_real_escape_string($conn, $vlLangs);
	$vlSkill = mysqli_real_escape_string($conn, $vlSkill);
	$vlTalent = mysqli_real_escape_string($conn, $vlTalent);
	$vlLocGov = mysqli_real_escape_string($conn, $vlLocGov);
	$vlLocArea = mysqli_real_escape_string($conn, $vlLocArea);

	$vlID = getSingleValue("volunteer", "MAX(vl_ID) + 1", "", 1);
	if (is_null($vlID)) $vlID = 1;

	// Hashing the password
	$hashedVlPwd = password_hash($vlPwd, PASSWORD_DEFAULT);

	if ($vlQual == 0)
		$vlSpec = -1;

	if ($vlGen == 0)
		$vlPPh = "MaleDefaultPic.jpg";
	else if ($vlGen == 1)
		$vlPPh = "FemaleDefaultPic.jpg";
	else if ($vlGen == 2)
		$vlPPh = "OtherDefaultPic.jpg";


	$regVolAccSql =
		"INSERT INTO volunteer (vl_ID, vl_UserName, vl_Password, vl_Photo, vl_AccCreatedIn, vl_Email, vl_Gender,
		vl_BirthDate, vl_Qualification, vl_Specialty, vl_Language, vl_Talent, vl_Skill, vl_locationGov, vl_LocationArea, vl_AccActive)
		VALUES($vlID, '$vlUser', '$hashedVlPwd', '$vlPPh', DATE(NOW()), '$vlEmail', $vlGen,
		'$vlDoB', $vlQual, $vlSpec, '$vlLangs', $vlTalent, '$vlSkill', $vlLocGov, $vlLocArea, 0);";

	try {
		mysqli_autocommit($conn, false);
		$regVolAccQry = mysqli_query($conn, $regVolAccSql);

		if (!$regVolAccQry) {
			throw new Exception('vlRegError');
		} else {
			$volConfEmailTitle = 'تاكيد تسجيل حسابك في بنك المتطوعين';
			$volConfEmailSub = "From: ".$ourEmail;
			$volConfEmailCont = 'شكراً لتسجيلك ببنك المتطوعين. يرجى النقر على الرابط لتأكيد حسابك'.'\n';
			$volConfEmailCont .= ' ومن ثم يمكنك تصفح كافة الفرص المتاحة للتطوع. رابط التفعيل: '.'\n\n';
			$volConfEmailCont .= "http://$_SERVER[HTTP_HOST]/index.php?vrfAcc=".password_hash($vlEmail, PASSWORD_DEFAULT)."&vrfStmp=".password_hash(getRealTimeDate(), PASSWORD_DEFAULT);

			$mailPassRes = sendBoVMail($vlEmail, $volConfEmailTitle, $volConfEmailCont, $volConfEmailSub);

			if (!$mailPassRes)
				throw new Exception('vlRegError');

			mysqli_commit($conn);
			$vlRegState = "vlRegSuccess";
		}
	} catch(Exception $regVolAccErr) {
		mysqli_rollback($conn);
		$vlRegState = "vlRegError";
	} finally {
		//echo($regVolAccSql);
		mysqli_autocommit($conn, true);
		return($vlRegState);
	}
}

?>
