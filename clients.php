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
				<li><a href="clients.php">Clients</a></li>
			</ul>

			<!-- start: Content -->
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Clients</h2>
					</div>
					<div class="box-content">
						<div class="row-fluid">
                        	<div class="x-box span12">
                            	<?php
								$name_sql = "SELECT a.* FROM `user_info` a LEFT JOIN `users` b ON a.user_id=b.id WHERE b.usergroup=2";
								if($userGroup!=1){
									$name_sql .= " AND b.id=$lawyer_id";
								}
								$name_sql .= " ORDER BY b.id ASC";
								
								$name_query = $lawyer->db->query($name_sql);
								$i=1;
								?>
                            	<ul class="nav tab-menu nav-tabs lawyer_list" id="myTab">
                                <?php 
								while($advocate_name = mysqli_fetch_row($name_query)){ 
									if($i==1){
										$cls= 'active';
									}
									else{
										$cls= '';
									}
									echo '<li class="'.$cls.'"><a href="#lawyer_tab_'.$advocate_name[1].'">'.$advocate_name[2].' '.$advocate_name[3].'</a></li>';
									$i++;
                                } 
								$i=1;
								?>
                                </ul>
                                
                                <div id="myTabContent" class="tab-content">
                                <?php 
								$name_query = $lawyer->db->query($name_sql);
								while($advocate_name = mysqli_fetch_row($name_query)){
									if($i==1){
										$cls= 'active';
									}
									else{
										$cls= '';
									}
									$_lawyer_id = $advocate_name[1];
									$client_sql = "SELECT a.*, b.name AS client_name, b.phone FROM `case_info` a LEFT JOIN `clients` b ON a.client_id=b.id WHERE a.lawyer_id='$_lawyer_id' AND status=1 ORDER BY a.id DESC";
									
									$client_query = $lawyer->db->query($client_sql);
									echo '<div class="tab-pane '.$cls.'" id="lawyer_tab_'.$_lawyer_id.'">';
									?>
                                    	<?php 
										if($client_query->num_rows){
										while($client = $client_query->fetch_object()){ ?>
                                        <div class="box">
                                        	<div class="box-content">
                                            	<div class="fluid-btn-area">
                                                	<a class="btn btn-green" href="edit_client.php?id=<?php echo $client->id;?>">Edit</a>
                                                    <a class="btn btn-red" onclick="remove_client('<?php echo $client->id;?>');">Remove</a>
                                                </div>
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
                                                    <div class="span4 heading">Payment:</div>
                                                    <div class="span8"><?php echo $client->payment;?></div> 
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span4 heading">Question:</div>
                                                    <div class="span8"><?php echo $client->question;?></div> 
                                                </div>
                                                <div class="row-fluid">
                                                    <div class="span4 heading">Attachment:</div>
                                                    <div class="span8"><?php if(!empty($client->attachment)){?><a href="action.php?task=download&id=<?php echo $client->id;?>">Download</a><?php } ?></div> 
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
										}
										}else{
											echo 'No any record found';
										}
										?>
                                    <?php
                                    echo '</div>';
									$i++;
								}
								?>
                                </div>    
                            </div>
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
<style type="text/css">
#myTabContent .box .box-content{
	position:relative;
}
#myTabContent .box .box-content .fluid-btn-area{
	position:absolute;
	right:10px;
	top:10px;
}
</style>
<script type="text/javascript">
function remove_client(client_id){
	var con = confirm("Confirm remove this client?");
	if(con){
		location = 'action.php?task=remove_client&id='+client_id;
	}
}
</script>
<?php include(dirname(__FILE__).'/footer.php');?>