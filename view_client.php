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
$case_id = (int)$_REQUEST['id'];

$client_sql = "SELECT a.*, b.name AS client_name, b.phone, CONCAT(c.first_name, ' ', c.last_name) AS lawyer_name FROM `case_info` a LEFT JOIN `clients` b ON a.client_id=b.id LEFT JOIN user_info c ON a.lawyer_id=c.user_id WHERE a.id=$case_id";
if($userGroup!=1){
	$client_sql .= " AND a.lawyer_id=$lawyer_id";
}
$client_query = $lawyer->db->query($client_sql);
if(!$client_query->num_rows){
	header('location: index.php');
}else{
	$client = $client_query->fetch_object();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include(dirname(__FILE__)."/include/head.php"); ?>
<body>
		<!-- start: Header -->
	<?php include(dirname(__FILE__)."/include/header.php"); ?>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<?php include(dirname(__FILE__)."/include/menu.php"); ?>
			<!-- end: Main Menu -->
			
			
			<!-- start: Content -->
			<div id="content" class="span10">
						
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Client</a></li>
			</ul>
				
				
			<!-- start: Main Menu -->
			
			<!-- end: Main Menu -->
			
			
			<!-- start: Content -->
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Client</h2>
                        <?php /*?><div class="box-icon">
							<a class="btn-minimize" onClick="window.print();"><i class=" icon-print"></i></a>
						</div><?php */?>
                        <div class="header-icon">
                        	<a class="btn-edit" href="edit_client.php?id=<?php echo $case_id;?>"><i class=" icon-edit"></i></a>
                        	<a class="btn-print" onClick="window.print();"><i class=" icon-print"></i></a>
                        </div>
					</div>
					<div class="box-content">
					<?php
					//echo "Client information saved";
					
					?>
                    	<div class="row-fluid">
                            <div class="span4 heading">Dossier:</div>
                            <div class="span8"><?php echo $client->dossier;?></div> 
                        </div>
						<div class="row-fluid">
                            <div class="span4 heading">Client Name:</div>
                            <div class="span8"><?php echo $client->client_name;?></div> 
                        </div>
                        <div class="row-fluid">
                            <div class="span4 heading">Phone No:</div>
                            <div class="span8"><?php echo $client->phone;?></div> 
                        </div>
                        <div class="row-fluid">
                            <div class="span4 heading">Receive Date:</div>
                            <div class="span8"><?php echo date('m/d/Y', strtotime($client->receive_date));?></div> 
                        </div>
                        <div class="row-fluid">
                            <div class="span4 heading">Where:</div>
                            <?php
                                if($client->location==1)
                                    $where = 'OFPRA';
                                else if($client->location==2)
                                    $where = 'CNDA';
                                else if($client->location==3)
                                    $where = 'IMMIGRATION';
                            ?>
                            <div class="span8"><?php echo $where;?></div> 
                        </div>
                        <div class="row-fluid">
                            <div class="span4 heading">Recours:</div>
                            <?php
                                if($client->recours==1)
                                    $recours = 'OK';
                                else if($client->recours==2)
                                    $recours = 'NOT YET';
                            ?>
                            <div class="span8"><?php echo $recours;?></div> 
                        </div>
                        <div class="row-fluid">
                            <div class="span4 heading">Aj:</div>
                            <?php
                                if($client->aj==1)
                                    $aj = 'OK';
                                else if($client->aj==2)
                                    $aj = 'IMPOSSIBLE';
                                else if($client->aj==3)
                                    $aj = 'NOT YET';
                            ?>
                            <div class="span8"><?php echo $aj;?></div> 
                        </div>
                        <div class="row-fluid">
                            <div class="span4 heading">Convocation:</div>
                            <?php $convocation = $client->convocation!='0000-00-00' ? date("m/d/Y", strtotime($client->convocation)) : '';?>
                            <div class="span8"><?php echo $convocation;?></div> 
                        </div>
                        <div class="row-fluid">
                            <div class="span4 heading">Document Last Date:</div>
                            <?php $doc_last_date = $client->doc_last_date!='0000-00-00' ? date("m/d/Y", strtotime($client->doc_last_date)) : '';?>
                            <div class="span8"><?php echo $doc_last_date;?></div> 
                        </div>
                        <div class="row-fluid">
                            <div class="span4 heading">Payment:</div>
                            <div class="span8"><?php echo $client->payment;?></div> 
                        </div>
                        <div class="row-fluid">
                            <div class="span4 heading">Advocate Name:</div>
                            <div class="span8"><?php echo $lawyer->name($client->lawyer_id);?></div> 
                        </div>
                        <div class="row-fluid">
                            <div class="span4 heading">Question:</div>
                            <div class="span8"><?php echo $client->question;?></div> 
                        </div>
                        <div class="row-fluid">
                            <div class="span4 heading">Attachment:</div>
                            <div class="span8"><?php if(!empty($client->attachment)){?><a href="action.php?task=download&id=<?php echo $client->id;?>">Download</a><?php } ?></div> 
                        </div>
                        <div class="row-fluid">
                            <div class="span4 heading">RDV:</div>
                            <?php $rdv = $client->rdv!='0000-00-00' ? date("m/d/Y", strtotime($client->rdv)) : '';?>
                            <div class="span8"><?php echo $rdv;?></div> 
                        </div>
					</div>
				</div><!--/span-->

			</div><!--/row-->
                
			<!-- end: Content -->
		</div><!--/#content.span10-->
		</div><!--/fluid-row-->
	
	<div class="clearfix"></div>
	</div>
	<footer>

		<p>
			<span style="text-align:left;float:left">&copy; 2015 </span>
			
		</p>

	</footer>

<?php include(dirname(__FILE__).'/footer.php');?>