<?php
include_once('dbConnOps.php');

// if (isset($_POST['loginUserBtn'])) {
	
	if (isset($_POST['enteredUserID'])) {
		$userInput = mysqli_real_escape_string($conn, $_POST['enteredUserID']);
	} 
	if (isset($_POST['enteredUserCode'])) {
		$pswdInput = mysqli_real_escape_string($conn, $_POST['enteredUserCode']);
	} else {
		if (empty($userInput) || empty($pswdInput)) {
			header("Location: ../index.php?login=emptyfields");
			exit();
		}
	}
	
	$loginAgSql = "SELECT * FROM agency WHERE ag_Name = '$userInput' OR ag_Email = '$userInput';";
	$loginVlSql = "SELECT * FROM volunteer WHERE vl_UserName = '$userInput' or vl_Email = '$userInput';";
	$loginAuSql = "SELECT * FROM adminuser WHERE au_UserName = '$userInput';";
	
	$loginRes = '';
	$loginSQLs = array($loginAgSql, $loginVlSql, $loginAuSql);
	foreach($loginSQLs as $loginNo => $loginSql) {
		$loginPassName = array('ag_Password', 'vl_Password', 'au_Password');
		$loginTypeName = array('ag_uid', 'vl_uid', 'au_uid');
		$loginIDName = array('ag_ID', 'vl_ID', 'au_ID');
		
		$loginQryRes = mysqli_query($conn, $loginSql);
		if ($loginQryRes) {
			if (mysqli_num_rows($loginQryRes) > 0) {
				while ($loginInfo = mysqli_fetch_assoc($loginQryRes)) {
					// Dehashing the password:
					$dehashedPswdChk = password_verify($pswdInput, $loginInfo[$loginPassName[$loginNo]]);
			
					if ($dehashedPswdChk == true) {
						$_SESSION['userType'] = $loginTypeName[$loginNo];
						echo($loginTypeName[$loginNo]);
						$_SESSION['userID'] = $loginInfo[$loginIDName[$loginNo]];
						$_SESSION["login_time_stamp"] = time(); //AD edite
						echo($loginInfo[$loginIDName[$loginNo]]);
						$loginRes = 'LIS';
					} else {
						$loginRes = 'LWP';
					}
				}
				break;
			}
		}
	}
	if ($loginRes == '')
		 $loginRes = 'LWU';
	
	echo($loginRes);
	
	if ($loginRes == 'LIS')
		header("Location: ../index.php");
	exit();
	/*
	$resVolunteer = mysqli_query($conn, $sqlVolunteer);
	if ($userIsVol = mysqli_num_rows($resVolunteer) > 0) {
		while ($volUser = mysqli_fetch_assoc($resVolunteer)) {
			// Dehashing the password:
			$dehashedPswdChk = password_verify($pswdInput, $volUser['vl_Password']);
			
			if ($dehashedPswdChk == true) {
				$_SESSION['userType'] = "vl_uid";
				$_SESSION['userID'] = $volUser['vl_ID'];
				header("Location: ../index.php?login=successvol");
				break;
				exit();
			} else {
				header("Location: ../index.php?login=wronguservol");
				exit();
			}
		}
	}
	
	$resAgency = mysqli_query($conn, $sqlAgency);
	if ($userIsAgency = mysqli_num_rows($resAgency) > 0) {
		while ($agUser = mysqli_fetch_assoc($resAgency)) {
			// Dehashing the password:
			$dehashedPswdChk = password_verify($pswdInput, $agUser['ag_Password']);
			
			if ($dehashedPswdChk == true) {
				$_SESSION['userType'] = "ag_uid";
				$_SESSION['userID'] = $agUser['ag_ID'];
				header("Location: ../index.php?login=successAg");
				//break;
				exit();
			} else {
				header("Location: ../index.php?login=wronguserAg");
				exit();
			}
		}
	}
	
	$resAdmin = mysqli_query($conn, $sqlAdmin);
	if (mysqli_num_rows($resAdmin) > 0) {
		while ($adminUser = mysqli_fetch_assoc($resAdmin)) {
			// Dehashing the password:
			$dehashedPswdChk = password_verify($pswdInput, $adminUser['au_Password']);
			
			if ($dehashedPswdChk == true) {
				$_SESSION['userType'] = "au_uid";
				$_SESSION['userID'] = $adminUser['au_ID'];
				header("Location: ../index.php?login=successadmin");
				break;
				exit();
			} else {
				header("Location: ../index.php?login=wronguseradmin");
				exit();
			}
		}
	}
	
	
	
	header("Location: ../index.php?login=usernotfound");*/
//}

?>









