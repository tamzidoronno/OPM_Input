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
				<li><a href="convocation.php">Convocation Date</a></li>
			</ul>

			<!-- start: Content -->
			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white user"></i><span class="break"></span>Convocation Date</h2>
					</div>
					<div class="box-content">
						<div class="row-fluid">
                        	<div class="x-box span12">
                            	<div class="search-form">
                                	<form action="" name="search-client" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    	<fieldset>
                                        	<div class="control-group">
                                            	<label class="control-label" for="keyword">Search Convocation: </label>
                                                <div class="controls">
                                                	<?php 
													if(isset($_POST['keyword']) && !empty($_POST['keyword'])){
														$keyword = date("m/d/Y", strtotime($_POST['keyword']));
													}
													else
														$keyword = '';
													
													
													?>
                                                	<input name="keyword" id="keyword" type="text" class="input-xlarge datepicker" value="<?php echo $keyword;?>" />
                                               
                                                    <input name="submit" type="submit" class="btn btn-primary " value="Search" />
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            	
                                <?php 
								$convocation_sql = "SELECT a.convocation, a.lawyer_id, b.name AS client_name, b.phone FROM `case_info` a LEFT JOIN `clients` b ON a.client_id=b.id LEFT JOIN `users` c ON a.lawyer_id=c.id WHERE a.status=1 AND c.status=1 ";
								if($userGroup!=1){
									$convocation_sql .= " AND a.lawyer_id=$lawyer_id";
								}
								if($keyword){
									$convocation_date = date('Y-m-d', strtotime($keyword));
									$convocation_sql .= " AND a.convocation='$convocation_date'";
								}
								$convocation_sql .= " ORDER BY a.convocation ASC";
							
								$client_query = $lawyer->db->query($convocation_sql);
								?>
									<?php 
									if($client_query->num_rows){
									while($client = $client_query->fetch_object()){ ?>
									<div class="box">
										<div class="box-content">
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
												<div class="span4 heading">Advocate Name:</div>
												<div class="span8"><?php echo $lawyer->name($client->lawyer_id);?></div> 
											</div>
											<div class="row-fluid">
												<div class="span4 heading">Convocation Date:</div>
												<div class="span8"><?php echo ($client->convocation=='0000-00-00') ? '-' : date('m/d/Y', strtotime($client->convocation));?></div> 
											</div>
										</div>
									</div>
									<?php 
									}
									}else{
										echo 'No any record found';
									}
									?>
    
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

<?php include(dirname(__FILE__).'/footer.php');?>