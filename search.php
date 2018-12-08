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
				<li><a href="search.php">Search</a></li>
			</ul>

			<!-- start: Content -->
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Search</h2>
					</div>
					<div class="box-content">
						<div class="row-fluid">
                        	<div class="x-box span12 client-list">
                            	<div class="search-form">
                                	<form action="" name="search-client" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    	<fieldset>
                                        	<div class="control-group">
                                            	<label class="control-label" for="keyword">Search Client: </label>
                                                <div class="controls">
                                                	<?php 
													if(isset($_POST['keyword']) && !empty($_POST['keyword'])){
														$keyword = strtolower($_POST['keyword']);
													}
													else
														$keyword = '';
													
													$client_list_sql = "SELECT DISTINCT(a.dossier) FROM `case_info` a WHERE status=1 AND a.dossier!='' ";
													if($userGroup!=1){
														$client_list_sql .= " AND a.lawyer_id=$lawyer_id";
													}
					/*
						$lawyer_sql = "SELECT a.*,b.* FROM `profile` a LEFT JOIN `officer_skills` b ON b.BA_No=a.BA_No";
$lawyer_sql .= "  WHERE a.BA_No='".$_POST['keyword']."' OR a.BA_No_Type='".$_POST['keyword']."' ORDER BY b.id ASC";
echo $lawyer_sql;
$lawyer_query = $lawyer->db->query($lawyer_sql);
$lawye0r_query = $lawyer->db->query($lawyer_sql);
					*/
													$client_list_sql .= " ORDER BY a.dossier ASC";
													$query = $lawyer->db->query($client_list_sql);
													$searchKeyword = array();
													if($query->num_rows){
														while($client = $query->fetch_object()){
															$searchKeyword[] = $client->dossier;
														}
													}
													{
													?>
                                                	<input name="keyword" id="keyword" type="text" class="input-xlarge" value="<?php echo $keyword;?>" />
                                                    <?php } ?>
                                                    <input name="submit" type="submit" class="btn btn-primary " value="Search" />
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            	<?php
								if($keyword){
									$client_sql = "SELECT a.*, b.name AS client_name, b.phone, CONCAT(c.first_name, ' ', c.last_name) AS lawyer_name FROM `case_info` a LEFT JOIN `clients` b ON a.client_id=b.id LEFT JOIN user_info c ON a.lawyer_id=c.user_id WHERE LOWER(a.dossier) LIKE '%".$lawyer->db->real_escape_string($keyword)."%'";
									
									if($userGroup!=1){
										$client_sql .= " AND a.lawyer_id=$lawyer_id";
									}
									$client_sql .= " ORDER BY a.id DESC";
									
									$client_query = $lawyer->db->query($client_sql);
									?>
                                    	<?php 
										if($client_query->num_rows){
										while($client = $client_query->fetch_object()){ ?>
                                        <div class="box">
                                        	<div class="box-content">
                                            	<?php if($client->status==0){ ?>
                                            	<span class="fluid-old">Old Client</span>
                                                <?php }else{ ?>
                                                	<div class="fluid-btn-area">
                                                		<a class="btn btn-green" href="edit_client.php?id=<?php echo $client->id;?>">Edit</a>
                                                	</div>
                                                <?php } ?>
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
                                                    <div class="span4 heading">Advocate:</div>
                                                    <div class="span8"><?php echo $client->lawyer_name;?></div> 
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
.chzn-container-single .chzn-single{
	height:32px;
}
#keyword_chzn + .btn{
	display:inline-block;
	position:relative;
	margin-top:-26px;
}
.client-list .box .box-content{
	position:relative;
}
.client-list .box .box-content .fluid-old{
	position:absolute;
	right:10px;
	top:10px;
	background:#F00;
	color:#fff;
	text-transform:uppercase;
	padding:10px;
}
.client-list .box .box-content .fluid-btn-area{
	position:absolute;
	right:10px;
	top:10px;
}
</style>
<script type="text/javascript">
var searchKeyword = ["<?php echo implode('","',$searchKeyword);?>"];
</script>
<?php include(dirname(__FILE__).'/footer.php');?>