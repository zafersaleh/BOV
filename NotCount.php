<?php
    include_once('../dbConnOps.php');
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


?>