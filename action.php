<?php
session_start();
include("class/class.admin.php");
$lawyer = new lawyerController();
$lawyer_id = $_SESSION['id'];
$userGroup = $_SESSION['group'];

if(!$lawyer->sessionBegin())
{
	header('location: login.php');
}
if(isset($_GET['out']))
{
	$lawyer->sessionEnd();
	header('location: login.php');
}
$task = $_REQUEST['task'];
if($task=='remove_client'){
	$client_id = $_REQUEST['id'];
	$lawyer->removeClient($client_id);
	header('location: clients.php');
}
else if($task=='delete_client'){
	$client_id = $_REQUEST['id'];
	$lawyer->deleteClient($client_id);
	header('location: old_client.php');
}
else if($task=='remove_lawyer'){
	$advocate_id = $_REQUEST['id'];
	if($userGroup==1){
		$lawyer->deleteLawyer($advocate_id);
		header('location: lawyers.php');
	}
	else
		header('location: index.php');
}
else if($task=='download'){
	$case_id = $_REQUEST['id'];
	$lawyer->downloadRDV($case_id);
	header('location: index.php');
}