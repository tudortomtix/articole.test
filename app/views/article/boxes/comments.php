<?php
if (isset($_GET['id'])) {
	$artid = $_GET['id'];
	$arttitle = $vars['article']['title'];
};

$cmtx_identifier = "$artid";
$cmtx_reference  = "$arttitle";

//config
switch ($_SERVER['SERVER_NAME']){
	case 'articole.test'; //dev
		$cmtx_folder     = '/comments/';
		require($cmtx_folder . 'frontend/index.php');
	break;
	case 'localhost'; //dev
		$cmtx_folder     = '/comments/';
		require($cmtx_folder . 'frontend/index.php');
	break;
	case 'ctrlf5.online'; //staging
		$cmtx_folder     = '/work/articole.test/comments/';
		require($_SERVER['DOCUMENT_ROOT'] . $cmtx_folder . 'frontend/index.php');
	break;
}

?>