<?php

header("Content-type: public");
header("Content-Disposition: attachment; filename=hello.xls");

include_once('functionalPage/dbConnOps.php');

$exportApsSql = "SELECT vl_UserName, vl_Email, vl_PhoneNumber, vl_Gender, timestampdiff(year, vl_BirthDate, DATE(NOW())) AS vl_Age, vl_Qualification, vl_Specialty FROM volunteer WHERE vl_ID IN (1, 5, 3);";
$exportApsQry = mysqli_query($conn, $exportApsSql);

if (mysqli_num_rows($exportApsQry) > 0) {
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
?>


