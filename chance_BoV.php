

<?php
	include_once('functionalPage/dbConnOps.php');
	include('header_BoV.php');
?>

    <section id="begin_div_chance">
       <div class="sectionMainTitle">
			<span></span>
			<label>الفرص</label>
			<span></span>
		</div>

<?php
		global $chanceType, $chanceLocation, $chanceWorkField, $chanceWorkSpecialty;
		if (isset($_SESSION['userType']) && isset($_SESSION['userID'])) {
			$userType = $_SESSION['userType'];
			$userID = $_SESSION['userID'];


			if ($userType == "ag_uid") {
				$agID = $userID;
                $isAgencyAccActive = getSingleValue('agency', 'ag_AccActive', 'ag_ID = '.$agID, 0);
                $canAgencyAddChance = getSingleValue('agency', 'ag_CanAddChance', 'ag_ID = '.$agID, 0);
            } else {
				$agID = -1;
                $isAgencyAccActive = 0;
                $canAgencyAddChance = 0;
            }


			if ($userType == 'ag_uid') {
                if ($isAgencyAccActive == 1 && $canAgencyAddChance) {
					echo('<button id="add_chance" onClick="showAddNewChanceMdl(0)">
            		<svg id="add_icon" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 91 91"><title>Add Chance</title><path d="M46,.51A45.5,45.5,0,1,0,91.51,46,45.55,45.55,0,0,0,46,.51Zm0,86A40.5,40.5,0,1,1,86.51,46,40.55,40.55,0,0,1,46,86.51Z" transform="translate(-0.51 -0.51)" style="fill:#4b235f"/><path d="M61,43.51H48.51V31a2.5,2.5,0,1,0-5,0v12.5H31a2.5,2.5,0,1,0,0,5h12.5V61a2.5,2.5,0,0,0,5,0V48.51H61a2.5,2.5,0,0,0,0-5Z" transform="translate(-0.51 -0.51)" style="fill:#4b235f"/></svg>
            		</button>');
                } else {
                    echo('<div id="contant"><h3>لا يمكن إضافة فرصة بسبب توقف حسابكم. يرجى التواصل مع إدارة الموقع لتفعيل حسابكم</h3></div>');
                }
            }
			if (!isset($_GET['sharedChance'])){   //start AD editing
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
				echo (addComboValues($chanceType, "", "الكل", $chanceTypeDef, "chType"));
				echo (addComboValues($chanceLocation, "", "الكل", $chanceLocationDef, "chLocation"));
				echo (addComboValues($chanceWorkField, "", "الكل", $chanceWorkFieldDef, "chWorkField"));
				echo("<button type='submit' id='vol_submit' name='filterChBtn' value='show'> تصفية </button></form>");
			$ch_Filter=" ";
			if (isset($_POST['filterChBtn'])) {
				if (isset($_POST['chType']) && $_POST['chType'] != -1) {
					$ch_Filter = $ch_Filter." AND ch_Type = ".$_POST['chType'];
				}
				if (isset($_POST['chLocation']) && $_POST['chLocation'] != -1) {
					$ch_Filter = $ch_Filter." AND ch_Location = ".$_POST['chLocation'];
				}
				if (isset($_POST['chWorkField']) && $_POST['chWorkField'] != -1) {
					$ch_Filter .= " AND ch_WorkField = ".$_POST['chWorkField'];
				}
			}
				echo(showChance($agID, -1,$ch_Filter));}      //end AD editing
			else
			{
				$sharedChnName = '';
				$sharedChanceHash = mysqli_real_escape_string($conn, $_GET['sharedChance']);

				$showSharedChnSql = "SELECT ch_ID, ch_Title FROM chance WHERE ch_ActiveApply = 1 AND ch_Deadline >= DATE(NOW())";
				$showSharedChnQry = mysqli_query($conn, $showSharedChnSql);
				if ($showSharedChnSql) {
					$chancesNum = mysqli_num_rows($showSharedChnQry);
					if ($chancesNum > 0) {
						while ($shareChnInfo = mysqli_fetch_assoc($showSharedChnQry)) {
							if ($shareChnInfo['ch_Title']==$sharedChanceHash) {
								$sharedChnName = $shareChnInfo['ch_ID'];
								break;
							}
						}
						$ch_Filter="AND ch_ID=".$sharedChnName ;

						if (!empty($sharedChnName))
							echo(showChance( $agID, -1,$ch_Filter));
						else
							echo('<div id="contant"><h3>عذراَ! الرابط الذي ادخلته غير صحيح او غير فعال.</h3></div>');
					} else {
						echo('<div id="contant"><h3>عذراَ! الرابط الذي ادخلته غير صحيح او غير فعال.</h3></div>');
					}
				} else {
					echo('<div id="contant"><h3>عذراَ! الرابط الذي ادخلته غير صحيح او غير فعال.</h3></div>');
				}
			}
		} else {
			if (isset($_GET['sharedChance'])) {
				$sharedChnName = '';
				$sharedChanceHash = mysqli_real_escape_string($conn, $_GET['sharedChance']);

				$showSharedChnSql = "SELECT ch_ID, ch_Title FROM chance WHERE ch_ActiveApply = 1 AND ch_Deadline >= DATE(NOW())";
				$showSharedChnQry = mysqli_query($conn, $showSharedChnSql);
				if ($showSharedChnSql) {
					$chancesNum = mysqli_num_rows($showSharedChnQry);
					if ($chancesNum > 0) {
						while ($shareChnInfo = mysqli_fetch_assoc($showSharedChnQry)) {
							if ($shareChnInfo['ch_Title']==$sharedChanceHash) {
								$sharedChnName = $shareChnInfo['ch_ID'];
								break;
							}
						}

						if (!empty($sharedChnName))
							echo(showChance(-1, $sharedChnName));
						else
							echo('<div id="contant"><h3>عذراَ! الرابط الذي ادخلته غير صحيح او غير فعال.</h3></div>');
					} else {
						echo('<div id="contant"><h3>عذراَ! الرابط الذي ادخلته غير صحيح او غير فعال.</h3></div>');
					}
				} else {
					echo('<div id="contant"><h3>عذراَ! الرابط الذي ادخلته غير صحيح او غير فعال.</h3></div>');
				}
			} else {
				echo('<div id="contant"><h3>يرجى تسجيل الدخول لعرض محتوى الصفحة</h3></div>');
			}
		}
?>

</section>

<?php
	include_once('footer_BoV.php');
?>
