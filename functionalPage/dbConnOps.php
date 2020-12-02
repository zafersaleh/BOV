<?php
session_start();
/*
use PHPMailer\PHPMailer\PHPMailer;

require_once('BoVMailOps/src/PHPMailer.php');
require_once('BoVMailOps/src/SMTP.php');
require_once('BoVMailOps/src/Exception.php');
*/

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "bankgojz_bov_site";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
	echo('Not Connected');
	exit();
} else {
	mysqli_set_charset($conn, "utf8");
}
if(isset($_SESSION["userID"]))  
{ 
    if(time()-$_SESSION["login_time_stamp"] >7200)   
    { 
        session_start();
	session_unset();
	session_destroy();
	//
	unset($_SESSION['userType']);
	unset($_SESSION['userID']);
	//
	header("Location: ../index.php");
    } 
} 
else
{ 
    
}
if (isset($_SESSION['userType']) && isset($_SESSION['userID'])) {
	$userType = $_SESSION['userType'];
	$userID = $_SESSION['userID'];
}

// all combo boxes arraays values

$volGender = array('ذكر','انثى');
$volEduQualification = array('ثانويةعامة', 'دبلوم', 'بكالوريوس', 'ماجستير', 'دكتوراة');
$volEduSpecialty = array('هندسة', 'إدارة', 'محاسبة', 'حاسوب', 'طب', 'إعلام', 'لغات', 'تربية');
$volTalents = array('الغناء', 'التصوير', 'التصميم', 'العزف', 'الرسم', 'الكتابة الإبداعية', 'متعدد المواهب');

$agencyType = array('منظمة غير ربحية', 'شركة تجارية', 'قطاع حكومي');
$agencyClass = array('منظمة دولية', 'منظمة محلية', 'مؤسسة', 'جمعية محلية', 'مبادرة', 'اخرى');
$agencySpecialty = array('تنموي', 'صحي', 'خيري', 'إغاثي', 'إستيراد وتصدير', 'مبيعات', 'نقل', 'لوجستيك', 'تأمين', 'خدمات مصرفية', 'الشؤون الإجتماعية والعمل', 'الصحة والسكان', 'المياة والبيئة', 'التجارة والصناعة والتعاون الدولي', 'الزراعة والري', 'اخرى');

$chanceType = array('ميداني', 'مكتبي', 'إداري', 'تعليمي', 'توعوي', 'أخرى');
$chanceWorkField =
	array('الترجمة', 'الكتابة والتحرير', 'الفنون والثقافات', 'تقنية المعلومات', 'الإعلام', 'تنسيق البرامج والمشاريع', 'الإدارة', 'الرياضة');

$chSpecTranslation = array('المستندات الخاصة بالمؤسسات', 'ترجمة محتويات المواقع لاي لغة اخرى مطلوبة', 'ترجمة الدراسات والمقالات', 'ترجمة المتطلبات والدورات (On Line) الجامعية', 'ترجمات أخرى');
$chSpecWriting = array('كتابة التقارير', 'كتابة مقترحات المشاريع', 'القيام بعملية البحث اللازمة للمشاريع', 'الكتابةالفنيةالمختلفة', 'أخرى');
$chSpecArt = array('الرسم', 'الموسيقى', 'مواهب فنية', 'أخرى');
$chSpecIT = array('هندسة الإتصالات', 'صيانة الكمبيوتر', 'هندسة برمجيات', 'هندسة شبكات', 'أخرى');
$chSpecMedia = array('إدارة مواقع التواصل الاجتماعي', 'تقديم الفعاليات والإحتفاليات', 'التصوير', 'المونتاج', 'الإخراج', 'تصميم المواقع الإلكترونية', 'تصميم الرسوم البيانية infographic', 'فوتوشوب', 'Graphics');
$chSpecProjs = array('تنسيق الفعاليات والإحتفالات', 'التنسيق الميداني', 'الحقوق والحريات', 'المناصرة وكسب التأييد', 'حل النزاع', 'التطوع', 'التعليم', 'المأوى', 'الطوارئ', 'المياه والإصحاح البيئي', 'المن الغذائي وتحسين سبل المعيشة', 'الصحة', 'التغذية', 'حماية الطفل', 'حماية المرأة', 'بناء السلام', 'الحوكمة الرشيدة', 'التعليم', 'التكنولوجيا وريادة الاعمال', 'الثقافة والتراث والفن', 'الإعلام والصحافة', 'التغير المناخي', 'حماية', 'التمويل الاصغر', 'البيئة', 'بناء قدرات المنظمات', 'الزراعة', 'بحث', 'القضاء على الفقر');
$chSpecMang = array('إدارة البرامج والمشاريع', 'إدارة الخدمات', 'الإدارة المالية', 'إدارة الموارد البشرية', 'إدارة التطوع', 'الشؤون الإدارية', 'التقييم والمتابعة');
$chSpecSport = array('كرة القدم', 'كرة السلة', 'كرة الطائرة', 'التايكواندو', 'الكاراتيه', 'الجمباز', 'قتال الشوارع', 'مختلف الرياضات لكافة الاعمار');

$chanceWorkSpecialty =
	array($chSpecTranslation, $chSpecWriting, $chSpecArt, $chSpecIT, $chSpecMedia, $chSpecProjs, $chSpecMang, $chSpecSport);

$chanceLocation = array('الأمانة', 'صنعاء', 'عدن', 'تعز', 'لحج', 'الضالع', 'أبين', 'الحديدة', 'ريمة', 'إب', 'حضرموت', 'المهرة', 'سقطرة', 'شبوة', 'ذمار', 'مأرب', 'الجوف', 'البيضاء', 'حجة', 'عمران', 'المحويت', 'صعدة');
$chanceLocGovAmana = array('معين', 'السبعين','الثورة');
$chanceLocGovSanaa = array('خولان', 'رهم','حزيز');
$chanceLocGovAden = array('خور مكسر', 'المعلا', 'الكورنيش', 'الساحل');
$chanceLocGovTaiz = array('الجمهوري', 'سوق الصميل','الجحملية','باب المندب','صالة');
$chanceLocGovTLahj = array('الحد', 'الحوطة ','المفلحي',' الملاح','يافع');
$chanceLocGovDalaa = array('دمت', 'قعطبة ','الضالع',' الحصن','الشعيب');
$chanceLocGovAbian = array('المحفد', 'مودية ','جيشان',' لودر','سباح');
$chanceLocGovHoaida = array('باجل', 'برع ','المراوعه',' الكدن','المينا');
$chanceLocGovRaima = array('الجبين', 'الجعفرية ','السفلية',' كسمة','مزهر');
$chanceLocGovIb = array('اب', 'بعدان ','جبلة',' حبيش','الشعر');
$chanceLocGovHadhramot = array('تريم', 'المكلا ','ثمود',' شبام','الشحر');
$chanceLocGovMahra = array('شحن', 'الغيضة ','حات',' المسيلة','منعر');
$chanceLocGovSuqatra = array('حديبو', 'قلميصوة ');
$chanceLocGovShabua = array('بيحان', 'الروضة ','نصاب',' عين','عسيلان');
$chanceLocGovThamar = array('الحدا', 'عنس ','عتمة',' المنار','ذمار');
$chanceLocGovMarib = array('مارب', 'الجوبة ','صرواح',' العبيدة','حريب');
$chanceLocGovJov = array('الحزم', 'المطمة ','الحميديات',' الغيل','المصلوب');
$chanceLocGovBidha = array('رداع', 'ردمان ','الرياشية',' البيضاء','مكيراس');
$chanceLocGovAmran = array('حرث سفيان', 'حوث ','خمر',' ريدة','شهارة');
$chanceLocGovHaja = array(' حجة', 'اسلم ','حرض',' افلح الشام','ميدي');
$chanceLocGovMahwit = array(' بني سعد', 'حفاش ','ملحان','  المحويت','الخبت');
$chanceLocGovSada = array('  صعدة', 'باقم ','منبة','  ساقين','رازح');
$chanceLocGovsAreas = array($chanceLocGovAmana, $chanceLocGovSanaa, $chanceLocGovAden,$chanceLocGovTaiz,$chanceLocGovTLahj,$chanceLocGovDalaa,$chanceLocGovAbian,$chanceLocGovHoaida,$chanceLocGovRaima,$chanceLocGovIb,$chanceLocGovHadhramot,$chanceLocGovMahra,$chanceLocGovSuqatra,$chanceLocGovShabua,$chanceLocGovThamar,$chanceLocGovMarib,$chanceLocGovJov,$chanceLocGovBidha,$chanceLocGovHaja,$chanceLocGovAmran,$chanceLocGovMahwit,$chanceLocGovSada);
$isChnPaid = array('لا يوجد', 'يوجد');


$adminAuthsStr = "stopAgAcc,activeAgAcc,editAgAcc,stopAgPostChance,activeAgPostChance,stopChnApp,activeChnApp,stopVlAcc,activeVlAcc,editVlAcc,stopAdminAcc,activeAdminAcc,addAdminAcc,editAdminAcc,addPosts,editPosts,stopPost,activePost,editOtherUserPost,addBankInf,editBankInf,stopBankInf,activeBankInf,superUser";
$adminAuthsStrArabic = "إيقاف حساب الحهة,تفعيل حساب الجهة,تعديل حساب الجهة,إيقاف نشر الفرص للجهة,تفعيل نشر الفرص للجهة,إيقاف التقديم للفرص,تفعيل التقديم للفرص,إيقاف حساب المتطوع,تفعيل حساب المتطوع,تعديل حساب المتطوع,إيقاف حساب إداري,تفعيل حساب إداري,إضافة حساب إداري,تعديل حساب إداري,إضافة منشورات البنك,تعديل منشورات البنك,إيقاف منشورات البنك,تفعيل منشورات البنك,تعديل منشورات البنك لمستخدمين آخرين,إضافة معلومات البنك,تعديل معلومات البنك,إيقاف معلومات البنك,تفعيل معلومات البنك,مستخدم إداري بكامل الصلاحيات";
$adminAuthsArr = explode(',', $adminAuthsStr);
$adminAuthsStrArabicArr = explode(',', $adminAuthsStrArabic);

$adminInfoType = array('عن البنك', 'رؤيتنا', 'رسالتنا', 'أهدافنا', 'قيمنا', 'مجلس الأمناء', 'المجلس الاعلى', 'الهيئة التنفيذية', 'الهيكل التنظيمي', 'شركاؤنا');

$ourEmail = 'abdo.gah95@gmail.com';


function showSearchRes($search_Txt) {
	global $userType, $userID;

	if (!empty($search_Txt)) {
		switch($userType) {
			case 'vl_uid':
				showAgency('all', '', " AND ag_Name LIKE '%$search_Txt%'");
				echo(showChance(-1, -1, " AND ch_Title LIKE '%$search_Txt%'"));
				break;

			case 'ag_uid':
				echo(showChance($userID, 0, " AND ch_Title LIKE '%$search_Txt%'"));
				break;
			case 'au_uid':
				showAgency('all', '', " AND ag_Name LIKE '%$search_Txt%'");
				echo(showChance(-1, 0, " AND ch_Title LIKE '%$search_Txt%'"));
				showVolunteer('', " vl_UserName LIKE '%$search_Txt%'");
				break;
		}
	}
}

function sendBoVMail($email_To, $email_Subj, $email_Cont, $email_Header) {
	/*$bov_sendEmail = new PHPMailer();

	// SMTP Settings;
	$bov_sendEmail->isSMTP();
	$bov_sendEmail->Host = 'smtp.gmail.com';
	$bov_sendEmail->SMTPAuth = true;
	$bov_sendEmail->Username = 'abdo.gah95@gmail.com';
	$bov_sendEmail->Password = 'SOS_5Heart7Smiley'; // 'sos5Heart7Smiley';
	$bov_sendEmail->Port = 465; // 587
	$bov_sendEmail->SMTPSecure = 'ssl'; // tls

	// Email Settings
	$bov_sendEmail->isHTML(true);
	$bov_sendEmail->setFrom($email_From);
	$bov_sendEmail->addAddress($email_To);
	$bov_sendEmail->Subject = $email_Subj;
	$bov_sendEmail->Body = $email_Cont;

	$bov_MailRes = $bov_sendEmail->send();*/
	/*$bov_MailRes = mail($email_To, $email_Subj, $email_Cont, $email_Header);
	return($bov_MailRes);*/
	return(true);
}

function getSingleValue($table = "", $wantedField = "", $condition = "", $valueAsNoResult = 0) {
	global $conn;

	if (!empty($condition))
		$condition = " WHERE ".$condition;

	$searchSql = "SELECT $wantedField FROM $table ".$condition;
	$searchQry = mysqli_query($conn, $searchSql);

    if ($searchResNum = mysqli_num_rows($searchQry) > 0) {
		$searchRes = mysqli_fetch_assoc($searchQry);
		return($searchRes[$wantedField]);
	} else
		return($valueAsNoResult);
}

function getRealTimeDate() {
	global $conn;

	$realTimeDateQry = mysqli_query($conn, "SELECT DATE(NOW()) AS realTimeDate");
	if ($realTimeDateNum = mysqli_num_rows($realTimeDateQry) > 0) {
		$realTimeDate = mysqli_fetch_assoc($realTimeDateQry);
		return($realTimeDate['realTimeDate']);
	} else
		return('01-01-1990');
}

function checkUserPrivelage ($userID = -1, $Prev) {
	if ($userID == -1 )
		exit();
		$wantedPrevValue=array();//ADedit
	$userPrevStr = getSingleValue("adminuser", "au_Authentication", "au_ID = ".$userID, 0);
	// echo($userPrevStr);
	$userPrev = explode(",", $userPrevStr);
	// print_r($userPrev);
	$prevOne= '';
	$prevZero = '';
	for ($prevIndex = 0; $prevIndex <= count($userPrev) - 1; $prevIndex++) {
		$prevOne= $Prev."=1";
		$prevZero = $Prev."=0";
		$fullAdminPrev = "superUser=1";
		if ($userPrev[$prevIndex] == $prevOne || $userPrev[$prevIndex] == $prevZero) {
			// echo($userPrev[$prevIndex]);
			$wantedPrev = explode("=", $userPrev[$prevIndex]);
			$wantedPrevValue = end($wantedPrev);
			// break;
		}
	}
	return($wantedPrevValue);
}

function adminBtns($fieldValue = 1, $wantedPage = "", $wantedBtn = "", $buttonLabel = "", $ID = 0, $pos = "one") {
    global $userType, $userID;
    $authToCheck = '';

	if ($wantedBtn == "" || $wantedPage == ""){
		return($userButtons = "");
		exit();
	}

    switch($fieldValue) {
        case 0:
            $enOrDis = "enable";
            $btnLabel = "تفعيل ";
            if ($wantedPage == 'Agency') {
                if ($wantedBtn == 'Account')
                    $authToCheck = 'activeAgAcc';
                elseif ($wantedBtn == 'AddChance')
                    $authToCheck = 'activeAgPostChance';
            } elseif ($wantedPage == 'Chance') {
                if ($wantedBtn == 'Apply')
                    $authToCheck = 'activeChnApp';
            } elseif ($wantedPage == 'Volunteer') {
                if ($wantedBtn == 'Account')
                    $authToCheck = 'activeVlAcc';
            } elseif ($wantedPage == 'Post') {
                if ($wantedBtn == 'Act')
                    $authToCheck = 'activePost';
            } elseif ($wantedPage == 'Info') {
                if ($wantedBtn == 'Act')
                    $authToCheck = 'activeBankInf';
            }

            break;
        case 1:
            $enOrDis = "disable";
            $btnLabel = "تعطيل ";

            if ($wantedPage == 'Agency') {
                if ($wantedBtn == 'Account')
                    $authToCheck = 'stopAgAcc';
                elseif ($wantedBtn == 'AddChance')
                    $authToCheck = 'stopAgPostChance';
            } elseif ($wantedPage == 'Chance') {
                if ($wantedBtn == 'Apply')
                    $authToCheck = 'stopChnApp';
            } elseif ($wantedPage == 'Volunteer') {
                if ($wantedBtn == 'Account')
                    $authToCheck = 'stopVlAcc';
            } elseif ($wantedPage == 'Post') {
                if ($wantedBtn == 'Act')
                    $authToCheck = 'stopPost';
            } elseif ($wantedPage == 'Info') {
                if ($wantedBtn == 'Act')
                    $authToCheck = 'stopBankInf';
            }

            break;
        default:
            $enOrDis = "";
            $btnLabel = "";
            break;
    }

    if ($userType == 'au_uid' && checkUserPrivelage($userID, $authToCheck) != 1)
        return($userButtons = "");

    $btnStyle = $enOrDis.$wantedPage.$wantedBtn.'Btn';

	$userButtons = "";
	if($pos == "beg" || $pos == "one") {
		if ($userType == "au_uid") {
			$userButtons = "<form id='admin".$wantedPage."Form' action = 'functionalPage/adminPrivilege.php' method = 'POST'>";
		} elseif ($userType == "ag_uid") {
			$userButtons = "<form  id='admin".$wantedPage."Form' action = 'functionalPage/agencyPrivilege.php' method = 'POST'>";
		}
	}

	$userButtons .= "<button type='submit' id='".$btnStyle."' name='".$enOrDis.$wantedPage.$wantedBtn."Btn' value='".$ID."'>"
		.$btnLabel.$buttonLabel."</button>";
	$pos == "end" || $pos == "one" ? $userButtons .= "</form>" : $userButtons = $userButtons;

	return($userButtons);
}

function addComboValues($arr, $event = "", $allChoiceVal = "", $defaultValue = "", $selectName = "") {
	$allSelectTag = '';
	$allSelectTag = "<select style='filterCmboSelect' name='".$selectName."'".$event."id='".$selectName."'>";

	if ($allChoiceVal != "")
		$allSelectTag .= "<option class='cmboOptVal' value='-1' selected='selected'>".$allChoiceVal."</option>";

	for ($index = 0; $index <= count($arr) - 1 ; $index++) {
		if ($defaultValue == $index || $defaultValue === $arr[$index])
			$setOptinDef = "selected='selected'";
		else
			$setOptinDef = "";
		$allSelectTag .= "<option class='cmboOptVal' value = '".$index."'".$setOptinDef.">".$arr[$index]."</option>";
	}
	$allSelectTag .= "</select>";
	return($allSelectTag);
}
// raghed bagin
function showAdminUser($auUserID = -1) {
	global $conn, $userID;
    $moreConditions = '';
    $editAdminAccBtn = '';

    if ($auUserID > 0)
        $moreConditions = ' AND au_ID = '.$auUserID;

	$showAdminsSql = "SELECT au_ID, au_UserName, au_AccCreatedIn, au_AccActive FROM adminuser WHERE (1=1)".$moreConditions.";";
	// echo($showAdminsSql);
	$showAdminsQry = mysqli_query($conn, $showAdminsSql);
	if (!$showAdminsQry) {
		echo('There are no admin Accounts');
	} else {
		if ($numOfAdmins = mysqli_num_rows($showAdminsQry) > 0) {
			while ($adminsInfo = mysqli_fetch_assoc($showAdminsQry)) {
                if (checkUserPrivelage($userID, 'editAdminAcc') == 1)
                    $editAdminAccBtn = '<button type="button" id="vol_submit_edit" onClick="showAdminUserMdl('.$adminsInfo['au_ID'].')">نعديل بيانات الحساب</button>';

                echo('<div id="profile">
                <div id="agy_div_admin">
                <h id="agy_name11">'.$adminsInfo['au_UserName'].'</h>
                <h id="agy_kind2">'.$adminsInfo['au_AccCreatedIn'].'</h><br>'.
                adminAuthsShow($adminsInfo['au_ID'], 'S').$editAdminAccBtn.'</div></div>');
            }
		} else {
            echo('<h3>لا يوجد اي حسابات لعرضها</h3>');
        }
    }
}
// raghed end

function adminAuthsShow($auID, $showType) {
    global $adminAuthsArr, $adminAuthsStrArabicArr;
    $auAuthStr = getSingleValue('adminuser', 'au_Authentication', 'au_ID = '.$auID, 'none');

    if ($auAuthStr == 'none' || empty($auAuthStr))
        exit();

    $allAuthsTaged = '';
    //$auAuthArr = explode(',', $auAuthStr);*/


    // foreach($adminAuthsArr as $adminAuthsName) {
	for ($I = 0; $I < count($adminAuthsArr); $I++) {
		$adminAuthsName = $adminAuthsArr[$I];
		$adminAuthsText = $adminAuthsStrArabicArr[$I];
        $auAuthVal = checkUserPrivelage($auID, $adminAuthsName);
		// $auAuthVal = checkUserPrivelage($auID, $adminAuthsArr[$I]);
        switch($auAuthVal) {
            case 0:
                if ($showType == 'S')
                    $allAuthsTaged .= '<label style="color:Red">'.$adminAuthsText.'</label><br>';
                elseif ($showType == 'C')
                    $allAuthsTaged .= '<input type="checkbox" name="'.$adminAuthsName.'"><label>'.$adminAuthsText.'</label><br>';
                break;
            case 1:
                if ($showType == 'S')
                    $allAuthsTaged .= '<label style="color:Green;">'.$adminAuthsText.'</label><br>';
                elseif ($showType == 'C')
                    $allAuthsTaged .= '<input type="checkbox" name="'.$adminAuthsName.'" checked="checked"><label>'.$adminAuthsText.'</label><br>';
                break;
        }
    }

    return $allAuthsTaged;
}

function showPosts() {
    global $conn, $userID, $userType;
    $postTags = '';
		$postDate = '';
    $postEditBtn = '';
    $postEditorName = '';
    $postEditingTag = '';
    $postWriterName = '';

    $postFilter = '';
    if ($userType != 'au_uid')
        $postFilter = " AND po_Active = 1";

    $showPostSql = "SELECT * FROM adminpost WHERE (1=1)".$postFilter." ORDER BY po_Date DESC";
    $showPostQry = mysqli_query($conn, $showPostSql);

    if ($showPostQry && $numOfPost = mysqli_num_rows($showPostQry) > 0) {
        while ($postInfo = mysqli_fetch_assoc($showPostQry)) {
						$adminMangTollsTag = '';
						
            if ($userType == 'au_uid') {
				
                if (($userID == $postInfo['po_WritingUserID'] && checkUserPrivelage($userID, 'editPosts') == 1) || checkUserPrivelage($userID, 'editOtherUserPost') == 1) {
					$postEditBtn = "<form id='adminPostForm' action = 'functionalPage/adminPrivilege.php' method = 'POST'>";
                    $postEditBtn .= '<button type="button" id="showPostMdlBtn" name="showPostMdlBtn" onclick="showPostMdl('.$postInfo['po_ID'].')">تعديل المنشور</button>'.
                    adminBtns($postInfo['po_Active'], "Post", "Act", "المنشور", $postInfo['po_ID'], "end");
                } else {
                    $postEditBtn = '';
                }

                $postWriterName = '<h5>كتب بواسطة:</h5><p>'.
                getSingleValue('adminuser', 'au_UserName', 'au_ID = '.$postInfo['po_WritingUserID'], '').'</p>';

                if (!is_null($postInfo['po_EditingUserID'])) {
                    $postEditorName = getSingleValue('adminuser', 'au_UserName', 'au_ID = '.$postInfo['po_EditingUserID'], '');
                    $postEditingTag = '<h5>آخر مستخدم قام بالتعديل:</h5><p>'.$postEditorName.'</p>';
                } else {
                    $postEditorName = '';
                    $postEditingTag = '';
                }

				$postDate = '<h5>تاريخ النشر:</h5><p>'.$postInfo['po_Date'].'</p>';

				if (!empty($postEditBtn) || !empty($postDate) || !empty($postWriterName) || !empty($postEditingTag)) {
					$adminMangTollsTag =
					'<section class="adminMangTools">
						<div class="adminNeededInfo">'
							.$postDate.$postWriterName.$postEditingTag.
						'</div>'
						.$postEditBtn.
					'</section>';

				}
            }

            $postTags .=
                '<div class="containerBox" id="post">'.
                    '<article>
						<h1>'.$postInfo['po_Title'].'</h1>
                    	<p>'.$postInfo['po_Content'].'</p>
					</article>'.
					$adminMangTollsTag.
				'</div>';
        }
    }

    return($postTags);
}

function showBankInfo($infClass) {
    global $conn, $userID, $userType, $adminInfoType;

    $divID = '';
    $ulBeg = '';
    $liBeg = '';
    $hBeg = '';
    $hEnd = '';
    $liEnd = '';
    $ulEnd = '';

    $mangDivBeg = '';
    $mangDivEnd = '';

    $infH = '';
    $infP = '';
    $infImg = '';
    $infTagged = '';
    $divWhole = '';

    $infAdminDetail = '';
    $infAdminEdtBtn = '';

    $bankInfSql = "SELECT * FROM admininfo WHERE nf_Class = $infClass";
    $bankInfQry = mysqli_query($conn, $bankInfSql);

    switch ($infClass) {
        case 0:
            $divID = 'about_us_detail';
            $hBeg = '<h1>';
            $hEnd = '</h1>';
            break;

        case 1:
            $divID = 'our_vision_detail';
            $hBeg = '<h1>';
            $hEnd = '</h1>';
            break;

        case 2:
            $divID = 'our_messege_detail';
            break;

        case 3:
            $divID = 'our_targets_detail';
            $ulBeg = '<ul>';
            $liBeg = '<li>';
            $hBeg = '<p>';
            $hEnd = '</p>';
            $liEnd = '</li>';
            $ulEnd = '</ul>';
            break;

        case 4:
            $divID = 'our_value_detail';
            $ulBeg = '<ul>';
            $liBeg = '<li>';
            $hBeg = '<h3>';
            $hEnd = '</h3>';
            $liEnd = '</li>';
            $ulEnd = '</ul>';
            break;

        case 5:
            $divID = 'managerA';
            $hBeg = '<h1 id="mang_name">';
            $hEnd = '</h1>';
            $mangDivBeg = '<div class="mangBox">';
            $mangDivEnd = '</div>';
            break;
        case 6:
            $divID = 'managerB';
            $hBeg = '<h1 id="mang_name">';
            $hEnd = '</h1>';
            $mangDivBeg = '<div class="mangBox">';
            $mangDivEnd = '</div>';
            break;
        case 7:
            $divID = 'managerC';
            $hBeg = '<h1 id="mang_name">';
            $hEnd = '</h1>';
            $mangDivBeg = '<div class="mangBox">';
            $mangDivEnd = '</div>';
            break;
        case 8:
            $divID = 'managerD';
            $hBeg = '<h1 id="mang_name">';
            $hEnd = '</h1>';
            $mangDivBeg = '<div class="mangBox">';
            $mangDivEnd = '</div>';
            break;
        case 9:
            $divID = 'managerE';
            $hBeg = '<h1 id="mang_name">';
            $hEnd = '</h1>';
            $mangDivBeg = '<div class="mangBox">';
            $mangDivEnd = '</div>';
            break;
    }

	if (!$bankInfQry || $bankInfNum = mysqli_num_rows($bankInfQry) <= 0) {
        $divWhole = '<article id="'.$divID.'">'.$mangDivBeg.'<h3 id="no_content">لا يوجد محتوى لعرضه لهذا القسم!</h3></article>';
    } else {

    while ($bankInfo = mysqli_fetch_assoc($bankInfQry)) {
        if (!is_null($bankInfo['nf_Title']))
            $infH = $hBeg.$bankInfo['nf_Title'].$hEnd;

        if (!is_null($bankInfo['nf_Content']) && !empty($bankInfo['nf_Content'])) {
			if ($infClass <= 4)
				$infP = '<p>'.$bankInfo['nf_Content'].'</p>';
			else if ($infClass >= 5)
				$infP = '<h2 id="title">'.$bankInfo['nf_Content'].'</h2>';
		} else {
			$infP = '';
		}

        if (!is_null($bankInfo['nf_Photo'])) {
            $qtedImgPath = "'nfPP/".$bankInfo['nf_Photo']."'";
            $infImg = '<img src='.$qtedImgPath.'>';
        }

        if ($userType == 'au_uid') {
        $infCreatorName = '<h5 id="adminAddedByLbl">اضيف بواسطة:</h5><p>'.
            getSingleValue('adminuser', 'au_UserName', 'au_ID = '.$bankInfo['nf_WritingUserID'], '').'</p>';

        if (!is_null($bankInfo['nf_EditingUserID'])) {
            $infEditorName = '<h5 id="admineditedByLbl">آخر مستخدم قام بالتعديل</h5><p>'.
            getSingleValue('adminuser', 'au_UserName', 'au_ID = '.$bankInfo['nf_EditingUserID'], '').'</p>';
        } else {
            $infEditorName = '';
        }

        if (checkUserPrivelage($userID, 'editBankInf') == 1) {
						$infAdminEdtBtn = "<form id='adminInfoForm' action = 'functionalPage/adminPrivilege.php' method = 'POST'>";
            $infAdminEdtBtn .= '<button type="button" id="showInfoMdlBtn" name="showInfoMdlBtn" onclick="showBankInfMdl('.$bankInfo['nf_ID'].')">تعديل المعلومة</button>'.
                    adminBtns($bankInfo['nf_Active'], "Info", "Act", "المعلومة", $bankInfo['nf_ID'], "end");;
        }

        $infAdminDetail = '<section class="adminMangTools">'.$infAdminEdtBtn.
				'<div class="adminNeededInfo">'.$infCreatorName.$infEditorName.'</div>';
        } else {
            $infAdminDetail = '';
        }



        $infTagged .= $mangDivBeg.$liBeg.$infImg.$infH.$infP.$infAdminDetail.$liEnd.$mangDivEnd;
    }

    $divWhole = '<article id="'.$divID.'" class="containerBox">'.$ulBeg.$infTagged.$ulEnd.'</article>';

	}
	return($divWhole);
}


function showAgency($allOrSingle = "", $agency_key = '', $filterCondition = "") {
	global $conn, $userID, $userType, $agencyType, $agencyClass, $agencySpecialty;

	$adminAgTotalInfo = '';

	if (!empty($agency_key)) {
		$extraCondition = " AND ag_Name = '$agency_key'";
		$showAgencyChances = true;
	} else {
		$extraCondition = "";
		$showAgencyChances = false;
	}

	if ($userType == "vl_uid")
		$extraCondition .= " AND ag_AccActive = 1";

	$extraCondition .= " ".$filterCondition;

	$showAgenciesSql = "SELECT * FROM agency WHERE (1 = 1)".$extraCondition;
	$showAgenciesQry = mysqli_query($conn, $showAgenciesSql);

	if ($showAgenciesRes = mysqli_num_rows($showAgenciesQry) > 0) {
		while ($agencyInfo = mysqli_fetch_assoc($showAgenciesQry)) {
			$ag_id = $agencyInfo['ag_ID'];
			$agTypeID = $agencyInfo['ag_Type'];
			$agClassID = $agencyInfo['ag_Class'];
			$agSpecialtyID = $agencyInfo['ag_Specialty'];
			$ag_NameParam = "'".$agencyInfo['ag_Name']."'";
			$passBtnAccParam = "'AG'";

			$adminBtnsAg = "";
			if ($userType == "au_uid")
					$adminBtnsAg .= adminBtns($agencyInfo['ag_AccActive'], "Agency", "Account", "حساب الجهة", $agencyInfo['ag_ID'], "beg");

			if ($userType == 'au_uid' && checkUserPrivelage($userID, 'editAgAcc') == 1) {
				$adminBtnsAg .= '<button type="button" onClick="showِAdminAlterPassMdl('.$ag_id.', '.$ag_NameParam.', '.$passBtnAccParam.')" id="adminEditAgPass">تغيير كلمة المرور</button>';
			} elseif ($userType == 'ag_uid' && $userID == $ag_id) {
				$adminBtnsAg .= '<button type="button" class="editPageBtn" onClick="showAgAlterInf('.$ag_id.')" class="editPageBtn">تعديل صفحتنا</button>';
			}

			if ($userType == "au_uid")
				$adminBtnsAg .= adminBtns($agencyInfo['ag_CanAddChance'], "Agency", "AddChance", "إضافة فرص", $agencyInfo['ag_ID'], "end");


			if (!empty($agencyInfo['ag_AdminUserID']) && $userType == "au_uid") {
				$editorUserName = getSingleValue("adminuser", "au_UserName", "au_ID = ".$agencyInfo['ag_AdminUserID'], 0);
				$editorUserTags = "<h5 id='agEditorTitle'>آخر مستخدم قام بالتعديل</h5><p id='agEditorName'>".$editorUserName."</p><br>";
			} else {
				$editorUserTags = "";
			}


			if (is_null($agencyInfo['ag_Appreviation']) || empty($agencyInfo['ag_Appreviation']))
				$agAppr = '';
			else
				$agAppr = ' ('.$agencyInfo['ag_Appreviation'].')';

			$agencyAccDate = '';
			if ($userType == 'au_uid')
				$agencyAccDate = '<h5 id="agEditorTitle">تاريخ إنشاء الحساب</h5><p id="agEditorName">'.
				$agencyInfo['ag_AccCreatedIn'].'</p><br>';

			if ($allOrSingle == "all") {
				$agencyNameHeader = "<a id='agy_name' href = 'singleAg_BoV.php?showAgency=".$agencyInfo['ag_Name']."'>"
						 .$agencyInfo['ag_Name'].$agAppr."</a>";
			} elseif ($allOrSingle == "single") {
				$agencyNameHeader = '<h1 id="Agency_name">'.$agencyInfo['ag_Name'].$agAppr.'</h1>';
			}

			if ($agClassID >= 0)
				$agClass =
				'<h4>تصنيف الجهة</h4>
				<h3>'.$agencyClass[$agClassID].'</h3>';
			else
				$agClass = '';

			if (!is_null($agencyInfo['ag_SocialLinks']) && !empty($agencyInfo['ag_SocialLinks']))
				$agSiteLink =
				'<h4>الموقع الإلكتروني</h4>
				<h3>'.$agencyInfo['ag_SocialLinks'].'</h3>';
			else
				$agSiteLink = '';

			if ((!is_null($agencyInfo['ag_Address']) && !empty($agencyInfo['ag_Address'])) || (!is_null($agencyInfo['ag_Branch']) && !empty($agencyInfo['ag_Branch']))) {
				$agAdressInf =
					'<div class="infoSubTitle">
						<span></span>
						<label>عناوين الجهة</label>
					</div>';

				if (!is_null($agencyInfo['ag_Address']) && !empty($agencyInfo['ag_Address']))
					$agAdressInf .=
					'<h4>العنوان الرئيسي</h4>
					<h3>'.$agencyInfo['ag_Address'].'</h3>';

				if (!is_null($agencyInfo['ag_Branch']) && !empty($agencyInfo['ag_Branch']))
					$agAdressInf .=
					'<h4>فروع الجهة</h4>
					<h3>'.$agencyInfo['ag_Branch'].'</h3>';

			} else {
				$agAdressInf = '';
			}

			if ($userType == "au_uid") {

					if ($editorUserTags || $agencyAccDate) {
						$adminAgTotalInfo =
							'<section class="adminMangTools">
								<div class="adminNeededInfo">'
									.$agencyAccDate.$editorUserTags.
								'</div>'
								.$adminBtnsAg.
							'</section>';
					}
			} elseif ($userType == "ag_uid") {
					$adminAgTotalInfo = $adminBtnsAg;
			}

			if ($allOrSingle == 'all') {
				echo('
				<section class="containerBox" id="agyViewContainer">
					<div class="profileHead">'.
					 	'<img src="agPP/'.$agencyInfo['ag_Photo'].'" alt="'.$agencyInfo['ag_Name'].' Logo">'.
						$agencyNameHeader.
						'<h2>'.$agencyType[$agTypeID].'</h2>
					</div>'
					 .$adminAgTotalInfo.
				'</section>');
			} else {
				echo('
				<div class="profileHead">
					<img src="agPP/'.$agencyInfo['ag_Photo'].'" alt="none">'
            		.$agencyNameHeader.
            		'<h2>'.$agencyType[$agTypeID].'</h2>
				</div>'
				.$adminAgTotalInfo.
				'<section class="rightProfileSection">
           			<div class="sectionMainTitle">
						<span></span>
						<label>الملف التعريفي</label>
						<span></span>
					</div>
					<div class="infoSubTitle">
						<span></span>
						<label>المعلومات العامة</label>
					</div>
					<h4>نوع الجهة</h4>
            		<h3>'.$agencyType[$agTypeID].'</h3>'
					.$agClass.
					'<h4>تخصص الجهة</h4>
            		<h3>'.$agencySpecialty[$agSpecialtyID].'</h3>

					<div class="infoSubTitle">
						<span></span>
						<label>معلومات التواصل</label>
					</div>
					<h4>رقم الهاتف</h4>
					<h3>'.$agencyInfo['ag_PhoneNumber'].'</h3>
					<h4>البريد الإلكتروني</h4>
					<h3>'.$agencyInfo['ag_Email'].'</h3>'
					.$agSiteLink.
					 $agAdressInf.
				'</section>
				<!-- Chances Section -->
        		<section class="leftProfileSection" id="agChanceSection">
           			<div class="sectionMainTitle">
						<span></span>
						<label>الفرص</label>
						<span></span>
					</div>');

				if ($userID == $ag_id && $userType == 'ag_uid' && $allOrSingle = 'single') {
                    $isAgencyAccActive = getSingleValue('agency', 'ag_AccActive', 'ag_ID = '.$ag_id, 0);
                    $canAgencyAddChance = getSingleValue('agency', 'ag_CanAddChance', 'ag_ID = '.$ag_id, 0);

                    if ($isAgencyAccActive == 1 && $canAgencyAddChance) {
				        echo(
							'<button id="add_chance" onClick="showAddNewChanceMdl(0)">
            					<svg id="add_icon" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 91 91"><title>Add Chance</title><path d="M46,.51A45.5,45.5,0,1,0,91.51,46,45.55,45.55,0,0,0,46,.51Zm0,86A40.5,40.5,0,1,1,86.51,46,40.55,40.55,0,0,1,46,86.51Z" transform="translate(-0.51 -0.51)" style="fill:#4b235f"/><path d="M61,43.51H48.51V31a2.5,2.5,0,1,0-5,0v12.5H31a2.5,2.5,0,1,0,0,5h12.5V61a2.5,2.5,0,0,0,5,0V48.51H61a2.5,2.5,0,0,0,0-5Z" transform="translate(-0.51 -0.51)" style="fill:#4b235f"/></svg>
            				</button>');
                    } else {
                        echo('
						<h4>لا يمكن إضافة فرصة بسبب توقف حسابكم. يرجى التواصل مع إدارة الموقع لتفعيل حسابكم</h4>');
                    }
				}
				if ($showAgencyChances == true && $allOrSingle = 'single')
					{
						echo(showChance($ag_id, -1));
					}
        		echo('</section>');
			}

		}
	} else {
		echo('
		<section class="containerBox" id="agyViewContainer">
			<div class="profileHead">
				<h1>لا توجد جهات مسجلة بعد!</h1>
			</div>
		</section>');
	}
}

function showChance($ag_Id = -1, $ch_ID = -1, $ch_Filter = '') {
	global $conn, $userID, $userType, $agencyType, $chanceLocation, $chanceType, $chanceWorkField, $chanceWorkSpecialty, $isChnPaid;
    $chanceAllTagDetail = '';

	$extraConditions = "";
	if ($ag_Id != -1)
		$extraConditions = " AND ch_agcID = $ag_Id";
	if ($userType == 'vl_uid')
		$extraConditions .= " AND ch_ActiveApply = 1 AND ch_Deadline >= DATE(NOW())";
  if ($ch_ID > 0)
		$extraConditions .= " AND ch_ID = $ch_ID";

	$extraConditions .= " ".$ch_Filter;

	$showChanceSql =
		"SELECT *, agency.ag_Name agName, agency.ag_Type agType, agency.ag_Photo agPhoto FROM chance
		INNER JOIN agency ON agency.ag_ID = chance.ch_agcID WHERE (1 = 1)". $extraConditions." ORDER BY ch_PostedIn DESC, ch_ID DESC;";
	// echo($showChanceSql);
	$showChanceQry = mysqli_query($conn, $showChanceSql);

	if ($showChanceQry && $showChanceRes = mysqli_num_rows($showChanceQry) > 0) {
		while ($ChanceInfo = mysqli_fetch_assoc($showChanceQry)) {
			$chLoc = $ChanceInfo['ch_Location'];
			$chPay = $ChanceInfo['ch_Payment'];
			$chTyp = $ChanceInfo['ch_Type'];
			$chFld = $ChanceInfo['ch_WorkField'];
			$chSpc = $ChanceInfo['ch_WorkSpecialty'];
			$chAgType = $ChanceInfo['agType'];
			//
			$chanceTasksArr = array();
			$chanceTasksTag = '';
			$chanceTermsArr = array();
			$chanceTermsTag = '';
			//
			$chanceNoteTag = '';
			$chanceFileInfo = '';
			//
			$chAgencyDetail = '';
			$volunteerBtns = '';
			$adminBtnsCh = '';
			$editorUserTags = '';

		  if ($userType != 'ag_uid' && $ag_Id == -1 && $ch_ID == -1)
		  	{
			  $chAgencyDetail =
				'<section class="containerBox chanceco" id="chanceAgProf">
					<div class="profileHead chancef">
						<img  class="chancei "src="agPP/'.$ChanceInfo['agPhoto'].'" alt="'.$ChanceInfo['agName'].' Logo">
						<div class="chanceAgInfo">
						<a class="ag_name" href = "singleAg_BoV.php?showAgency='.$ChanceInfo['agName'].'">
							<h2>'.$ChanceInfo['agName'].'</h2>
							<h2>'.$agencyType[$chAgType].'</h2>
							</a>
						</div>
						
					</div>';
		  	}
		  if ($ch_ID == -1)
			  {
				  $chanceTitle =
					  '<h1 onClick="showChanceMdl('.$ChanceInfo['ch_ID'].')" style="cursor: pointer;">'.$ChanceInfo['ch_Title'].'</h1>';
			  } else {
				  $chanceTitle =
					  '<h1>'.$ChanceInfo['ch_Title'].'</h1>';
			  }

		  if ($userType == "vl_uid" && $ch_ID == -1)
		  	{
				  
        		$isVlAccActive = getSingleValue('volunteer', 'vl_AccActive', 'vl_ID = '.$userID, 0);
				$didUserApply = getSingleValue("chanceapplication", "COUNT(ap_ID)", "ap_volID = ".$userID." AND ap_chnID = ".$ChanceInfo['ch_ID'], -1);
				if ($didUserApply >= 1)
					$volApplyBtn = '<button type="button">متقدم بالفرصة</button>';
				else{
					$vlapb= $ChanceInfo['ch_ID'] + 1000000;
					$volApplyBtn =
					//'<input type="button" name="applyToChance" placeholder="Name" value="'.$ChanceInfo['ch_ID'].'" onclick="myFunction()"/>';
					'<button type="button" id="'.$vlapb.'" name="applyToChance" onclick="myFunction('.$ChanceInfo['ch_ID'].')" value="'.$ChanceInfo['ch_ID'].'">التطوع بالفرصة</button>';
				}
				if ($isVlAccActive != 1)
					$volApplyBtn = '';
					$volunteerBtns =
					'<form action="functionalPage/volunteerPrivilege.php " id="'.$ChanceInfo['ch_ID'].'" method="POST" >'
							.$volApplyBtn.
							'<button type="button" name="sharing" onClick="shareChance('.$ChanceInfo['ch_ID'].')">مشاركة الفرصة</button>
					</form>';
      		}

			if ($userType != "vl_uid" && $ch_ID == -1) {
				$adminBtnsCh = adminBtns($ChanceInfo['ch_ActiveApply'], "Chance",
						"Apply", "التقديم للفرصة", $ChanceInfo['ch_ID'], "one");

				$adminBtnsCh.= "<form id='showApplicantFrm' action='chanceApplicants_BoV.php' method='GET'>";
					$adminBtnsCh.=
						"<button type='submit' name='showApplicants' value='"
						.$ChanceInfo['ch_Title']."'>إستعراض المتقدمين</button>
				</form>";

				if (!empty($ChanceInfo['ch_AdminUserID']) && $userType == "au_uid") {
					$editorUserName = getSingleValue("adminuser", "au_UserName", "au_ID = ".$ChanceInfo['ch_AdminUserID'], 0);
					$editorUserTags =
						"<h5>آخر مستخدم قام بالتعديل</h5>
						<p>".$editorUserName."</p>";
					//
					$editorUserTags =
						'<div class="adminNeededInfo">'
							.$editorUserTags.
						'</div>';
				}
			}

			$chanceAllTagDetail .=
				$chAgencyDetail.
				'<section class="containerBox" id="chanceInfoBox">'
					.$chanceTitle.
					'<div id="chanceGenInfo">
						<h4>نوع الفرصة</h4>
						<h3>'.$chanceType[$chTyp].'</h3>
						<h4>موقع الفرصة</h4>
						<h3>'.$chanceLocation[$chLoc].'</h3>
						<h4>عدد المتطوعين</h4>
						<h3>'.$ChanceInfo['ch_VolCapacity'].'</h3>
						<h4>مقابل مادي</h4>
						<h3>'.$isChnPaid[$chPay].'</h3>
					</div>
					<div id="chanceFieldInfo">
						<h4>مجال التطوع</h4>
						<h3 id="chanceFieldDetail"> '.$chanceWorkField[$chFld].' - '
					.$chanceWorkSpecialty[$chFld][$chSpc].'</h3>
					</div>
					<div id="chancePeriodInfo">
						<h4>فترة التطوع</h4>
						<h3 id="chancePeriodDetail">'.$ChanceInfo['ch_StartAt'].' حتى '.$ChanceInfo['ch_EndAt'].'</h3>
					</div>';
			//
			if ($ch_ID > 0) {
				$chAgencyDetail = '';
				//
				$chanceTasksArr = explode('(&)', $ChanceInfo['ch_Task']);
				$chanceTasksTag =
				'<div id="chanceTasksInfo">
					<h4>قائمة المهام المطلوبة</h4>
					<ul>';
					  foreach($chanceTasksArr as $chTask) {
						  $chanceTasksTag .= '<li><h3>'.$chTask.'</h3></li>';
					  }
					$chanceTasksTag .=
					'</ul>'.
				'</div>';
				//
	      		$chanceTermsArr = explode('(&)', $ChanceInfo['ch_Terms']);
				$chanceTermsTag =
				'<div id="chanceTermsInfo">
					<h4>شروط ومحددات الفرصة</h4>
					<ul>';
					  foreach($chanceTermsArr as $chTerm) {
						  $chanceTermsTag .= '<li><h3>'.$chTerm.'</h3></li>';
					  }
					  $chanceTermsTag .=
					'</ul>
				</div>';
				//
				if (!empty($ChanceInfo['ch_Note']))
					$chanceNoteTag =
						'<div id="chanceNoteInfo">
							<h4>تفاصيل إضافية</h4>
							<ul>
								<li><p>'.$ChanceInfo['ch_Note'].'</p></li>
							</ul>
						</div>';
				//
				if (!is_null($ChanceInfo['ch_FileLink']))
					$chanceFileInfo =
					'<div id="chanceFileInfo">
						<h4>إستمارة التطوع</h4>
	          			<a id="chnDocLink" href="functionalPage/validationOps.php?saveChnFile='.$ChanceInfo['ch_FileLink'].'">تحميل  الإستمارة</a>
	      			</div>';
				//
				$chanceAllTagDetail .=
					$chanceTasksTag.
					$chanceTermsTag.
					$chanceNoteTag.
					$chanceFileInfo.
				'</section>';
			} else {
				$chanceAllTagDetail .=
					'<section class="adminMangTools">'.
						$editorUserTags.$volunteerBtns.$adminBtnsCh.
					'</section>'.
				'</section>';
				if ($userType != 'ag_uid' && $ag_Id == -1 && $ch_ID == -1)
				{
					$chanceAllTagDetail .= '</section>';
				}
			}

		}
	} else {
		$chanceAllTagDetail =
            '<div class="containerBox">
				<h1> لا يوجد اي فرص للتطوع بها حالياً! </h1>
			</div>';
	}
    return($chanceAllTagDetail);
}


function showApplicant ($chanceID,$ap_ch_filter) {
	if (empty($chanceID))
		exit();
		$filterApplicant=$ap_ch_filter;
		//$filterApplicant = "ORDER BY ap_AcceptVol DESC; ";
		if($ap_ch_filter="")
		$filterApplicant = "GROUP BY ap_AcceptVol ORDER BY round(AVG(ap_volRate)) DESC ;";
	global $conn, $userID, $userType, $volEduQualification, $volEduSpecialty, $volTalents;
	$applicantSql =
		"SELECT ap_ID, ap_SubmitedIn, ap_volID, ap_AcceptVol, ap_volRate, ap_volRateComment, vl_UserName, vl_Photo, Vl_Gender,
		vl_BirthDate, vl_Qualification, vl_Specialty, vl_Talent, vl_Skill, vl_Language, vl_AccActive FROM chanceapplication INNER JOIN volunteer ON volunteer.vl_ID = chanceapplication.ap_volID WHERE ap_chnID = ".$chanceID." AND vl_AccActive = 1 ".$filterApplicant.";";

	$applicantQry = mysqli_query($conn, $applicantSql);
	if ($applicantQry) {
		$chanceEndDate = getSingleValue('chance', 'ch_EndAt', 'ch_ID = '.$chanceID);
		$realTimeQry = mysqli_query($conn, "SELECT DATE(NOW()) AS realTimeDate");
		$realTimeDate = mysqli_fetch_assoc($realTimeQry);

        $apSelNo = 0;
		while ($applicantInfo = mysqli_fetch_assoc($applicantQry)) {
			$acceptBtnOnclick = "";
			if ($realTimeDate['realTimeDate'] < $chanceEndDate) {
				$acceptBtnOnclick = "acceptVolBtnFrm()";
				$btnType = "submit";
				if ($applicantInfo['ap_AcceptVol'] == 0) {
					$acceptBtnClass = "acceptVolAppBtn";
					$acceptBtnText = "قبول المتقدم";
				} else {
					$acceptBtnClass = "volAcceptedBtn";
					$acceptBtnText = "إلغاء القبول";

				}
			} else {
				$btnType = "button";
				if ($applicantInfo['ap_AcceptVol'] == 0) {
					$acceptBtnClass = "volNotAcceptedBtn";
					$acceptBtnText = "غير مقبول";
				} else {
					$acceptBtnClass = "evaluateVolBtn";
					$acceptBtnText = "تقييم المتطوع";
					$acceptBtnOnclick = "showRateVolMdl('".$applicantInfo['vl_UserName']."', ".$applicantInfo['ap_ID'].")";
				}
			}

			$appVolAvgRate = getSingleValue("chanceapplication", "round(AVG(ap_volRate), 1)", "ap_volID = ".$applicantInfo['ap_volID'], 0);
			if (is_null($appVolAvgRate))
				$appVolAvgRate = '0.0';

			$acceptAppBtn = "";
			if ($userType == 'ag_uid') {
				if ($applicantInfo['ap_volRate'] == null && is_null($applicantInfo['ap_volRateComment'])) {
				$acceptAppBtn =
					'<button type="'.$btnType.'" name="acceptVolApp"
					onClick="'.$acceptBtnOnclick.'" class="'.$acceptBtnClass.'" 	value="'.$applicantInfo['ap_ID'].'">'.$acceptBtnText.'</button>';
				}
			}

	echo('
	<section class="applicants_profile">
		<img id="img_applicants" src="vlPP/'.$applicantInfo['vl_Photo'].'" alt="none">
		<div class="applicants_profile_Info">
			<h1 id="applicants_name" onClick="showVlDetailMdl('.$applicantInfo['ap_volID'].')">'
		 	.$applicantInfo['vl_UserName'].'</h1>
			<h2 id="applicants_experience" style="cursor: pointer;">مزيد من التفاصيل</h2>'.
		 	$acceptAppBtn.
			'<div id="applSelRate">
				<span class="volRate">'.$appVolAvgRate.'</span>
				<span class="applicant_Rate_Line"></span>
				<label for="selectApplChk'.$applicantInfo['ap_volID'].'" class="bovCheckBox">
					<input type="checkbox" value="'.$applicantInfo['ap_volID'].'" id="selectApplChk'.$apSelNo.'" name="applicantSel'.$apSelNo.'" class="applicantSel">
					<span></span>
				</label>
			</div>
		</div>'.
	'</section>');
            $apSelNo++;
		}
	} else {
		echo('<div class="applicnat-box"><h4>لا يوجد اي متقدمين !</h4></div>');
	}

}

function showVolunteer($volAcc, $volFilter, $showInfoOnly = false) {
	global $conn, $userID, $userType, $volEduQualification, $volEduSpecialty, $volTalents, $chanceLocation, $chanceLocGovsAreas;
	$allOrProfile = '';
	$extraFilter = "";
	$volAllTagStr = "";
	$adminBtnsVl = "";
	$volAddExpBtn = '';

	if ($volAcc != '') {
		$allOrProfile = 'profile';
		$extraFilter .= ' AND vl_ID = '.$volAcc;
	} else {
		$allOrProfile = 'all';
	}

	if ($volFilter != '')
		$extraFilter .= ' AND '.$volFilter;
		

	$showVolSql =
		'SELECT vl_ID, vl_UserName, vl_Photo, Vl_Gender, timestampdiff(year, vl_BirthDate, DATE(NOW())) AS vl_Age, vl_Qualification,  vl_Email, vl_PhoneNumber, vl_Specialty,vl_Talent, vl_Skill, vl_locationGov, vl_LocationArea,
		vl_Language, vl_AccCreatedIn, vl_AccActive, vl_AdminUserID FROM volunteer WHERE (1 = 1) '.$extraFilter;
	$showVolQry = mysqli_query($conn, $showVolSql);
	
	if ($showVolQry || mysqli_num_rows($showVolQry) > 0) {
		while ($volInfo = mysqli_fetch_assoc($showVolQry)) {
			$volQualID = $volInfo['vl_Qualification'];
			$volTlntID = $volInfo['vl_Talent'];
			$volLatestExp = getSingleValue('volunteer_experience', 'MAX(vl_ExpPosition)', 'vl_volID = '.$volInfo['vl_ID'], '');
			$volAvgRate = getSingleValue("chanceapplication", "Round(AVG(ap_volRate), 1)", "ap_volID = ".$volInfo['vl_ID'], 0);
			if (is_null($volAvgRate))
				$volAvgRate = '0.0';
			$volNameParam = "'".$volInfo['vl_UserName']."'";
			$volAddExpBtnParam = "'New'";
			$passBtnAccVlBtn = "'VL'";

			$vlAlterPageParams = $volInfo['vl_ID'].", '".$volInfo['vl_PhoneNumber']."', '".$volInfo['vl_Language']."', '".$volInfo['vl_Skill']."', '".$volInfo['vl_UserName']."'";

			$volAccDate = '';
			if ($showInfoOnly == false) {
				if ($userType == 'au_uid') {
					//
					$volAccDate = '<div class="adminNeededInfo"><h5 id="agEditorTitle">تاريخ إنشاء الحساب : </h5><p id="study_deg">'.
					$volInfo['vl_AccCreatedIn'].'</p><br>';
					//
					if (!empty($volInfo['vl_AdminUserID'])) {
						$editorUserName = getSingleValue("adminuser", "au_UserName", "au_ID = ".$volInfo['vl_AdminUserID'], 0);
						$editorUserTags = "<h5 id='agEditorTitle'> آخر مستخدم قام بالتعديل:</h5><p id='agEditorName'>".$editorUserName."</p>";
					} else {
						$editorUserTags = "";
					}
					//
					$adminBtnsVl = '<section class="adminMangTools">';
					$adminBtnsVl .= $volAccDate.$editorUserTags.'</div>';
					$adminBtnsVl .= adminBtns($volInfo['vl_AccActive'], "Volunteer", "Account", "الحساب",$volInfo['vl_ID'], "beg");
					$adminBtnsVl .= '<button type="button" onClick="showِAdminAlterPassMdl('.$volInfo['vl_ID'].', '.$volNameParam.', '.$passBtnAccVlBtn.')" id="adminEditVlPass">تغيير كلمة المرور</button>';
					$adminBtnsVl .= '</form></section>';
				} elseif ($userType == 'vl_uid' && $userID == $volInfo['vl_ID']) {
					$adminBtnsVl .= '<button class="editPageBtn" type="button" onClick="showVlAlterInf(this.value)" value="'.$volInfo['vl_ID'].'">تعديل صفحتي</button>';
				}
				if ($userType == 'vl_uid' && $userID == $volInfo['vl_ID'])
					$volAddExpBtn = '<button type="button" onClick="showAddEditExpMdl('.$userID.', \'N\')"> إضافة خبرة </button>';
			}
			//
			if (!is_null($volInfo['vl_PhoneNumber']) && !empty($volInfo['vl_PhoneNumber']))
				$vlPhoneNum = '<h4>رقم الهاتف</h4>
				<h3>'.$volInfo['vl_PhoneNumber'].'</h3>';
			else
				$vlPhoneNum = '';
			//
			$vlAddress = 
				$chanceLocation[$volInfo['vl_locationGov']].' - '.$chanceLocGovsAreas[$volInfo['vl_locationGov']][$volInfo['vl_LocationArea']];
			//
			switch ($allOrProfile) {
				case 'all':
					$volAllTagStr .=
					'<section class="containerBox">
						<div class="profileHead">
							<img id="img_applicants" src="vlPP/'.$volInfo['vl_Photo'].'" alt="none">
							<h1 id="applicants_name" onClick="showVlDetailMdl('.$volInfo['vl_ID'].')">'
							.$volInfo['vl_UserName'].'</h1>
							<h2 id="applicants_experience">مزيد من التفاصيل</h2>
							<span class="volRate">'.$volAvgRate.
							'</span>
						</div>'
						.$adminBtnsVl.
					'</section>';
					break;
				case 'profile':
					$volSkill = '';
					if (!empty($volInfo['vl_Skill']) && !is_null($volInfo['vl_Skill'] != '')) {
						$volSkillsArr = explode('(&)', $volInfo['vl_Skill']);
						$volSkill .=
							'<h4>المهارات</h4>
							<ul id="volSkilssList">';
								for ($skillNo = 0; $skillNo <= count($volSkillsArr) - 1; $skillNo++) {
									$volSkill .= '<li><h3>'.$volSkillsArr[$skillNo].'</h3></li>';
								}
						$volSkill .=
							'</ul>';
					}

					$volSpecialties = '';
					if (!empty($volInfo['vl_Specialty']) && $volInfo['vl_Specialty'] != -1) {
						$volSpecialties = '<h4>التخصص</h4>';
						$volSpecialty = explode(',', $volInfo['vl_Specialty']);
						$volSpecialties .=
							'<ul id="volSpecList">';
								foreach ($volSpecialty as $volSpecID) {
									$volSpecialties .=
										'<li><h3>'.$volEduSpecialty[$volSpecID].'</h3></li>';
								}
						$volSpecialties .=
							'</ul>';
					}

					$volExperience = tagVolExperience($volInfo['vl_ID'], $showInfoOnly);
					$volRating = tagVolRate($volInfo['vl_ID']);

					$volAllTagStr .=
					'<section class="profileHead">
						<img src="vlPP/'.$volInfo['vl_Photo'].'" alt="none">
						<h1>'.$volInfo['vl_UserName'].'</h1>
						<h2>'.$volLatestExp.'</h2>
						<span class="volRate">'.$volAvgRate.'</span>
					</section>'.$adminBtnsVl.

					'<section class="rightProfileSection" id="volPersInfoSec">
						<div class="sectionMainTitle">
							<span></span>
							<label>الملف التعريفي</label>
							<span></span>
						</div>

						<div class="infoSubTitle">
							<span></span>
							<label>المعلومات الشخصية</label>
						</div>
							<h4>العمر</h4>
							<h3>'.$volInfo['vl_Age'].'</h3>
							<h4>المؤهل الدراسي</h4>
							<h3>'.$volEduQualification[$volQualID].'</h3>'
							.$volSpecialties.

						'<div class="infoSubTitle">
							<span></span>
							<label>معلومات التواصل</label>
						</div>'
							.$vlPhoneNum.
							'<h4>البريد الإلكتروني</h4>
							<h3>'.$volInfo['vl_Email'].'</h3>
							<h4>العنوان</h4>
							<h3>'.$vlAddress.'</h3>
						<div class="infoSubTitle">
							<span></span>
							<label>المؤهلات والمهارات</label>
						</div>
						<h4>اللغات</h4>
						<ul id="volLangList">'.
							tagVolLanguage($volInfo['vl_Language'], 'P').
						'</ul>'.
						$volSkill.
						'<h4>المواهب</h4>
						<ul>
							<li><h3>'.$volTalents[$volTlntID].'</h3></li>
						</ul>'.
						$volAddExpBtn.$volExperience.
					'</section>'.
					$volRating;
					break;
			}

		}
	}
	echo($volAllTagStr);
}

function tagVolLanguage($langStr, $tagType) {
	$LabelStr = ['اللغة الام', 'جيد', 'متوسط', 'ممتاز'];
	$langTag = '';

	$volLanguagesInf = explode('-', $langStr);
	for ($LngId = 0; $LngId < count($volLanguagesInf); $LngId++) {
		$LngLvlInf = explode('=', $volLanguagesInf[$LngId]);
		$LngName = $LngLvlInf[0];
		$LngLvl = $LngLvlInf[1];

		$LangLevel = '';
		if ($tagType == 'P') {
			$LangLevel = $LabelStr[$LngLvl - 1];
		} elseif ($tagType == 'A') {
    		for ($lng = 1; $lng <= 4; $lng++) {
        		if 	($LngLvl == $lng)
					$lvlCheckVal = 'checked';
        		else
					$lvlCheckVal = '';

				$LangLevel .=
            '<label class="bovRadioButton" for="Lang'.$LngId.'Lvl'.$lng.'">'.
							'<input type="radio" id="Lang'.$LngId.'Lvl'.$lng.'" name="Lang'.$LngId.'Lvl" value="'.$lng.'"'.$lvlCheckVal.'>'
							.$LabelStr[$lng - 1].
							'<span></span>'.
						'</label>';
    		}
		}

		$langTag .=
			'<li>'.
				'<h3>'.$LngName;
				if ($tagType == 'P')
					$langTag .= ' - '.$LangLevel.'</h3>';
				elseif ($tagType == 'A')
					$langTag .= '</h3>'.
					$LangLevel.'<p class="Error-Text" id="langErr'.$LngId.'"></p>';
			$langTag .=
			'</li>';
	}

    return($langTag);
}

function tagVolExperience($volID, $hideEditBtn) {
	global $conn;
	$volExpTag = '';
	$volEditExpBtn = '';

	$volExpSql = "SELECT * FROM volunteer_experience WHERE vl_volID = $volID";
	$volExpQry = mysqli_query($conn, $volExpSql);
	if (($volExpQry) && ($volExpRes = mysqli_num_rows($volExpQry) > 0)) {
		$volExpTag =
			'<div class="infoSubTitle">
				<span></span>
				<label>الخبرات</label>
			</div>';
		$volName = getSingleValue('volunteer', 'vl_UserName', 'vl_ID = '.$volID, 'none');
		while ($volExpInf = mysqli_fetch_assoc($volExpQry)) {
			$editExpBtnParam = $volExpInf['vl_ExpID'];

			if ($hideEditBtn == false)
				$volEditExpBtn = '<button type="button" id="Agency_edit" onClick="showAddEditExpMdl('.$editExpBtnParam.', \'O\')"> تعدبل الخبرة </button>';
				$volDeleteExpBtn = '';
				

			$volExpTag .=
			'<ul class="volExpInfo">
				<li><h4>'.$volExpInf['vl_ExpPosition'].'</h4></li>
				<li><h3>'.$volExpInf['vl_ExpStart'].' حتى '.$volExpInf['vl_ExpEnd'].'</h3></li>
				<li><h3>'.$volExpInf['vl_ExpOrg'].'</h3></li>
				<li><h3>'.$volExpInf['vl_ExpSup'].'</h3></li>
				<li><h3>'.$volExpInf['vl_ExpSupEmail'].'</h3></li>
				<li><h3>'.$volExpInf['vl_ExpDesc'].'</h3></li>
			</ul>'
			.$volEditExpBtn .$volDeleteExpBtn;
		}
	} else {
		if ($hideEditBtn == false) {
			$volExpTag =
			'<span></span>
			<label class="infoTitle">الخبرات</label>';
		}
	}

	return($volExpTag);
}
//raghed begin <hr id="line7">
function tagVolRate($vlID) {
	global $conn;
	$volRateTag = '';

	$volRateSql =
		"SELECT agency.ag_Name agName, agency.ag_photo agPhoto, chance.ch_Title chTitle, ap_volRate, ap_volRateComment FROM chanceapplication INNER JOIN chance ON chance.ch_ID = chanceapplication.ap_chnID INNER JOIN agency ON agency.ag_ID = chance.ch_agcID WHERE ap_volID = $vlID AND ap_AcceptVol = 1 AND ap_volRate > 0 AND ap_volRateComment IS NOT null";
	$volRateQry = mysqli_query($conn, $volRateSql);
	if ($volRateQry) {
		$volRateRes = mysqli_num_rows($volRateQry);
		$vlRateNo = 1;

		if ($volRateRes > 0) {
			$volRateTag =
			'<section class="leftProfileSection" id="volPersInfoSec">
				<div class="sectionMainTitle">
					<span></span>
					<label>التقييم</label>
					<span></span>
				</div>';
			while ($volRateInf = mysqli_fetch_assoc($volRateQry)) {
				$volRateTag .=
				'<section class="containerBox">
					<article class="applicants_profile">
						<img src="agPP/'.$volRateInf['agPhoto'].'" alt="'.$volRateInf['agName'].' Logo">
						<div class="applicants_profile_Info">
							<h1>'.$volRateInf['agName'].'</h1>
							<h2>'.$volRateInf['chTitle'].'</h2>
							<span class="volRate">'.$volRateInf['ap_volRate'].'</span>
						</div>
					</article>
					<p>'.$volRateInf['ap_volRateComment'].'</p>
				</section>';

				/*if ($vlRateNo != $volRateRes)
					$volRateTag .= '<hr id="line7">';*/


				$vlRateNo++;
			}
			$volRateTag .=
			'</section>';
		}
	}

	return($volRateTag);
}
function Notification(){
	global $conn, $ch_ID, $ap_state, $ap_read, $ag_Id,$ch_title,$ag_image,$ag_name,$tag; 
	$userID = $_SESSION['userID'];
	$userType = $_SESSION['userType'];
	

	if ($userType == 'ag_uid') {
		$extraConditions = " AND ch_agcID = $userID";
		$extraConditions .= " AND ch_ActiveApply = 1 AND ch_Deadline >= DATE(NOW())";
		$showAgSql=" SELECT  agency.ag_Name agName, chance.ch_ID, chance.ch_Title FROM chance
		INNER JOIN agency ON agency.ag_ID = chance.ch_agcID WHERE (1 = 1) ".$extraConditions." ORDER BY ch_PostedIn DESC, ch_ID DESC";
		$showAgQry = mysqli_query($conn, $showAgSql);
		if ($showAgQry || mysqli_num_rows($showAgQry) > 0) {
		while ($AgInfo = mysqli_fetch_assoc($showAgQry)) {
			$ch_ID=$AgInfo['ch_ID'];
			$ch_title=$AgInfo['ch_Title'];
			$SqlQ="SELECT  volunteer.vl_UserName, volunteer.vl_Photo, chanceapplication.ap_ID, chanceapplication.ag_read FROM chanceapplication INNER JOIN volunteer ON volunteer.vl_ID = chanceapplication.ap_volID WHERE ap_chnID = ".$ch_ID." ;";
			$showAgQry1 = mysqli_query($conn, $SqlQ);
		if ($showAgQry1 || mysqli_num_rows($showAgQry1) > 0) {
		while ($AgInfo1 = mysqli_fetch_assoc($showAgQry1)) {
			$vl_name=$AgInfo1['vl_UserName'];
			$vl_photo=$AgInfo1['vl_Photo'];
			$ap_id = $AgInfo1['ap_ID'];
			$read = $AgInfo1['ag_read'];
			
			if($read == 1){
				$tag ='<a href="chanceApplicants_BoV.php?showApplicants='.$ch_title.'" onclick="read('.$ap_id.')"  id="main_page">';
			}
			else{
				$tag ='<a href="chanceApplicants_BoV.php?showApplicants='.$ch_title.'" onclick="read('.$ap_id.')" style="background-color: rgba(127,126,126,0.4);" id="main_page">';
			}
			echo' 
				<div  class="col-12">
					'.$tag.'
					<div id="notificationsImage" class="col-3 col-3-s">
					<img src="vlPP/'.$vl_photo.'" alt="none">
					</div>
					<div class="col-8 col-8-s">
					<p class="notp">لقد قدم<span style="font-weight: bold"> '.$vl_name.' </span> بتطوع في فرصة<span> '.$ch_title.' </span>  </p>
					</div>
				</a>
				</div>
			';

		}
	}
}
		}

	}
	elseif ($userType == 'vl_uid'){
	$showVolSql ="SELECT * from chanceapplication where ap_volID = $userID and ap_AcceptVol = 1  ORDER BY ap_SubmitedIn DESC";
	$showVolQry = mysqli_query($conn, $showVolSql);
	if ($showVolQry || mysqli_num_rows($showVolQry) > 0) {
	while ($volInfo = mysqli_fetch_assoc($showVolQry)) {
		 $ch_ID = $volInfo['ap_chnID'];
		 $ap_read = $volInfo['ap_read'];
		 $ap = $volInfo['ap_ID'];
		 $ch_title = getSingleValue('chance', 'ch_Title', 'ch_ID = '.$ch_ID, -1);
		 $ag_Id = getSingleValue('chance', 'ch_agcID', 'ch_ID = '.$ch_ID, -1);
		 $ag_image = getSingleValue('agency', 'ag_Photo', 'ag_ID = '.$ag_Id, -1);
		 $ag_name = getSingleValue('agency', 'ag_Name', 'ag_ID = '.$ag_Id, -1);
		 if($ap_read == 1){
			$tag ='<a href="chance_BoV.php?sharedChance='.$ch_title.'" onclick="read('.$ap.')"  id="main_page" >';
		}
		else{
			$tag ='<a href="chance_BoV.php?sharedChance='.$ch_title.'" onclick="read('.$ap.')" style="background-color: rgba(127,126,126,0.4);" id="main_page" >';
		}
		
		 echo' 
		 <div  class="col-12">
					'.$tag.'
					<div id="notificationsImage" class="col-3 col-3-s">
					<img src="agPP/'.$ag_image.'" alt="none">
					</div>
					<div class="col-8 col-8-s">
					<p class="notp">تم قبولك من قبل<span style="font-weight: bold"> '.$ag_name.' </span> في فرصة<span> '.$ch_title.' </span>  </p>
					</div>
				</a>
				</div>';
	
			}
		}

	}	
}
function countNot(){
	global $conn;
	$uId = $_SESSION['userID'];
	$uType = $_SESSION['userType'];
	$ch_ID ="";
	$gaCount =0 ;
	$vlCount = getSingleValue('chanceapplication', 'COUNT(ap_volID)', ' ap_read = 0 AND ap_AcceptVol = 1 AND ap_volID = '.$uId, -1);
	$extraConditions = " AND ch_agcID = $uId";
	$extraConditions .= " AND ch_ActiveApply = 1 AND ch_Deadline >= DATE(NOW())";
	$showAgSqlC=" SELECT  chance.ch_ID FROM chance INNER JOIN agency ON agency.ag_ID = chance.ch_agcID WHERE (1 = 1) ".$extraConditions." ORDER BY ch_PostedIn DESC, ch_ID DESC";
	$showAgQryC = mysqli_query($conn, $showAgSqlC);
		if ($showAgQryC || mysqli_num_rows($showAgQryC) > 0) {
		while ($AgInfoC = mysqli_fetch_assoc($showAgQryC)) {
			$ch_ID=$AgInfoC['ch_ID'];
			$gaCount += getSingleValue("chanceapplication INNER JOIN volunteer ON volunteer.vl_ID = chanceapplication.ap_volID ", "COUNT(ap_volID)", "ap_chnID = ".$ch_ID." AND vl_AccActive = 1 AND ag_read = 0", -1);

		}
	}

    if ( $uType == 'ag_uid'){
		echo $gaCount;

    }
    elseif( $uType == 'vl_uid'){
        echo $vlCount;

    }
}



?>
