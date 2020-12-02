<?php
	include_once('functionalPage/dbConnOps.php');
	include('header_BoV.php');

    if (!isset($_SESSION['userType']) && !isset($_SESSION['userID'])) {
        echo('<h1>هذه الصفحة غير موجودة يرجى التأكد من صحة الرابط المدخل!</h1>');
        exit();
    } else {
	   $userType = $_SESSION['userType'];
	   $userID = $_SESSION['userID'];
    
        if ($userType != 'au_uid') {
            echo('<h1>هذه الصفحة غير موجودة يرجى التأكد من صحة الرابط المدخل!</h1>');
            exit();
        }
    }
?>

<button class="accordion"> حسابات المستخدمين </button>
    <div class="panel">
        <?php
            $addAdminUserBtn = '';
        if ($userType == 'au_uid' && checkUserPrivelage($userID, 'addAdminAcc') == 1)
            $addAdminUserBtn = '<br><button type="button" id="add_new_news" onclick="showAdminUserMdl()"> إضافة مستخدم </button>';
            
            echo($addAdminUserBtn);
            showAdminUser();
        ?>
    </div>
<div class="separate"></div> <!-- Added by Majd -->

<button class="accordion"> منشورات البنك </button>
    <div class="panel">
     <?php
        $addPostBtn = '';
        if ($userType == 'au_uid' && checkUserPrivelage($userID, 'addPosts') == 1)
            $addPostBtn = '<button id="add_new_news" id="add_new_news" type="button" onclick="showPostMdl(0)"> إضافة منشور </button>';
       echo($addPostBtn.showPosts()); 
     ?>
    </div>

    <div class="separate"></div> <!-- Added by Majd -->

<button class="accordion"> معلومات البنك </button>
    <div class="panel">
      <?php
        $addBankInfoBtn = '';
        if ($userType == 'au_uid' && checkUserPrivelage($userID, 'addBankInf') == 1)
            $addBankInfoBtn = '<button type="button" id="add_new_news" onclick="showBankInfMdl(-1)"> إضافة معلومة </button>';
        
        echo($addBankInfoBtn);
      ?>
       
       <!-- Bank Information 
<section id="info">
        <div id="info_1">
            <h1 id="about_us_title">عن البنك</h1>
        </div>
        <div id="info_2">
            <h1>رؤيتنا</h1>
        </div>
        <div id="info_3">
            <h1>رسالتنا</h1>
        </div>
        <div id="info_4">
            <h1>أهدافنا</h1>
        </div>
        <div id="info_5">
            <h1>قيمنا</h1>
        </div>
</section>--> 
		
		<!-- Majd, I made the Section above a comment -->
   
<div id="info_line"> </div>

<!-- Information Paragragh -->
<section id="info_p">
  
  <?php
	echo('<p class="HL"> عن البنك </p>');
    echo(showBankInfo(0));
	echo('<p class="HL"> رؤيتنا </p>');
    echo(showBankInfo(1));
	echo('<p class="HL"> رسالتنا </p>');
    echo(showBankInfo(2));
	echo('<p class="HL"> أهدافنا </p>');
    echo(showBankInfo(3));
	echo('<p class="HL"> قيمنا </p>');
    echo(showBankInfo(4));
  ?>
        
<!-- Managers Section 
<section id="managers_general">
        <div id="mang_1">
            <h1>مجلس الأمناء</h1>
        </div>
        <div id="mang_2">
            <h1>المجلس الاعلى</h1>
        </div>
        <div id="mang_3">
            <h1>الهيئة التنفيذية</h1>
        </div>
        <div id="mang_4">
            <h1>الهيكل التنظيمي</h1>
        </div>
        <div id="mang_5">
            <h1>شركاؤنا</h1>
        </div>
</section> -->
   <!-- Majd, I made the Section above a comment -->
	
	
<div id="info_line_2"></div>

<section id="managers">
    <?php
	echo('<p class="HL2"> مجلس الأمناء </p>');
    echo(showBankInfo(5));
	echo('<p class="HL2"> المجلس الأعلى </p>');
    echo(showBankInfo(6));
	echo('<p class="HL2"> الهيئة التنفيذية </p>');
    echo(showBankInfo(7));
	echo('<p class="HL2"> المجلس التنظيمي </p>');
    echo(showBankInfo(8));
	echo('<p class="HL2"> شركاؤنا </p>');
    echo(showBankInfo(9));
    ?>
</section>
    </div>
     
		 
<?php
	include('footer_BoV.php');
?>