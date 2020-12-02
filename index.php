<?php
	include_once('header_BoV.php');
	include_once('functionalPage/dbConnOps.php');
if (!isset($_SESSION['userType']) && !isset($_SESSION['userID'])) {

	if (isset($_GET['vrfAcc']) && isset($_GET['vrfStmp'])) {
		$vrfLinkEmail = mysqli_real_escape_string($conn, $_GET['vrfAcc']);
		$vrfLinkDate = mysqli_real_escape_string($conn, $_GET['vrfStmp']);

		$realDate = getRealTimeDate();
		if (!password_verify($realDate, $vrfLinkDate)) {
			echo('<p class="Error-Text" id="vrfLinkErr">عذراً! هذا الرابط انتهت مدته </p>');
			exit();
		} else {
			$compareEmailSql = "SELECT vl_ID, vl_Email FROM volunteer WHERE vl_AccActive = 0 AND vl_AdminUserID IS NULL;";
			$compareEmailQry = mysqli_query($conn, $compareEmailSql);

			if (mysqli_num_rows($compareEmailQry) > 0) {
				while($vlMailInfo = mysqli_fetch_assoc($compareEmailQry)) {
					if (password_verify($vlMailInfo['vl_Email'], $vrfLinkEmail)) {
						$accToVerify = $vlMailInfo['vl_ID'];
						break;
					} else {
						$accToVerify = 0;
					}
				}
				if ($accToVerify > 0) {
					$verifyVlAccSql = "UPDATE volunteer SET vl_AccActive = 1 WHERE vl_ID = $accToVerify;";
					try {
						mysqli_autocommit($conn, false);
						$verifyVlAccQry = mysqli_query($conn, $verifyVlAccSql);
						if ($verifyVlAccQry) {
							echo('<p class="Error-Text" id="vrfLinkErr">تم تأكيد حسابك بنجاح. يمكنك الآن تصفح جميع الفرص والتطوع بها</p>');
						} else {
							throw new Exception('accNotVerified');
						}

						mysqli_commit($conn);
					} catch(Exception $vrfAccErr) {
						mysqli_rollback($conn);
						echo('<p class="Error-Text" id="vrfLinkErr">عذراً! حدث خطأ اثناء تأكيد حسابك. يرجى المحاولة لاحقاَ او التواصل مع إدارة الموقع</p>');
					} finally {
						mysqli_autocommit($conn, true);
					}

				} else {
					echo('<p class="Error-Text" id="vrfLinkErr">عذراً! هذا الرابط غير صالح</p>');
					exit();
				}
			} else {
				echo('<p class="Error-Text" id="vrfLinkErr">عذراً! هذا الرابط عير صالح</p>');
				exit();
			}
		}
	}

echo('
<!-- Signup forms -->
<section class="sectionContainer">
<!-- Volunteer signup -->
   <div id="vol_form">
      <form action="functionalPage/signUpNewAcc.php" method="POST" id="vol_sign_up" onSubmit="return checkVlRegInf()">
       <div id="vol_front">
        <div id="vol_cont" class="containerBox">
           <h1 class="signupTitle">سجّل كمتطوع</h1>
           <p id="vol_p">شاهد جميع الفرص التي ترفب في التطوّع بها</p>

           <!-- Basic Info -->

		   <label for="f_name" class="inputTitle">الإسم</label>
		   <label for="l_name" class="inputTitle">اللقب</label>
           <input type="text" name="volFname" id="f_name" placeholder="الإسم الأول">
           <input type="text" name="volLname" id="l_name" placeholder="الإسم الأخير">
           <p class="Error-Text" id="volFnameErr"></p>
		   <p class="Error-Text" id="volLnameErr"></p>
		   <label for="vol_email" class="inputTitle">البريد الإلكتروني</label>
           <input type="email" name="volemail" id="vol_email" placeholder="البريد الإلكتروني">
		   <p class="Error-Text" id="volEmailErr"></p>
			<label for="vol_gender" class="inputTitle">انوع الإجتماعي</label>
			<label for="age" class="inputTitle">تاريخ الميلاد</label>'.
			addComboValues($volGender, '', '--اختر النوع--', '-1', 'vol_gender').
			'<input name="vlbirthDate" type="date">
			<p class="Error-Text" id="volGenderErr"></p>
			<p class="Error-Text" id="vlBirthDateErr"></p>');

           echo('
		   <label for="vol_gender" class="inputTitle">كلمة المرور</label>
		   <label for="vol_gender" class="inputTitle">تأكيد كلمة المرور</label>
           <input type="password" name="volPass" id="vol_pass" placeholder="كلمة المرور">
           <input type="password" name="volPassConf" id="vol_passconf" placeholder="تأكيد كلمة المرور ">
		   <p class="Error-Text" id="volPassErr"></p>
		   <p class="Error-Text" id="volPassConfErr"></p>
           <button type="button" id="flipVolSignFront" onClick="regVlFirstInfo()">سجّل</button>
        </div>
    </div>

    <!-- Additional info -->

         <div id="vol_back">
          <div id="vol_cont" class="containerBox">
			   <label for="edu_qual" class="inputTitle">المؤهل الدراسي</label>
			   <label for="edu_spec" class="inputTitle">التخصص الدراسي</label>'.
				addComboValues($volEduQualification, 'onChange="vl_qualChange()"', '--المؤهل الدراسي--', '-1','edu_qual').
				addComboValues($volEduSpecialty, '', '--التخصص--', '-1','edu_spec').
				'<p class="Error-Text" id="eduQualErr"></p>
				 <p class="Error-Text" id="eduSpecErr"></p>
			   <div id="volSignupLangs">
				   <label id="vol_lang_title" class="inputTitle">اللغة</label>
				   <label class="bovCheckBox">الــعربيـــــة
					   <input name="langAr" type="checkbox" checked="checked">
					   <span id="checkmark"></span>
				   </label>

				   <label for="LangArr1" class="bovRadioButton">
					   <input type="radio" id="LangArr1" name="LangArLvl" value="1">
					   اللغة الام
					   <span></span>
				   </label>
				   <label for="LangArr2" class="bovRadioButton">
					   <input type="radio" id="LangArr2" name="LangArLvl" value="2">
					   جيد
					   <span></span>
				   </label>
				   <label for="LangArr3" class="bovRadioButton">
					   <input type="radio" id="LangArr3" name="LangArLvl" value="3">
					   متوسط
					   <span></span>
				   </label>
				   <label for="LangArr4" class="bovRadioButton">
					   <input type="radio" id="LangArr4" name="LangArLvl" value="4">
					   ممتاز
					   <span></span>
				   </label>
				   <p class="Error-Text" id="arbLangErr"></p>

				   <label class="bovCheckBox">الإنجليزية
					   <input type="checkbox" name="langEn">
					   <span id="checkmark"></span>
				   </label>

				   <label for="LanEng1" class="bovRadioButton">
					   <input type="radio" id="LanEng1" name="LangEngLvl" value="1">
					   اللغة الام
					   <span></span>
				   </label>
				   <label for="LangEng2" class="bovRadioButton">
					   <input type="radio" id="LangEng2" name="LangEngLvl" value="2">
					   جيد
					   <span></span>
				   </label>
				   <label for="LangEng3" class="bovRadioButton">
					   <input type="radio" id="LangEng3" name="LangEngLvl" value="3">
					   متوسط
					   <span></span>
				   </label>
				   <label for="LangEng4" class="bovRadioButton">
					   <input type="radio" id="LangEng4" name="LangEngLvl" value="4">
					   ممتاز
					   <span></span>
				   </label>
				   <p class="Error-Text" id="engLangErr"></p>
				 </div>
				 <div id="volSignupLocation">
				 	<label class="inputTitle">المحافظة</label>'.
					addComboValues($chanceLocation, '', '--اختر المحافظة--', '-1', 'volLocGov').
					'<p class="Error-Text" id="volLocGovErr"></p>
					<label class="inputTitle">المديرية</label>'.
					addComboValues($chanceLocGovsAreas[0], '', '--اختر المديرية--', '-1', 'volLocArea').
					'<p class="Error-Text" id="volLocAreaErr"></p>
				</div>
        <label for="vlSkill0" class="inputTitle">المهارات</label>
				<label id="vlTalantBack" class="inputTitle">المواهب</label>
        <input type="text" id="vlSkill" name="vlSkill" class="VolSkillTxt" placeholder="ادخل المهارة">'.
				addComboValues($volTalents, '', '--اختر موهبتك--', '-1', 'vol_talent').
        '<p class="Error-Text" id="vlSkillErr"></p>
			  <p class="Error-Text" id="volTalentErr"></p>
			  <label class="bovCheckBox" id="terms_title" onClick="showVolSignupTerms()">
					<input type="checkbox" name="vol_agree" id="vol_agree">
					أوافق على الشروط والأحكام
					<span></span>
			 	</label>
			  <p class="Error-Text" id="volAgreeErr"></p>
			  <button type="submit" id="vol_submit" name="volAddInfReg">تم</button>

			  </div>
			 </div>
		  </form>
		 </div>
<!--<p class="Error-Text" id="volAddInfRegErr"></p>-->
   <!-- End of volunteer signup forms -->

<!-- Start of Agencies signup forms -->
       <div id="ag_form">
        <form action="functionalPage/signUpNewAcc.php" method="POST" id="agy_sign_up" onSubmit="return checkAgRegInf()">
             <div id="ag_front">
             <div id="ag_cont" class="containerBox">
                <h1 class="signupTitle">سجّل كجهة</h1>
                <p id="ag_p">نظم عملك التطوعي </p>

                <!-- Basic Info -->

				<label for="ag_name" class="inputTitle">إسم الجهة</label>
				<label for="ag_app" class="inputTitle">إختصار لإسم الحهة</label>
				<input type="text" name="ag_name" id="ag_name" placeholder="إسم الجهة">
				<input type="text" name="ag_app" id="ag_app" placeholder="إختصار الإسم">
				<p class="Error-Text" id="ag_nameErr"></p>
				<label for="ag_email" class="inputTitle">البريد الإلكتروني</label>
                <input type="email" name="ag_email" id="ag_email" placeholder="البريد الإلكتروني">
				<p class="Error-Text" id="ag_emailErr"></p>
				<label for="ag_pass" class="inputTitle">كلمةالمرور</label>
				<label for="ag_passconf" class="inputTitle">تأكيد كلمة المرور</label>
                <input type="password" name="ag_pass" id="ag_pass" placeholder="كلمة المرور">
                <input type="password" name="ag_passconf" id="ag_passconf" placeholder="تأكيد كلمة المرور ">
				<p class="Error-Text" id="ag_passErr"></p>
				<p class="Error-Text" id="ag_passconfErr"></p>
                <button id="ag_flip" type="submit" name="signAgAcc" onClick="regAgFirstInfo()">سجّل</button>
            </div>
            </div>
            <!-- Additional info -->
            <div id="ag_back">
			  <div id="ag_cont" class="containerBox">
			  	<label for="ag_type" class="inputTitle">تصنيف الجهة</label>
				<label for="ag_class" class="inputTitle">تخصص الحهة</label>'.
				addComboValues($agencyType, 'onChange="ag_typeChange()"', '-نوع الجهة-', '-1','ag_type').
				addComboValues($agencyClass, '', '-تخصص الجهة-', '-1', 'ag_class').
				'<p class="Error-Text" id="ag_typeErr"></p>
				<p class="Error-Text" id="ag_classErr"></p>
				<label for="ag_spec" class="inputTitle">مجال العمل</label>
				<label for="ag_phone" class="inputTitle">رقم الهاتف</label>'.
				addComboValues($agencySpecialty, '', '-مجال عمل الجهة-', '-1', 'ag_spec').
				'<input type="text" name="ag_phone" id="ag_phone" placeholder="رقم الهاتف">
				<p class="Error-Text" id="ag_specErr"></p>
				<p class="Error-Text" id="ag_phoneErr"></p>
				<label for="ag_location" class="inputTitle">عنوان مقر الجهة</label>
               	<input type="text" name="ag_location" id="ag_location" placeholder="العنوان">
				<label for="ag_branches" class="inputTitle">فروع الجهة (إن وجد)</label>
                <input type="text" name="ag_branches" id="ag_branches" placeholder="الفروع">
				<label for="ag_social" class="inputTitle">رابط التواصل</label>
                <input type="text" name="ag_social" id="ag_social" Placeholder="رابط موقع إلكتروني / تواصل إجتماعي">
                <label id="terms_title" class="bovCheckBox" onClick="showAgySignupTerms()">
					<input type="checkbox" name="ag_agree" id="ag_agree">
					نوافق على الشروط والأحكام
					<span></san>
				</label>
				<p class="Error-Text" id="agy_agree"></p>
                <!--<p class="Error-Text" id="ag_submitErr"></p>-->
                <button type="submit" id="ag_submit" name="signAgAcc">تم</button>
			  </div>
			</div>
         </form>
     </div>
</section>');
}

echo(
	'<section class="sectionContainer">'.
	showPosts().
	'</section>'
);

?>


<!-- Bank Information -->
<section class="sectionContainer">
	<section class="bankInfoTitles">
		<h1 class="activeTitle">عن البنك</h1>
		<hr>
		<h1>رؤيتنا</h1>
		<hr>
		<h1>رسالتنا</h1>
		<hr>
		<h1>أهدافنا</h1>
		<hr>
		<h1>قيمنا</h1>
	</section>
<!-- Information Paragragh -->
	<section class="bankInfoDetail">
	  <?php
		echo(showBankInfo(0));
		echo(showBankInfo(1));
		echo(showBankInfo(2));
		echo(showBankInfo(3));
		echo(showBankInfo(4));
	  ?>
	</section>
</section>

<!-- Managers Section -->
<section class="sectionContainer">
	<section class="bankInfoTitles">
		<h1 class="activeTitle">فريق العمل </h1>
		<hr>
		<h1>الفريق التقني</h1>
		<hr>
		<h1> المستشارين</h1>
		<hr>
		<h1> شركاؤنا</h1>
	</section>

	<section class="bankInfoDetail">
		<?php
		echo(showBankInfo(5));
		echo(showBankInfo(6));
		echo(showBankInfo(7));
		echo(showBankInfo(9));
		
		?>
	</section>
</section>
<?php
$contactFormStr =
        '<!-- Contact Us -->
        <section class="sectionContainer">
			<div id="conatctUsBox">
                <h1>تـواصل بنا</h1>
                <form action="functionalPage/validationOps.php" id="send" method="POST" onSubmit="return checkSenEmailInfo()">
                    <input id="send_name" name="send_name" type="text" placeholder="الأسم الكامل">
                    <p class="Error-Text" id="send_nameErr"></p>
                    <input id="send_email" name="send_email" type="email" placeholder="البريد الإلكتروني">
                    <p class="Error-Text" id="send_emailErr"></p>
                    <textarea name="send_message" style="height: 200px" id="send_message" placeholder="الرسالة ..." cols="30" rows="4"></textarea>
                    <p class="Error-Text" id="send_messageErr"></p>
                    <button type="submit" id="send_button" name="send_Email">إرسال</button>
                    <p class="Error-Text" id="send_SendingErr"></p>
                </form>
			</div>
        </section>';

if (isset($userType)) {
    if ($userType == "au_uid") {
        $contactFormStr = '';
    }
}

echo($contactFormStr);
?>

<?php
	include('footer_BoV.php');
?>
