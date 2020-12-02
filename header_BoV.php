<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="appearancePage/appearance_BoV.css">
	<link rel="stylesheet" href="appearancePage/appearance_Lab_BoV.css">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	
    <title>بنك المتطوعين</title>

</head>
<body>

<?php
include_once('functionalPage/dbConnOps.php');
?>

<header class="head-con">
	<div id="home_header" class="">
		<div class="logo col-11 col-9-p">
			<a href="index.php" style="display:flex !important;">
			<svg class="col-12 col-12-s col-8-p" data-name="Bank Of Volunteers" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54.91 16.48"><defs><style>.cls-1{fill:#fff;}</style></defs><title>Bank Of Volunteers</title><path class="cls-1" d="M13.32,17.32a.6.6,0,0,1-.29-.08,6.8,6.8,0,0,1-2.7-5.12c-.38-3.69,2.82-6,3-6.08a.55.55,0,0,1,.63.89h0S11.11,9,11.42,12a5.73,5.73,0,0,0,2.19,4.3.55.55,0,0,1,.17.75A.53.53,0,0,1,13.32,17.32Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M6.85,17.32a.53.53,0,0,1-.46-.26.56.56,0,0,1,.17-.76A5.66,5.66,0,0,0,8.75,12C9.06,9,6.28,7,6.25,6.93A.55.55,0,0,1,6.88,6c.14.09,3.34,2.39,3,6.08a6.8,6.8,0,0,1-2.7,5.12A.6.6,0,0,1,6.85,17.32Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M10.1,7.7a1.88,1.88,0,0,1,0-3.76h0a1.88,1.88,0,1,1,0,3.76ZM10.1,5a.78.78,0,1,0,.78.78A.79.79,0,0,0,10.1,5Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M13.68,2.29" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M4.49,15.74a.49.49,0,0,1-.21,0,.8.8,0,0,1-.21-.15A8.64,8.64,0,0,1,6.51,1.72.54.54,0,1,1,7,2.7a7.55,7.55,0,0,0-2.4,11.79,4.32,4.32,0,0,0,1.93-3.57L4.77,9.18a.54.54,0,0,1,0-.78.55.55,0,0,1,.77,0l1.9,1.89a.6.6,0,0,1,.16.34,5.42,5.42,0,0,1-2.84,5A.52.52,0,0,1,4.49,15.74Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M15.76,15.74a.54.54,0,0,1-.27-.07,5.43,5.43,0,0,1-2.83-5,.54.54,0,0,1,.16-.34L14.71,8.4a.55.55,0,1,1,.78.78l-1.74,1.74a4.3,4.3,0,0,0,1.92,3.57,7.47,7.47,0,0,0,1.88-5A7.59,7.59,0,0,0,13.27,2.7.54.54,0,0,1,13,2a.54.54,0,0,1,.73-.25,8.67,8.67,0,0,1,4.9,7.79,8.56,8.56,0,0,1-2.48,6.05.45.45,0,0,1-.19.14A.54.54,0,0,1,15.76,15.74Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M10,18.14A8.7,8.7,0,0,1,5.71,17,.55.55,0,0,1,6.26,16a7.53,7.53,0,0,0,7,.28l.38-.19a.54.54,0,0,1,.74.21.55.55,0,0,1-.21.75l-.44.22A8.59,8.59,0,0,1,10,18.14Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M22.11,12a.72.72,0,0,1,.77.66c0,.17-.16.42-.3.43a.64.64,0,0,1,.47.62.76.76,0,0,1-.77.76h-.7a.41.41,0,0,1-.21,0,.3.3,0,0,1-.1-.24V12.25c0-.19.08-.29.26-.29Zm-.33,1h.37a.22.22,0,0,0,.25-.22.25.25,0,0,0-.28-.24h-.34Zm0,1h.48a.28.28,0,0,0,.3-.27c0-.16-.13-.32-.41-.32h-.37Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M25.23,13.25v.95a.24.24,0,0,1-.25.25c-.05,0-.2,0-.2-.18v0a.75.75,0,0,1-.52.23.52.52,0,0,1-.56-.52.61.61,0,0,1,.64-.58.8.8,0,0,1,.45.13v-.16c0-.18-.21-.3-.38-.3s-.24,0-.36,0-.23,0-.23-.19a.22.22,0,0,1,.16-.2,1,1,0,0,1,.44-.09C24.83,12.58,25.23,12.77,25.23,13.25Zm-1,.62c0,.1.12.15.24.15s.3,0,.3-.17-.14-.13-.27-.13S24.19,13.77,24.19,13.87Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M27.39,13.21v1a.25.25,0,0,1-.5,0V13.3a.24.24,0,1,0-.48,0v.88a.22.22,0,0,1-.25.25.22.22,0,0,1-.24-.25V12.84a.23.23,0,0,1,.24-.25.23.23,0,0,1,.25.22.57.57,0,0,1,.44-.23C27.1,12.58,27.39,12.74,27.39,13.21Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M28.52,12.11v1.06l.62-.52a.25.25,0,0,1,.16-.06.26.26,0,0,1,.26.26c0,.08,0,.12-.11.18l-.34.29c.41.77.48.68.48.86a.22.22,0,0,1-.24.25.26.26,0,0,1-.23-.13l-.4-.7s-.19.16-.2.18v.4a.24.24,0,1,1-.48,0V12.11c0-.16.07-.25.24-.25A.22.22,0,0,1,28.52,12.11Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M33.1,13.51a.85.85,0,0,1-.83.94.87.87,0,0,1-.82-1,.84.84,0,0,1,.82-.93A.86.86,0,0,1,33.1,13.51Zm-1.15,0c0,.23.1.54.32.54s.33-.26.33-.48-.1-.52-.33-.52S32,13.25,32,13.47Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M34.88,12.1a.2.2,0,0,1-.21.2.18.18,0,0,0-.17.2v.11h0c.17,0,.26.05.26.22s-.08.22-.26.22h0v1.13a.22.22,0,0,1-.24.25.23.23,0,0,1-.25-.25V13c-.16,0-.24,0-.24-.21s.08-.22.25-.22v-.22a.57.57,0,0,1,.61-.53C34.78,11.86,34.88,11.94,34.88,12.1Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M37,12.14l.47,1.4c.16-.45.3-.95.46-1.4a.24.24,0,0,1,.24-.19.3.3,0,0,1,.28.27.24.24,0,0,1,0,.09l-.65,1.84c-.06.18-.16.28-.3.28s-.23-.09-.29-.26l-.67-1.86a.44.44,0,0,1,0-.1.23.23,0,0,1,.26-.26A.26.26,0,0,1,37,12.14Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M40.72,13.51a.85.85,0,0,1-.83.94.87.87,0,0,1-.82-1,.84.84,0,0,1,.82-.93A.86.86,0,0,1,40.72,13.51Zm-1.15,0c0,.23.1.54.32.54s.33-.26.33-.48-.1-.52-.33-.52S39.57,13.25,39.57,13.47Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M41.83,12.11v2.07a.22.22,0,0,1-.24.25c-.18,0-.25-.08-.25-.25V12.11c0-.17.08-.25.24-.25A.22.22,0,0,1,41.83,12.11Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M44,12.83v1.4c0,.16-.08.23-.24.23a.18.18,0,0,1-.19-.19v-.1a.61.61,0,0,1-.49.27c-.29,0-.57-.27-.57-.75v-.84a.22.22,0,0,1,.25-.25c.17,0,.24.08.24.25v.75c0,.31.11.37.23.37s.3-.16.3-.47v-.67c0-.15,0-.24.23-.24A.21.21,0,0,1,44,12.83Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M46.19,13.21v1a.22.22,0,0,1-.25.25.22.22,0,0,1-.24-.25V13.3a.26.26,0,0,0-.24-.29.27.27,0,0,0-.25.29v.88a.22.22,0,0,1-.25.25c-.15,0-.23-.09-.23-.25V12.84a.24.24,0,0,1,.48,0,.57.57,0,0,1,.44-.23C45.9,12.58,46.19,12.74,46.19,13.21Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M47.53,12.49v.13h.14c.17,0,.25,0,.25.2s-.08.2-.25.2h-.14v.76c0,.13,0,.19.07.19s.26.08.26.24-.09.24-.26.24c-.46,0-.56-.25-.56-.67V13c-.13,0-.22-.06-.22-.2s.09-.18.22-.2v-.13a.21.21,0,0,1,.24-.24C47.45,12.25,47.53,12.33,47.53,12.49Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M50.18,13.37c0,.25-.15.25-.39.25h-.72a.41.41,0,0,0,.42.38c.24,0,.34-.2.51-.2s.18.06.18.21a.18.18,0,0,1-.06.15.84.84,0,0,1-.68.3.88.88,0,0,1-.87-1,.86.86,0,0,1,.82-.94A.74.74,0,0,1,50.18,13.37Zm-1.09-.08h.59A.28.28,0,0,0,49.4,13,.3.3,0,0,0,49.09,13.29Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M52.48,13.37c0,.25-.15.25-.39.25h-.73a.41.41,0,0,0,.42.38c.25,0,.34-.2.52-.2s.18.06.18.21a.22.22,0,0,1-.06.15.84.84,0,0,1-.68.3.88.88,0,0,1-.87-1,.86.86,0,0,1,.82-.94A.74.74,0,0,1,52.48,13.37Zm-1.09-.08H52A.28.28,0,0,0,51.7,13,.3.3,0,0,0,51.39,13.29Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M54.38,12.83a.25.25,0,0,1-.25.25h-.19a.25.25,0,0,0-.26.24v.88a.22.22,0,0,1-.25.25.22.22,0,0,1-.24-.25V12.84c0-.17.08-.25.24-.25a.2.2,0,0,1,.21.2.56.56,0,0,1,.39-.23C54.28,12.56,54.38,12.7,54.38,12.83Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M56.29,12.65a.23.23,0,0,1,.13.2.21.21,0,0,1-.22.21c-.17,0-.3-.1-.48-.1s-.14,0-.14.12.9.27.9.79-.38.58-.72.58a1.12,1.12,0,0,1-.61-.18.23.23,0,0,1-.1-.2.22.22,0,0,1,.23-.21c.19,0,.28.17.53.17.09,0,.15,0,.15-.11,0-.25-.87-.27-.87-.82,0-.39.32-.56.69-.56A1,1,0,0,1,56.29,12.65Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M22.6,6.26a.43.43,0,0,0,.44,0,.36.36,0,0,0,.15-.15.43.43,0,0,0,0-.44A.54.54,0,0,0,23,5.52a.43.43,0,0,0-.44,0,.54.54,0,0,0-.15.15.55.55,0,0,0-.06.22.55.55,0,0,0,.06.22A.54.54,0,0,0,22.6,6.26Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M26.23,10.34a.5.5,0,0,0-.21-.05.46.46,0,0,0-.21.05.36.36,0,0,0-.15.15.42.42,0,0,0-.06.21.43.43,0,0,0,.06.22.36.36,0,0,0,.15.15.4.4,0,0,0,.42,0,.33.33,0,0,0,.16-.15.48.48,0,0,0,.05-.22.5.5,0,0,0-.05-.21A.46.46,0,0,0,26.23,10.34Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M27.36,10.34a.54.54,0,0,0-.21-.05.54.54,0,0,0-.22.05.39.39,0,0,0-.2.36.54.54,0,0,0,.05.22.54.54,0,0,0,.15.15.43.43,0,0,0,.22.06.37.37,0,0,0,.21-.06.33.33,0,0,0,.16-.15.48.48,0,0,0,.05-.22.5.5,0,0,0-.05-.21A.57.57,0,0,0,27.36,10.34Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M30.28,9h-.91a1,1,0,0,1-.45-.08.45.45,0,0,1-.23-.22.81.81,0,0,1-.07-.33A.74.74,0,0,1,28.69,8a.5.5,0,0,1,.23-.25.83.83,0,0,1,.45-.1h.43a.41.41,0,0,0,.3-.09.4.4,0,0,0,.1-.3A.38.38,0,0,0,30.1,7a.38.38,0,0,0-.3-.1h-.46a2.2,2.2,0,0,0-.71.11,1.16,1.16,0,0,0-.45.31,1.13,1.13,0,0,0-.26.45,1.92,1.92,0,0,0-.08.55,1.69,1.69,0,0,0,.08.56L28,9H27V7.19a.38.38,0,0,0-.09-.29.37.37,0,0,0-.28-.09.34.34,0,0,0-.39.38V9H24.57V7.2a.43.43,0,0,0-.1-.31.4.4,0,0,0-.3-.1.41.41,0,0,0-.31.1.48.48,0,0,0-.1.31V9.44a1.12,1.12,0,0,1-.08.46c-.12.24-.36.35-.75.33a.83.83,0,0,1-.76-.35.91.91,0,0,1-.11-.47V7.54A.46.46,0,0,0,22,7.23a.4.4,0,0,0-.3-.1.41.41,0,0,0-.31.1.46.46,0,0,0-.09.31V9.45a2,2,0,0,0,.11.72,1.33,1.33,0,0,0,.31.47,1.21,1.21,0,0,0,.47.26,2.53,2.53,0,0,0,1.49,0,1.35,1.35,0,0,0,.47-.26,1.21,1.21,0,0,0,.33-.48,1.6,1.6,0,0,0,.11-.52.38.38,0,0,0,.28.09h1.73a.42.42,0,0,0,.33-.12L27,9.57a.33.33,0,0,0,.34.19h3a.38.38,0,0,0,.3-.1.37.37,0,0,0,.1-.28.33.33,0,0,0-.1-.27A.38.38,0,0,0,30.28,9Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M39.32,6.13a.47.47,0,0,0,.42,0A.41.41,0,0,0,39.9,6a.47.47,0,0,0,0-.42.33.33,0,0,0-.16-.15.39.39,0,0,0-.21-.06.37.37,0,0,0-.21.06.28.28,0,0,0-.15.15.37.37,0,0,0-.06.21.39.39,0,0,0,.06.21A.38.38,0,0,0,39.32,6.13Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M40.44,6.13a.54.54,0,0,0,.22,0,.46.46,0,0,0,.21,0A.41.41,0,0,0,41,6a.47.47,0,0,0,0-.42.38.38,0,0,0-.16-.15.39.39,0,0,0-.21-.06.43.43,0,0,0-.22.06.29.29,0,0,0-.14.15.37.37,0,0,0-.06.21A.39.39,0,0,0,40.3,6,.43.43,0,0,0,40.44,6.13Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M45.54,5.52a.34.34,0,0,0-.39.39V9h-1a.75.75,0,0,0,.06-.13,2,2,0,0,0,.08-.55,1.91,1.91,0,0,0-.08-.54A1.51,1.51,0,0,0,44,7.31,1.14,1.14,0,0,0,43.58,7,1.35,1.35,0,0,0,43,6.86a1.2,1.2,0,0,0-.55.12,1.16,1.16,0,0,0-.39.31,1.35,1.35,0,0,0-.24.46,1.61,1.61,0,0,0-.09.54,1.67,1.67,0,0,0,.09.55.44.44,0,0,0,.06.16H40.5V7.19a.38.38,0,0,0-.1-.29.35.35,0,0,0-.28-.09.34.34,0,0,0-.39.38V9H38.08V8.51A1.63,1.63,0,0,0,38,8a1.48,1.48,0,0,0-.28-.45,1.8,1.8,0,0,0-.4-.33A1.83,1.83,0,0,0,36.8,7a2,2,0,0,0-.54-.08A2.6,2.6,0,0,0,35.7,7a1.66,1.66,0,0,0-.5.18l0,0V5.92a.34.34,0,0,0-.38-.38.33.33,0,0,0-.38.38V9h-.67c0-.19,0-.41,0-.67a2,2,0,0,0-.37-1,1.16,1.16,0,0,0-.4-.33,1.2,1.2,0,0,0-.55-.12,1.25,1.25,0,0,0-.56.12,1,1,0,0,0-.39.32,1.31,1.31,0,0,0-.25.45,2,2,0,0,0-.08.55,2.1,2.1,0,0,0,.08.56,1.63,1.63,0,0,0,.25.47,1.28,1.28,0,0,0,.39.34,1.37,1.37,0,0,0,1.05,0,1.15,1.15,0,0,1-.07.24.56.56,0,0,1-.37.32,3.67,3.67,0,0,1-.51,0h-.1a.51.51,0,0,0-.3.08.43.43,0,0,0-.13.28.44.44,0,0,0,0,.2.42.42,0,0,0,.11.16.93.93,0,0,0,.54.09,1.84,1.84,0,0,0,1.19-.37,1.38,1.38,0,0,0,.34-.49,2.67,2.67,0,0,0,.13-.57.41.41,0,0,0,.29.12h3.68a.59.59,0,0,0,.26,0A.24.24,0,0,0,38,9.64a.43.43,0,0,0,.29.12h1.73a.42.42,0,0,0,.33-.12l0-.07a.34.34,0,0,0,.35.19H43a1.35,1.35,0,0,0,.55-.11,1,1,0,0,0,.37-.3v0a.34.34,0,0,0,.39.38h1.13a.42.42,0,0,0,.33-.12.46.46,0,0,0,.11-.35V5.91a.37.37,0,0,0-.1-.29A.33.33,0,0,0,45.54,5.52ZM32.84,8.59a.85.85,0,0,1-.09.24.55.55,0,0,1-.16.18.38.38,0,0,1-.22.06A.32.32,0,0,1,32.14,9a.62.62,0,0,1-.15-.2,1.22,1.22,0,0,1-.09-.27,1.41,1.41,0,0,1,0-.28,1.22,1.22,0,0,1,0-.26A.79.79,0,0,1,32,7.75a.46.46,0,0,1,.15-.16.56.56,0,0,1,.23-.07.39.39,0,0,1,.22.08.46.46,0,0,1,.16.2,1.45,1.45,0,0,1,.09.25c0,.1,0,.19,0,.28A2.28,2.28,0,0,1,32.84,8.59ZM37.32,9H35.16V8.37a.5.5,0,0,1,.09-.24.82.82,0,0,1,.24-.25,1.37,1.37,0,0,1,.35-.15,1.42,1.42,0,0,1,.42-.05,1.74,1.74,0,0,1,.39.05A1.2,1.2,0,0,1,37,7.9a.78.78,0,0,1,.24.27.69.69,0,0,1,.09.36ZM43.25,9A.4.4,0,0,1,43,9a.32.32,0,0,1-.22-.08.81.81,0,0,1-.27-.57.7.7,0,0,1,.27-.74A.38.38,0,0,1,43,7.55a.33.33,0,0,1,.22.08.77.77,0,0,1,.28.65A.75.75,0,0,1,43.25,9Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M46.71,5.61a.34.34,0,0,0-.39.38V9.38a.38.38,0,0,0,.1.29.4.4,0,0,0,.29.09A.39.39,0,0,0,47,9.67a.38.38,0,0,0,.1-.29V6A.34.34,0,0,0,46.71,5.61Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M50.63,7.72h.71a.21.21,0,0,0,.17-.06.2.2,0,0,0,.06-.16.21.21,0,0,0-.06-.17.29.29,0,0,0-.17,0h0a.57.57,0,0,1-.24,0,.35.35,0,0,1-.15-.11.21.21,0,0,1,0-.13.19.19,0,0,1,0-.1.13.13,0,0,1,.1-.07.55.55,0,0,1,.21,0h.13a.21.21,0,0,0,.17-.06.22.22,0,0,0,.06-.17.18.18,0,0,0-.06-.16.24.24,0,0,0-.17-.06h-.21a.85.85,0,0,0-.29,0,.66.66,0,0,0-.22.12.33.33,0,0,0-.13.16.53.53,0,0,0,0,.2.5.5,0,0,0,.06.24.63.63,0,0,0,.19.21h-.09l-.1,0a.13.13,0,0,0-.06.07.11.11,0,0,0,0,.08.22.22,0,0,0,.05.16A.22.22,0,0,0,50.63,7.72Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M54.28,6.13a.46.46,0,0,0,.21,0,.51.51,0,0,0,.22,0A.39.39,0,0,0,54.86,6a.4.4,0,0,0,0-.42.36.36,0,0,0-.15-.15.43.43,0,0,0-.22-.06.37.37,0,0,0-.21.06.31.31,0,0,0-.15.15.37.37,0,0,0-.06.21.39.39,0,0,0,.06.21A.46.46,0,0,0,54.28,6.13Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M56.42,6.9a.35.35,0,0,0-.28-.09.34.34,0,0,0-.39.38V9H54.9V7.19a.38.38,0,0,0-.09-.29.37.37,0,0,0-.28-.09.34.34,0,0,0-.39.38V9h-.86V5.9a.42.42,0,0,0-.09-.29.38.38,0,0,0-.28-.09.34.34,0,0,0-.38.38V9H50.08a.75.75,0,0,1-.31-.06.53.53,0,0,1-.23-.27,1,1,0,0,1-.08-.46v-1a.44.44,0,0,0-.1-.32.46.46,0,0,0-.31-.09.4.4,0,0,0-.29.09.44.44,0,0,0-.1.32v1a1.94,1.94,0,0,0,.12.72,1.07,1.07,0,0,0,.32.47,1.18,1.18,0,0,0,.48.26,1.9,1.9,0,0,0,.54.07h2.73a.49.49,0,0,0,.33-.11l0-.08a.31.31,0,0,0,.33.19h.9a.42.42,0,0,0,.33-.12l.05-.07a.33.33,0,0,0,.34.19h.89a.42.42,0,0,0,.33-.12.54.54,0,0,0,.12-.36V7.19A.38.38,0,0,0,56.42,6.9Z" transform="translate(-1.61 -1.66)"/><path class="cls-1" d="M56.08,10.36a.51.51,0,0,0-.21-.06.47.47,0,0,0-.21.06.31.31,0,0,0-.15.15.4.4,0,0,0,0,.42.33.33,0,0,0,.15.16.4.4,0,0,0,.42,0,.41.41,0,0,0,.16-.16.47.47,0,0,0,0-.42A.46.46,0,0,0,56.08,10.36Z" transform="translate(-1.61 -1.66)"/></svg>
</a>
			</div>
	<?php
		
		if (isset($_SESSION['userType']) && isset($_SESSION['userID'])) {
			$userID = $_SESSION['userID'];
			$userType = $_SESSION['userType'];
			$userImage='';
			$UserName='';
			$userRate='';
			$agencyNav='';
			$agencyNavn='';
			$agencyNavBtn='';
			$vlPage='';
			$vlPagen='';
			$vlPageBtnPhone='';
			$agencyNavBtnPhone='';
			$agencyToShoww='';
			$NotCount = getSingleValue("chanceapplication", "COUNT(ap_ID)", "ap_volID = ".$userID." AND ap_AcceptVol = 1 ", -1);

			if ($userType == 'ag_uid') {
				$agencyToShow = getSingleValue('agency', 'ag_Name', 'ag_ID = '.$userID, -1);
				$agencyToShoww = getSingleValue('agency', 'ag_Appreviation', 'ag_ID = '.$userID, -1);
				$userImage ='agPP/';
				$userImage .= getSingleValue('agency', 'ag_Photo', 'ag_ID = '.$userID, -1);
				$UserName = $agencyToShoww;
				$agencyNavBtn = '<div class="col-6 col-2-p">
				<a href="singleAg_BoV.php?showAgency='.$agencyToShow.'" id="main_page" style="color: #fff !important" >
					<div id="img_natification"  class="col-4 col-12-p">
					<img src="'.$userImage.'" alt="none">
					</div>
					<div id="natification_name" class="col-8 col-9-p">
					<span class="col-12" >'.$UserName.' </span>
					</div>
				</a>
				</div>';
				$agencyNavBtnPhone = '<li class="phone-hide"><a href="singleAg_BoV.php?showAgency='.$agencyToShow.'" id="main_page" class="vavImage"><img src="'.$userImage.'" alt="none"></a>
				</li>';
			}
			elseif ($userType == 'vl_uid' || $userType == 'au_uid'){
				$agencyNav = '<li><a href="agency_BoV.php" class="fab fa-first-order fa-lg" id="main_page" ></a></li>';
				$agencyNavn ='<li><a href="agency_BoV.php" class="icon" id="main_page" >الجهات</a></li>';
			}
			$vlPageBtn = '';
			if ($userType == 'vl_uid') {
				$vlToShow = getSingleValue('volunteer', 'vl_UserName', 'vl_ID = '.$userID, 'none');
				$UserName =explode(" ", $vlToShow);
				$userImage ='vlPP/';
				$userImage .= getSingleValue('volunteer', 'vl_Photo', 'vl_ID = '.$userID, -1);
				$userRate = getSingleValue('chanceapplication', 'Round(AVG(ap_volRate), 1)', 'ap_volID = '.$userID, 0);
				if($userRate== null)
				$userRate="0.0";
				$vlPageBtn = '<div class="col-6 col-2-p">
				<a href="volunteer_BoV.php?showVol='.$vlToShow.'" id="main_page" style="color: #fff !important">
					<div id="img_natification"  class="col-4 col-12-p">
					<img src="'.$userImage.'" alt="none">
					</div>
					<div id="natification_name" class="col-8 col-9-p">
					<span class="col-12" >'.$UserName[0].' </span>
					<span class="col-12" style=" background-color: #f0a032; border-radius: 50px; margin: 0 30%; ">'.$userRate.'</span>
					</div>
				</a>
				</div>';
				$vlPageBtnPhone = '<li class="phone-hide"><a href="volunteer_BoV.php?showVol='.$vlToShow.'" id="main_page" ><img class="vavImage" src="'.$userImage.'" alt="none"></a>
				</li>';
			} elseif ($userType == 'au_uid') {
				$vlPage = '<li><a class="fas fa-users fa-lg" href="volunteer_BoV.php" id="main_page" ></a></li>';
				$vlPagen = '<li><a class="icon" href="volunteer_BoV.php" id="main_page" >المت طوعين</a></li>';
			}

            if ($userType == 'au_uid') {
				$adminNavBtn = '<div class="col-2 col-2-p"><a href="adminEditor_BoV.php"  class="fas fa-users-cog fa-lg" id="main_page"></a></div>';
				$adminNavBtnPhone = '<li class="phone-hide"><a href="adminEditor_BoV.php"  class="fas fa-users-cog fa-lg" id="main_page"></a></li>';
            } else {
				$adminNavBtn = '';
				$adminNavBtnPhone='';
			}
			if ($userType == 'vl_uid' || $userType == 'ag_uid') {
				$natification='<li class="phone-hide"><a class="far fa-bell fa-lg" onclick="AppearNot()"><span id="countTow"></span></a></li>';
				$natifications='<div class="col-2 col-2-p">
				<li class="far fa-bell fa-lg" id="img_natification_bell" src="vlPP/notification.png" alt="none"  onclick="AppearNot()"><span id="count"></span></li>
				</div>';
            } else {
				$natification = '';
				$natifications='';
            }

			echo(
      		'<div class="searchBox col-12-s">
			  <div class="col-10-s" id="searchField">
			 		 <input class="col-9-s col-9" id="searchTxt"  type="text" name="Search_Box" placeholder="عن ماذا تريد البحث؟">
					 <a class="searchBt col-3-s col-3 fas fa-search fa-lg" href="#" onClick="searchForText()"></a>
			  </div>
			  <div class="col-2-s phone-hide">
					<i class="fas fa-sign-out-alt fa-lg" value="off" onClick="EndSession()"></i>
				</div>
		  </div>
			<div class="navMenu">
			 <ul id="navMenu" class="nav">
				  <li><a class="fas fa-home fa-lg" href="index.php"></a></li>
				  <li><a href="chance_BoV.php" class="fas fa-newspaper fa-lg"></a></li>
					'.$agencyNav.' 
					'.$vlPage.'
					'.$natification.'
					'.$vlPageBtnPhone.'
					'.$agencyNavBtnPhone.'
					'.$adminNavBtnPhone.'
				</ul>
				<ul id="navMenu" class="nav">
					<li><a class="icon" href="index.php">الرئيسية</a></li>
					<li><a href="chance_BoV.php" class="icon">الفرص</a></li>
					'.$agencyNavn.' 
					'.$vlPagen.'
				</ul>
			</div>

			<div class="natification_profile">
				'.$vlPageBtn.' '.$agencyNavBtn.''.$adminNavBtn.''.$natifications.'
				<div class="col-2">
					<li class="fas fa-sign-out-alt fa-lg" value="off" onClick="EndSession()"></li>
				</div>
				<!--<span class="natification_Rate_Line"></span> --> 
			</div>'
		);
		 
            
		} else {
			echo('
			<div class="sgin-to col-12-s">
			<div class="col-4-s">
				<i class="fas fa-sign-in-alt fa-lg" id="sign-icon" onclick="apearsgin()" ></i>
				</div>
			</div>
			<div class="sign_in" id="sign-box">
			<form action="functionalPage/loginOps.php" id="sign_in" method="POST" onsubmit="return checkLoginInfo()">
            <input type="text" id="enteredUserID" name="enteredUserID" placeholder="إسم المستخدم / البريد الإلكتروني">
            <input type="password" id="enteredUserCode" name="enteredUserCode" placeholder="كلمة المرور">
            <button type="submit" id="loginUserBtn" name="loginUserBtn">تسجيل الدخول</button>
            <p class="Error-Text" id="logiErr"></p>
            <p id="forget" name="forgetPass" onClick="showForgetPassMdl()" style="cursor: pointer;">نسيت كلمة المرور؟</p>
        </form></div>');
		}
	?>
	</div>
</header>

<div id="Not"></div>
<div id="generalMdl" class="ShowModal">
</div>
<div id="notificationContainer">
			<div id="notificationTitle">
				<h2>الإشعارات</h2>
			</div>
			<div id="notificationsBody" class="notifications"></div>
</div>

<div id="searchResult" class="col-12-p">



