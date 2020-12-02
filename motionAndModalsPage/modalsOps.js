// JavaScript Document

// Get the modal
var detailShowModal = document.getElementById("generalMdl");

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == detailShowModal) {
    detailShowModal.innerHTML = "";
    detailShowModal.style.display = "none";
  }
};
localStorage.setItem("scrollTop", document.body.scrollTop);

window.onload = function() {  
  var scroll = parseInt(localStorage.getItem("scrollTop"));
  //parseInt(localStorage.scrollTop);   
  if (!isNaN(scroll))
  document.body.scrollTop = scroll;
}
var Accordion = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < Accordion.length; i++) {
  Accordion[i].addEventListener("click", function () {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var AccPanel = this.nextElementSibling;
    if (AccPanel.style.maxHeight) {
      AccPanel.style.maxHeight = null;
    } else {
      AccPanel.style.maxHeight = AccPanel.scrollHeight + "px";
    }
  });
}

const currentLocation = location.href;
const menuItem = document.querySelectorAll("a");
const menuLength = menuItem.length;
for (let i = 0; i < menuLength; i++) {
  if (menuItem[i].href === currentLocation) {
    menuItem[i].classList.add("act");
    menuItem[i].classList.remove("icon");
    menuItem[i].classList.add("disicon");


  }
}

/*Changing content of the bankinfo sections*/
let infoTitlesBox = document.getElementsByClassName("bankInfoTitles");
let infoDetailsBox = document.getElementsByClassName("bankInfoDetail");

for (let no = 0; no < infoTitlesBox.length; no++) {
  let infoTitles = infoTitlesBox[no].getElementsByTagName("h1");
  let infoDetails = infoDetailsBox[no].getElementsByTagName("article");
  for (let i = 0; i < infoTitles.length; i++) {
    infoTitles[i].onclick = function () {
      for (let j = 0; j < infoTitles.length; j++) {
        infoTitles[j].className = "";
        infoDetails[j].classList.remove("activeInfo");
      }
      this.classList.add("activeTitle");
      infoDetails[i].classList.add("activeInfo");
    };
  }
}
//
infoTitlesBox[0].getElementsByTagName("h1")[2].click();
infoTitlesBox[1].getElementsByTagName("h1")[0].click();

function checkLoginInfo() {
  const UserNameTxt = document.getElementById("enteredUserID");
  const UserPassTxt = document.getElementById("enteredUserCode");
  const UserLoginErr = document.getElementById("logiErr");
  const UserLoginBtn = document.getElementById("loginUserBtn");

  const UserLoginFrm = document.getElementById("sign_in");
  const UserLoginFrmData = new FormData(UserLoginFrm);

  UserLoginErr.innerHTML = "";

  const LoginUserReq = new XMLHttpRequest();
  LoginUserReq.onreadystatechange = function () {
    if (LoginUserReq.readyState == 4 && LoginUserReq.status == 200) {
      let LoginUserRes = LoginUserReq.responseText;
      if (LoginUserRes == "LWU")
        UserLoginErr.innerHTML = "إسم المستخدم او البريد الإلكتروني غير موجود";
      else if (LoginUserRes == "LWP")
        UserLoginErr.innerHTML = "كلمة المرور غير صحيحة";
      else {
        UserLoginErr.innerHTML = "";
        UserLoginFrm.submit();
        return true;
      }
    }
  };

  if (UserNameTxt.value == "" && UserPassTxt.value == "") {
    UserLoginErr.innerHTML = "يرجى إدخال إسم المستخدم وكلمة المرور";
  } else {
    if (UserNameTxt.value == "") {
      UserLoginErr.innerHTML = "يرجى إدخال إسم المسخدم او البريد الإلكتروني";
    } else if (UserPassTxt.value == "") {
      UserLoginErr.innerHTML = "يرجى إدخال كلمة المرور";
    } else {
      LoginUserReq.open("POST", "functionalPage/loginOps.php", false);
      UserLoginFrmData.append("loginUserBtn", "userSignIn");
      LoginUserReq.send(UserLoginFrmData);
    }
  }

  return false;
}

function searchForText() {
  let SearchBoxTxt = document.getElementById("searchTxt");
  let SearchBoxErr = document.getElementById("Search_BoxErr");
  let PageContBox = document.getElementById("searchResult");

  const SearchReq = new XMLHttpRequest();
  SearchReq.onreadystatechange = function () {
    if (SearchReq.readyState == 4 && SearchReq.status == 200) {
      let searchRes = SearchReq.responseText;
      PageContBox.innerHTML = searchRes;
    }
  };

  if (SearchBoxTxt.value == "") {
    SearchBoxErr.innerHTML = "يرجى إدخال نص للبحث";
  } else {
    //	SearchBoxErr.innerHTML = '';

    SearchReq.open("POST", "functionalPage/validationOps.php", false);
    SearchReq.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    SearchReq.send("searchText=" + SearchBoxTxt.value);
  }
  return false;
}
function ShowChance(zafer) {
  let PageContBox = document.getElementById("searchResult");
  let ShowPop = document.getElementById("notificationContainer");
  let bell = document.getElementById("img_natification_bell");
  if (ShowPop.style.display == "block") {
    ShowPop.style.display = "none";
    bell.classList.remove("act");
  } 
  const SearchReq = new XMLHttpRequest();
  SearchReq.onreadystatechange = function () {
    if (SearchReq.readyState == 4 && SearchReq.status == 200) {
      let searchRes = SearchReq.responseText;
      PageContBox.innerHTML = searchRes;
    }
  };

    SearchReq.open("POST", "functionalPage/validationOps.php", false);
    SearchReq.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    SearchReq.send("searchText=" + zafer);
  return false;
}

function AppearNot() {
  let ShowPop = document.getElementById("notificationContainer");
  let bell = document.getElementById("img_natification_bell");
  if (ShowPop.style.display == "block") {
    ShowPop.style.display = "none";
    bell.classList.remove("act");
  } else {
    ShowPop.style.display = "block";
    bell.classList.add("act");
    let notplace = document.getElementById("notificationsBody");
    const notfic = new XMLHttpRequest();
    notfic.onreadystatechange = function () {
      if (notfic.readyState == 4 && notfic.status == 200) {
        let notget = notfic.responseText;
        notplace.innerHTML = notget;
      }
    };
    notfic.open("POST", "functionalPage/validationOps.php", false);
    notfic.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    notfic.send("notfun= on");
  }

  return false;
}
/*
function countBell() {
  setInterval(function(){
  let countplace = document.getElementById("img_natification_bell");
  const notnu = new XMLHttpRequest();
  notnu.onreadystatechange = function () {
    if (notnu.readyState == 4 && notnu.status == 200) {
      let g = notnu.responseText;
      countplace.innerHTML = g;
    }
  };
    notnu.open("POST", "functionalPage/validationOps.php", false);
    notnu.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    notnu.send("notnumber= on");
  return false;
},1000);

}
countBell();
*/
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText == 0){

      }
      else{
        document.getElementById("count").style.display = "flex";
        document.getElementById("countTow").style.display = "flex";    
        document.getElementById("count").innerHTML = this.responseText;
        document.getElementById("countTow").innerHTML = this.responseText;
      }
    }
  };
  xhttp.open("POST", "functionalPage/validationOps.php", true);
  xhttp.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  xhttp.send("notnumber");
  }

function read(read) {
  const notnu = new XMLHttpRequest();
  notnu.onreadystatechange = function () { };
    notnu.open("POST", "functionalPage/validationOps.php", false);
    notnu.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    notnu.send("read=" +read);
  return false;
}
function apearsgin() {
  let z = document.getElementById("sign-box");
  let b = document.getElementById("sign-icon");
  let h = document.getElementById("home_header");
  if (z.style.display == "flex") {
    z.style.display = "none";
    b.classList.remove("act");
    h.classList.remove("home_header");
  } else {
    z.style.display = "flex";
    b.classList.add("act");
    h.classList.add("home_header");
  }
}

/*Logout from website button*/
function EndSession() {
  document.location.href = "functionalPage/logoutOps.php";
}

function acceptVolBtnFrm() {
  const applicantsFrm = document.getElementById("apolicantsFrm");
  applicantsFrm.setAttribute("action", "functionalPage/agencyPrivilege.php");
  applicantsFrm.submit();
}

function checkSelectedAps(expChnId) {
  let checkApsSelect = false;

  const applicantsFrm = document.getElementById("apolicantsFrm");
  const apsSelects = document.getElementsByClassName("applicantSel");
  const apsSelectErr = document.getElementById("selectApsErr");
  const apsExpBtn = document.getElementById("extSelAppls");

  for (let selID = 0; selID < apsSelects.length; selID++) {
    if (apsSelects[selID].checked == true) checkApsSelect = true;
  }

  if (checkApsSelect == false) {
    apsSelectErr.innerHTML =
      "يرجى إختيار متقدم واحد على الاقل لإستخراج بياناته!";
    apsExpBtn.setAttribute("type", "button");
  } else {
    apsSelectErr.innerHTML = "";
    apsExpBtn.setAttribute("value", expChnId);
    apsExpBtn.setAttribute("name", "expApsToExcelBtn");
    apsExpBtn.setAttribute("type", "submit");
  }
}

function selectAllAps() {
  const ApsSelects = document.getElementsByClassName("applicantSel");

  for (let selID = 0; selID < ApsSelects.length; selID++) {
    ApsSelects[selID].checked = true;
  }
}

function showAdminUserMdl(AuID = "") {
  //alert('You pressed ' + msgStr);
  let auNameTags = "";
  let auReqToSend = "";
  let AddEditAuBtn = "";
  let opTyp = "";

  if (AuID != "") {
    auNameTags = '<h id="agy_name"></h><h id="agy_kind"></h>';
    AddEditAuBtn =
      '<button type="submit" id="doSendNewPass" name="alterAuAccInf" value="' +
      AuID +
      '"> تعديل </button>';
    opTyp = "'O'";
  } else {
    auNameTags =
      '<input type="text" id="newAuName" name="auUserName" placeholder="إسم المستخدم"><p class="Error-Text" id="newAuNameErr"></p>';
    AddEditAuBtn =
      '<button type="submit" id="doSendNewPass" name="addNewAdmin"> إضافة </button>';
    opTyp = "'N'";
  }

  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<form class="ModalForm animateShowModal" action="functionalPage/adminPrivilege.php" method="POST" onSubmit="return checkNewAuInf(' +
    opTyp +
    ')">' +
    '<div id="post">' +
    auNameTags +
    '<input type="checkbox" id="auAccActive" name="auAccActive"><label> فاعلية الحساب </label>' +
    '<input type="password" id="auNewPass" name="auNewPass" placeholder="كلمة المرور الجديدة">' +
    '<p class="Error-Text" id="auNewPassErr"></p>' +
    '<input type="password" id="auNewPassCnf" name="auNewPassCnf" placeholder="تأكيد كلمة المرور الجديدة">' +
    '<p class="Error-Text" id="auNewPassCnfErr"></p>' +
    '<div id="auAuths"></div>' +
    AddEditAuBtn +
    '<button type="button" id="clsSendNewPassMdl" onclick="hideGeneralModal()"> إلغاء </button>' +
    "</div></form>";

  const auInfReq = new XMLHttpRequest();
  const auAccAuths = document.getElementById("auAuths");

  if (AuID != "") {
    const auAccName = document.getElementById("agy_name");
    const auAccDate = document.getElementById("agy_kind");
    const auAccStateChk = document.getElementById("auAccActive");

    auInfReq.onreadystatechange = function () {
      if (auInfReq.readyState == 4 && auInfReq.status == 200) {
        var auInfReqRes = auInfReq.responseText;
        auInfReqRes = auInfReqRes.split("^");
        auAccName.innerHTML = auInfReqRes[0];
        auAccDate.innerHTML = auInfReqRes[1];
        if (auInfReqRes[2] == 0) auAccStateChk.checked = false;
        else auAccStateChk.checked = true;
        auAccAuths.innerHTML = auInfReqRes[3];
      }
    };

    auReqToSend = "getAuInf=" + AuID;
  } else {
    auInfReq.onreadystatechange = function () {
      if (auInfReq.readyState == 4 && auInfReq.status == 200) {
        var auInfReqRes = auInfReq.responseText;
        auAccAuths.innerHTML = auInfReqRes;
      }
    };

    auReqToSend = "getAuAuthChks=-1";
  }

  auInfReq.open("POST", "functionalPage/validationOps.php", false);
  auInfReq.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  auInfReq.send(auReqToSend);

  detailShowModal.style.display = "block";
}

function checkNewAuInf(OpTyp = "") {
  let ErrLbls = document.getElementsByClassName("Error-Text");
  let checkingNewAuRes = true;

  if (OpTyp != "O") {
    const auNewNameTxt = document.getElementById("newAuName");
    const auNewNameErr = document.getElementById("newAuNameErr");

    auNewNameErr.innerHTML = "";

    const checkAuNameReq = new XMLHttpRequest();
    checkAuNameReq.onreadystatechange = function () {
      if (checkAuNameReq.readyState == 4 && checkAuNameReq.status == 200) {
        let checkAuNameRes = checkAuNameReq.responseText;
        if (checkAuNameRes > 0)
          auNewNameErr.innerHTML =
            "إسم المستخدم موجود مسبقاً! يرجى إختيار إسم آخر";
      }
    };

    if (auNewNameTxt.value == "") {
      auNewNameErr.innerHTML = "يرجى إدخال إسم المستخدم";
    } else {
      checkAuNameReq.open("POST", "functionalPage/validationOps.php", false);
      checkAuNameReq.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      checkAuNameReq.send("auNameChecked=" + auNewNameTxt.value);
    }
  }

  const auNewPassTxt = document.getElementById("auNewPass");
  const auNewPassErr = document.getElementById("auNewPassErr");
  const auNewPassCnfTxt = document.getElementById("auNewPassCnf");
  const auNewPassCnfErr = document.getElementById("auNewPassCnfErr");

  auNewPassErr.innerHTML = "";
  auNewPassCnfErr.innerHTML = "";

  if (auNewPassTxt.value == "")
    auNewPassErr.innerHTML = "";
  else if (auNewPassTxt.value.length < 7)
    auNewPassErr.innerHTML = "يجب ان يكون طول كلمة المرور 7 احرف او اكثر";
  else if (auNewPassCnfTxt.value == "")
    auNewPassCnfErr.innerHTML = "يرجى إدخال تأكيد كلمة المرور الجديدة";
  else if (auNewPassTxt.value != auNewPassCnfTxt.value)
    auNewPassCnfErr.innerHTML =
      "كلمة المرور التي ادخلتها لا تتوافق مع تأكيد كلمة المرور";

  for (let i = 0; i < ErrLbls.length; i++) {
    if (ErrLbls[i].innerHTML != "") {
      checkingNewAuRes = false;
      break;
    }
  }

  return checkingNewAuRes;
}

function showPostMdl(PoId) {
  let PoTitle = "";
  let PoContent = "";
  let PoFrmBtnName = "";
  let PoFrmBtnCaption = "";

  const poInfReq = new XMLHttpRequest();
  poInfReq.onreadystatechange = function () {
    if (poInfReq.readyState == 4 && poInfReq.status == 200) {
      let poInfRes = poInfReq.responseText;
      poInfRes = poInfRes.split("^");
      PoTitle = poInfRes[0];
      PoContent = poInfRes[1];
    }
  };

  if (PoId != "") {
    poInfReq.open("POST", "functionalPage/validationOps.php", false);
    poInfReq.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    poInfReq.send("getPostInf=" + PoId);

    PoFrmBtnName = "editOldPost";
    PoFrmBtnCaption = " تعديل ";
  } else {
    PoFrmBtnName = "addNewPost";
    PoFrmBtnCaption = " إضافة ";
  }
  //raghed begin id="chance2" <input id="post_content" id="addpostbutton"
  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<form action="functionalPage/adminPrivilege.php" method="POST" class="ModalForm animateShowModal" id="postInfoMdl" onSubmit="return checkPostInf()" enctype="multipart/form-data">' +
    '<div class="containerBox"> ' +
    '<input type="text" name="post_title" id="post_title" value="' +
    PoTitle +
    '" placeholder="عنوان المنشور">' +
    '<p class="Error-Text" id="post_titleErr"></p>' +
    '<textarea id="post_content" name="post_content" placeholder="محتوى المنشور">' +
    PoContent +
    "</textarea>" +
    '<p class="Error-Text" id="post_contentErr"></p>' +
    '<button type="button" id="postPhotoBtn"> إضافة صورة </button>' +
    '<input type="file" id="post_media" name="post_media">' +
    '<p class="Error-Text" id="post_mediaErr"></p>' +
    '<button type="submit" id="addpostbutton" name="' +
    PoFrmBtnName +
    '" value="' +
    PoId +
    '">' +
    PoFrmBtnCaption +
    "</button>" +
    '<button type="button" onClick="hideGeneralModal()" id="clsAddchanceMdl" name="clsAddchanceMdl">إلغاء</button>' +
    "</div>" +
    "</form>";
  detailShowModal.style.display = "block";
  //
  let postNewPhotoFile = document.getElementById("post_media");
  let postNewPhotoBtn = document.getElementById("postPhotoBtn");
  postNewPhotoBtn.addEventListener("click", function () {
    postNewPhotoFile.click();
  });
}

function checkPostInf() {
  let errorTxts = document.getElementsByClassName("Error-Text");
  let poValidationState;
  const poTitleTxt = document.getElementById("post_title");
  const poTitleErr = document.getElementById("post_titleErr");
  const poContentTxt = document.getElementById("post_content");
  const poContentErr = document.getElementById("post_contentErr");
  const poPhotoFile = document.getElementById("post_media");
  const poPhotoErr = document.getElementById("post_mediaErr");
  //
  const poFrm = document.getElementById("postInfoMdl");
  const poFrmData = new FormData(poFrm);
  //
  const poCheckImgReq = new XMLHttpRequest();
  poCheckImgReq.onreadystatechange = function () {
    if (poCheckImgReq.readyState == 4 && poCheckImgReq.status == 200) {
      let poCheckImgRes = poCheckImgReq.responseText;
      if (poCheckImgRes != "") poPhotoErr.innerHTML = poCheckImgRes;
      else poPhotoErr.innerHTML = "";
    }
  };
  //
  poTitleErr.innerHTML = "";
  poContentErr.innerHTML = "";
  //
  if (poTitleTxt.value == "") poTitleErr.innerHTML = "يرجى إدخال عنوان المنشور";
  if (poContentTxt.value == "")
    poContentErr.innerHTML = "يرجى إدخال محتوى المنشور!";
  else if (poContentTxt.value.length > 1250)
    poContentErr.innerHTML =
      "لقد تجاوزت الطول المسموح للمنشور! يرجى التقليل من المحتوى او إعادة كتابته";
  //
  if (poPhotoFile.value != "") {
    poCheckImgReq.open("POST", "functionalPage/validationOps.php", false);
    poCheckImgReq.send(poFrmData);
  } else {
    poPhotoErr.innerHTML = "";
  }
  //
  for (let errNu = 0; errNu < errorTxts.length; errNu++) {
    poValidationState = true;
    if (errorTxts[errNu].innerHTML != "") {
      poValidationState = false;
      break;
    } else {
      poValidationState = true;
    }
  }
  //
  return poValidationState;
}

function showBankInfMdl(infId) {
  let infTitle = "";
  let infContent = "";
  let infPhoto = "";
  let infClassCmbo = "";

  let infFrmBtnName = "";
  let infFrmBtnCaption = "";

  const infDetailReq = new XMLHttpRequest();
  infDetailReq.onreadystatechange = function () {
    if (infDetailReq.readyState == 4 && infDetailReq.status == 200) {
      let infDetailRes = infDetailReq.responseText;
      infDetailRes = infDetailRes.split("^");
      infTitle = infDetailRes[0];
      infContent = infDetailRes[1];
      infClassCmbo = infDetailRes[2];
      if (infDetailRes[3] != "" && infId > 0)
        infPhoto = "nfPP/" + infDetailRes[3];
      else infPhoto = "vlPP/maledefaultpic.jpg";
    }
  };

  infDetailReq.open("POST", "functionalPage/validationOps.php", false);
  infDetailReq.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  infDetailReq.send("fetchInfDetail=" + infId);

  if (infId > 0) {
    infFrmBtnName = "editBankInfBtn";
    infFrmBtnCaption = "تعديل";
  } else {
    infFrmBtnName = "addBankInfBtn";
    infFrmBtnCaption = "إضافة";
  }
  //
  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<form action="functionalPage/adminPrivilege.php" method="POST" class="ModalForm animateShowModal" id="bnkInfDetailMdl" enctype="multipart/form-data">' +
    '<section class="containerBox">' +
    '<div id="infoTitleClassBox">' +
    infClassCmbo +
    '<p class="Error-Text" id="infClassErr"></p>' +
    '<input type="text" id="infTitle" name="infTitle" value="' +
    infTitle +
    '" placeholder="عنوان رئيسي للمعلومة">' +
    '<p class="Error-Text" id="infTitleErr"></p>' +
    "</div>" +
    '<div id="infoMemberImgBox">' +
    '<img id="infMemImg" src="' +
    infPhoto +
    '" alt="' +
    infTitle +
    ' Photo">' +
    '<button type="button" id="InfPhotoBtn">...</button>' +
    '<p class="Error-Text" id="infPhotoErr"></p>' +
    '<input type="file" id="infPhoto" name="infMemPhoto" placeholder="صورة للمعلومة - إن وجد">' +
    "</div>" +
    '<textarea id="infContent" name="infContent" cols="65" rows="20" placeholder="محتوى او تقاصيل للعنوان">' +
    infContent +
    "</textarea>" +
    '<p class="Error-Text" id="infContentErr"></p>' +
    '<button type="submit" id = "editAddInfBtn" name="' +
    infFrmBtnName +
    '" value="' +
    infId +
    '">' +
    infFrmBtnCaption +
    "</button>" +
    '<button type="button" onClick="hideGeneralModal()" id="clsAddchanceMdl" name="clsAddchanceMdl">إلغاء</button>' +
    "</section>" +
    "</form>";
  //
  detailShowModal.style.display = "block";
  //
  let infPhotoFile = document.getElementById("infPhoto");
  //
  const infClassTxt = document.getElementById("infClass");
  const infFrm = document.getElementById("bnkInfDetailMdl");
  let errLabels = document.getElementsByClassName("Error-Text");
  //
  const infClassErr = document.getElementById("infClassErr");
  const infTitleTxt = document.getElementById("infTitle");
  const infTitleErr = document.getElementById("infTitleErr");
  const infContentTxt = document.getElementById("infContent");
  const infContentErr = document.getElementById("infContentErr");
  const infPhotoTxt = document.getElementById("infPhoto");
  const infPhotoErr = document.getElementById("infPhotoErr");
  //
  const infFrmBtn = document.getElementById("editAddInfBtn");
  //
  //
  function checkInfPhoto() {
    let isInfPhotoOk = true;
    infPhotoErr.innerHTML = "";
    //
    const infImgReq = new XMLHttpRequest();
    infImgReq.onreadystatechange = function () {
      if (infImgReq.readyState == 4 && infImgReq.status == 200) {
        let infImgRes = infImgReq.responseText;
        if (infImgRes != "") infPhotoErr.innerHTML = infImgRes;
      }
    };
    //
    if (infClassTxt.value < 5) {
      infPhotoErr.innerHTML = "لا يمكن إختيار صورة لهذا المحتوى";
      infPhotoTxt.value = "";
    } else {
      let infFrmData = new FormData(infFrm);
      infImgReq.open("POST", "functionalPage/validationOps.php", false);
      infImgReq.send(infFrmData);
    }
    if (infPhotoErr.innerHTML != "") isInfPhotoOk = false;
    return isInfPhotoOk;
  }
  infPhotoFile.addEventListener("change", function () {
    const infoCurImg = document.getElementById("infMemImg");
    //
    let infoImgTypeInf = this.files[0]["type"];
    infoImgTypeInf = infoImgTypeInf.split("/");
    //
    const infoImgReader = new FileReader();
    infoImgReader.onload = function () {
      if (infoImgTypeInf[0] == "image") {
        if (checkInfPhoto()) infoCurImg.src = infoImgReader.result;
      }
    };
    infoImgReader.readAsDataURL(this.files[0]);
  });
  //
  let infPhotoBtn = document.getElementById("InfPhotoBtn");
  infPhotoBtn.addEventListener("click", function () {
    infPhotoFile.click();
  });
  //
  function checkBankInfDetailFrm(inf_ID) {
    let infFrmCheckRes = true;
    //
    infClassErr.innerHTML = "";
    infTitleErr.innerHTML = "";
    infContentErr.innerHTML = "";
    //
    const infTypeExistReq = new XMLHttpRequest();
    infTypeExistReq.onreadystatechange = function () {
      if (infTypeExistReq.readyState == 4 && infTypeExistReq.status == 200) {
        let infTypeExistRes = infTypeExistReq.responseText;
        if (infTypeExistRes != "") infClassErr.innerHTML = infTypeExistRes;
        else infClassErr.innerHTML = "";
      }
    };
    //
    if (infClassTxt.value <= 5) {
      if (infClassTxt.value < 0) {
        infClassErr.innerHTML = "يرجى إختيار نوع المعلومة!";
      } else if (infClassTxt.value == 0) {
        if (infTitleTxt.value == "")
          infTitleErr.innerHTML = "يرجى إدخال عنوان لتعريف البنك!";
        if (infContentTxt.value == "")
          infContentErr.innerHTML = "يرجى إدخال محتوى تعريف البنك";
      } else if (infClassTxt.value == 1) {
        if (infTitleTxt.value == "") {
          infTitleErr.innerHTML = "يرجى إدخال العنوان للرؤية";
        } else if (infTitleTxt.value != "") {
          infTypeExistReq.open(
            "POST",
            "functionalPage/validationOps.php",
            false
          );
          infTypeExistReq.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );
          infTypeExistReq.send(
            "checkInfVision=vision&checkInfVisionID=" + inf_ID
          );
        } else {
          infTitleErr.innerHTML = "";
          infContentErr.innerHTML = "";
        }
        //
        if (infContentTxt.value != "")
          infContentErr.innerHTML = "لا يمكن إضافة محتوى للرؤية";
      } else if (infClassTxt.value == 2) {
        if (infContentTxt.value == "") {
          infContentErr.innerHTML = "يرجى إدخال محتوى الرسالة";
        } else if (infContentTxt.value != "") {
          infTypeExistReq.open(
            "POST",
            "functionalPage/validationOps.php",
            false
          );
          infTypeExistReq.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
          );
          infTypeExistReq.send(
            "checkInfMessage=message&checkInfMessageID=" + inf_ID
          );
        } else {
          infTitleErr.innerHTML = "";
          infContentErr.innerHTML = "";
        }
        if (infTitleTxt.value != "")
          infTitleErr.innerHTML = "لا يمكن إضافة عنوان للرسالة";
      } else if (infClassTxt.value == 3) {
        if (infTitleTxt.value == "")
          infTitleErr.innerHTML = "يرجى إدخال عنوان للهدف";
        if (infContentTxt.value != "")
          infContentErr.innerHTML = "لا يمكن إضافة محتوى للاهداف";
      } else if (infClassTxt.value == 4) {
        if (infTitleTxt.value == "")
          infTitleErr.innerHTML = "يرجى إدخال العنوان للقيمة";
        if (infContentTxt.value == "")
          infContentErr.innerHTML = "يرجى إدخال المحتوى للقيمة";
      }
    } else if (infClassTxt.value >= 5) {
      if (infTitleTxt.value == "")
        infTitleErr.innerHTML = "يرجى إدخال عنوان الصورة";
      //
      if (infContentTxt.value == "")
        infContentErr.innerHTML = "يرجى إدخال منصب العضو في مربع محتوى الملومة";
      //
      if (infPhotoTxt.value == "" && infFrmBtn.name == "addBankInfBtn")
        infPhotoErr.innerHTML = "يرجى إختيار صورة للمحتوى";
    }
    //
    if (infTitleTxt.value.length > 250)
      infTitleErr.innerHTML = "لقد تجاوزت الطول المسموح للعنوان!";
    if (infContentTxt.value.length > 500)
      infContentErr.innerHTML = "لقد تجاوزت الطول المسموح للمحتوى!";
    //
    checkInfPhoto();
    infFrmCheckRes = true;
    for (let errNu = 0; errNu <= errLabels.length - 1; errNu++) {
      if (errLabels[errNu].innerHTML != "") {
        infFrmCheckRes = false;
        break;
      }
    }
    return infFrmCheckRes;
  }
  //
  document.getElementById("bnkInfDetailMdl").onsubmit = function () {
    return checkBankInfDetailFrm(infId);
  };
}

function regVlFirstInfo() {
  checkVlRegInf();
  let volFirstRegRes = true;
  const volFrom = document.getElementById("vol_sign_up");
  const volFrontForm = document.querySelector("#vol_front #vol_cont");
  const volFrontErrors = volFrontForm.getElementsByClassName("Error-Text");
  const volBackForm = document.querySelector("#vol_back #vol_cont");
  const volBackErrors = volBackForm.getElementsByClassName("Error-Text");
  //
  for (fErN = 0; fErN < volFrontErrors.length; fErN++) {
    if (volFrontErrors[fErN].innerHTML != "") {
      volFirstRegRes = false;
      break;
    }
  }
  //
  if (volFirstRegRes == true) {
    for (let erNo = 0; erNo < volBackErrors.length; erNo++) {
      volBackErrors[erNo].innerHTML = "";
    }
    volFrom.style.transform = "rotateY(180deg)";
  }
}

function vl_qualChange() {
  const vlQualCmbo = document.getElementsByName("edu_qual");
  let vlQualVal = vlQualCmbo[0].value;
  //
  const vlSpecCmbo = document.getElementById("edu_spec");
  if (vlQualVal == 0) vlSpecCmbo.style.opacity = "0";
  else vlSpecCmbo.style.opacity = "1";
}

function checkVlRegInf() {
  let vlRegCheckRes = "";
  let vlRegFrmData = new FormData(document.getElementById("vol_sign_up"));
  //
  const vlRegBackFrm = document.querySelector("#vol_back #vol_cont");
  //
  const checkVlRegReq = new XMLHttpRequest();
  checkVlRegReq.onreadystatechange = function () {
    if (checkVlRegReq.readyState == 4 && checkVlRegReq.status == 200) {
      vlRegCheckRes = checkVlRegReq.responseText;
      if (vlRegCheckRes == "vlRegError") {
        document.getElementById("volAddInfRegErr").innerHTML =
          "حدث خطاء اثناء التسجيل :( يرجى إعادة المحاولة لاحقاً";
      } else if (vlRegCheckRes == "vlRegSuccess") {
        vlRegBackFrm.innerHTML =
          "<h1>تم تسجيل حسابك بنجاح. يرجى التحقق من بريدك الإلكتروني لتفعيل حسابك</h1>";
      } else {
        vlRegCheckRes = vlRegCheckRes.split("(#)");
        document.getElementById("volFnameErr").innerHTML = vlRegCheckRes[0];
        document.getElementById("volLnameErr").innerHTML = vlRegCheckRes[1];
        document.getElementById("volPassErr").innerHTML = vlRegCheckRes[2];
        document.getElementById("volPassConfErr").innerHTML = vlRegCheckRes[3];
        document.getElementById("volEmailErr").innerHTML = vlRegCheckRes[4];
        document.getElementById("volGenderErr").innerHTML = vlRegCheckRes[5];
        //
        document.getElementById("vlBirthDateErr").innerHTML = vlRegCheckRes[6];
        document.getElementById("eduQualErr").innerHTML = vlRegCheckRes[7];
        document.getElementById("eduSpecErr").innerHTML = vlRegCheckRes[8];
        document.getElementById("volTalentErr").innerHTML = vlRegCheckRes[9];
        document.getElementById("arbLangErr").innerHTML = vlRegCheckRes[10];
        document.getElementById("engLangErr").innerHTML = vlRegCheckRes[11];
        document.getElementById("volLocGovErr").innerHTML = vlRegCheckRes[12];
        document.getElementById("volLocAreaErr").innerHTML = vlRegCheckRes[13];
        document.getElementById("vlSkillErr").innerHTML = vlRegCheckRes[14];
        document.getElementById("volAgreeErr").innerHTML = vlRegCheckRes[15];
      }
    }
  };
  //
  checkVlRegReq.open("POST", "functionalPage/signUpNewAcc.php", false);
  vlRegFrmData.append("volAddInfReg", "");
  checkVlRegReq.send(vlRegFrmData);
  //
  return false;
}

function showVolSignupTerms() {
  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<div class="ModalForm animateShowModal" id="volSignupTermsMdl">' +
    '<div class="containerBox">' +
    "<label>لوائح وضوابط المتطوع</label>" +
    '<button type="button" id="doSendNewPass"> اوافق </button>' +
    '<button type="button" id="clsSendNewPassMdl" name="clsModalRate" onClick="hideGeneralModal()">إغلاق</button>' +
    "</div></div>";
  detailShowModal.style.display = "block";
  //
  document
    .getElementById("doSendNewPass")
    .addEventListener("click", function () {
      document.getElementById("vol_agree").checked = "checked";
      hideGeneralModal();
    });
}

function ag_typeChange() {
  const agTypeCmbo = document.getElementsByName("ag_type");
  let agTypeVal = agTypeCmbo[0].value;
  //
  const agClass = document.getElementById("ag_class");
  if (agTypeVal == 0) agClass.style.display = "block";
  else agClass.style.display = "none";
}

function regAgFirstInfo() {
  checkAgRegInf();
  let AllowAgFormFlip = true;
  const agRegForm = document.getElementById("agy_sign_up");
  const agFrontFormErrs = document
    .getElementById("ag_front")
    .getElementsByClassName("Error-Text");
  const agBack = document.querySelector("#ag_back #ag_cont");
  const agBackError = agBack.getElementsByClassName("Error-Text");
  //
  for (
    let fAgFrmErrNum = 0;
    fAgFrmErrNum <= agFrontFormErrs.length - 1;
    fAgFrmErrNum++
  ) {
    if (agFrontFormErrs[fAgFrmErrNum].innerHTML != "") {
      AllowAgFormFlip = false;
      break;
    }
  }
  // flip to the back agency form only if the front form has noerrors.
  if (AllowAgFormFlip == true) {
    agRegForm.style.transform = "rotateY(180deg)";
    for (let erNo = 0; erNo < agBackError.length; erNo++) {
      agBackError[erNo].innerHTML = null;
      /*agBackError[erNo].style.backgroundColor = 'yellow';*/
    }
  }
}

function checkAgRegInf() {
  const regAgFrm = document.getElementById("agy_sign_up");
  let regAgFrmData = new FormData(regAgFrm);

  const regAgBackFrm = document.getElementById("ag_back");

  const agNameErr = document.getElementById("ag_nameErr");
  const agEmailErr = document.getElementById("ag_emailErr");
  const agPassErr = document.getElementById("ag_passErr");

  const agPassCnfErr = document.getElementById("ag_passconfErr");
  const agTypeErr = document.getElementById("ag_typeErr");
  const agClsErr = document.getElementById("ag_classErr");

  const agSpecErr = document.getElementById("ag_specErr");
  const agPhoneErr = document.getElementById("ag_phoneErr");
  const agAgreeErr = document.getElementById("agy_agree");

  const agRegErr = document.getElementById("ag_submitErr");

  const checkAgRegReq = new XMLHttpRequest();

  checkAgRegReq.onreadystatechange = function () {
    if (checkAgRegReq.readyState == 4 && checkAgRegReq.status == 200) {
      var checkAgRegRes = checkAgRegReq.responseText;

      if (checkAgRegRes == "agRegError") {
        agRegErr.innerHTML =
          "حدث خطاء اثناء تسجيل الحساب. يرجى المحاولة مرة اخرى!";
      } else if (checkAgRegRes == "agRegSuccess") {
        regAgBackFrm.innerHTML =
          '<div id="post"><h1>تم تسجيل حسابكم بنجاح. يرجى الإنتطار حتى يتم تفعيل حسابكم من قبل إدارةالموثع وسيتمالتواصل معكم حينها.</h1></div><br>';
      } else {
        checkAgRegRes = checkAgRegRes.split("^$");
        agNameErr.innerHTML = checkAgRegRes[0];
        agEmailErr.innerHTML = checkAgRegRes[1];
        agPassErr.innerHTML = checkAgRegRes[2];

        agPassCnfErr.innerHTML = checkAgRegRes[3];
        agTypeErr.innerHTML = checkAgRegRes[4];
        agClsErr.innerHTML = checkAgRegRes[5];

        agSpecErr.innerHTML = checkAgRegRes[6];
        agPhoneErr.innerHTML = checkAgRegRes[7];
        agAgreeErr.innerHTML = checkAgRegRes[8];
      }
    }
  };

  checkAgRegReq.open("POST", "functionalPage/signUpNewAcc.php", false);
  regAgFrmData.append("signAgAcc", "hello");
  checkAgRegReq.send(regAgFrmData);

  return false;
}

function showAgySignupTerms() {
  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<div class="ModalForm animateShowModal" id="agySignupTermsMdl">' +
    '<div class="containerBox">' +
    "<label>لوائح وضوابط الجهات</label>" +
    '<button type="button" id="doSendNewPass">نوافق</button>' +
    '<button type="button" id="clsSendNewPassMdl" name="clsModalRate" onClick="hideGeneralModal()">إغلاق</button>' +
    "</div></div>";
  detailShowModal.style.display = "block";
  //
  document
    .getElementById("doSendNewPass")
    .addEventListener("click", function () {
      document.getElementById("ag_agree").checked = "checked";
      hideGeneralModal();
    });
}

function showChanceMdl(Ch_ID) {
  const chInfReq = new XMLHttpRequest();
  chInfReq.onreadystatechange = function () {
    if (chInfReq.readyState == 4 && chInfReq.status == 200) {
      let chInfRes = chInfReq.responseText;
      detailShowModal.innerHTML =
        '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
        '<div class="ModalForm animateShowModal" id="viewChanceDetMdl">' +
        chInfRes +
        "</div>";
    }
  };

  chInfReq.open("POST", "functionalPage/validationOps.php", false);
  chInfReq.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  chInfReq.send("showChInfo=" + Ch_ID);

  detailShowModal.style.display = "block";
}

function hideGeneralModal() {
  detailShowModal.innerHTML = "";
  detailShowModal.style.display = "none";
}

function shareChance(shareChnID) {
  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<div class="ModalForm animateShowModal"><div id="password_div">' +
    "<form>" +
    '<textarea name="chnLinkTxt" id="volExpDesc"></textarea>' +
    '<button type="button" name="copyChnLink" id="adminAlterAccPass" onClick="copyChnLink()"> نسخ </button>' +
    '<button type="button" onClick="hideGeneralModal()" id="clsAddchanceMdl" name="clsAddchanceMdl">إلغاء</button>' +
    "</form>" +
    "</div>";
  detailShowModal.style.display = "block";

  let chnLinkTxt = document.getElementById("volExpDesc");
  let copyChnLink = document.getElementById("adminAlterAccPass");

  const chnLinkReq = new XMLHttpRequest();
  chnLinkReq.onreadystatechange = function () {
    if (chnLinkReq.readyState == 4 && chnLinkReq.status == 200) {
      chnLinkTxt.innerHTML = chnLinkReq.responseText;
    }
  };

  chnLinkReq.open("POST", "functionalPage/validationOps.php", false);
  chnLinkReq.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  chnLinkReq.send("copyChnLinkID=" + shareChnID);

  copyChnLink.addEventListener("click", function () {
    chnLinkTxt.select();
    chnLinkTxt.setSelectionRange(0, 99999);
    document.execCommand("copy");
  });
}

//raghed bagin <div id="password_div">
function showِAdminAlterPassMdl(accToAlter, accShowName, accType) {
  var PassAlterBtnName = "";

  if (accType == "VL") {
    PassAlterBtnName = "adminAlterVlPass";
  } else if (accType == "AG") {
    PassAlterBtnName = "adminAlterAgPass";
  }
  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<form class="ModalForm animateShowModal" action="functionalPage/adminPrivilege.php" onSubmit="return confAccAdminPass()" method="POST" id="changePassMdl">' +
    '<div class="containerBox">' +
    "<label>" +
    accShowName +
    "</label>" +
    '<input type="password" name="accNewPassAdmin" id="accNewPassAdmin"><p class="Error-Text" id="accNewPassErr"></p>' +
    '<input type="password" name="accNewPassConfAdmin" id="accNewPassConfAdmin">' +
    '<p class="Error-Text" id="accNewPassConfErr"></p><button type="submit" name="' +
    PassAlterBtnName +
    '" id="adminAlterAccPass">تأكيد</button>' +
    '<button type="button" onClick="hideGeneralModal()" id="clsAddchanceMdl" name="clsAddchanceMdl">إلغاء</button>' +
    "</div>" +
    "</form>";
  detailShowModal.style.display = "block";
  var changePassBtn = document.getElementById("adminAlterAccPass");
  changePassBtn.value = accToAlter;
  // alert('hello there');

  //raghed end
}

function confAccAdminPass() {
  var checkAdminAgNewPass = true;
  var agNewPassAdminTxt = document.getElementById("accNewPassAdmin");
  var agNewPassConfAdminTxt = document.getElementById("accNewPassConfAdmin");
  var agNewPassErrTxt = document.getElementById("accNewPassErr");
  var agNewPassConfErrTxt = document.getElementById("accNewPassConfErr");

  agNewPassErrTxt.innerHTML = "";
  agNewPassConfErrTxt.innerHTML = "";

  if (agNewPassAdminTxt.value == "") {
    agNewPassErrTxt.innerHTML = "يرجى إدخال كلمةالمرورالجديد";
    checkAdminAgNewPass = false;
  }

  if (agNewPassConfAdminTxt.value == "") {
    agNewPassConfErrTxt.innerHTML = "يرجى إدخال تأكيد كلمة المرور";
    checkAdminAgNewPass = false;
  }

  if (agNewPassAdminTxt.value != "" && agNewPassAdminTxt.value.length < 7) {
    agNewPassErrTxt.innerHTML =
      "يجب ان تكون كلمة المرور اطول من او تساوي 7 احرف";
    checkAdminAgNewPass = false;
  }

  if (
    agNewPassAdminTxt.value != "" &&
    agNewPassConfAdminTxt.value != "" &&
    agNewPassAdminTxt.value != agNewPassConfAdminTxt.value
  ) {
    agNewPassConfErrTxt.innerHTML =
      "كلمة المرور المدخلة وتأكيدها غير متطابقتان.";
    checkAdminAgNewPass = false;
  }
  return checkAdminAgNewPass;
}

function showAddNewChanceMdl(ChanceAgAcc) {
  let ChanceTypes = "";
  let ChanceClasses = "";
  let ChanceSpecialty = "";
  let ChanceLocation = "";

  const chnCombosReq = new XMLHttpRequest();
  chnCombosReq.onreadystatechange = function () {
    if (chnCombosReq.readyState == 4 && chnCombosReq.status == 200) {
      let chnCombosRes = chnCombosReq.responseText;
      chnCombosRes = chnCombosRes.split("%");
      ChanceTypes =
        chnCombosRes[0] + '<p class="Error-Text" id="Chn_Err_Type"></p>';
      ChanceClasses =
        chnCombosRes[1] + '<p class="Error-Text" id="Chn_Err_Field"></p>';
      ChanceSpecialty =
        chnCombosRes[2] + '<p class="Error-Text" id="Chn_Err_Spec"></p>';
      ChanceLocation = chnCombosRes[3];
    }
  };

  chnCombosReq.open("POST", "functionalPage/validationOps.php", false);
  chnCombosReq.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  chnCombosReq.send("getChnComboes=0");

  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<form action="functionalPage/agencyPrivilege.php" method="POST" class="ModalForm animateShowModal" onSubmit="return checkChnInfoFrm()" enctype="multipart/form-data" id="addEditChanceMdl">' +
    '<div class="containerBox">' +
    '<input type="text" id="ChnTitle" name="ChnTitle" placeholder="عنوان الفرصة">' +
    '<p class="Error-Text" id="Chn_Err_Title"></p> ' +
    '<div id="chnMainInfo">' +
    "<label>نوع الفرصة</label>" +
    ChanceTypes +
    "<label>عدد المتطوعين</label>" +
    '<input type="number" id="ChnCapacity" name="ChnCapacity" placeholder="عدد المتطوعين المطلوب">' +
    '<p class="Error-Text" id="Chn_Err_Capacity"></p> ' +
    "</div>" +
    '<div id="chnLocPayInfo">' +
    "<label>موقع الفرصة</label>" +
    '<p class="Error-Text" id="Chn_Err_Location"></p> ' +
    ChanceLocation +
    '<label class="bovCheckBox">مقابل مادي' +
    '<input type="checkbox" id="ChnPayment" name="ChnPayment">' +
    '<span id="checkmark"></span>' +
    "</label>" +
    "</div>" +
    '<div id="chnPeriodInfo">' +
    '<label class="chnFullTitle">فترة التطوع</label>' +
    "<h6>تاريخ إنتهاء التقديم</h6>" +
    '<input type="date" id="ChnDeadLine" name="ChnDeadLine" placeholder="تاريخ إنتهاء التقديم للفرصة">' +
    '<p class="Error-Text" id="Chn_Err_Deadline"></p> ' +
    "<h6>تاريخ بدء الفرصة</h6>" +
    '<input type="date" id="ChnStart" name="ChnStart" placeholder="تاريخ بدء الفرصة">' +
    '<p class="Error-Text" id="Chn_Err_Start"></p> ' +
    "<h6>تاريخ إنتهاء الفرصة</h6>" +
    '<input type="date" id="ChnEnd" name="ChnEnd" placeholder="تاريخ إنتهاء الفرصة">' +
    '<p class="Error-Text" id="Chn_Err_End"></p> ' +
    "</div>" +
    '<div id="chnFieldSpecInfo">' +
    '<label class="chnFullTitle">مجال التطوع</label>' +
    "<h6>مجال العمل</h6>" +
    ChanceClasses +
    "<h6>تخصص المجال</h6>" +
    ChanceSpecialty +
    "</div>" +
    '<div id="chnTasksListInfo"> ' +
    '<label class="chnFullTitle">قائمة المهام المطلوبة</label> ' +
    '<ul id="chnTasksList"> ' +
    '<li id="ChnTaskList0">' +
    '<input type="text" id="ChnTasks0" name="ChnTasks0"  ' +
    'class="ChnTasksTxt" placeholder="ادخل مهمة للفرصة هنا">' +
    '<p class="Error-Text" id="Chn_Err_Task0"></p>' +
    "</li>" +
    "</ul> " +
    '<p class="Error-Text" id="Chn_Err_Tasks"></p> ' +
    '<button type="button" onclick="addChanceTask()" class="addChnPoint">+</button>' +
    "</div> " +
    '<div id="chnTermsInfo"> ' +
    '<label class="chnFullTitle">شروط ومحددات الفرصة</label> ' +
    '<ul id="chnTermsList"> ' +
    '<li><input type="text" id="ChnTerms0" name="ChnTerms0" ' +
    'class="ChnTermsTxt" placeholder="ادخل شرط الفرصة">' +
    '<p class="Error-Text" id="Chn_Err_Term0"></p></li> ' +
    "</ul> " +
    '<p class="Error-Text" id="Chn_Err_Terms"></p> ' +
    '<button type="button" onclick="addChanceTerm()" class="addChnPoint">+</button>' +
    "</div> " +
    '<div id="chnNoteInfo">' +
    '<label class="chnFullTitle">تفاصيل إضافية</label>' +
    '<textarea id="ChnNote" name="ChnNote" cols="50" rows="10" placeholder="تفاصيل إضافية">' +
    "</textarea>" +
    '<p class="Error-Text" id="Chn_Err_Note"></p> ' +
    "</div>" +
    '<div id="chnFileInfo" style="display: none !important;">' +
    "<label>إستمارة التطوع</label>" +
    '<button type="button" id="infoFileBtn">إضافة إستمارة</button>' +
    '<input type="file" hidden="hidden" id="ChnFile" name="ChnFile">' +
    '<p class="Error-Text" id="Chn_Err_File"></p> ' +
    "</div>" +
    '<button type="submit" id="doAddChance" name="doAddChance">إضافة بيانات الفرصة</button>' +
    '<button type="button" onClick="hideGeneralModal()" id="clsAddchanceMdl" name="clsAddchanceMdl">إلغاء</button>' +
    "</div>" +
    "</form>";
  detailShowModal.style.display = "block";
}

function ChnSpecChange(reqType) {
  let chnWorkSpecCmbo;
  let chnWorkFieldVal;
  //
  if (reqType == 0) {
    chnWorkSpecCmbo = document.getElementById("ChnSpec");
    chnWorkFieldVal = document.getElementById("ChnField").value;
  } else if (reqType == 1) {
    chnWorkSpecCmbo = document.getElementById("volExpWorkSpec");
    chnWorkFieldVal = document.getElementById("volExpWorkField").value;
  }

  const chnWorkSpecReq = new XMLHttpRequest();
  chnWorkSpecReq.onreadystatechange = function () {
    if (chnWorkSpecReq.readyState == 4 && chnWorkSpecReq.status == 200) {
      chnWorkSpecCmbo.innerHTML = chnWorkSpecReq.responseText;
    }
  };

  chnWorkSpecReq.open("POST", "functionalPage/validationOps.php", false);
  chnWorkSpecReq.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  chnWorkSpecReq.send("getChnSpecCmboVal=" + chnWorkFieldVal);
}

function addChanceTask() {
  const ChnTasksUl = document.getElementById("chnTasksList");
  let ChnTaskTxtNu = document.getElementsByClassName("ChnTasksTxt").length;
  let ChnNewTaskLi = document.createElement("li");
  let ChnNewTaskTxt = document.createElement("input");
  let ChnNewTaskErr = document.createElement("p");
  let ChnNewTaskBtn = document.createElement("button");

  let ChnTaskPrevTxt = document.getElementById("ChnTasks" + (ChnTaskTxtNu - 1));
  let ChnTaskPrevErr = document.getElementById(
    "Chn_Err_Task" + (ChnTaskTxtNu - 1)
  );

  if (ChnTaskPrevTxt.value != "") {
    ChnNewTaskLi.setAttribute("id", "ChnTaskList" + ChnTaskTxtNu);

    ChnNewTaskTxt.setAttribute("id", "ChnTasks" + ChnTaskTxtNu);
    ChnNewTaskTxt.setAttribute("name", "ChnTasks" + ChnTaskTxtNu);
    ChnNewTaskTxt.setAttribute("class", "ChnTasksTxt");
    ChnNewTaskTxt.setAttribute("placeholder", "ادخل مهمة الفرصة");

    ChnNewTaskErr.setAttribute("class", "Error-Text");
    ChnNewTaskErr.setAttribute("id", "Chn_Err_Task" + ChnTaskTxtNu);

    ChnNewTaskBtn.setAttribute("type", "button");
    ChnNewTaskBtn.setAttribute("class", "pointBtn");
    ChnNewTaskBtn.setAttribute(
      "onClick",
      "removeChanceTask(" + ChnTaskTxtNu + ")"
    );
    ChnNewTaskBtn.innerHTML = "-";

    ChnNewTaskLi.appendChild(ChnNewTaskTxt);
    ChnNewTaskLi.appendChild(ChnNewTaskBtn);
    ChnNewTaskLi.appendChild(ChnNewTaskErr);

    ChnTasksUl.appendChild(ChnNewTaskLi);
    ChnTaskPrevErr.innerHTML = "";
  } else {
    ChnTaskPrevErr.innerHTML = "يرجى إدخال المهمة قبل إضافة مهمة جديدة";
  }
}

function removeChanceTask(ChnTaskID) {
  const ChnTaskUl = document.getElementById("vol_lest_5");
  const ChnTaskLi = document.getElementById("ChnTaskList" + ChnTaskID);
  let ChnTasks = ChnTaskUl.getElementsByClassName("ChnTasksTxt");
  let ChnTaskBtns = ChnTaskUl.getElementsByClassName("pointBtn");
  let ChnTaskLists = ChnTaskUl.getElementsByTagName("li");
  let ChnTaskErrs = ChnTaskUl.getElementsByTagName("p");
  ChnTaskUl.removeChild(ChnTaskLi);

  for (let lNu = 0; lNu <= ChnTasks.length - 1; lNu++) {
    ChnTasks[lNu].id = "ChnTasks" + lNu;
    ChnTasks[lNu].name = "ChnTasks" + lNu;
    ChnTaskLists[lNu].id = "ChnTaskList" + lNu;
    ChnTaskErrs[lNu].id = "Chn_Err_Task" + lNu;
  }

  for (let bNu = 0; bNu <= ChnTaskBtns.length - 1; bNu++) {
    ChnTaskBtns[bNu].setAttribute(
      "onClick",
      "removeChanceTask(" + (bNu + 1) + ")"
    );
  }
}

function addChanceTerm() {
  const ChnTermsUl = document.getElementById("chnTermsList");
  let ChnTermTxtNu = document.getElementsByClassName("ChnTermsTxt").length;
  let ChnNewTermLi = document.createElement("li");
  let ChnNewTermTxt = document.createElement("input");
  let ChnNewTermErr = document.createElement("p");
  let ChnNewTermBtn = document.createElement("button");

  let ChnTermPrevTxt = document.getElementById("ChnTerms" + (ChnTermTxtNu - 1));
  let ChnTermPrevErr = document.getElementById(
    "Chn_Err_Term" + (ChnTermTxtNu - 1)
  );

  if (ChnTermPrevTxt.value != "") {
    ChnNewTermLi.setAttribute("id", "ChnTermList" + ChnTermTxtNu);

    ChnNewTermTxt.setAttribute("id", "ChnTerms" + ChnTermTxtNu);
    ChnNewTermTxt.setAttribute("name", "ChnTerms" + ChnTermTxtNu);
    ChnNewTermTxt.setAttribute("class", "ChnTermsTxt");
    ChnNewTermTxt.setAttribute("placeholder", "ادخل شرط الفرصة");

    ChnNewTermErr.setAttribute("class", "Error-Text");
    ChnNewTermErr.setAttribute("id", "Chn_Err_Term" + ChnTermTxtNu);

    ChnNewTermBtn.setAttribute("type", "button");
    ChnNewTermBtn.setAttribute("class", "pointBtn");
    ChnNewTermBtn.setAttribute(
      "onClick",
      "removeChanceTerm(" + ChnTermTxtNu + ")"
    );
    ChnNewTermBtn.innerHTML = "-";

    ChnNewTermLi.appendChild(ChnNewTermTxt);
    ChnNewTermLi.appendChild(ChnNewTermBtn);
    ChnNewTermLi.appendChild(ChnNewTermErr);

    ChnTermsUl.appendChild(ChnNewTermLi);
    ChnTermPrevErr.innerHTML = "";
  } else {
    ChnTermPrevErr.innerHTML = "يرجى إدخال الشرط قبل إضافة شرط جديد";
  }
}

function removeChanceTerm(ChnTermID) {
  const ChnTermUl = document.getElementById("vol_lest_6");
  const ChnTermLi = document.getElementById("ChnTermList" + ChnTermID);
  let ChnTerms = ChnTermUl.getElementsByClassName("ChnTermsTxt");
  let ChnTermBtns = ChnTermUl.getElementsByClassName("pointBtn");
  let ChnTermLists = ChnTermUl.getElementsByTagName("li");
  let ChnTermErrs = ChnTermUl.getElementsByTagName("p");
  ChnTermUl.removeChild(ChnTermLi);

  for (let lNu = 0; lNu <= ChnTerms.length - 1; lNu++) {
    ChnTerms[lNu].id = "ChnTerms" + lNu;
    ChnTerms[lNu].name = "ChnTerms" + lNu;
    ChnTermLists[lNu].id = "ChnTermList" + lNu;
    ChnTermErrs[lNu].id = "Chn_Err_Term" + lNu;
  }

  for (let bNu = 0; bNu <= ChnTermBtns.length - 1; bNu++) {
    ChnTermBtns[bNu].setAttribute(
      "onClick",
      "removeChanceTerm(" + (bNu + 1) + ")"
    );
  }
}

function checkChnInfoFrm() {
  const ChnErrorLbls = document.getElementsByClassName("Error-Text");
  ChnErrorLblsRes = true;

  // Cahnce Title Text is Empty
  const TitleTxt = document.getElementById("ChnTitle");
  const TitleErr = document.getElementById("Chn_Err_Title");
  TitleErr.innerHTML = "";
  if (TitleTxt.value == "") TitleErr.innerHTML = "يرجى إدخال عنوان الفرصة";

  // Cahnce Capacity Text is Empty
  const CapacityTxt = document.getElementById("ChnCapacity");
  const CapacityErr = document.getElementById("Chn_Err_Capacity");
  CapacityErr.innerHTML = "";
  if (CapacityTxt.value == "")
    CapacityErr.innerHTML = "يرجى إدخال عدد المتطوعين المطلوب للفرصة";

  // Cahnce Starting Date is Empty
  const StartDate = document.getElementById("ChnStart");
  const StartErr = document.getElementById("Chn_Err_Start");
  StartErr.innerHTML = "";
  if (StartDate.value == "") StartErr.innerHTML = "يرجى إدخال تاريخ بدء الفرصة";

  // Cahnce Ending Date is Empty
  const EndDate = document.getElementById("ChnEnd");
  const EndErr = document.getElementById("Chn_Err_End");
  EndErr.innerHTML = "";
  if (EndDate.value == "") EndErr.innerHTML = "يرجى إدخال تاريخ نهاية الفرصة";

  // Cahnce Deadline Date is Empty
  const DeadlineDate = document.getElementById("ChnDeadLine");
  const DeadlineErr = document.getElementById("Chn_Err_Deadline");
  DeadlineErr.innerHTML = "";
  if (DeadlineDate.value == "")
    DeadlineErr.innerHTML = "يرجى إدخال تاريخ إنتهاء التقديم للفرصة";

  // Ensure dates are valid
  if (
    EndDate.value != "" &&
    StartDate.value != "" &&
    EndDate.value < StartDate.value
  )
    EndErr.innerHTML =
      "تاريخ نهاية الفرصة اقدم من تاريخ بداية الفرصة! يرجى التأكد من صحةالتواريخ المدخلة";

  if (
    StartDate.value != "" &&
    DeadlineDate.value != "" &&
    DeadlineDate.value > StartDate.value
  )
    DeadlineErr.innerHTML =
      "تاريخ إنتهاء التقديم احدث من تاريخ بدء الفرصة! يرجى التأكد من صحة التواريخ المدخلة";

  // Cahnce Location Text is Empty
  const LocationTxt = document.getElementById("ChnLocation");
  const LocationErr = document.getElementById("Chn_Err_Location");
  LocationErr.innerHTML = "";
  if (LocationTxt.value < 0) LocationErr.innerHTML = "يرجى إدخال موقع الفرصة";

  // Cahnce Type Text is Empty
  const TypeTxt = document.getElementById("ChnType");
  const TypeErr = document.getElementById("Chn_Err_Type");
  TypeErr.innerHTML = "";
  if (TypeTxt.value < 0) TypeErr.innerHTML = "يرجى إدخال نوع الفرصة";

  // Cahnce Field Text is Empty
  const FieldTxt = document.getElementById("ChnField");
  const FieldErr = document.getElementById("Chn_Err_Field");
  FieldErr.innerHTML = "";
  if (FieldTxt.value < 0) FieldErr.innerHTML = "يرجى إدخال مجال عمل الفرصة";

  // Cahnce Specialty Text is Empty
  const SpecialtyTxt = document.getElementById("ChnSpec");
  const SpecialtyErr = document.getElementById("Chn_Err_Spec");
  SpecialtyErr.innerHTML = "";
  if (SpecialtyTxt.value < 0)
    SpecialtyErr.innerHTML = "يرجى إدخال تخصص عمل الفرصة";

  // Chance File Choosen and checked
  const ChanceDocTxt = document.getElementById("ChnFile");
  const ChanceDocErr = document.getElementById("Chn_Err_File");
  const ChanceAddFrm = document.getElementById("addEditChanceMdl");
  const AddChnFrmData = new FormData(ChanceAddFrm);

  const CheckChnFileReq = new XMLHttpRequest();
  CheckChnFileReq.onreadystatechange = function () {
    if (CheckChnFileReq.readyState == 4 && CheckChnFileReq.status == 200) {
      CheckChnFileRes = CheckChnFileReq.responseText;
      if (CheckChnFileRes != "") ChanceDocErr.innerHTML = CheckChnFileRes;
      else ChanceDocErr.innerHTML = "";
    }
  };

  if (ChanceDocTxt.value != "") {
    CheckChnFileReq.open("POST", "functionalPage/validationOps.php", false);
    CheckChnFileReq.send(AddChnFrmData);
  }

  // Chaance Tasks
  let ChnWholTaskStr = "";
  const ChnaceTasksTxt = document.getElementsByClassName("ChnTasksTxt");
  const ChanceTasksErr = document.getElementById("Chn_Err_Tasks");
  for (let nu = 0; nu <= ChnaceTasksTxt.length - 1; nu++) {
    ChnWholTaskStr += ChnaceTasksTxt[nu].value + "(&)";
    if (nu == ChnaceTasksTxt.length - 1) {
      if (ChnWholTaskStr.length > 1250)
        ChanceTasksErr.innerHTML =
          "يرجى التقليل من النصوص في المهام حيث انكم قد تجاوزتم الحد المسموح لإجمالي نص المهام!";
    }

    let TaskErrLbl = document.getElementById("Chn_Err_Task" + nu);
    if (ChnaceTasksTxt[nu].value == "")
      TaskErrLbl.innerHTML =
        "يرجى حذف مربع المهمة او إدخال مهمة الفرصة وعدم تركه فارغ";
    else TaskErrLbl.innerHTML = "";
  }

  // Chaance Terms
  let ChnWholTermStr = "";
  const ChnaceTermsTxt = document.getElementsByClassName("ChnTermsTxt");
  const ChanceTermsErr = document.getElementById("Chn_Err_Terms");
  for (let nu = 0; nu <= ChnaceTermsTxt.length - 1; nu++) {
    ChnWholTermStr += ChnaceTermsTxt[nu].value + "(&)";
    if (nu == ChnaceTermsTxt.length - 1) {
      if (ChnWholTermStr.length > 1250)
        ChanceTermsErr.innerHTML =
          "يرجى التقليل من النصوص في الشروط حيث انكم قد تجاوزتم الحد المسموح لإجمالي نص الشروط!";
    }

    let TermErrLbl = document.getElementById("Chn_Err_Term" + nu);
    if (ChnaceTermsTxt[nu].value == "")
      TermErrLbl.innerHTML =
        "يرجى حذف مربع الشرط او إدخال شرط الفرصة وعدم تركه فارغ";
    else TermErrLbl.innerHTML = "";
  }

  // Chance note exceeds limit
  const ChnanceNoteTxt = document.getElementById("ChnNote");
  const ChanceNoteErr = document.getElementById("Chn_Err_Note");
  if (ChnanceNoteTxt.value.length > 250)
    ChanceNoteErr.innerHTML =
      "لقد تجاوزتم الحد المسموح للملاحظة. يرجى التقليل من النص المدخل!";
  else ChanceNoteErr.innerHTML = "";

  for (let errNo = 0; errNo <= ChnErrorLbls.length - 1; errNo++) {
    if (ChnErrorLbls[errNo].innerHTML != "") {
      ChnErrorLblsRes = false;
      break;
    } else {
      ChnErrorLblsRes = true;
    }
  }

  return ChnErrorLblsRes;
}

function showVlDetailMdl(VlID) {
  var vlPageInfo = "";
  const vlPageReq = new XMLHttpRequest();
  vlPageReq.onreadystatechange = function () {
    if (vlPageReq.readyState == 4 && vlPageReq.status == 200) {
      var pageReciever = vlPageReq.responseText;
      detailShowModal.innerHTML =
        '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
        '<form action="functionalPage/volunteerPrivilege.php" method="POST" class="ModalForm animateShowModal"' +
        'onSubmit="return checkVlExpInf()" id="aplViewDetailMdl">' +
        '<div class="containerBox">' +
        pageReciever +
        "</div>" +
        "</form>";
    }
  };

  vlPageReq.open("POST", "functionalPage/validationOps.php", false);
  vlPageReq.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  vlPageReq.send("showVlInfo=" + VlID);

  detailShowModal.style.display = "block";
}

function showAddEditExpMdl(ExpID, AddOrEdit) {
  let VlName,
    ExpPos,
    ExpOrg,
    ExpStart,
    ExpEnd,
    ExpSup,
    ExpSupEmail,
    ExpDesc,
    expField,
    expSpec;
  let BtnText = "",
    BtnName = "";

  const VolExpDetailReq = new XMLHttpRequest();
  VolExpDetailReq.onreadystatechange = function () {
    if (VolExpDetailReq.readyState == 4 && VolExpDetailReq.status == 200) {
      let VolExpInfStr = VolExpDetailReq.responseText;
      if (VolExpInfStr != "" && VolExpInfStr != null) {
        VolExpInfStr = VolExpInfStr.split("(EXP)");
        VlName = VolExpInfStr[0];
        ExpPos = VolExpInfStr[1];
        ExpOrg = VolExpInfStr[2];
        ExpStart = VolExpInfStr[3];
        ExpEnd = VolExpInfStr[4];
        ExpSup = VolExpInfStr[5];
        ExpSupEmail = VolExpInfStr[6];
        ExpDesc = VolExpInfStr[7];
        expField = VolExpInfStr[8];
        expSpec = VolExpInfStr[9];
      }
    }
  };

  if (AddOrEdit == "N") {
    BtnText = "إضافة";
    BtnName = "doAddVolExp";
  } else if (AddOrEdit == "O") {
    BtnText = "تعديل";
    BtnName = "doEditVolExp";
  }

  VolExpDetailReq.open("POST", "functionalPage/validationOps.php", false);
  VolExpDetailReq.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  VolExpDetailReq.send("showVolExpInf=" + ExpID + "&ExpShowType=" + AddOrEdit);

  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<form action="functionalPage/volunteerPrivilege.php" method="POST" class="ModalForm animateShowModal" onSubmit="return checkVlExpInf()" id="volEditAddExpMdl">' +
    '<div class="containerBox">' +
    '<h1 id="applicants_name">' +
    VlName +
    "</h1>" +
    '<div id="vlExpMainInfo">' +
    "<label>المسمى الوظيفي</label>" +
    '<input type="text" placeholder="المسمى الوظيفي للخيرة" id="volExpPos" name="volExpPos" value="' +
    ExpPos +
    '">' +
    '<p id="volExpPosErr" class="Error-Text"></p>' +
    "<label>تاريخ بدء الخبرة</label>" +
    '<input type="date" placeholder="تاريخ بدء الخبرة" id="volExpStart" name="volExpStart" value="' +
    ExpStart +
    '">' +
    '<p id="volExpStartErr" class="Error-Text"></p>' +
    "<label>تاريخ إنتهاء الخبرة</label>" +
    '<input type="date" placeholder="تاريخ إنتهاء الخبرة" id="volExpEnd" name="volExpEnd" value="' +
    ExpEnd +
    '">' +
    '<p id="volExpEndErr" class="Error-Text"></p>' +
    "</div>" +
    '<div id="vlExmAgencyInfo">' +
    "<label>الجهة التي عملت بها</label>" +
    '<input type="text" placeholder="إسم الجهة (منظمة.. شركة..)" id="volExpOrg" name="volExpOrg" value="' +
    ExpOrg +
    '">' +
    '<p id="volExpOrgErr" class="Error-Text"></p>' +
    "<label>المدير/المشرف</label>" +
    '<input type="text" placeholder="إسم المشرف/المدير" id="volExpSup" name="volExpSup" value="' +
    ExpSup +
    '">' +
    '<p id="volExpSupErr" class="Error-Text"></p>' +
    "<label>البريد الإلكتروني للمدير/المشرف</label>" +
    '<input type="email" placeholder="البريد الإلكتروني للمشرف/المدير" id="volExpSupEmail" name="volExpSupEmail" value="' +
    ExpSupEmail +
    '">' +
    '<p id="volExpSupEmailErr" class="Error-Text"></p>' +
    "</div>" +
    '<div id="vlExpCategoryInfo">' +
    "<label>مجال العمل</label>" +
    expField +
    '<p id="volExpWorkFieldErr" class="Error-Text"></p>' +
    "<label>تخصص المجال</label>" +
    expSpec +
    '<p id="volExpWorkSpecErr" class="Error-Text"></p>' +
    "</div>" +
    '<div id="vlExpDescInfo">' +
    "<label>وصف مختصر عن الخبرة</label>" +
    '<textarea id="volExpDesc" name="volExpDesc" placeholder="اكتب وصف للمهام في هذه الخبرة">' +
    ExpDesc +
    "</textarea>" +
    '<p class="Error-Text" id="volExpDescErr"></p>' +
    "</div>" +
    '<button type="submit" id="doAddVolExp" name="' +
    BtnName +
    '" value="' +
    ExpID +
    '"> ' +
    BtnText +
    " </button>" +
    '<button type="button" id="clo_add_exp" onClick="hideGeneralModal()"> إلغاء </button>' +
    "</div></form>";
  detailShowModal.style.display = "block";
  document
    .getElementById("volExpWorkField")
    .addEventListener("change", function () {
      ChnSpecChange(1);
    });
}

function deleteExpMdl(ExpID, AddOrEdit) {
  if (AddOrEdit == "D") {
    BtnText = "حذف";
    BtnName = "DeletVolExp";
  }
  const VolExpDetailReq = new XMLHttpRequest();
  VolExpDetailReq.open("POST", "functionalPage/validationOps.php", false);
  VolExpDetailReq.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  VolExpDetailReq.send("showVolExpInf=" + ExpID + "&ExpShowType=" + AddOrEdit);

  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<form action="functionalPage/volunteerPrivilege.php" method="POST" class="ModalForm animateShowModal" onSubmit="return checkVlExpInf()" id="volEditAddExpMdl">' +
    '<div class="containerBox">' +
    '<button type="submit" id="DeletVolExp" name="' +
    BtnName +
    '" value="' +
    ExpID +
    '"> ' +
    BtnText +
    " </button>" +
    '<button type="button" id="clo_add_exp" onClick="hideGeneralModal()"> إلغاء </button>' +
    "</div></form>";
  detailShowModal.style.display = "block";
  document
    .getElementById("volExpWorkField")
    .addEventListener("change", function () {
      ChnSpecChange(1);
    });
}

function checkVlExpInf() {
  let newExpRes = true;
  let expPosTxt = document.getElementById("volExpPos");
  let expOrgTxt = document.getElementById("volExpOrg");
  let expStartTxt = document.getElementById("volExpStart");
  let expEndTxt = document.getElementById("volExpEnd");
  let expSupTxt = document.getElementById("volExpSup");
  let expSupEmailTxt = document.getElementById("volExpSupEmail");
  let expDescTxt = document.getElementById("volExpDesc");
  let expFieldTxt = document.getElementById("volExpWorkField");
  let expSpecTxt = document.getElementById("volExpWorkSpec");

  let expPosErr = document.getElementById("volExpPosErr");
  let expOrgErr = document.getElementById("volExpOrgErr");
  let expStartErr = document.getElementById("volExpStartErr");
  let expEndErr = document.getElementById("volExpEndErr");
  let expSupErr = document.getElementById("volExpSupErr");
  let expSupEmailErr = document.getElementById("volExpSupEmailErr");
  let expDescErr = document.getElementById("volExpDescErr");
  let expFieldErr = document.getElementById("volExpWorkFieldErr");
  let expSpecErr = document.getElementById("volExpWorkSpecErr");

  expPosErr.innerHTML = "";
  if (expPosTxt.value == "") {
    expPosErr.innerHTML = "يرجى إدخال المسمى الوظيفي للخبرة";
    newExpRes = false;
  }
  expOrgErr.innerHTML = "";
  if (expOrgTxt.value == "") {
    expOrgErr.innerHTML = "يرجى إدخال إسم الجهة للخبرة";
    newExpRes = false;
  }
  expStartErr.innerHTML = "";

  if (expStartTxt.value == "") {
    expStartErr.innerHTML = "يرجى إدخال تاريخ بداية فترة الخبرة";
    newExpRes = false;
  }
  expEndErr.innerHTML = "";
  if (expEndTxt.value == "") {
    expEndErr.innerHTML = "يرجى إدخال تاريخ نهاية فترة الخبرة";
    newExpRes = false;
  }

  if (expStartTxt.value != "" && expEndTxt.value != "") {
    if (expStartTxt.value > expEndTxt.value) {
      expEndErr.innerHTML =
        "تاريخ بداية الفترة احدث من تاريخ نهايتها! يرجى التأكد من صحة التواريخ المدخلة";
      newExpRes = false;
    }
  }
  expSupErr.innerHTML = "";
  if (expSupTxt.value == "") {
    expSupErr.innerHTML = "يرجى إدخال إسمم مديرك او مشرفك بهذه الخبرة";
    newExpRes = false;
  }
  expSupEmailErr.innerHTML = "";
  if (expSupEmailTxt.value == "") {
    expSupEmailErr.innerHTML =
      "يرجى إدخال البريد الإلكتروني لمديرك او مشرفك بهذه الخبرة";
    newExpRes = false;
  }
  expDescErr.innerHTML = "";
  if (expDescTxt.value == "") {
    expDescErr.innerHTML = "يرجى إدخال وصف المهام للخبرة";
    newExpRes = false;
  } else if (expDescTxt.value.length > 250) {
    expDescErr.innerHTML = "لقد تجاوزت الحد المسموح لوصف المهام!";
    newExpRes = false;
  }
  expFieldErr.innerHTML = "";
  if (expFieldTxt.value < 0) {
    expFieldErr.innerHTML = "يرجى تحديد مجال العمل للخبرة";
    newExpRes = false;
  }
  expSpecErr.innerHTML = "";
  if (expSpecTxt.value < 0) {
    expSpecErr.innerHTML = "يرجى تحديد تخصص عمل الخبرة";
    newExpRes = false;
  }

  return newExpRes;
}

function createChildElement(
  elemTag,
  elemAttrName = null,
  elemAttrVal = null,
  elemParent = null,
  elemHTML = null,
  elemChildVal = null,
  elemParentID = null
) {
  let newElement = null;
  let numOfElem = 1;
  //
  if (elemChildVal != null) numOfElem = elemChildVal.length;
  else numOfElem = 1;
  //
  for (let nu = 0; nu < numOfElem; nu++) {
    newElement = document.createElement(elemTag);
    //
    if (elemAttrName != null) {
      for (let no = 0; no < elemAttrName.length; no++) {
        newElement.setAttribute(elemAttrName[no], elemAttrVal[no]);
      }
      if (elemHTML != null) newElement.innerHTML = elemHTML;
    }
    //
    if (elemParent != null) elemParent.appendChild(newElement);
  }
  //
  return newElement;
}

function showVlAlterInf(VlInfID) {
  let VlInfName,
    VlInfPhone,
    VlInfLang,
    VlInfSkil,
    VlInfPhoto,
    VlInfSkills,
    VlInfQual,
    VlInfSpec,
    VlInfSpecialty,
    VlInfGov,
    VlInfArea;
  const VlInfoReq = new XMLHttpRequest();
  VlInfoReq.onreadystatechange = function () {
    if (VlInfoReq.readyState == 4 && VlInfoReq.status == 200) {
      let VlWholeInfo = VlInfoReq.responseText;
      VlWholeInfo = VlWholeInfo.split("(^)");
      VlInfName = VlWholeInfo[0];
      VlInfPhone = VlWholeInfo[1];
      VlInfSkil = VlWholeInfo[2];
      VlInfPhoto = VlWholeInfo[3];
      VlInfLang = VlWholeInfo[4];
      VlInfQual = VlWholeInfo[5];
      VlInfSpec = VlWholeInfo[6];
      VlInfGov = VlWholeInfo[7];
      VlInfArea = VlWholeInfo[8];
      // Adding only the first specialty of the volunteer
      VlInfSpecialty = "";
      if (VlInfSpec != "" && VlInfSpec != null) {
        VlInfSpec = VlInfSpec.split("(,)");
        VlInfSpecialty = VlInfSpec[0];
        VlInfSpecialty +=
          '<button type="button" id="addSpecBtn" class="pointBtn">+</button>' +
          '<p class="Error-Text"></p>';
      }
      // Adding only the first volunteer skill
      VlInfSkills = "";
      if (VlInfSkil != "") {
        VlInfSkil = VlInfSkil.split("(&)");
        VlInfSkills =
          "<li>" +
          '<input type="text" name="vlSkill0" class="VolSkillTxt" value="' +
          VlInfSkil[0] +
          '" placeholder="ادخل المهارة">' +
          '<p class="Error-Text"></p>' +
          "</li>";
      }
    }
  };

  VlInfoReq.open("POST", "functionalPage/validationOps.php", false);
  VlInfoReq.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  VlInfoReq.send("getVolEditInfo=" + VlInfID);

  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<form action="functionalPage/volunteerPrivilege.php" method="POST" class="ModalForm animateShowModal" id="vlNewInfoMdl" enctype="multipart/form-data">' +
    '<div class="containerBox">' +
    '<div class="profileHead">' +
    '<img id="volPrfImg" src="vlPP/' +
    VlInfPhoto +
    '" alt="' +
    VlInfName +
    ' Photo">' +
    "<h1>" +
    VlInfName +
    "</h1>" +
    '<button type="button" id="volSelectPP">تغيير الصورة</button>' +
    '<input type="file" hidden="hidden" id="vlNewPic" name="volNewPic">' +
    '<p class="Error-Text" id="vlPhotoErr"></p>' +
    "</div>" +
    '<div id="vlNewPhoneInfo">' +
    '<label class="infoBigTitle">رقم الهاتف</label>' +
    '<input type="number" id="vlNewPhone" name="vlNewPhone" placeholder="رقم الهاتف" value="' +
    VlInfPhone +
    '" size="9">' +
    '<p class="Error-Text" id="vlPhoneErr"></p>' +
    '<label class="infoBigTitle">المحافظة</label>' +
    VlInfGov +
    '<p class="Error-Text" id="vlGovErr"></p>' +
    '<label class="infoBigTitle">المديرية</label>' +
    VlInfArea +
    '<p class="Error-Text" id="vlAreaErr"></p>' +
    "</div>" +
    '<div id="vlNewQualSpecInfo">' +
    '<label class="infoBigTitle">المؤهل الدراسي</label>' +
    VlInfQual +
    '<p class="Error-Text" id="vlQualErr"></p>' +
    '<label class="infoBigTitle">التخصص</label>' +
    VlInfSpecialty +
    "</div>" +
    '<div id="vlNewLangInfo">' +
    '<label class="infoBigTitle">اللغات</label>' +
    '<ul id="vlNewLangList">' +
    VlInfLang +
    "</ul>" +
    '<p class="Error-Text" id="vlNewLangsErr"></p>' +
    '<button type="button" id="addVlLang" name="addVlLang" class="pointBtn">+</button>' +
    "</div>" +
    '<div id="vlNewSkillInfo">' +
    '<label class="infoBigTitle">المهارات</label>' +
    '<ul id="vlNewSkillList">' +
    VlInfSkills +
    "</ul>" +
    '<button type="button" id="addVlSkill" class="pointBtn">+</button>' +
    "</div>" +
    '<div id="vlNewPassInfo">' +
    '<label class="infoBigTitle">تغيير كلمة المرور</label>' +
    "<h6>كلمة المرور الحالية</h6>" +
    '<input type="password" id="vlOldPass" name="vlOldPass" placeholder="كلمة المرور الحالية">' +
    '<p class="Error-Text" id="vlCurPassErr"></p>' +
    "<h6>كلمة المرور الجديدة</h6>" +
    '<input type="password" id="vlNewPass" name="vlNewPass" placeholder="كلمة المرور الجديدة">' +
    '<p class="Error-Text" id="vlnewPassErr"></p>' +
    "<h6>تأكيد كلمة المرور الجديدة</h6>" +
    '<input type="password" id="vlNewPassConf" name="vlNewPassConf" placeholder="تأكيد كلمة المرور الجديدة">' +
    '<p class="Error-Text" id="vlNewPassConfErr"></p>' +
    "</div>" +
    '<button type="submit" id="doEditVlAcc" name="doEditVlAcc" value="' +
    VlInfID +
    '"> تعديل </button>' +
    '<button type="button" id="close_edit_bage" onClick="hideGeneralModal()"> إلغاء </button>' +
    "</div>" +
    "</form>";
  //
  const inputVlForm = document.getElementById("vlNewInfoMdl");
  //
  document.getElementById("volSelectPP").addEventListener("click", function () {
    document.getElementById("vlNewPic").click();
  });
  //
  function checkVlImg() {
    let isVlImgGood = true;
    let checkVlNewPhotoRes = "";
    let vlFormData = new FormData(inputVlForm);
    const volNewPhotoErr = document.getElementById("vlPhotoErr");
    //
    let checkVlPrfImgReq = new XMLHttpRequest();
    checkVlPrfImgReq.onreadystatechange = function () {
      if (checkVlPrfImgReq.readyState == 4 && checkVlPrfImgReq.status == 200) {
        checkVlNewPhotoRes = checkVlPrfImgReq.responseText;
        if (checkVlNewPhotoRes != "")
          volNewPhotoErr.innerHTML = checkVlNewPhotoRes;
        else volNewPhotoErr.innerHTML = "";
      }
    };
    checkVlPrfImgReq.open("POST", "functionalPage/validationOps.php", false);
    checkVlPrfImgReq.send(vlFormData);
    return (isVlImgGood = checkVlNewPhotoRes == "");
  }
  document.getElementById("vlNewPic").addEventListener("change", function () {
    const volInfImg = document.getElementById("volPrfImg");
    let volImgTypeInf = this.files[0]["type"];
    const volImgReader = new FileReader();
    //
    volImgTypeInf = volImgTypeInf.split("/");
    volImgReader.onload = function () {
      if (volImgTypeInf[0] == "image") {
        if (checkVlImg()) volInfImg.src = volImgReader.result;
      }
    };
    volImgReader.readAsDataURL(this.files[0]);
  });
  //
  document.getElementById("volLocGov").addEventListener("change", function () {
    volLocGovChange();
  });
  //
  let vlSpecBoxSel = document
    .getElementById("vlNewQualSpecInfo")
    .getElementsByTagName("select");
  function vlEditQualSpec() {
    let vlSpecBoxErr = document
      .getElementById("vlNewQualSpecInfo")
      .getElementsByClassName("Error-Text");
    let canAddSpec;
    for (let selN = 0; selN < vlSpecBoxSel.length; selN++) {
      canAddSpec = false;
      vlSpecBoxErr[selN].innerHTML = "";
      if (vlSpecBoxSel[0].value < 1) {
        if (vlSpecBoxSel[0].value < 0)
          vlSpecBoxErr[0].innerHTML = "يرجى تحديد مؤهلك العلمي";
        if (selN > 0) {
          vlSpecBoxSel[selN].value = -1;
          vlSpecBoxSel[selN].disabled = true;
        }
      } else {
        vlSpecBoxSel[selN].disabled = false;
        if (vlSpecBoxSel[selN].value == -1)
          vlSpecBoxErr[selN].innerHTML = "يرجى تحديد تخصصك اوحذف المربع";
        else canAddSpec = true;
      }
    }
    return canAddSpec;
  }
  //
  function addVlSpec(vl2ndSpec = "") {
    let newSpecCont = vl2ndSpec;
    if (vl2ndSpec == "" || vl2ndSpec == null)
      newSpecCont = document.getElementById("edu_spec0").innerHTML;
    //
    document
      .getElementById("vlNewQualSpecInfo")
      .appendChild(
        createChildElement(
          "select",
          ["id", "name"],
          ["edu_spec1", "edu_spec1"],
          null,
          newSpecCont
        )
      );
    if (vl2ndSpec == "" || vl2ndSpec == null)
      document.getElementById("edu_spec1").value = -1;
    document
      .getElementById("vlNewQualSpecInfo")
      .appendChild(
        createChildElement(
          "button",
          ["id", "class", "type"],
          ["remSpecBtn", "pointBtn", "button"],
          null,
          "-"
        )
      );
    document
      .getElementById("vlNewQualSpecInfo")
      .appendChild(createChildElement("p", ["class"], ["Error-Text"]));
    //
    document
      .getElementById("remSpecBtn")
      .addEventListener("click", function () {
        document.getElementById("vlNewQualSpecInfo").removeChild(this);
        document
          .getElementById("vlNewQualSpecInfo")
          .removeChild(document.getElementById("edu_spec1"));
        document.getElementById("addSpecBtn").style.display = "block";
      });
    document.getElementById("addSpecBtn").style.display = "none";
  }
  document.getElementById("addSpecBtn").addEventListener("click", function () {
    if (vlEditQualSpec()) addVlSpec();
  });
  //
  if (VlInfSpec.length > 1) {
    addVlSpec(VlInfSpec[1]);
  }
  for (let seN = 0; seN < vlSpecBoxSel.length; seN++) {
    vlSpecBoxSel[seN].onchange = vlEditQualSpec;
  }
  //
  const vlLangList = document.getElementById("vlNewLangList");
  const vlLangLi = vlLangList.getElementsByTagName("li");
  function canAddNewLang() {
    let canAddLang;
    for (let num = 0; num < vlLangLi.length; num++) {
      canAddLang = true;
      let liChild = vlLangLi[num].children[0];
      let lichildOpt = vlLangLi[num].querySelectorAll('input[type="radio"]');
      let liChildErr = vlLangLi[num].getElementsByClassName("Error-Text")[0];
      if (liChild.tagName == "INPUT") {
        if (liChild.value == "" || liChild.value == null) {
          vlLangLi[num].getElementsByClassName("Error-Text")[0].innerHTML =
            "يرجى إدخال إسم اللغة";
          canAddLang = false;
        }
      }
      if (canAddLang == true) {
        canAddLang = false;
        for (let lNo = 0; lNo < lichildOpt.length; lNo++) {
          if (lichildOpt[lNo].checked) {
            canAddLang = true;
            break;
          }
        }
        if (canAddLang == false)
          liChildErr.innerHTML = "يرجى تحديد مستوى إتقانك للغة";
        else liChildErr.innerHTML = "";
      }
    }
    //
    let liLangErr = vlLangList.getElementsByClassName("Error-Text");
    for (let errN = 0; errN < liLangErr.length; errN++) {
      if (liLangErr[errN].innerHTML != "") {
        canAddLang = false;
        break;
      }
    }
    return canAddLang;
  }
  document.getElementById("addVlLang").addEventListener("click", function () {
    let newLangLvlNames = ["اللغة الام", "جيد", "متوسط", "ممتاز"];
    let langsNum = vlLangLi.length;
    //
    if (canAddNewLang()) {
      let liNewLangNum = vlLangList.getElementsByClassName("VolLangTxt").length;
      langsNum++;
      //
      let newLangLi = createChildElement("li");
      let newLangTxt = createChildElement(
        "input",
        ["class", "name", "type", "placeholder"],
        ["VolLangTxt", "vlNewLangName" + liNewLangNum, "text", "ادخل اللغة"],
        newLangLi
      );
      let newLangBtn = createChildElement(
        "button",
        ["class", "type"],
        ["pointBtn remVlLang", "button"],
        newLangLi,
        "-"
      );
      //
      for (let i = 0; i < newLangLvlNames.length; i++) {
        let newLangLbl = createChildElement(
          "label",
          ["class", "for"],
          ["bovRadioButton", "langs" + liNewLangNum + "Lvl" + (i + 1)],
          newLangLi,
          newLangLvlNames[i]
        );
        let newLangLblInput = createChildElement(
          "input",
          ["id", "type", "name", "value"],
          [
            "langs" + liNewLangNum + "Lvl" + (i + 1),
            "radio",
            "langs" + liNewLangNum + "Lvl",
            i + 1,
          ],
          newLangLbl
        );
        let newLangLblSpan = createChildElement("span", null, null, newLangLbl);
      }
      let newLangErr = createChildElement(
        "p",
        ["class", "id"],
        ["Error-Text", "langsErr" + liNewLangNum],
        newLangLi
      );
      vlLangList.appendChild(newLangLi);
      //
      newLangBtn.addEventListener("click", function () {
        vlLangList.removeChild(this.parentElement);
        //
        let numTxt = 0;
        for (let remLNo = 0; remLNo < vlLangLi.length; remLNo++) {
          let currRemLang = vlLangLi[remLNo].children[0];
          let currRemLangOpt = vlLangLi[remLNo].querySelectorAll(
            'input[type="radio"]'
          );
          let currRemLangErr = vlLangLi[remLNo].getElementsByClassName(
            "Error-Text"
          )[0];
          if (currRemLang.tagName == "INPUT") {
            currRemLang.setAttribute("name", "vlNewLangName" + numTxt);
            currRemLangErr.setAttribute("id", "langsErr" + numTxt);
            for (let lvNo = 0; lvNo < currRemLangOpt.length; lvNo++) {
              currRemLangOpt[lvNo].setAttribute(
                "id",
                "langs" + numTxt + "Lvl" + (lvNo + 1)
              );
              currRemLangOpt[lvNo].setAttribute(
                "name",
                "langs" + numTxt + "Lvl"
              );
              currRemLangOpt[lvNo].parentElement.setAttribute(
                "for",
                "langs" + numTxt + "Lvl" + (lvNo + 1)
              );
            }
            numTxt++;
          }
        }
      });
    }
  });
  // Giving add volunteer button its functionality
  const vlSkillList = document.getElementById("vlNewSkillList");
  let vlSkillsLi = vlSkillList.getElementsByTagName("li");
  function canAddNewSkill() {
    let canListAddSkill = true;
    //
    for (let sklId = 0; sklId < vlSkillsLi.length; sklId++) {
      vlSkillsLi[sklId].getElementsByClassName("Error-Text")[0].innerHTML = "";
      if (vlSkillsLi[sklId].children[0].value == "") {
        vlSkillsLi[sklId].getElementsByClassName("Error-Text")[0].innerHTML =
          "يرجى إدخال المهارة او حذف مربع الإدخال";
        canListAddSkill = false;
      }
    }
    return canListAddSkill;
  }
  function addVolSkill(skillTxtVal = "") {
    let newSkillName = "vlSkill" + vlSkillsLi.length;
    //
    if (canAddNewSkill()) {
      let vlNewSkill = createChildElement("li", null, null, vlSkillList);
      let vlNewSkillTxt = createChildElement(
        "input",
        ["name", "type", "placeholder", "value"],
        [newSkillName, "text", "ادخل المهارة", skillTxtVal],
        vlNewSkill
      );
      let vlNewSkillBtn = createChildElement(
        "button",
        ["class", "type"],
        ["pointBtn", "button"],
        vlNewSkill,
        "-"
      );
      let vlNewSkillErr = createChildElement(
        "p",
        ["class"],
        ["Error-Text"],
        vlNewSkill,
        ""
      );
      vlNewSkillBtn.addEventListener("click", function () {
        vlSkillList.removeChild(this.parentElement);
        for (let liNu = 0; liNu < vlSkillsLi.length; liNu++) {
          vlSkillsLi[liNu].children[0].setAttribute("name", "vlSkill" + liNu);
        }
      });
    }
  }
  //
  document.getElementById("addVlSkill").addEventListener("click", function () {
    addVolSkill();
  });
  if (VlInfSkil.length > 1) {
    for (let sklN = 1; sklN < VlInfSkil.length; sklN++) {
      addVolSkill(VlInfSkil[sklN]);
    }
  }
  //
  detailShowModal.style.display = "block";
  // Function to checkif all information are appropriate and complete before submiting new edits
  function checkVlEditPage(vl_ID) {
    let isNewVlInfoGood;
    // Check Phne number
    document.getElementById("vlPhoneErr").innerHTML = "";
    if (document.getElementById("vlNewPhone").value == "")
      document.getElementById("vlPhoneErr").innerHTML = "يرجى إدخال رقم هاتفك";
    else if (document.getElementById("vlNewPhone").value.length < 9)
      document.getElementById("vlPhoneErr").innerHTML =
        "يجب ان لا يقل الرقم عن 9 ارقام";
    // Check volunteer Adress fields
    document.getElementById("vlGovErr").innerHTML = "";
    if (!(document.getElementById("volLocGov").value >= 0))
      document.getElementById("vlGovErr").innerHTML = "يرجى إختيار محافظتك";
    document.getElementById("vlAreaErr").innerHTML = "";
    if (!(document.getElementById("volLocArea").value >= 0))
      document.getElementById("vlAreaErr").innerHTML = "يرجى إختيار مديريتك";
    // Check all info in thei boxes
    vlEditQualSpec();
    canAddNewLang();
    canAddNewSkill();
    checkVlImg();
    // Check if volunteer changed password
    if (document.getElementById("vlOldPass").value != "") {
      if (document.getElementById("vlOldPass").value.length < 7) {
        document.getElementById("vlCurPassErr").innerHTML =
          "طول كلمة المرور لا يقل عن سبعة رموز";
      } else {
        let checkVlPassReq = new XMLHttpRequest();
        checkVlPassReq.onreadystatechange = function () {
          if (checkVlPassReq.readyState == 4 && checkVlPassReq.status == 200) {
            var volOldPassCheckRes = checkVlPassReq.responseText;
            if (volOldPassCheckRes != "") {
              document.getElementById("vlCurPassErr").innerHTML =
                checkVlPassReq.responseText;
            } else {
              document.getElementById("vlCurPassErr").innerHTML = "";
              if (document.getElementById("vlNewPass").value == "") {
                document.getElementById("vlnewPassErr").innerHTML =
                  "يرجى إدخال كلمة المرور الجديدة!";
              } else if (
                document.getElementById("vlNewPass").value.length < 7
              ) {
                document.getElementById("vlnewPassErr").innerHTML =
                  "كلمة المرور يجب ان تتكون من سبعة رموز او اكثر";
              } else {
                document.getElementById("vlnewPassErr").innerHTML = "";
                if (document.getElementById("vlNewPassConf").value.length < 7) {
                  document.getElementById("vlNewPassConfErr").innerHTML =
                    "كلمة المرور يجب ان تتكون من سبعة رموز او اكثر";
                } else if (
                  document.getElementById("vlNewPassConf").value !=
                  document.getElementById("vlNewPass").value
                ) {
                  document.getElementById("vlNewPassConfErr").innerHTML =
                    "كلمة المرور وتأكيدها غير متطابقتان";
                } else {
                  document.getElementById("vlNewPassConfErr").innerHTML = "";
                }
              }
            }
          }
        };
        checkVlPassReq.open("POST", "functionalPage/validationOps.php", false);
        checkVlPassReq.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        checkVlPassReq.send(
          "checkVlCurPass=" +
            document.getElementById("vlOldPass").value +
            "&volPassToCheck=" +
            vl_ID
        );
      }
    }
    // Check error texts if empty or not to prevent or allow submition in case of no errors
    let vlEditInfFrmCon = document.querySelector("#vlNewInfoMdl .containerBox");
    let vlEditInfoErrs = vlEditInfFrmCon.querySelectorAll(".Error-Text");
    for (let erN = 0; erN < vlEditInfoErrs.length; erN++) {
      isNewVlInfoGood = true;
      if (vlEditInfoErrs[erN].innerHTML != "") {
        isNewVlInfoGood = false;
        break;
      }
    }
    return isNewVlInfoGood;
  }
  // Giving the form the function that prevents it from submiting if info is inapropriate
  document.getElementById("vlNewInfoMdl").onsubmit = function () {
    return checkVlEditPage(VlInfID);
  };
}
//
document.getElementById("volLocGov").addEventListener("change", function () {
  volLocGovChange();
});
//
function volLocGovChange() {
  const vlAreaReq = new XMLHttpRequest();
  vlAreaReq.onreadystatechange = function () {
    if (vlAreaReq.readyState == 4 && vlAreaReq.status == 200) {
      document.getElementById("volLocArea").innerHTML = vlAreaReq.responseText;
      document.getElementById("volLocArea").disabled = false;
    }
  };
  if (document.getElementById("volLocGov").value >= 0) {
    vlAreaReq.open("POST", "functionalPage/validationOps.php", false);
    vlAreaReq.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    vlAreaReq.send(
      "getVlEditAreaVal=" + document.getElementById("volLocGov").value
    );
  } else {
    document.getElementById("volLocArea").value = -1;
    document.getElementById("volLocArea").disabled = true;
  }
}
//
function showAgAlterInf(agInfID) {
  var agInfName,
    agInfAppr,
    agInfType,
    agInfPhone,
    agInfBranch,
    agInfAddress,
    agInfSocial,
    agInfPhoto;
  const agInfoReq = new XMLHttpRequest();
  agInfoReq.onreadystatechange = function () {
    if (agInfoReq.readyState == 4 && agInfoReq.status == 200) {
      var agWholeInfo = agInfoReq.responseText;
      agWholeInfo = agWholeInfo.split("#");
      agInfName = agWholeInfo[0];
      agInfAppr = agWholeInfo[1];
      agInfType = agWholeInfo[2];
      agInfPhone = agWholeInfo[3];
      agInfBranch = agWholeInfo[4];
      agInfAddress = agWholeInfo[5];
      agInfSocial = agWholeInfo[6];
      agInfPhoto = agWholeInfo[7];
    }
  };
  agInfoReq.open("POST", "functionalPage/validationOps.php", false);
  agInfoReq.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded"
  );
  agInfoReq.send("getAgcEditInfo=" + agInfID);

  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<form action="functionalPage/agencyPrivilege.php" method="POST" class="ModalForm animateShowModal" id="agNewInfoMdl" enctype="multipart/form-data">' +
    '<div class="containerBox">' +
    '<div class="profileHead">' +
    '<img src="agPP/' +
    agInfPhoto +
    '" id="agency_img" alt="' +
    agInfName +
    ' Logo" name="agCurPhoto">' +
    '<h1 id="Agency_name">' +
    agInfName +
    "</h1>" +
    '<h2 id="Agency_kind">' +
    agInfType +
    "</h2>" +
    '<button type="button" id="agIconBtn" name="agIconBtn">تغيير الشعار</button>' +
    '<input type="file" hidden="hidden" id="agNewPhotoTxt" name="agNewPhoto">' +
    '<p id="agNewPhotoErr" class="Error-Text"></p>' +
    "</div>" +
    '<div id="agNewApprBox">' +
    '<label class="infoBigTitle">إختصار للإسم</label>' +
    '<input type="text" id="agNewApprTxt"  name="agNewApprTxt" value="' +
    agInfAppr +
    '" placeholder="إختصار إسم الجهة - إن وجد">' +
    "</div>" +
    '<div id="agNewPhoneBox">' +
    '<label class="infoBigTitle">رقم الهاتف</label>' +
    '<input type="text" id="agNewPhoneTxt" name="agNewPhoneTxt" value="' +
    agInfPhone +
    '" placeholder="رقم الهاتف">' +
    '<p id="agNewPhoneErr" class="Error-Text"></p>' +
    "</div>" +
    '<div id="agNewAdresses">' +
    '<label class="infoBigTitle">عناوين الجهة</label>' +
    "<h6>فروع الجهة (إن وجد)</h6>" +
    '<input type="text" id="agNewBranchTxt" name="agNewBranchTxt" value="' +
    agInfBranch +
    '" placeholder="الفروع">' +
    '<p id="agNewBranchErr" class="Error-Text"></p>' +
    "<h6>عنوان موقع الجهة</h6>" +
    '<input type="text" id="agNewِAddressTxt" name="agNewِAddressTxt" value="' +
    agInfAddress +
    '" placeholder="عنوان الجهة">' +
    '<p id="agNewِAddressErr" class="Error-Text"></p>' +
    "<h6>موقع إلكتروني / تواصل إجتماعي</h6>" +
    '<input type="text" id="agNewSocTxt" name="agNewSocTxt" value="' +
    agInfSocial +
    '" placeholder="عنوان مواقع التواصل الإجتماعي">' +
    '<p id="agNewSocErr" class="Error-Text"></p>' +
    "</div>" +
    '<div id="agNewPass">' +
    '<label class="infoBigTitle">تغيير كلمة المرور</label>' +
    "<h6>كلمة المرور الحالية</h6>" +
    '<input type="password" id="agOldPassTxt" name="agOldPassTxt" placeholder="كلمة المرور الحالية">' +
    '<p id="agOldPassErr" class="Error_Text"></p>' +
    "<h6>كلمة المرور الجديدة</h6>" +
    '<input type="password" id="agNewPassTxt" name="agNewPassTxt" placeholder="كلمةالمرور الجديدة">' +
    '<p id="agNewPassErr" class="Error_Text"></p>' +
    "<h6>تأكيد كلمة المرورو الجديدة</h6>" +
    '<input type="password" id="agNewPassConfTxt" name="agNewPassConfTxt" placeholder="تأكيد كلمة المرور الجديدة">' +
    '<p id="agNewPassConfErr" class="Error_Text"></p>' +
    "</div>" +
    '<button type="submit" id="alterAgNewInf" name="alterAgNewInf" value="' +
    agInfID +
    '">تعديل</button>' +
    '<button type="button" id="clsModalRate2" name="clsModalRate" onClick="hideGeneralModal()">إلغاء</button>' +
    "</div>" +
    "</form>";
  //
  detailShowModal.style.display = "block";
  //
  const agNewInfoFrm = document.getElementById("agNewInfoMdl");
  //
  const agNewPhoneTxt = document.getElementById("agNewPhoneTxt");
  const agNewPhoneErr = document.getElementById("agNewPhoneErr");
  const agOldPassTxt = document.getElementById("agOldPassTxt");
  const agOldPassErr = document.getElementById("agOldPassErr");
  const agNewPassTxt = document.getElementById("agNewPassTxt");
  const agNewPassErr = document.getElementById("agNewPassErr");
  const agNewPassConfTxt = document.getElementById("agNewPassConfTxt");
  const agNewPassConfErr = document.getElementById("agNewPassConfErr");
  //
  let agIconChangeFile = document.getElementById("agNewPhotoTxt");
  const agIconChangeErr = document.getElementById("agNewPhotoErr");
  //
  function checkAgNewLogo() {
    let isAgNewIconOK = true;
    const agNewInfoFrmData = new FormData(agNewInfoFrm);
    //
    const checkAgPrfImgReq = new XMLHttpRequest();
    checkAgPrfImgReq.onreadystatechange = function () {
      if (checkAgPrfImgReq.readyState == 4 && checkAgPrfImgReq.status == 200) {
        agIconChangeErr.innerHTML = checkAgPrfImgReq.responseText;
      }
    };
    if (agIconChangeFile.value != "") {
      checkAgPrfImgReq.open("POST", "functionalPage/validationOps.php", false);
      checkAgPrfImgReq.send(agNewInfoFrmData);
    }
    if (agIconChangeErr.innerHTML != "") {
      isAgNewIconOK = false;
      agIconChangeFile.value = "";
    }
    //
    return isAgNewIconOK;
  }
  agIconChangeFile.addEventListener("change", function () {
    let agInfImg = document.getElementById("agency_img");
    if (this.value != "") {
      let agFileTypeInf = this.files[0]["type"];
      agFileTypeInf = agFileTypeInf.split("/");
      //
      const agImgReader = new FileReader();
      agImgReader.onload = function () {
        if (agFileTypeInf[0] == "image")
          if (checkAgNewLogo()) agInfImg.src = agImgReader.result;
      };
      agImgReader.readAsDataURL(this.files[0]);
    }
  });
  document.getElementById("agIconBtn").addEventListener("click", function () {
    agIconChangeFile.click();
  });
  function checkِAgNewInfo(ag_ID) {
    let checkAgNewInfo = true;
    const checkAgPassReq = new XMLHttpRequest();
    //
    agNewPhoneErr.innerHTML = "";
    agNewPassErr.innerHTML = "";
    agNewPassConfErr.innerHTML = "";
    //
    checkAgPassReq.onreadystatechange = function () {
      if (checkAgPassReq.readyState == 4 && checkAgPassReq.status == 200) {
        var checkAgPassRes = checkAgPassReq.responseText;
        if (checkAgPassRes != "") agOldPassErr.innerHTML = checkAgPassRes;
        else agOldPassErr.innerHTML = "";
      }
    };
    //
    if (agNewPhoneTxt.value == "") {
      agNewPhoneErr.innerHTML = "يرجى إدخال رقم الهاتف الخاص بكم";
      checkAgNewInfo = false;
    } else if (
      agNewPhoneTxt.value.length < 9 &&
      agNewPhoneTxt.value.length < 8
    ) {
      agNewPhoneErr.innerHTML = "يجب ان يكون رقم الهاتف مكون من 8 او 9 ارقام";
      checkAgNewInfo = false;
    }

    if (agOldPassTxt.value != "") {
      if (agOldPassTxt.value.length < 7) {
        agOldPassErr.innerHTML = "كلمة المرور المدخلة اقصر من 7 احرف";
        checkAgNewInfo = false;
      } else if (agOldPassTxt.value.length >= 7) {
        checkAgPassReq.open("POST", "functionalPage/validationOps.php", false);
        checkAgPassReq.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        checkAgPassReq.send(
          "agPass_Txt=" + agOldPassTxt.value + "&agPass_ID=" + ag_ID
        );

        if (agOldPassErr.innerHTML == "") {
          checkAgNewInfo = false;
          if (agNewPassTxt.value == "")
            agNewPassErr.innerHTML = "يرجى إدخال كلمة المرور الجديدة";
          else if (agNewPassTxt.value.length < 7)
            agNewPassErr.innerHTML =
              "يجب ان يكون طول كلمة المرور 7 احرف او اكثر";
          else if (agNewPassConfTxt.value == "")
            agNewPassConfErr.innerHTML = "يرجى إدخال تأكيد كلمة المرور الجديدة";
          else if (agNewPassTxt.value != agNewPassConfTxt.value)
            agNewPassConfErr.innerHTML =
              "كلمة المرور التي ادخلتها لا تتوافق مع تأكيد كلمة المرور";
          else checkAgNewInfo = true;
        }
      }
    } else {
      if (agNewPassTxt.value != "" || agNewPassConfTxt.value != "") {
        agOldPassErr.innerHTML = "يرجى إدخال كلمة المرور الحالية!";
      }
    }
    if (agIconChangeFile.value == "") {
      agIconChangeErr.innerHTML = "";
    }
    if (
      agIconChangeErr.innerHTML == "" &&
      agOldPassErr.innerHTML == "" &&
      checkAgNewInfo == true
    ) {
      return true;
    } else {
      return false;
    }
  } //End of checkِAgNewInfo
  agNewInfoFrm.onsubmit = function () {
    return checkِAgNewInfo(agInfID);
  };
}

function showRateVolMdl(volName, VolID) {
  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<form action="functionalPage/agencyPrivilege.php" method="POST" onSubmit="return checkVlRateInfo()"' +
    ' class="ModalForm animateShowModal" id="rateVolMdl">' +
    '<div class="containerBox">' +
    '<label id="volRateName"></label>' +
    '<input type="number" name="volRate" id="volRateValue" placeholder="تقييم المتطوع" min="1" max="5">' +
    '<p id="rateValErr" class="Error_Text"></p>' +
    '<textarea type="text" class="volRateComment" name="volRateComment" id="volRateComment" placeholder="تقرير عن المتطوع"></textarea>' +
    '<p id="rateComErr" class="Error_Text"></p>' +
    '<button type="submit" id="doRateVol" name="doRateVol" value="">حفظ التقييم</button>' +
    '<button type="button" id="clsModalRate" name="clsModalRate" onClick="hideGeneralModal()">إلغاء</button>' +
    "</div></form>";
  detailShowModal.style.display = "block";

  const rateId = document.getElementById("doRateVol");
  const rateName = document.getElementById("volRateName");

  rateName.innerHTML = volName;
  rateId.value = VolID;
}

function checkVlRateInfo() {
  let rateCheckRes = true;

  const rateValueTxt = document.getElementById("volRateValue");
  const rateCommentTxt = document.getElementById("volRateComment");

  const rateValueErr = document.getElementById("rateValErr");
  const rateCommentErr = document.getElementById("rateComErr");

  rateValueErr.innerHTML = "";
  if (rateValueTxt.value == "") {
    rateValueErr.innerHTML = "يرجى إدخال تقييمكم لاداء المتطوع";
    rateCheckRes = false;
  } else if (rateValueTxt.value != "" && rateValueTxt.value > 5) {
    rateValueErr.innerHTML = "يرجى إدخال قيمة اقل من 5 لتقييم المتطوع";
    rateCheckRes = false;
  }

  rateCommentErr.innerHTML = "";
  if (rateCommentTxt.value == "") {
    rateCommentErr.innerHTML = "يرجى إدخال تقريركم عن اداء المتطوع";
    rateCheckRes = false;
  }

  return rateCheckRes;
}

function showForgetPassMdl() {
  detailShowModal.innerHTML =
    '<span onClick="hideGeneralModal()" class="closeModal" title="إغلاق النافذة">&times;</span>' +
    '<form action="functionalPage/validationOps.php" method="POST" onSubmit="return checkForgetPassEmail()"' +
    ' class="ModalForm animateShowModal" id="forgetPassMdl">' +
    '<div class="containerBox">' +
    "<label>يرجى إدخال البريد الإلكتروني الخاص بحسابك</label>" +
    '<input type="email" name="forgetUserEmail" id="accForgetEmail">' +
    '<p id="forgetUserEmailErr" class="Error_Text"></p>' +
    '<button type="submit" id="doSendNewPass" name="doSendNewPass" value=""> إرسال  </button>' +
    '<button type="button" id="clsSendNewPassMdl" name="clsModalRate" onClick="hideGeneralModal()">إلغاء</button>' +
    "</div></form>";
  detailShowModal.style.display = "block";
}

function checkForgetPassEmail() {
  let CheckEmailRes = true;
  const EnteredEmailTxt = document.getElementById("accForgetEmail");
  const EnteredEmailErr = document.getElementById("forgetUserEmailErr");
  const ChangePassFrm = document.getElementById("post");

  const CheckForgetEmailReq = new XMLHttpRequest();
  CheckForgetEmailReq.onreadystatechange = function () {
    if (
      CheckForgetEmailReq.readyState == 4 &&
      CheckForgetEmailReq.status == 200
    ) {
      var checkForgEmailRes = CheckForgetEmailReq.responseText;
      if (checkForgEmailRes == "WorongEmail") {
        EnteredEmailErr.innerHTML =
          "هذا البريد الإلكتروني غير موجود يرجى التأكد من صحة البريد الإلكتروني المدخل!";
        CheckEmailRes = false;
      } else if (checkForgEmailRes == "doneNewAutoPass") {
        ChangePassFrm.innerHTML =
          '<p2 class="Error_Text">تم تعديل كلمة المرور بنجاح. يرجى التحقق من البريد الإلكتروني لمعرفة كلمة المرور الجديدة</p2><br><button type="button" id="clsSendNewPassMdl" name="clsModalRate" onClick="hideGeneralModal()">حسناً</button>';
      } else if (checkForgEmailRes == "noneNewAutoPass") {
        EnteredEmailErr.innerHTML = "<p2>حدث خطأ اثناء تغيير كلمة المرور</p2>";
      } else {
        EnteredEmailErr.innerHTML = "";
      }
    }
  };

  if (EnteredEmailTxt.value == "") {
    EnteredEmailErr.innerHTML = "يرجى إدخال البريد الإلكتروني الخاص بالحساب!";
    CheckEmailRes = false;
  } else {
    CheckForgetEmailReq.open("POST", "functionalPage/validationOps.php", false);
    CheckForgetEmailReq.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    CheckForgetEmailReq.send(
      "doSendNewPass=new" + "&forgetUserEmail=" + EnteredEmailTxt.value
    );
  }

  return false;
}

function checkSenEmailInfo() {
  const SenderNameErr = document.getElementById("send_nameErr");
  const SenderEmailErr = document.getElementById("send_emailErr");
  const SenderMsgErr = document.getElementById("send_messageErr");
  const SendingEmailErr = document.getElementById("send_SendingErr");

  const SenEmailFrm = document.getElementById("send");
  let SendEmailFrmData = new FormData(SenEmailFrm);

  const SendEmailCheckReq = new XMLHttpRequest();
  SendEmailCheckReq.onreadystatechange = function () {
    if (SendEmailCheckReq.readyState == 4 && SendEmailCheckReq.status == 200) {
      let SendEmailCheckRes = SendEmailCheckReq.responseText;

      if (SendEmailCheckRes == "good") {
        SenEmailFrm.innerHTML =
          "<h2>تم الإرسال بنجاح. شكراً لتواصلكم معنا</h2>";
      } else if (SendEmailCheckRes == "error") {
        SendingEmailErr.innerHTML =
          "حدث خطاء اثناء الإرسال, يرجى إعادة المحاولة";
        SenderNameErr.innerHTML = "";
        SenderEmailErr.innerHTML = "";
        SenderMsgErr.innerHTML = "";
      } else {
        SendingEmailErr.innerHTML = "";
        SendEmailCheckRes = SendEmailCheckRes.split("(#)");
        SenderNameErr.innerHTML = SendEmailCheckRes[0];
        SenderEmailErr.innerHTML = SendEmailCheckRes[1];
        SenderMsgErr.innerHTML = SendEmailCheckRes[2];
      }
    }
  };

  SendEmailFrmData.append("send_Email", "send");
  SendEmailCheckReq.open("POST", "functionalPage/validationOps.php", false);
  SendEmailCheckReq.send(SendEmailFrmData);

  return false;
}
function myFunction(bar) {
  const vlapbt = bar;
  const vlapb = bar + 1000000;
  const vlapbt1 = document.getElementById(vlapb);
  vlapbt1.textContent = "متقدم بالفرصة";

  const vlapfrm = document.getElementById(vlapbt);
  const vlapfrmData = new FormData(vlapfrm);

  UserLoginErr = "";

  const vlapReq = new XMLHttpRequest();

  vlapReq.open("POST", "functionalPage/volunteerPrivilege.php", false);
  vlapfrmData.append("applyToChance", vlapbt);
  vlapReq.send(vlapfrmData);

  return false;
}
