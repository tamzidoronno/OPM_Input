<?php 
require_once("class/class.common.php");
$common = new commonClass();
$common->sessionStart();
error_reporting(E_ALL);
include("class/class.admin.php");
$lawyer = new lawyerController();
$lawyer_id = $lawyer->isLogin();

if(!$lawyer_id || !$lawyer->sessionBegin())
{
    $lawyer->logout();
    $common->redirect('login.php');
	//echo "<script> location.replace('login.php')</script>";
	//exit;
}
if(isset($_GET['out']))
{
	$lawyer->logout();
    $common->redirect('login.php');
    //$lawyer->sessionEnd();
	//echo "<script> location.replace('login.php')</script>";
	//exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include(dirname(__FILE__)."/include/head.php"); ?>
<body>
	<!-- start: Header -->
	<?php include(dirname(__FILE__)."/include/header.php")?>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php include(dirname(__FILE__)."/include/menu.php"); ?>
			<!-- end: Main Menu -->
			
			<!-- start: Content -->
			<?php include(dirname(__FILE__)."/include/index_content.php"); ?>
			<!-- end: Content -->
<?php include(dirname(__FILE__)."/include/footer.php")?>